<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Person;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Registration;
use App\Models\Organization;
use App\Models\OrganizationMembership;
use App\Models\CampusProfile;
use App\Models\CompanyProfile;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        $roles = Role::all();
        return view('auth.login', compact('roles'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status !== 'active') {
                Auth::logout();
                return back()->with('error', 'Akun Anda dinonaktifkan oleh administrator.');
            }

            return $this->redirectBasedOnRole($user);
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * One-click demo login helper
     */
    public function quickLogin($email)
    {
        abort_unless(app()->environment(['local', 'testing']), 404);

        $user = User::where('email', $email)->first();
        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();
            return $this->redirectBasedOnRole($user)->with('success', "Berhasil masuk sebagai {$user->name} ({$user->activeRole?->name}).");
        }

        return redirect()->route('login')->with('error', 'Pengguna tidak ditemukan.');
    }

    /**
     * Switch active role for users with multiple roles (BR-10)
     */
    public function switchRole(Request $request)
    {
        $request->validate(['role_id' => 'required|exists:roles,id']);
        $user = Auth::user();

        if ($user->roles->contains('id', $request->role_id) || $user->isSuperAdmin()) {
            $user->update(['active_role_id' => $request->role_id]);
            $role = Role::find($request->role_id);
            return $this->redirectBasedOnRole($user->fresh())->with('success', "Peran aktif berhasil dialihkan ke: {$role->name}");
        }

        return back()->with('error', 'Anda tidak memiliki hak untuk peran tersebut.');
    }

    public function showRegister(Request $request)
    {
        $category = $request->query('category', 'pengunjung');
        $event = Event::active();
        return view('auth.register', compact('category', 'event'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
            'category' => 'required|in:pengunjung,kampus,industri,sponsor,sekolah',
            'organization_name' => 'required_unless:category,pengunjung|nullable|string|max:255',
        ]);

        $event = Event::active();
        abort_unless($event, 503, 'Pendaftaran belum tersedia karena acara aktif belum dikonfigurasi.');
        $roleSlug = match($request->category) {
            'kampus' => 'pic-kampus',
            'industri' => 'pic-industri',
            'sponsor' => 'pic-sponsor',
            'sekolah' => 'pic-sekolah',
            default => 'pengunjung',
        };

        $role = Role::where('slug', $roleSlug)->first();

        $organizationType = [
            'kampus' => 'campus',
            'industri' => 'industry',
            'sponsor' => 'sponsor',
            'sekolah' => 'school',
        ][$request->category] ?? null;

        $user = DB::transaction(function () use ($request, $event, $role, $organizationType) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'active_role_id' => $role?->id,
                'status' => 'active',
                'is_verified' => true,
            ]);

            if ($role) $user->roles()->attach($role->id);

            Person::create([
                'user_id' => $user->id,
                'full_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'organization_name' => $request->organization_name ?? 'Individu',
            ]);

            $organization = null;
            if ($organizationType) {
                $organization = Organization::create([
                    'event_id' => $event->id,
                    'type' => $organizationType,
                    'name' => $request->organization_name,
                    'slug' => Str::slug($request->organization_name) . '-' . Str::lower(Str::random(6)),
                    'pic_name' => $request->name,
                    'pic_email' => $request->email,
                    'pic_phone' => $request->phone,
                    'status' => 'pending_verification',
                ]);

                OrganizationMembership::create([
                    'organization_id' => $organization->id,
                    'user_id' => $user->id,
                    'role_in_org' => 'pic',
                    'is_active' => true,
                ]);

                if ($organizationType === 'campus') {
                    CampusProfile::create(['organization_id' => $organization->id]);
                } elseif (in_array($organizationType, ['industry', 'sponsor'], true)) {
                    CompanyProfile::create(['organization_id' => $organization->id, 'is_sponsor' => $organizationType === 'sponsor']);
                } elseif ($organizationType === 'school') {
                    SchoolProfile::create(['organization_id' => $organization->id]);
                }
            }

            $registrationCategory = $organizationType ?? 'visitor';
            $registration = Registration::create([
                'event_id' => $event->id,
                'organization_id' => $organization?->id,
                'user_id' => $user->id,
                'category' => $registrationCategory,
                'registration_code' => 'REG-' . strtoupper(Str::random(10)),
                'status' => 'submitted',
            ]);

            $ticketCategory = [
                'pengunjung' => 'visitor',
                'kampus' => 'pic_campus',
                'industri' => 'industry_exhibitor',
                'sponsor' => 'sponsor',
            ][$request->category] ?? null;

            if ($ticketCategory) {
                Ticket::create([
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                    'registration_id' => $registration->id,
                    'category' => $ticketCategory,
                    'status' => 'active',
                ]);
            }

            return $user;
        });

        Auth::login($user);

        return $this->redirectBasedOnRole($user)->with('success', 'Pendaftaran akun berhasil! Selamat datang di FUTURiSE 2026.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }

    protected function redirectBasedOnRole(User $user)
    {
        $roleSlug = $user->activeRole?->slug ?? $user->roles->first()?->slug;
        $staffLandingPages = [
            'super-admin' => 'admin.dashboard',
            'ketua-pelaksana' => 'admin.dashboard',
            'sekretariat' => 'admin.organizations',
            'keuangan' => 'admin.finance',
            'program-kurasi' => 'admin.projects',
            'kampus-sekolah' => 'admin.booths',
            'industri-sponsor' => 'admin.booths',
            'venue-teknis' => 'admin.booths',
            'publikasi' => 'admin.projects',
            'registrasi-layanan' => 'admin.checkin',
        ];

        if (isset($staffLandingPages[$roleSlug])) {
            return redirect()->route($staffLandingPages[$roleSlug]);
        }
        if ($roleSlug === 'juri') return redirect()->route('juri.dashboard');

        return redirect()->route('portal.dashboard');
    }
}
