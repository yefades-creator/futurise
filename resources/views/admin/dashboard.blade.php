@extends('layouts.admin', ['title' => 'Dashboard Lintas Divisi Panitia FUTURiSE 2026'])

@section('content')
<div class="space-y-8">
    <!-- Header Title & Export Tools (Section 15) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Dashboard Lintas Divisi (Ketua Pelaksana & Super Admin)</span>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-0.5">Monitoring & Kesiapan Acara FUTURiSE 2026</h1>
            <p class="text-xs text-slate-500 mt-1">Satu sumber data terintegrasi sejak pendaftaran hingga pelaporan dan tindak lanjut H+30.</p>
        </div>

        <div class="flex items-center gap-2 self-start sm:self-auto">
            <div class="relative" x-data="{ exportOpen: false }" @click.outside="exportOpen = false">
                <button @click="exportOpen = !exportOpen" class="px-4 py-2.5 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold text-xs flex items-center gap-2 shadow-sm transition">
                    <i class="fa-solid fa-file-export text-cyan-400"></i>
                    <span>Ekspor Data (Section 15)</span>
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </button>
                <div x-show="exportOpen" x-cloak class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 text-xs">
                    <a href="{{ route('admin.export', 'projects') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700 font-medium">
                        <i class="fa-solid fa-laptop-code text-cyan-600 w-5"></i> Ekspor 60 Karya (CSV)
                    </a>
                    <a href="{{ route('admin.export', 'checkins') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700 font-medium">
                        <i class="fa-solid fa-qrcode text-rose-600 w-5"></i> Ekspor Log Check-in (CSV)
                    </a>
                    <a href="{{ route('admin.export', 'finance') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700 font-medium">
                        <i class="fa-solid fa-file-invoice-dollar text-emerald-600 w-5"></i> Ekspor Tagihan Keuangan (CSV)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 1. KPI UTAMA LINTAS DIVISI (Section 1 & 15) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Kampus & Karya -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-start justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Partisipasi Kampus & Karya</span>
                <span class="text-2xl font-black text-slate-900 mt-1 block">{{ $totalCampuses }} / {{ $totalProjects }}</span>
                <span class="text-[11px] text-emerald-600 font-semibold mt-1 block">
                    <i class="fa-solid fa-check-double mr-1"></i> {{ $publishedProjects }} Karya Terpublikasi (BR-11)
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-lg">
                <i class="fa-solid fa-building-columns"></i>
            </div>
        </div>

        <!-- 45 Booth Sabuga -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-start justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Alokasi 45 Booth (BR-05)</span>
                <span class="text-2xl font-black text-slate-900 mt-1 block">{{ $allocatedBooths }} <span class="text-xs text-slate-400 font-normal">/ {{ $totalBooths }}</span></span>
                <span class="text-[11px] text-teal-600 font-semibold mt-1 block">
                    <i class="fa-solid fa-store mr-1"></i> 100% Terisi Sesuai Kuota
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-lg">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
        </div>

        <!-- Kehadiran Pengunjung (BR-11 & BR-12) -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-start justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Pengunjung Unik (BR-11)</span>
                <span class="text-2xl font-black text-cyan-700 mt-1 block">{{ $attendance['unique_visitors_cumulative'] }}</span>
                <span class="text-[11px] text-slate-500 font-medium mt-1 block">
                    Target Kumulatif: <strong>{{ $event->target_visitors }}</strong>
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-700 flex items-center justify-center text-lg">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <!-- Kepuasan CSAT (Section 14) -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-start justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Tingkat Kepuasan (CSAT)</span>
                <span class="text-2xl font-black {{ $csatPercent >= 85 ? 'text-emerald-700' : 'text-amber-600' }} mt-1 block">
                    {{ $csatPercent }}%
                </span>
                <span class="text-[11px] text-slate-500 font-medium mt-1 block">
                    {{ $satisfiedSurvey }} puas dari {{ $totalSurvey }} respons (Target &ge; 85%)
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg">
                <i class="fa-regular fa-face-smile"></i>
            </div>
        </div>
    </div>

    <!-- 2. MONITORING KEHADIRAN & KAPASITAS SABUGA (BR-11 & BR-12) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kapasitas Venue Bersamaan Sabuga (BR-12) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-people-roof text-indigo-600"></i> Okupansi Sabuga (BR-12)
                </h3>
                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded {{ $attendance['is_over_capacity'] ? 'bg-rose-100 text-rose-800' : 'bg-emerald-100 text-emerald-800' }}">
                    {{ $attendance['is_over_capacity'] ? 'Over Kapasitas' : 'Aman & Terkendali' }}
                </span>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <div class="flex justify-between font-bold text-slate-700 mb-1">
                        <span>Okupansi Bersamaan Saat Ini:</span>
                        <span class="text-slate-900 font-black text-sm">{{ $attendance['concurrent_occupancy'] }} / {{ $attendance['concurrent_capacity'] }} Orang</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-gradient-to-r from-cyan-500 to-indigo-600 h-3 rounded-full" style="width: {{ min(100, $attendance['occupancy_percent']) }}%"></div>
                    </div>
                    <span class="text-[10px] text-slate-400 block mt-1">Dihitung dari selisih pemindaian IN ({{ $attendance['total_in_scans'] }}) dan OUT ({{ $attendance['total_out_scans'] }}).</span>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1 text-[11px] text-slate-600">
                    <p><strong>Aturan BR-12:</strong> Target kumulatif (1.000) dipisahkan dari kapasitas fisik bersamaan venue Sabuga ({{ $attendance['concurrent_capacity'] }} orang) untuk menjamin keselamatan pengunjung.</p>
                </div>
            </div>
        </div>

        <!-- Rekapitulasi Keuangan (BR-07 & BR-08) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-coins text-emerald-600"></i> Rekapitulasi Keuangan & Sponsorship (BR-08)
                </h3>
                <span class="text-xs font-semibold text-slate-400">Kas Tunai vs Barang/Jasa In-Kind</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                <div class="p-3 rounded-xl bg-emerald-50/70 border border-emerald-100">
                    <span class="text-slate-500 text-[10px] uppercase font-bold block">Penerimaan Kas (Lunas)</span>
                    <span class="text-base font-black text-emerald-800 mt-0.5 block">Rp {{ number_format($finance['cash_received'], 0, ',', '.') }}</span>
                    <span class="text-[9px] text-emerald-600">Terverifikasi (BR-06)</span>
                </div>

                <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-100">
                    <span class="text-slate-500 text-[10px] uppercase font-bold block">Menunggu Verifikasi</span>
                    <span class="text-base font-black text-amber-800 mt-0.5 block">Rp {{ number_format($finance['cash_pending'], 0, ',', '.') }}</span>
                    <span class="text-[9px] text-amber-600">Bukti bayar masuk</span>
                </div>

                <div class="p-3 rounded-xl bg-rose-50/70 border border-rose-100">
                    <span class="text-slate-500 text-[10px] uppercase font-bold block">Pengeluaran Operasional</span>
                    <span class="text-base font-black text-rose-800 mt-0.5 block">Rp {{ number_format($finance['cash_expenses'], 0, ',', '.') }}</span>
                    <span class="text-[9px] text-rose-600">Biaya gedung & pameran</span>
                </div>

                <div class="p-3 rounded-xl bg-teal-50/70 border border-teal-100">
                    <span class="text-slate-500 text-[10px] uppercase font-bold block">Dukungan In-Kind (BR-08)</span>
                    <span class="text-base font-black text-teal-800 mt-0.5 block">Rp {{ number_format($finance['total_in_kind'], 0, ',', '.') }}</span>
                    <span class="text-[9px] text-teal-600">Terpisah dari kas tunai</span>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-slate-500">Saldo Kas Bersih Saat Ini: <strong class="text-slate-900 text-sm">Rp {{ number_format($finance['cash_balance'], 0, ',', '.') }}</strong></span>
                <a href="{{ route('admin.finance') }}" class="font-bold text-cyan-600 hover:text-cyan-700">Kelola Tagihan & Verifikasi Pembayaran &rarr;</a>
            </div>
        </div>
    </div>

    <!-- 3. KOLABORASI & TINDAK LANJUT H+30 & TUGAS KRITIS HARI H (Section 18) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Kolaborasi & H+30 -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-handshake text-purple-600"></i> Pertemuan Kolaborasi & Tindak Lanjut H+30
                </h3>
                <span class="text-xs text-slate-500 font-semibold">Target 30 Pertemuan & 10 H+30</span>
            </div>

            <div class="grid grid-cols-3 gap-3 text-center text-xs">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block">Pertemuan Meja</span>
                    <span class="text-xl font-black text-indigo-900 mt-1 block">{{ $totalMeetings }}</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block">Komitmen H+30</span>
                    <span class="text-xl font-black text-purple-900 mt-1 block">{{ $totalFollowUps }}</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block">Status Terlambat</span>
                    <span class="text-xl font-black {{ $overdueFollowUps > 0 ? 'text-rose-600' : 'text-emerald-600' }} mt-1 block">{{ $overdueFollowUps }}</span>
                </div>
            </div>

            <div class="pt-2 text-right">
                <a href="{{ route('admin.followups') }}" class="text-xs font-bold text-cyan-600 hover:text-cyan-700">Lihat Seluruh Tindak Lanjut Pasca Event &rarr;</a>
            </div>
        </div>

        <!-- Checklist Kesiapan Kritis Hari H (Section 18) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-clipboard-check text-rose-600"></i> Tugas Kritis Hari H (Tahap 2 Rilis)
                </h3>
                <span class="text-[10px] bg-rose-100 text-rose-800 font-extrabold px-2 py-0.5 rounded uppercase">Wajib Siap</span>
            </div>

            <div class="space-y-2.5 text-xs">
                @foreach($tasks as $t)
                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid {{ $t->status === 'completed' ? 'fa-circle-check text-emerald-500' : 'fa-spinner text-amber-500 animate-spin' }}"></i>
                        <div>
                            <span class="font-bold text-slate-800 block">{{ $t->title }}</span>
                            <span class="text-[10px] text-slate-400 uppercase font-semibold">{{ $t->division }} &bull; Tenggat: {{ $t->due_date->format('d M') }}</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase {{ $t->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $t->status }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
