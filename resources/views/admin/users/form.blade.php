@extends('layouts.admin', ['title' => ($user->exists ? 'Ubah User' : 'Tambah User') . ' | Admin FUTURiSE'])

@section('content')
<div class="max-w-3xl space-y-6">
    <div>
        <a href="{{ route('admin.users') }}" class="text-xs font-bold text-cyan-700 hover:text-cyan-900"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Data User</a>
        <h1 class="text-2xl font-black text-slate-900 mt-3">{{ $user->exists ? 'Ubah User' : 'Tambah User' }}</h1>
        <p class="text-sm text-slate-500 mt-1">Tentukan informasi akun, status akses, verifikasi, dan satu atau beberapa peran.</p>
    </div>

    @if($errors->any())
    <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
        <p class="font-bold mb-1">Periksa kembali data berikut:</p>
        <ul class="list-disc pl-5 space-y-0.5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8 space-y-6">
        @csrf
        @if($user->exists) @method('PUT') @endif

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama lengkap</label>
                <input name="name" value="{{ old('name', $user->name) }}" required maxlength="255" class="w-full p-3 rounded-xl border border-slate-200 text-sm" autocomplete="name">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255" class="w-full p-3 rounded-xl border border-slate-200 text-sm" autocomplete="email">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor telepon</label>
                <input name="phone" value="{{ old('phone', $user->phone) }}" maxlength="30" class="w-full p-3 rounded-xl border border-slate-200 text-sm" autocomplete="tel">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Status akun</label>
                <select name="status" required class="w-full p-3 rounded-xl border border-slate-200 text-sm">
                    <option value="active" @selected(old('status', $user->status) === 'active')>Aktif</option>
                    <option value="inactive" @selected(old('status', $user->status) === 'inactive')>Nonaktif</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Status verifikasi</label>
                <select name="is_verified" required class="w-full p-3 rounded-xl border border-slate-200 text-sm">
                    <option value="1" @selected((string) old('is_verified', (int) $user->is_verified) === '1')>Terverifikasi</option>
                    <option value="0" @selected((string) old('is_verified', (int) $user->is_verified) === '0')>Belum diverifikasi</option>
                </select>
            </div>
        </div>

        <section class="rounded-2xl border border-cyan-200 bg-cyan-50/50 p-4 sm:p-5 space-y-3">
            <div>
                <h2 class="text-sm font-black text-slate-900">Keanggotaan Kampus & Tim</h2>
                <p class="text-xs text-slate-600 mt-1">Tautkan akun ke organisasi kampus dan timnya. Organisasi yang masih menunggu verifikasi tetap dapat ditautkan, tetapi harus diverifikasi di menu Organisasi sebelum karya bisa didaftarkan.</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Organisasi kampus</label>
                    <select id="user-organization" name="organization_id" class="w-full p-3 rounded-xl border border-slate-200 text-sm bg-white">
                        <option value="">Tidak ditautkan</option>
                        @foreach($organizations as $organization)
                        <option value="{{ $organization->id }}" @selected((string) old('organization_id', $linkedOrganizationId) === (string) $organization->id)>{{ $organization->name }} · {{ $organization->status === 'verified' ? 'Terverifikasi' : 'Belum terverifikasi' }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Tim mahasiswa</label>
                    <select id="user-team" name="team_id" class="w-full p-3 rounded-xl border border-slate-200 text-sm bg-white">
                        <option value="">Pilih tim (wajib untuk peran Tim Mahasiswa)</option>
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}" data-organization="{{ $team->organization_id }}" @selected((string) old('team_id', $linkedTeamId) === (string) $team->id)>{{ $team->name }} — {{ $team->organization->name }}</option>
                        @endforeach
                    </select>
                    @if($teams->isEmpty())<p class="text-[11px] text-amber-700 mt-1">Belum ada tim untuk organisasi kampus terverifikasi pada acara aktif.</p>@endif
                    <input name="new_team_name" value="{{ old('new_team_name') }}" maxlength="255" placeholder="Atau buat tim baru (nama tim)" class="w-full p-3 mt-2 rounded-xl border border-slate-200 text-sm">
                </div>
            </div>
        </section>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">{{ $user->exists ? 'Password baru (opsional)' : 'Password' }}</label>
                <input type="password" name="password" {{ $user->exists ? '' : 'required' }} minlength="8" class="w-full p-3 rounded-xl border border-slate-200 text-sm" autocomplete="new-password">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi password</label>
                <input type="password" name="password_confirmation" {{ $user->exists ? '' : 'required' }} minlength="8" class="w-full p-3 rounded-xl border border-slate-200 text-sm" autocomplete="new-password">
            </div>
        </div>

        <div class="space-y-3">
            <div>
                <h2 class="text-sm font-black text-slate-900">Peran user</h2>
                <p class="text-xs text-slate-500 mt-1">Pilih minimal satu peran. Untuk akun multi-peran, tentukan juga peran aktifnya.</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-2">
                @foreach($roles as $role)
                <label class="flex items-start gap-3 p-3 border border-slate-200 rounded-xl hover:bg-slate-50 cursor-pointer">
                    <input type="checkbox" name="role_ids[]" value="{{ $role->id }}" @checked(in_array($role->id, old('role_ids', $assignedRoleIds))) class="mt-0.5 rounded border-slate-300 text-cyan-700">
                    <span><span class="block text-sm font-bold text-slate-800">{{ $role->name }}</span><span class="block text-[11px] text-slate-500">{{ $role->description }}</span></span>
                </label>
                @endforeach
            </div>
            <div class="max-w-sm">
                <label class="block text-xs font-bold text-slate-700 mb-1">Peran aktif setelah login</label>
                <select name="active_role_id" required class="w-full p-3 rounded-xl border border-slate-200 text-sm">
                    <option value="">Pilih peran aktif</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" @selected((string) old('active_role_id', $user->active_role_id ?? $roles->first()?->id) === (string) $role->id)>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">
            <a href="{{ route('admin.users') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-sm font-bold">Batal</a>
            <button class="px-5 py-2.5 rounded-xl bg-cyan-700 hover:bg-cyan-800 text-white text-sm font-bold"><i class="fa-solid fa-floppy-disk mr-1"></i> Simpan User</button>
        </div>
    </form>
</div>
<script>
    (() => {
        const organization = document.getElementById('user-organization');
        const team = document.getElementById('user-team');
        if (!organization || !team) return;
        const filterTeams = () => {
            Array.from(team.options).forEach((option) => {
                if (!option.dataset.organization) return;
                option.hidden = organization.value !== '' && option.dataset.organization !== organization.value;
                if (option.hidden && option.selected) team.value = '';
            });
        };
        organization.addEventListener('change', filterTeams);
        filterTeams();
    })();
</script>
@endsection
