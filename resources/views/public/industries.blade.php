@extends('layouts.app', ['title' => 'Direktori Industri & Mitra | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Ekosistem Kemitraan</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Direktori Industri & Mitra Terkonfirmasi</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Perusahaan, BUMN, perbankan, dan asosiasi mitra yang hadir untuk menjalin kemitraan teknologi, riset terapan, dan penyerapan talenta digital.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($industries as $ind)
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div class="space-y-4">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold uppercase {{ $ind->type === 'industry' ? 'bg-cyan-100 text-cyan-800' : 'bg-teal-100 text-teal-800' }}">
                                {{ $ind->type === 'industry' ? 'Exhibitor Industri' : 'Mitra Asosiasi' }}
                            </span>
                            @if($ind->companyProfile?->is_sponsor)
                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-amber-100 text-amber-800 uppercase">
                                    <i class="fa-solid fa-crown text-[9px] mr-0.5"></i> Sponsor Terkonfirmasi
                                </span>
                            @endif
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">{{ $ind->name }}</h2>
                        <p class="text-xs text-slate-500 font-medium">{{ $ind->companyProfile?->sector ?? 'Teknologi & Bisnis' }} &bull; {{ $ind->city }}</p>
                    </div>

                    @if($ind->allocatedBooth)
                    <div class="text-right flex-shrink-0">
                        <span class="inline-block px-2.5 py-1 rounded-lg bg-slate-900 text-cyan-300 font-black text-xs">
                            Booth {{ $ind->allocatedBooth->code }}
                        </span>
                        <span class="block text-[10px] text-slate-400 mt-0.5">{{ $ind->allocatedBooth->size }}</span>
                    </div>
                    @endif
                </div>

                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ $ind->companyProfile?->profile_summary ?? 'Organisasi yang berkomitmen membangun sinergi riset dan pengembangan inovasi bersama kampus di Jawa Barat.' }}
                </p>

                <!-- Solusi Ditawarkan & Kebutuhan Kerjasama (Section 2 & 10) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-bold text-slate-700 block text-[11px]"><i class="fa-solid fa-briefcase text-cyan-600 mr-1"></i> Solusi Ditawarkan:</span>
                        <p class="text-[11px] text-slate-600 leading-relaxed">{{ $ind->companyProfile?->solutions_offered ?? 'Program Inkubasi, API, Co-Development.' }}</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-bold text-slate-700 block text-[11px]"><i class="fa-solid fa-handshake text-indigo-600 mr-1"></i> Kebutuhan Dicari:</span>
                        <p class="text-[11px] text-slate-600 leading-relaxed">{{ $ind->companyProfile?->collaboration_needs ?? 'Teknologi AI/ML, IoT, Rekrutmen Talenta.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer Action Button -->
            <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs">
                @if($ind->website)
                    <a href="{{ $ind->website }}" target="_blank" class="text-slate-500 hover:text-cyan-600 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-link text-[10px]"></i> Kunjungi Website
                    </a>
                @else
                    <span class="text-slate-400">APTIKOM Partner</span>
                @endif

                @auth
                    <a href="{{ route('portal.dashboard') }}" class="px-4 py-2 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-regular fa-calendar-check"></i> Ajukan Pertemuan Meja
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition">
                        Masuk untuk Matchmaking
                    </a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
