<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Event;
use App\Models\Person;
use App\Models\Role;
use App\Models\Organization;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['roles', 'activeRole'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim($request->string('q')->toString());
                $query->where(function ($query) use ($term) {
                    $query->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User(['status' => 'active', 'is_verified' => true]);
        $roles = Role::orderBy('name')->get();
        $assignedRoleIds = [];
        [$organizations, $teams, $linkedOrganizationId, $linkedTeamId] = $this->academicOptions($user);

        return view('admin.users.form', compact('user', 'roles', 'assignedRoleIds', 'organizations', 'teams', 'linkedOrganizationId', 'linkedTeamId'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $this->ensureActiveRoleIsAssigned($data);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'password' => $data['password'],
                'active_role_id' => $data['active_role_id'],
                'status' => $data['status'],
                'is_verified' => $data['is_verified'],
            ]);
            $user->roles()->sync($data['role_ids']);
            $this->syncAcademicLinks($user, $data);
            Person::updateOrCreate(
                ['user_id' => $user->id],
                ['full_name' => $user->name, 'email' => $user->email, 'phone' => $user->phone]
            );

            AuditLog::log('user_created', 'User', $user->id, null, [
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $data['role_ids'],
                'status' => $user->status,
            ], "Super Admin membuat akun {$user->email}", Event::active()?->id);
        });

        return redirect()->route('admin.users')->with('success', 'Akun user berhasil dibuat.');
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::orderBy('name')->get();
        $assignedRoleIds = $user->roles->pluck('id')->all();
        [$organizations, $teams, $linkedOrganizationId, $linkedTeamId] = $this->academicOptions($user);

        return view('admin.users.form', compact('user', 'roles', 'assignedRoleIds', 'organizations', 'teams', 'linkedOrganizationId', 'linkedTeamId'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validatedData($request, $user);
        $this->ensureActiveRoleIsAssigned($data);
        $this->protectLastSuperAdmin($user, $data['role_ids'], $data['status']);

        DB::transaction(function () use ($data, $user) {
            $old = [
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'role_ids' => $user->roles()->pluck('roles.id')->all(),
            ];
            $user->fill([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'active_role_id' => $data['active_role_id'],
                'status' => $data['status'],
                'is_verified' => $data['is_verified'],
            ]);
            if (!empty($data['password'])) {
                $user->password = $data['password'];
            }
            $user->save();
            $user->roles()->sync($data['role_ids']);
            $this->syncAcademicLinks($user, $data);

            Person::updateOrCreate(
                ['user_id' => $user->id],
                ['full_name' => $user->name, 'email' => $user->email, 'phone' => $user->phone]
            );

            AuditLog::log('user_updated', 'User', $user->id, $old, [
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'role_ids' => $data['role_ids'],
            ], "Super Admin memperbarui akun {$user->email}", Event::active()?->id);
        });

        return redirect()->route('admin.users')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ((int) $user->id === (int) auth()->id()) {
            return back()->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $this->protectLastSuperAdmin($user, [], 'inactive');

        if ($this->hasOperationalHistory($user)) {
            return back()->with('error', 'User memiliki data/riwayat terkait. Nonaktifkan akun agar riwayat acara tetap utuh.');
        }

        DB::transaction(function () use ($user) {
            AuditLog::log('user_deleted', 'User', $user->id, [
                'name' => $user->name,
                'email' => $user->email,
            ], null, "Super Admin menghapus akun {$user->email}", Event::active()?->id);
            $user->delete();
        });

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }

    private function validatedData(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $user ? Rule::unique('users', 'email')->ignore($user->id) : Rule::unique('users', 'email')],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'is_verified' => ['required', 'boolean'],
            'role_ids' => ['required', 'array', 'min:1'],
            'role_ids.*' => ['required', 'integer', 'distinct', 'exists:roles,id'],
            'active_role_id' => ['required', 'integer', 'exists:roles,id'],
            'organization_id' => ['nullable', 'integer', 'exists:organizations,id'],
            'team_id' => ['nullable', 'integer', 'exists:teams,id'],
            'new_team_name' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function academicOptions(User $user): array
    {
        $eventId = Event::active()?->id;
        $organizations = Organization::where('event_id', $eventId)->where('type', 'campus')->orderBy('name')->get();
        $teams = Team::whereHas('organization', fn ($query) => $query->where('event_id', $eventId)->where('type', 'campus'))
            ->with('organization')->orderBy('name')->get();
        $linkedOrganizationId = DB::table('organization_memberships')
            ->join('organizations', 'organizations.id', '=', 'organization_memberships.organization_id')
            ->where('organization_memberships.user_id', $user->id)
            ->where('organizations.event_id', $eventId)
            ->where('organization_memberships.is_active', true)
            ->value('organization_memberships.organization_id');
        $linkedTeamId = DB::table('team_members')
            ->join('teams', 'teams.id', '=', 'team_members.team_id')
            ->join('organizations', 'organizations.id', '=', 'teams.organization_id')
            ->where('team_members.user_id', $user->id)
            ->where('organizations.event_id', $eventId)
            ->value('team_members.team_id');

        return [$organizations, $teams, $linkedOrganizationId, $linkedTeamId];
    }

    private function syncAcademicLinks(User $user, array $data): void
    {
        $eventId = Event::active()?->id;
        $organization = null;
        $team = null;
        if (!empty($data['organization_id'])) {
            $organization = Organization::where('event_id', $eventId)
                ->where('type', 'campus')->find($data['organization_id']);
            if (!$organization) {
                throw ValidationException::withMessages(['organization_id' => 'Pilih organisasi kampus pada acara aktif.']);
            }
        }
        if (!empty($data['team_id'])) {
            $team = Team::whereKey($data['team_id'])
                ->whereHas('organization', fn ($query) => $query->where('event_id', $eventId)->where('type', 'campus'))
                ->first();
            if (!$team || !$organization || (int) $team->organization_id !== (int) $organization->id) {
                throw ValidationException::withMessages(['team_id' => 'Tim harus berasal dari organisasi kampus terpilih dan sudah terverifikasi.']);
            }
        }
        if (!$team && $organization && filled($data['new_team_name'] ?? null)) {
            $team = Team::create(['organization_id' => $organization->id, 'name' => trim($data['new_team_name'])]);
        }
        $activeRoleSlug = Role::find($data['active_role_id'])?->slug;
        if ($activeRoleSlug === 'tim-mahasiswa' && $organization && !$team) {
            throw ValidationException::withMessages(['team_id' => 'Pilih tim untuk akun Tim Mahasiswa. Jika belum ada tim, buat tim terlebih dahulu melalui pengelola data kampus.']);
        }

        DB::table('organization_memberships')
            ->where('user_id', $user->id)
            ->whereIn('organization_id', Organization::where('event_id', $eventId)->select('id'))
            ->delete();
        DB::table('team_members')->where('user_id', $user->id)
            ->whereIn('team_id', Team::whereHas('organization', fn ($query) => $query->where('event_id', $eventId))->select('id'))
            ->delete();

        if ($organization) {
            $organizationRole = $activeRoleSlug === 'pic-kampus' ? 'pic' : 'student';
            DB::table('organization_memberships')->insert([
                'organization_id' => $organization->id,
                'user_id' => $user->id,
                'role_in_org' => $organizationRole,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        if ($team) {
            DB::table('team_members')->insert([
                'team_id' => $team->id,
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'student_status' => 'Aktif',
                'is_leader' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function ensureActiveRoleIsAssigned(array $data): void
    {
        if (!in_array((int) $data['active_role_id'], array_map('intval', $data['role_ids']), true)) {
            throw ValidationException::withMessages([
                'active_role_id' => 'Peran aktif harus dipilih dari peran yang diberikan kepada user.',
            ]);
        }
    }

    private function protectLastSuperAdmin(User $user, array $roleIds, string $status): void
    {
        $superAdminRoleId = Role::where('slug', 'super-admin')->value('id');
        $willRemainSuperAdmin = $status === 'active' && in_array((int) $superAdminRoleId, array_map('intval', $roleIds), true);
        $isCurrentlySuperAdmin = $user->roles()->where('roles.id', $superAdminRoleId)->exists();

        if ($isCurrentlySuperAdmin && (int) $user->id === (int) auth()->id() && !$willRemainSuperAdmin) {
            throw ValidationException::withMessages([
                'status' => 'Anda tidak dapat menonaktifkan atau mencabut peran Super Admin dari akun yang sedang digunakan.',
            ]);
        }

        if ($isCurrentlySuperAdmin && !$willRemainSuperAdmin) {
            $otherActiveAdmins = User::where('status', 'active')
                ->where('id', '!=', $user->id)
                ->whereHas('roles', fn ($query) => $query->where('roles.id', $superAdminRoleId))
                ->exists();
            if (!$otherActiveAdmins) {
                throw ValidationException::withMessages([
                    'status' => 'Setidaknya harus ada satu akun Super Admin aktif.',
                ]);
            }
        }
    }

    private function hasOperationalHistory(User $user): bool
    {
        $references = [
            'organization_memberships' => ['user_id'],
            'registrations' => ['user_id'],
            'team_members' => ['user_id'],
            'judge_assignments' => ['user_id'],
            'assessments' => ['user_id'],
            'votes' => ['user_id'],
            'survey_responses' => ['user_id'],
            'tickets' => ['user_id'],
            'check_in_logs' => ['user_id'],
            'support_tickets' => ['user_id'],
            'project_feedbacks' => ['user_id'],
            'audit_logs' => ['user_id'],
            'publication_approvals' => ['approved_by'],
            'project_versions' => ['reviewed_by', 'submitted_by'],
        ];

        foreach ($references as $table => $columns) {
            foreach ($columns as $column) {
                if (DB::table($table)->where($column, $user->id)->exists()) {
                    return true;
                }
            }
        }

        return false;
    }
}
