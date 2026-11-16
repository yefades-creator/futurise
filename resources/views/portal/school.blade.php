@extends('layouts.app', ['title' => 'Portal Rombongan Sekolah | FUTURiSE 2026'])

@section('content')
<div class="gradient-brand text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Portal Kunjungan Edukasi (Section 8)</span>
        <h1 class="text-2xl sm:text-3xl font-black mt-1">{{ $organization->name ?? 'Portal Sekolah' }}</h1>
        <p class="text-xs text-slate-300 mt-1">PIC Rombongan: <strong>{{ $organization->pic_name ?? auth()->user()->name }}</strong> &bull; {{ $organization->pic_phone ?? '0812xxxx' }}</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10" x-data="{ openBookingModal: false }">
    @include('portal._organization-status')
    <!-- QR Rombongan & Arahan Kedatangan (Section 8) -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
            <div>
                <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Administrasi Kelompok (Section 8)</span>
                <h2 class="text-xl font-black text-slate-900 mt-0.5">QR Rombongan & Slot Tur Terkonfirmasi</h2>
                <p class="text-xs text-slate-500 mt-1">QR rombongan mewakili administrasi kelompok; jumlah orang yang hadir dicatat saat ketibaan di Gate Bus Sabuga.</p>
            </div>
            @if($organization?->status === 'verified' && $availableSlots->isNotEmpty())
                <button @click="openBookingModal = true" class="px-5 py-2.5 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold text-xs flex items-center gap-2 shadow-md transition self-start sm:self-auto">
                    <i class="fa-solid fa-plus text-cyan-400"></i> Ajukan Slot Tur Tambahan
                </button>
            @elseif($organization?->status !== 'verified')
                <span class="px-4 py-2.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 font-bold text-xs">Menunggu verifikasi sekolah</span>
            @else
                <span class="px-4 py-2.5 rounded-xl bg-slate-100 border border-slate-200 text-slate-600 font-bold text-xs">Belum ada slot tersedia</span>
            @endif
        </div>

        <!-- Booking Slot Form -->
        <div x-show="openBookingModal" x-cloak class="bg-slate-50 border border-slate-200 p-6 rounded-2xl space-y-4">
            <h4 class="font-bold text-slate-800 text-sm">Pilih Jadwal Slot Tur Sekolah (Sabuga)</h4>
            @if($availableSlots->isNotEmpty())
            <form action="{{ route('portal.tours.book') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pilihan Slot Waktu Tur</label>
                    <select name="tour_slot_id" required class="w-full p-2.5 border rounded-xl bg-white text-xs">
                        @foreach($availableSlots as $slot)
                            <option value="{{ $slot->id }}">
                                {{ $slot->slot_name }} &bull; {{ $slot->date->format('d M') }} ({{ $slot->start_time }} - {{ $slot->end_time }}) &bull; Sisa Kuota: {{ $slot->max_capacity - $slot->booked_count }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Jumlah Siswa</label>
                        <input type="number" name="student_count" min="5" max="200" required class="w-full p-2.5 border rounded-xl bg-white text-xs" placeholder="Misal: 80">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Jumlah Guru Pendamping</label>
                        <input type="number" name="teacher_count" min="1" max="20" required class="w-full p-2.5 border rounded-xl bg-white text-xs" placeholder="Misal: 6">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Catatan Transportasi (Jumlah Bus/Kendaraan)</label>
                    <input type="text" name="arrival_notes" placeholder="Misal: Menggunakan 2 unit Bus Pariwisata tiba pukul 08.45 WIB" class="w-full p-2.5 border rounded-xl bg-white text-xs">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openBookingModal = false" class="px-4 py-2 rounded-xl bg-slate-200 text-slate-700 font-bold text-xs">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-900 text-white font-bold text-xs">Konfirmasi Pendaftaran Tur</button>
                </div>
            </form>
            @else
                <p class="text-sm text-slate-600">Belum ada jadwal yang bisa dipilih. Hubungi panitia Kampus dan Sekolah untuk menambahkan atau membuka slot tur.</p>
            @endif
        </div>

        <!-- Registered Visits -->
        <div class="space-y-4">
            @forelse($visits as $v)
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-6 text-xs">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase bg-indigo-100 text-indigo-900">
                            {{ $v->tourSlot->slot_name }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">
                            {{ strtoupper($v->arrival_status) }}
                        </span>
                    </div>

                    <h3 class="font-bold text-slate-900 text-base">Jadwal: {{ $v->tourSlot->date->format('d M Y') }} &bull; {{ $v->tourSlot->start_time }} - {{ $v->tourSlot->end_time }} WIB</h3>
                    
                    <div class="text-slate-600 flex flex-wrap gap-4 pt-1">
                        <span><i class="fa-solid fa-graduation-cap text-cyan-600 mr-1"></i> Rencana: <strong>{{ $v->student_count }} Siswa</strong> + <strong>{{ $v->teacher_count }} Guru</strong></span>
                        <span><i class="fa-solid fa-users text-teal-600 mr-1"></i> Total Hadir Fisik: <strong>{{ in_array($v->arrival_status, ['arrived', 'completed'], true) ? $v->actual_attendees . ' Orang' : 'Belum dicatat' }}</strong></span>
                        <span><i class="fa-solid fa-user-tie text-purple-600 mr-1"></i> Pemandu Tur: <strong>{{ $v->tourSlot->guide_name ?? 'Duta Kampus APTIKOM' }}</strong></span>
                    </div>

                    @if($v->arrival_notes)
                        <p class="text-slate-500 italic bg-white p-2 rounded-lg border border-slate-100">{{ $v->arrival_notes }}</p>
                    @endif
                </div>

                <!-- QR Badge for Group -->
                <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center flex-shrink-0 shadow-sm min-w-[260px]">
                    <div id="group-qr-{{ $v->id }}" data-qr-token="{{ $v->qr_group_token }}" class="w-56 h-56 bg-white mx-auto flex items-center justify-center mb-2" aria-label="QR rombongan sekolah"></div>
                    <span class="text-[10px] text-slate-400 block uppercase font-bold">QR Rombongan:</span>
                    <span class="font-black text-slate-800 text-xs block font-mono">{{ $v->qr_group_token }}</span>
                    <span class="text-[10px] text-slate-500 block mt-1">Tunjukkan QR ini ke petugas di Gate Bus. Kecerahan layar sebaiknya dimaksimalkan.</span>
                </div>
            </div>
            @empty
            <p class="text-xs text-slate-500 italic">Belum ada slot tur terdaftar.</p>
            @endforelse
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" defer onerror="this.onerror=null;this.src='https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js'"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('[id^="group-qr-"]');
        let attempts = 0;
        const renderCodes = () => {
            if (!window.QRCode) {
                if (attempts++ < 20) return window.setTimeout(renderCodes, 250);
                elements.forEach((element) => { element.textContent = 'QR tidak dapat dimuat. Gunakan token di bawah untuk input manual.'; });
                return;
            }
            elements.forEach((element) => {
                new QRCode(element, { text: element.dataset.qrToken, width: 220, height: 220, correctLevel: QRCode.CorrectLevel.M });
            });
        };
        renderCodes();
    });
</script>
@endsection
