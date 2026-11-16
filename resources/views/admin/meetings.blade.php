@extends('layouts.admin', ['title' => 'Pertemuan Kolaborasi & Cek Bentrok | Admin FUTURiSE'])

@section('content')
<div class="space-y-6" x-data="{ openScheduleModal: false }">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">Business Matchmaking & Networking</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Penjadwalan Pertemuan Meja Kolaborasi (BR-13)</h1>
            <p class="text-xs text-slate-500 mt-1">Sistem otomatis mendeteksi dan menolak jadwal pertemuan yang bentrok untuk pihak yang sama atau meja yang sama.</p>
        </div>

        <button @click="openScheduleModal = true" class="px-5 py-2.5 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold text-xs flex items-center gap-2 shadow-sm self-start sm:self-auto">
            <i class="fa-solid fa-plus text-cyan-400"></i> Jadwalkan Pertemuan Manual
        </button>
    </div>

    <!-- Rule Alert (BR-13 & Acceptance 10) -->
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-xs text-amber-950 flex items-start gap-3">
        <i class="fa-solid fa-calendar-xmark text-amber-600 text-lg mt-0.5"></i>
        <div class="space-y-1">
            <strong>Kriteria Penerimaan 10 & Aturan Bisnis BR-13:</strong>
            <br>Pertemuan dengan pihak atau meja bentrok <strong>DITOLAK</strong> oleh sistem secara otomatis. Tidak boleh ada dua organisasi yang dijadwalkan pada meja yang sama atau waktu yang bersamaan.
        </div>
    </div>

    <!-- Modal Penjadwalan Manual Panitia -->
    <div x-show="openScheduleModal" x-cloak class="bg-white border border-slate-200 p-6 rounded-3xl shadow-lg space-y-4 max-w-2xl">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="font-bold text-slate-900 text-sm">Penjadwalan Pertemuan Meja Kolaborasi (Cek Bentrok Otomatis)</h3>
            <button type="button" @click="openScheduleModal = false" class="text-slate-400 hover:text-slate-600">&times;</button>
        </div>

        <form action="{{ route('admin.meetings.schedule') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pihak Pengaju (Pihak 1)</label>
                    <select name="requester_org_id" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs" required>
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}">{{ $org->name }} ({{ strtoupper($org->type) }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pihak Dituju (Pihak 2)</label>
                    <select name="target_org_id" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs" required>
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}">{{ $org->name }} ({{ strtoupper($org->type) }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Meja Kolaborasi</label>
                    <select name="table_number" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs" required>
                        @for($t = 1; $t <= 10; $t++)
                            <option value="Meja Kolaborasi {{ $t }}">Meja Kolaborasi {{ $t }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Waktu Mulai</label>
                    <input type="datetime-local" name="start_time" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Waktu Selesai</label>
                    <input type="datetime-local" name="end_time" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Topik Agenda Pembahasan</label>
                <input type="text" name="agenda_topic" required placeholder="Agenda eksplorasi kerjasama dan MoU riset" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                <button type="button" @click="openScheduleModal = false" class="px-4 py-2 rounded-xl bg-slate-200 text-slate-700 font-bold text-xs">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs">Jadwalkan & Validasi Bebas Bentrok</button>
            </div>
        </form>
    </div>

    <!-- Meetings Table -->
    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Seluruh Pertemuan Meja Terjadwal ({{ $meetings->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-3 px-4">Meja</th>
                        <th class="py-3 px-4">Waktu Pelaksanaan</th>
                        <th class="py-3 px-4">Pihak 1 (Host)</th>
                        <th class="py-3 px-4">Pihak 2 (Invitee)</th>
                        <th class="py-3 px-4">Topik Agenda</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($meetings as $m)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-indigo-900">{{ $m->table_number }}</td>
                        <td class="py-3 px-4 text-slate-700 font-medium">
                            {{ $m->start_time->format('d M &bull; H:i') }} - {{ $m->end_time->format('H:i') }}
                        </td>
                        <td class="py-3 px-4 font-bold text-slate-800">{{ $m->requester->name }}</td>
                        <td class="py-3 px-4 font-bold text-slate-800">{{ $m->target->name }}</td>
                        <td class="py-3 px-4 text-slate-600 max-w-xs truncate">{{ $m->agenda_topic }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $m->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ strtoupper($m->status) }}
                            </span>
                            @if($m->status === 'requested' && auth()->user()->hasRole(['super-admin', 'sekretariat', 'program-kurasi', 'industri-sponsor']))
                            <div class="flex gap-1 mt-2">
                                <form action="{{ route('admin.meetings.status', $m->id) }}" method="POST">@csrf<input type="hidden" name="status" value="confirmed"><button class="text-[10px] px-2 py-1 rounded bg-emerald-600 text-white">Konfirmasi</button></form>
                                <form action="{{ route('admin.meetings.status', $m->id) }}" method="POST">@csrf<input type="hidden" name="status" value="cancelled"><button class="text-[10px] px-2 py-1 rounded bg-rose-600 text-white">Tolak</button></form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">Belum ada pertemuan terjadwal.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
