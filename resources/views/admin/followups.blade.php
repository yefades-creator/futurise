@extends('layouts.admin', ['title' => 'Monitoring Tindak Lanjut H+30 | Admin FUTURiSE'])

@section('content')
<div class="space-y-6" x-data="{ editingFuId: null }">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Komitmen Pasca Festival (H+30)</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Monitoring Tindak Lanjut & Hilirisasi Inovasi</h1>
            <p class="text-xs text-slate-500 mt-1">Sistem otomatis menandai komitmen yang mendekati atau melewati tenggat 30 hari pasca festival (Section 9).</p>
        </div>
    </div>

    <!-- Table of Follow Ups -->
    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4">Judul Komitmen</th>
                        <th class="py-3 px-4">Organisasi / Kampus</th>
                        <th class="py-3 px-4">Rencana Tindakan</th>
                        <th class="py-3 px-4">Tenggat Waktu H+30</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($followUps as $fu)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-slate-900 max-w-xs truncate">{{ $fu->title }}</td>
                        <td class="py-3 px-4 font-medium text-slate-700">{{ $fu->organization->name }}</td>
                        <td class="py-3 px-4 text-slate-600 max-w-md truncate">{{ $fu->action_plan }}</td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-slate-800">{{ $fu->deadline_h30->format('d M Y') }}</span>
                            @if($fu->isOverdue())
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-black bg-rose-100 text-rose-800 ml-1 uppercase">Terlambat</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase
                                {{ $fu->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($fu->status === 'in_progress' ? 'bg-cyan-100 text-cyan-800' : 'bg-slate-100 text-slate-700') }}">
                                {{ strtoupper($fu->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <button type="button" @click="editingFuId = (editingFuId === {{ $fu->id }} ? null : {{ $fu->id }})" class="px-3 py-1 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition">
                                Update Hasil
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Row -->
                    <tr x-show="editingFuId === {{ $fu->id }}" x-cloak class="bg-indigo-50/40">
                        <td colspan="6" class="p-4">
                            <form action="{{ route('admin.followups.update', $fu->id) }}" method="POST" class="bg-white p-5 rounded-2xl border border-indigo-100 space-y-3 max-w-xl mx-auto text-xs">
                                @csrf
                                @method('PUT')
                                <h4 class="font-bold text-slate-800">Perbarui Hasil Diskusi & Status H+30</h4>

                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Status Progres</label>
                                    <select name="status" class="w-full p-2 border rounded-xl bg-slate-50 text-xs">
                                        <option value="open" {{ $fu->status === 'open' ? 'selected' : '' }}>Open (Menunggu Tindak Lanjut)</option>
                                        <option value="in_progress" {{ $fu->status === 'in_progress' ? 'selected' : '' }}>In Progress (Dalam Negosiasi/Penyusunan PKS)</option>
                                        <option value="completed" {{ $fu->status === 'completed' ? 'selected' : '' }}>Completed (Kerjasama Terjalin / PKS Ditandatangani)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Ringkasan Hasil Diskusi Terkini</label>
                                    <textarea name="result_summary" rows="2" class="w-full p-2 border rounded-xl bg-slate-50 text-xs" placeholder="Catatan progress kemitraan...">{{ $fu->result_summary }}</textarea>
                                </div>

                                <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                                    <button type="button" @click="editingFuId = null" class="px-3 py-1.5 rounded-xl bg-slate-200 text-slate-700 font-bold">Batal</button>
                                    <button type="submit" class="px-4 py-1.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold">Simpan Progress</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">Belum ada komitmen tindak lanjut H+30.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
