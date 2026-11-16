@extends('layouts.app', ['title' => 'Venue Sabuga & Denah Booth | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Informasi Lokasi & Denah</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Venue Festival & Denah 45 Booth</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Sasana Budaya Ganesha (Sabuga) ITB Bandung. Temukan denah pembagian zona pameran, lokasi booth kampus/industri, dan panduan transportasi.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16" x-data="{ searchBooth: '', filterZone: 'all' }">
    <!-- 1. Profil Venue & Fasilitas (Section 2 & BR-12) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-4">
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Gedung Utama Acara</span>
            <h2 class="text-2xl font-black text-slate-900">{{ $event->venue_name ?? 'Sasana Budaya Ganesha (Sabuga) ITB' }}</h2>
            <p class="text-xs text-slate-600 leading-relaxed">
                {{ $event->venue->address ?? 'Jl. Tamansari No. 73, Lebak Siliwangi, Coblong, Kota Bandung, Jawa Barat' }}
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-4 border-t border-slate-100 text-xs">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-bold text-slate-400 uppercase text-[10px] block">Kapasitas Bersamaan (BR-12)</span>
                    <span class="font-black text-slate-800 text-base mt-0.5 block">{{ $event->venue->concurrent_capacity ?? 600 }} Orang</span>
                    <span class="text-[10px] text-slate-400">Terpisah dari target kumulatif</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-bold text-slate-400 uppercase text-[10px] block">Total Booth Terpasang</span>
                    <span class="font-black text-cyan-700 text-base mt-0.5 block">45 Booth Pameran</span>
                    <span class="text-[10px] text-slate-400">30 Kampus, 10 Industri, 5 Mitra</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 col-span-2 sm:col-span-1">
                    <span class="font-bold text-slate-400 uppercase text-[10px] block">Layanan Internet</span>
                    <span class="font-black text-emerald-700 text-base mt-0.5 block">Dedicated 1 Gbps</span>
                    <span class="text-[10px] text-slate-400">Didukung Telkom Indonesia</span>
                </div>
            </div>

            <div class="pt-2">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Fasilitas Pendukung Venue:</h3>
                <div class="flex flex-wrap gap-2 text-xs">
                    @foreach($event->venue->facilities ?? [] as $f)
                    <span class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-700 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-check text-cyan-600 text-[10px]"></i> {{ $f }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-slate-900 rounded-3xl p-8 text-white flex flex-col justify-between space-y-4 shadow-xl">
            <div>
                <span class="text-cyan-400 font-bold uppercase text-xs tracking-wider">Akses Transportasi</span>
                <h3 class="text-xl font-black mt-2">Menuju Sabuga ITB</h3>
                <p class="text-xs text-slate-300 mt-3 leading-relaxed">
                    {{ $event->venue->transport_guide ?? 'Dapat diakses melalui Jalan Tamansari atau Jalan Siliwangi Bandung. Tersedia halte angkutan umum jurusan Cicaheum-Ciroyom, Dago-Stasiun Hall, atau bus Trans Metro Pasundan.' }}
                </p>
            </div>

            <div class="pt-4 border-t border-slate-800">
                <a href="https://maps.google.com/?q=Sabuga+ITB+Bandung" target="_blank" class="block w-full text-center py-3 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white font-bold text-xs uppercase tracking-wider shadow-md transition">
                    <i class="fa-solid fa-map-location mr-1.5"></i> Buka Google Maps
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Denah Visual Interaktif & Pencarian 45 Booth (Section 2 & 4) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Floor Plan Visual</span>
                <h2 class="text-2xl font-black text-slate-900 mt-1">Peta Denah 45 Booth Sabuga</h2>
                <p class="text-xs text-slate-500 mt-1">Cari nama kampus atau institusi untuk menemukan nomor dan lokasi booth dengan cepat.</p>
            </div>

            <!-- Search & Zone Filters -->
            <div class="flex flex-wrap items-center gap-2">
                <div class="relative w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                    <input type="text" x-model="searchBooth" placeholder="Cari kode booth / institusi..."
                        class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-cyan-500 bg-slate-50">
                </div>

                <select x-model="filterZone" class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs bg-slate-50 text-slate-700 font-bold">
                    <option value="all">Semua Kategori (45)</option>
                    <option value="campus">Zona Kampus (B-01 s/d B-30)</option>
                    <option value="industry">Zona Industri (I-01 s/d I-10)</option>
                    <option value="partner">Zona Mitra (M-01 s/d M-05)</option>
                </select>
            </div>
        </div>

        <!-- Visual Floor Grid Simulation -->
        <div class="bg-slate-900 rounded-2xl p-6 text-white border border-slate-800 space-y-4">
            <div class="flex items-center justify-between text-xs text-slate-400 pb-3 border-b border-slate-800">
                <span class="font-bold uppercase tracking-wider text-cyan-400"><i class="fa-solid fa-compass mr-1"></i> Area Panggung Utama & LED Display 4K (Main Stage)</span>
                <span class="text-[11px] text-slate-500">Pintu Masuk Utama Sabuga (Gate 1) &darr;</span>
            </div>

            <!-- Grid of 45 Booths -->
            <div class="grid grid-cols-2 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-9 gap-2.5">
                @foreach($booths as $b)
                @php
                    $orgName = $b->allocation?->organization?->name ?? 'Belum Dialokasikan';
                    $isCampus = $b->category === 'campus';
                    $isInd = $b->category === 'industry';
                @endphp
                <div x-show="(filterZone === 'all' || filterZone === '{{ $b->category }}') && ('{{ strtolower($b->code . ' ' . $orgName) }}'.includes(searchBooth.toLowerCase()))"
                    class="p-2.5 rounded-xl border transition text-center cursor-pointer group 
                    {{ $isCampus ? 'bg-slate-800/90 border-slate-700 hover:border-cyan-400 hover:bg-slate-800' : ($isInd ? 'bg-indigo-950/90 border-indigo-700 hover:border-amber-400' : 'bg-teal-950/90 border-teal-700 hover:border-teal-400') }}"
                    title="{{ $b->code }}: {{ $orgName }} ({{ $b->projects->count() }} Karya)">
                    
                    <span class="block text-xs font-black {{ $isCampus ? 'text-cyan-400' : ($isInd ? 'text-amber-400' : 'text-teal-300') }}">{{ $b->code }}</span>
                    <span class="block text-[10px] font-bold text-slate-200 truncate mt-0.5">{{ $b->allocation?->organization?->name ?? 'Tersedia' }}</span>
                    <span class="block text-[9px] text-slate-400 mt-0.5">{{ $b->size }} &bull; {{ $b->power_watt }}W</span>
                </div>
                @endforeach
            </div>

            <!-- Floor Legend -->
            <div class="pt-4 border-t border-slate-800 flex flex-wrap items-center justify-center gap-6 text-[11px] text-slate-400">
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-cyan-600 inline-block"></span> 30 Booth Akademik Kampus (B-01 s/d B-30)</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-indigo-600 inline-block"></span> 10 Booth Korporat Industri (I-01 s/d I-10)</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-teal-600 inline-block"></span> 5 Booth Mitra Asosiasi (M-01 s/d M-05)</span>
            </div>
        </div>

        <!-- Daftar Lengkap Booth & Karya Terkait (Section 4) -->
        <div>
            <h3 class="text-base font-bold text-slate-900 mb-4">Daftar Lengkap Alokasi 45 Booth</h3>
            <div class="overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px] border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-4">Kode</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Institusi / Exhibitor</th>
                            <th class="py-3 px-4">Karya Terkait (BR-03)</th>
                            <th class="py-3 px-4">Daya Listrik</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($booths as $b)
                        <tr class="hover:bg-slate-50/80 transition" x-show="(filterZone === 'all' || filterZone === '{{ $b->category }}') && ('{{ strtolower($b->code . ' ' . ($b->allocation?->organization?->name ?? '')) }}'.includes(searchBooth.toLowerCase()))">
                            <td class="py-3 px-4 font-black text-slate-900">{{ $b->code }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $b->category === 'campus' ? 'bg-cyan-50 text-cyan-800' : ($b->category === 'industry' ? 'bg-indigo-50 text-indigo-800' : 'bg-teal-50 text-teal-800') }}">
                                    {{ $b->category }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-semibold text-slate-800">
                                {{ $b->allocation?->organization?->name ?? 'Belum dialokasikan' }}
                            </td>
                            <td class="py-3 px-4 text-slate-600">
                                @forelse($b->projects as $p)
                                    <div class="mb-1">
                                        <a href="{{ route('project.detail', $p->slug) }}" class="text-cyan-700 hover:underline font-medium">&bull; {{ $p->title }}</a>
                                    </div>
                                @empty
                                    <span class="text-slate-400 italic">-</span>
                                @endforelse
                            </td>
                            <td class="py-3 px-4 text-slate-500">{{ $b->power_watt }} Watt</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
