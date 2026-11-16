@extends('layouts.app', ['title' => 'Program & Agenda Rundown | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Rangkaian Acara</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Program dan Agenda Festival</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Tujuh program unggulan, jadwal pitching 10 finalis di panggung utama, dan rundown sesi pleno serta workshop interaktif.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Filter Sesi Buttons (Section 2) -->
    <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-slate-200">
        <span class="text-xs font-bold text-slate-400 uppercase mr-2"><i class="fa-solid fa-filter mr-1"></i> Filter Sesi:</span>
        <a href="{{ route('agenda') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ !$type ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Semua Sesi
        </a>
        <a href="{{ route('agenda', ['type' => 'keynote']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $type === 'keynote' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Keynote Leaders
        </a>
        <a href="{{ route('agenda', ['type' => 'pitching']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $type === 'pitching' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Pitching Arena
        </a>
        <a href="{{ route('agenda', ['type' => 'panel']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $type === 'panel' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Panel Diskusi
        </a>
        <a href="{{ route('agenda', ['type' => 'workshop']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $type === 'workshop' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            Showcase 60 Booth
        </a>
        <a href="{{ route('agenda', ['type' => 'tour']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $type === 'tour' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            School Tech Tour
        </a>
    </div>

    <!-- 10 Pitching Finalists Spotlight (Section 1: 10 finalis pitching) -->
    <div class="bg-gradient-to-tr from-slate-900 to-indigo-950 rounded-3xl p-6 sm:p-8 text-white shadow-xl border border-slate-800">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-amber-500 text-slate-950 uppercase tracking-wider">
                    <i class="fa-solid fa-trophy"></i> West Java Pitching Arena
                </span>
                <h2 class="text-2xl font-black mt-2">Daftar 10 Finalis Pitching di Main Stage Sabuga</h2>
                <p class="text-xs text-slate-300 mt-1">10 tim terbaik terpilih untuk mempresentasikan inovasinya langsung di depan dewan juri ahli dan investor.</p>
            </div>
            <span class="text-xs font-bold bg-white/10 px-3 py-1.5 rounded-xl border border-white/20 self-start md:self-auto">
                <i class="fa-solid fa-clock text-amber-400 mr-1"></i> Hari ke-1 &bull; 13.30 - 16.30 WIB
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($pitchFinalists as $f)
            <div class="bg-slate-800/80 border border-slate-700 rounded-2xl p-4 flex items-start gap-4 hover:border-amber-400/50 transition">
                <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 border border-amber-500/40 flex items-center justify-center font-black text-sm flex-shrink-0">
                    #{{ $f->pitch_order ?? $loop->iteration }}
                </div>
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-slate-700 text-cyan-300">{{ $f->category }}</span>
                        <span class="text-[10px] text-slate-400"><i class="fa-solid fa-store mr-1 text-slate-500"></i> Booth {{ $f->booth?->code ?? '-' }}</span>
                    </div>
                    <a href="{{ route('project.detail', $f->slug) }}" class="font-bold text-sm text-white hover:text-cyan-400 transition block">
                        {{ $f->title }}
                    </a>
                    <p class="text-xs text-slate-400 font-medium"><i class="fa-solid fa-building-columns text-[10px] mr-1 text-slate-500"></i> {{ $f->organization->name }} ({{ $f->team?->name ?? 'Tim' }})</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Detailed Rundown Timeline -->
    <div class="space-y-6">
        <h2 class="text-2xl font-black text-slate-900">Rundown Lengkap Sesi & Area</h2>
        <div class="space-y-4">
            @foreach($sessions as $sess)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="space-y-2 md:max-w-2xl">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase tracking-wider 
                                {{ $sess->type === 'pitching' ? 'bg-amber-100 text-amber-800' : ($sess->type === 'keynote' ? 'bg-indigo-100 text-indigo-800' : 'bg-teal-100 text-teal-800') }}">
                                {{ strtoupper($sess->type) }}
                            </span>
                            <span class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-cyan-600"></i> {{ $sess->stage_or_room }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 leading-snug">{{ $sess->title }}</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $sess->description }}</p>

                        <!-- Speakers list if any -->
                        @if($sess->speakers->count() > 0)
                        <div class="pt-3 mt-3 border-t border-slate-100">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Pembicara / Panelis Terkonfirmasi:</span>
                            <div class="flex flex-wrap gap-4">
                                @foreach($sess->speakers as $spk)
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center font-bold text-[10px] text-slate-700">
                                        {{ substr($spk->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $spk->name }}</p>
                                        <p class="text-[10px] text-slate-500">{{ $spk->title }} &bull; {{ $spk->organization }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 text-center min-w-[160px] flex-shrink-0">
                        <span class="text-[10px] text-slate-400 uppercase font-bold block">Waktu Sesi</span>
                        <span class="text-base font-black text-indigo-900 block mt-1">
                            {{ $sess->start_time->format('H:i') }} - {{ $sess->end_time->format('H:i') }}
                        </span>
                        <span class="text-xs text-slate-500 font-semibold block mt-0.5">WIB (Waktu Bandung)</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
