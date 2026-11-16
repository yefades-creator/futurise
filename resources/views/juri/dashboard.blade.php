@extends('layouts.app', ['title' => 'Portal Juri Ahli | Penilaian FUTURiSE 2026'])

@section('content')
<div class="gradient-brand text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-purple-400 font-extrabold text-xs uppercase tracking-widest">Portal Dewan Juri Ahli</span>
                <h1 class="text-2xl sm:text-3xl font-black mt-1">Selamat Bertugas, {{ $user->name }}</h1>
                <p class="text-xs text-slate-300 mt-1">Penilaian karya inovasi digital mahasiswa APTIKOM Jawa Barat mengacu pada 5 indikator standar (Section 13).</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1.5 rounded-xl bg-purple-900/60 border border-purple-500/30 text-xs font-bold text-purple-200">
                    <i class="fa-solid fa-lock text-purple-400 mr-1"></i> Nilai Terkunci: <strong>{{ $completedCount }}</strong>
                </span>
                <span class="px-3 py-1.5 rounded-xl bg-amber-900/60 border border-amber-500/30 text-xs font-bold text-amber-200">
                    <i class="fa-regular fa-clock text-amber-400 mr-1"></i> Menunggu: <strong>{{ $pendingCount }}</strong>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    <!-- Notice Aturan Penjurian (Section 13 & Acceptance 08) -->
    <div class="bg-purple-50 border border-purple-200 rounded-2xl p-4 text-xs text-purple-900 flex items-start gap-3">
        <i class="fa-solid fa-gavel text-purple-600 text-lg mt-0.5"></i>
        <div class="space-y-1">
            <strong>Kriteria Penerimaan Developer 08:</strong> Juri hanya dapat menilai karya yang ditugaskan kepadanya dan tidak dapat mengubah nilai setelah difinalisasi / dikunci.
            <br>Nilai akhir dihitung otomatis berdasarkan 5 indikator berbobot: Relevansi Masalah (25%), Fungsi Prototipe (25%), Kebaruan Solusi (20%), Potensi Dampak (20%), Komunikasi & Demo (10%).
        </div>
    </div>

    <!-- Assignments List -->
    <div class="space-y-4" x-data="{ filter: 'all' }">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="text-xl font-black text-slate-900">Daftar Karya yang Ditugaskan kepada Anda ({{ $assignments->count() }})</h2>
            <div class="flex flex-wrap gap-2">
                <button type="button" @click="filter = 'all'" :class="filter === 'all' ? 'bg-purple-900 text-white' : 'bg-white text-slate-600 border border-slate-200'" class="px-3 py-2 rounded-lg text-xs font-bold">Semua ({{ $assignments->count() }})</button>
                <button type="button" @click="filter = 'open'" :class="filter === 'open' ? 'bg-amber-600 text-white' : 'bg-white text-slate-600 border border-slate-200'" class="px-3 py-2 rounded-lg text-xs font-bold">Perlu dinilai ({{ $pendingCount }})</button>
                <button type="button" @click="filter = 'locked'" :class="filter === 'locked' ? 'bg-purple-700 text-white' : 'bg-white text-slate-600 border border-slate-200'" class="px-3 py-2 rounded-lg text-xs font-bold"><i class="fa-solid fa-lock mr-1"></i> Nilai terkunci ({{ $completedCount }})</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($assignments as $a)
            @php
                $p = $a->project;
                $asm = $a->assessment;
                $isLocked = ($asm && $asm->status === 'locked');
            @endphp
            <div x-show="filter === 'all' || filter === '{{ $isLocked ? 'locked' : 'open' }}'" class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase bg-slate-100 text-slate-800">
                            {{ $p->category }}
                        </span>

                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                            {{ $isLocked ? 'bg-purple-100 text-purple-800' : ($asm ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600') }}">
                            <i class="fa-solid {{ $isLocked ? 'fa-lock' : 'fa-pen' }} mr-1"></i>
                            {{ $isLocked ? 'TERKUNCI (FINAL)' : ($asm ? 'DRAF TERSIMPAN' : 'BELUM DINILAI') }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 leading-snug">{{ $p->title }}</h3>
                        <p class="text-xs text-cyan-700 font-semibold mt-1">
                            <i class="fa-solid fa-building-columns text-[10px]"></i> {{ $p->organization->name }} ({{ $p->team?->name ?? 'Tim' }})
                        </p>
                    </div>

                    <p class="text-xs text-slate-600 line-clamp-2">{{ $p->solution_description }}</p>

                    <!-- Score Card if available -->
                    @if($asm)
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">Nilai Akhir Dihitung:</span>
                        <span class="font-black text-base {{ $isLocked ? 'text-purple-700' : 'text-slate-800' }}">
                            {{ $asm->final_score }} / 100
                        </span>
                    </div>
                    @endif
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <!-- Declare Conflict button -->
                    @if(!$isLocked)
                    <form action="{{ route('juri.conflict.declare', $a->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mendeklarasikan konflik kepentingan untuk karya ini? Penugasan akan dialihkan.')">
                        @csrf
                        <button type="submit" class="text-[11px] text-slate-400 hover:text-rose-600 font-semibold">
                            <i class="fa-solid fa-hand-dots mr-1"></i> Ada Konflik Kepentingan?
                        </button>
                    </form>
                    @else
                    <span class="text-[11px] text-slate-400"><i class="fa-solid fa-check text-emerald-500 mr-1"></i> Nilai sah tersimpan</span>
                    @endif

                    <a href="{{ route('juri.assessment.show', $p->id) }}" class="px-4 py-2 rounded-xl {{ $isLocked ? 'bg-slate-100 hover:bg-slate-200 text-slate-700' : 'bg-purple-900 hover:bg-purple-800 text-white' }} font-bold text-xs transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid {{ $isLocked ? 'fa-eye' : 'fa-gavel' }}"></i>
                        {{ $isLocked ? 'Lihat Lembar Penilaian' : 'Buka Formulir Penilaian' }}
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-2 bg-white rounded-3xl p-12 text-center border border-slate-200">
                <p class="text-slate-500 text-xs">Belum ada karya yang ditugaskan kepada Anda saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
