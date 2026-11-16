@extends('layouts.admin', ['title' => 'Verifikasi Organisasi & Pendaftaran'])

@section('content')
<div class="space-y-6">
    <div>
        <span class="text-xs font-bold text-cyan-700 uppercase tracking-widest">Pendaftaran & Verifikasi</span>
        <h1 class="text-2xl font-black text-slate-900 mt-1">Organisasi Acara</h1>
        <p class="text-xs text-slate-500 mt-1">Verifikasi PIC dan organisasi sesuai divisi. Pendaftaran baru tetap berstatus menunggu sampai ditinjau.</p>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase text-[10px]">
                    <tr>
                        <th class="px-5 py-3">Organisasi</th>
                        <th class="px-5 py-3">Kategori</th>
                        <th class="px-5 py-3">PIC</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($organizations as $organization)
                    <tr class="align-top">
                        <td class="px-5 py-4">
                            <strong class="text-slate-900">{{ $organization->name }}</strong>
                            <span class="block text-slate-500 mt-1">{{ $organization->pic_email }}</span>
                        </td>
                        <td class="px-5 py-4 uppercase">{{ $organization->type }}</td>
                        <td class="px-5 py-4">{{ $organization->pic_name }}<span class="block text-slate-500 mt-1">{{ $organization->pic_phone }}</span></td>
                        <td class="px-5 py-4">
                            <span class="px-2 py-1 rounded-full font-bold uppercase {{ $organization->status === 'verified' ? 'bg-emerald-100 text-emerald-800' : ($organization->status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800') }}">{{ str_replace('_', ' ', $organization->status) }}</span>
                            @if($organization->verification_notes)<p class="mt-2 max-w-xs text-slate-500">{{ $organization->verification_notes }}</p>@endif
                        </td>
                        <td class="px-5 py-4 min-w-64">
                            <form action="{{ route('admin.organizations.verify', $organization->id) }}" method="POST" class="space-y-2">
                                @csrf
                                <select name="status" class="w-full p-2 border border-slate-200 rounded-lg bg-white" required>
                                    <option value="verified" {{ $organization->status === 'verified' ? 'selected' : '' }}>Verifikasi</option>
                                    <option value="rejected" {{ $organization->status === 'rejected' ? 'selected' : '' }}>Tolak pendaftaran</option>
                                </select>
                                <textarea name="verification_notes" rows="2" maxlength="2000" class="w-full p-2 border border-slate-200 rounded-lg" placeholder="Catatan verifikasi / alasan penolakan">{{ $organization->verification_notes }}</textarea>
                                <button class="px-3 py-2 rounded-lg bg-indigo-900 text-white font-bold">Simpan Keputusan</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-8 text-center text-slate-500">Belum ada organisasi untuk ditinjau.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
