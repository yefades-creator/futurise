@extends('layouts.admin', ['title' => 'Manajemen User | Admin FUTURiSE'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Super Administrator</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Data User</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola akun, peran, status akses, dan verifikasi pengguna FUTURiSE.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-700 hover:bg-cyan-800 text-white font-bold text-sm shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Tambah User
        </a>
    </div>

    <form method="GET" action="{{ route('admin.users') }}" class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col sm:flex-row gap-3">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, atau telepon" class="flex-1 p-2.5 border border-slate-200 rounded-xl text-sm">
        <select name="status" class="p-2.5 border border-slate-200 rounded-xl text-sm">
            <option value="">Semua status</option>
            <option value="active" @selected(request('status') === 'active')>Aktif</option>
            <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
        </select>
        <button class="px-4 py-2 rounded-xl bg-slate-900 text-white font-semibold text-sm"><i class="fa-solid fa-magnifying-glass mr-1"></i> Cari</button>
    </form>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3">Pengguna</th>
                        <th class="px-5 py-3">Peran</th>
                        <th class="px-5 py-3">Peran Aktif</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Verifikasi</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/70">
                        <td class="px-5 py-4">
                            <div class="font-bold text-slate-900">{{ $user->name }}</div>
                            <div class="text-xs text-slate-500">{{ $user->email }}</div>
                            @if($user->phone)<div class="text-xs text-slate-400 mt-0.5">{{ $user->phone }}</div>@endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex flex-wrap gap-1">@forelse($user->roles as $role)<span class="px-2 py-1 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-bold">{{ $role->name }}</span>@empty<span class="text-rose-600 text-xs">Belum ada peran</span>@endforelse</div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">{{ $user->activeRole?->name ?? '—' }}</td>
                        <td class="px-5 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $user->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700' }}">{{ $user->status === 'active' ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td class="px-5 py-4 text-xs font-semibold {{ $user->is_verified ? 'text-emerald-700' : 'text-amber-700' }}">{{ $user->is_verified ? 'Terverifikasi' : 'Belum diverifikasi' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="px-3 py-1.5 rounded-lg bg-cyan-50 text-cyan-800 hover:bg-cyan-100 font-semibold text-xs"><i class="fa-solid fa-pen mr-1"></i> Ubah</a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus akun ini? User yang memiliki riwayat akan ditolak penghapusannya; nonaktifkan akun tersebut agar riwayat tetap tersimpan.')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 font-semibold text-xs"><i class="fa-solid fa-trash mr-1"></i> Hapus</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-5 py-12 text-center text-slate-500">Tidak ada user yang cocok dengan pencarian.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">{{ $users->links() }}</div>
    </div>
</div>
@endsection
