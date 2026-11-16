@extends('layouts.app', ['title' => 'Portal Industri & Mitra | FUTURiSE 2026'])

@section('content')
<div class="gradient-brand text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Portal Exhibitor Industri</span>
                <h1 class="text-2xl sm:text-3xl font-black mt-1">{{ $organization->name ?? 'Portal Industri' }}</h1>
                <p class="text-xs text-slate-300 mt-1">{{ $organization->companyProfile?->sector ?? 'Sektor Bisnis & Teknologi' }} &bull; PIC: <strong>{{ $organization->pic_name ?? auth()->user()->name }}</strong></p>
            </div>
            @if($allocatedBooth)
            <div class="bg-white/10 border border-white/20 rounded-2xl px-5 py-3 text-right">
                <span class="text-[10px] text-amber-300 uppercase font-bold tracking-wider block">Booth Korporat (BR-04)</span>
                <span class="text-xl font-black text-white">{{ $allocatedBooth->code }}</span>
                <span class="text-[11px] text-slate-300 block">{{ $allocatedBooth->size }} &bull; {{ $allocatedBooth->power_watt }}W</span>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10" x-data="{ openMeetingModal: false }">
    @include('portal._organization-status')
    @include('portal._invoices')
    <!-- Meeting Requests & Matchmaking Section (Section 9 & BR-13) -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
            <div>
                <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Business Matchmaking (BR-13)</span>
                <h2 class="text-xl font-black text-slate-900 mt-0.5">Pertemuan Kolaborasi & Hilirisasi Kampus</h2>
                <p class="text-xs text-slate-500 mt-1">Sistem otomatis memeriksa ketersediaan waktu kedua belah pihak dan meja kolaborasi tanpa bentrok.</p>
            </div>
            <button @click="openMeetingModal = true" class="px-5 py-2.5 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold text-xs flex items-center gap-2 shadow-md transition self-start sm:self-auto">
                <i class="fa-solid fa-plus text-cyan-400"></i> Ajukan Pertemuan Baru
            </button>
        </div>

        <!-- Meeting Modal Form -->
        <div x-show="openMeetingModal" x-cloak class="bg-slate-50 border border-slate-200 p-6 rounded-2xl space-y-4">
            <h4 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                <i class="fa-solid fa-handshake text-indigo-600"></i> Formulir Penjadwalan Meja Kolaborasi
            </h4>
            <form action="{{ route('portal.meetings.request') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Target Kampus / Institusi</label>
                        <select name="target_org_id" required class="w-full p-2.5 border rounded-xl bg-white text-xs">
                            @foreach($campuses as $camp)
                                <option value="{{ $camp->id }}">{{ $camp->name }} ({{ $camp->city }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Meja Kolaborasi</label>
                        <select name="table_number" required class="w-full p-2.5 border rounded-xl bg-white text-xs">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="Meja Kolaborasi {{ $i }}">Meja Kolaborasi {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Waktu Mulai</label>
                        <input type="datetime-local" name="start_time" required class="w-full p-2.5 border rounded-xl bg-white text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Waktu Selesai</label>
                        <input type="datetime-local" name="end_time" required class="w-full p-2.5 border rounded-xl bg-white text-xs">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Topik Agenda / Kebutuhan Solusi</label>
                    <input type="text" name="agenda_topic" required placeholder="Misal: Penjajakan Pilot Test AI Vision & Rekrutmen Talenta Mahasiswa"
                        class="w-full p-2.5 border rounded-xl bg-white text-xs">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openMeetingModal = false" class="px-4 py-2 rounded-xl bg-slate-200 text-slate-700 font-bold text-xs">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-900 text-white font-bold text-xs">Jadwalkan Pertemuan</button>
                </div>
            </form>
        </div>

        <!-- Meeting List -->
        <div class="space-y-4">
            @forelse($meetings as $m)
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 rounded-md text-[10px] font-black uppercase bg-indigo-100 text-indigo-900">
                        {{ $m->table_number }}
                    </span>
                    <span class="text-slate-500 font-semibold">{{ $m->start_time->format('d M &bull; H:i') }} - {{ $m->end_time->format('H:i') }} WIB</span>
                </div>
                <h4 class="font-bold text-slate-900 text-sm">{{ $m->agenda_topic }}</h4>
                <p class="text-slate-600">Mitra Pertemuan: <strong>{{ $m->requester_org_id === $organization->id ? $m->target->name : $m->requester->name }}</strong></p>
                @if($m->discussion_notes)
                    <p class="text-slate-600 italic bg-white p-3 rounded-xl border border-slate-100 mt-2"><strong>Catatan Hasil:</strong> {{ $m->discussion_notes }}</p>
                @endif
            </div>
            @empty
            <p class="text-xs text-slate-500 italic">Belum ada agenda pertemuan kolaborasi yang dijadwalkan.</p>
            @endforelse
        </div>
    </div>

    <!-- Tindak Lanjut Pasca Festival H+30 (Section 4 & Section 9) -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
        <div>
            <span class="text-xs font-bold text-purple-600 uppercase tracking-widest">Komitmen Kemitraan</span>
            <h2 class="text-xl font-black text-slate-900 mt-0.5">Monitoring Tindak Lanjut H+30</h2>
            <p class="text-xs text-slate-500 mt-1">Daftar tindakan lanjutan, tenggat waktu, dan status realisasi kerjasama pasca-acara.</p>
        </div>

        <div class="space-y-3 text-xs">
            @forelse($followUps as $fu)
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-900 text-sm">{{ $fu->title }}</span>
                    <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase {{ $fu->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ strtoupper($fu->status) }}
                    </span>
                </div>
                <p class="text-slate-600">{{ $fu->action_plan }}</p>
                <div class="text-[11px] text-slate-400 pt-1 flex items-center justify-between">
                    <span>Tenggat H+30: <strong class="text-slate-700">{{ $fu->deadline_h30->format('d M Y') }}</strong></span>
                    @if($fu->isOverdue())
                        <span class="text-rose-600 font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Status Terlambat</span>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-xs text-slate-500 italic">Belum ada komitmen tindak lanjut H+30.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
