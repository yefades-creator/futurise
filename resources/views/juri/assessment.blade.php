@extends('layouts.app', ['title' => 'Formulir Penilaian: ' . $project->title . ' | Juri FUTURiSE'])

@section('content')
@php
    $isLocked = ($assessment && $assessment->status === 'locked');
@endphp

<div class="gradient-brand text-white py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('juri.dashboard') }}" class="text-xs text-purple-300 hover:text-white flex items-center gap-1 font-semibold mb-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Penugasan
        </a>
        <div class="flex items-center gap-2 mb-2">
            <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase bg-purple-500/30 text-purple-200">
                Lembar Penilaian Juri (Section 13)
            </span>
            @if($isLocked)
                <span class="px-2.5 py-0.5 rounded text-[10px] font-black uppercase bg-purple-100 text-purple-900">
                    <i class="fa-solid fa-lock mr-1"></i> STATUS: TERKUNCI (ACCEPTANCE 08)
                </span>
            @endif
        </div>
        <h1 class="text-2xl sm:text-3xl font-black leading-tight">{{ $project->title }}</h1>
        <p class="text-xs text-slate-300 mt-1">Institusi: <strong>{{ $project->organization->name }}</strong> &bull; Booth: {{ $project->booth?->code ?? '-' }}</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{
    scores: {
        @foreach($rubric->criteria as $crit)
            '{{ $crit->id }}': {{ $existingScores[$crit->id] ?? 4 }},
        @endforeach
    },
    weights: {
        @foreach($rubric->criteria as $crit)
            '{{ $crit->id }}': {{ $crit->weight_percent }},
        @endforeach
    },
    calculateTotal() {
        let total = 0;
        for (let id in this.scores) {
            let val = parseFloat(this.scores[id]) || 0;
            let weight = parseFloat(this.weights[id]) || 0;
            total += (val / 5.0) * weight;
        }
        return total.toFixed(2);
    }
}">

    @if($isLocked)
    <div class="mb-8 p-4 rounded-2xl bg-purple-50 border border-purple-200 text-purple-900 text-xs flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <i class="fa-solid fa-shield-halved text-purple-600 text-lg"></i>
            <div>
                <strong>Kriteria Penerimaan 08 Terpenuhi:</strong> Nilai resmi telah dikunci pada {{ $assessment->locked_at ? $assessment->locked_at->format('d M Y H:i') : '-' }} WIB. Nilai tidak dapat diubah lagi oleh juri.
            </div>
        </div>
        <span class="text-base font-black text-purple-800">Nilai Akhir: {{ $assessment->final_score }} / 100</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Assessment Form (Left 2 cols) -->
        <div class="lg:col-span-2 space-y-6">
            <form action="{{ route('juri.assessment.store', $project->id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Criteria Scoring Cards (Section 13) -->
                @foreach($rubric->criteria as $crit)
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                    <div class="flex items-start justify-between gap-3 border-b border-slate-100 pb-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-purple-100 text-purple-800 font-black text-xs flex items-center justify-center">
                                    {{ $crit->code }}
                                </span>
                                <h3 class="font-bold text-slate-900 text-sm">{{ $crit->name }}</h3>
                            </div>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $crit->description }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-800 font-black text-xs">
                                Bobot {{ (int)$crit->weight_percent }}%
                            </span>
                            <span class="block text-[10px] text-purple-700 font-bold mt-1" x-text="'Skor: ' + ((scores['{{ $crit->id }}'] / 5.0) * weights['{{ $crit->id }}']).toFixed(1) + ' poin'"></span>
                        </div>
                    </div>

                    <!-- 1 - 5 Scale Radio Group -->
                    <div>
                        <span class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Pilih Skala Nilai (1 - 5):</span>
                        <div class="grid grid-cols-5 gap-2 text-center text-xs">
                            @for($val = 1; $val <= 5; $val++)
                            <label class="p-3 rounded-xl border cursor-pointer transition flex flex-col items-center justify-between"
                                :class="scores['{{ $crit->id }}'] == {{ $val }} ? 'bg-purple-900 text-white border-purple-900 shadow-sm font-bold' : 'bg-slate-50 hover:bg-slate-100 text-slate-700 border-slate-200'">
                                <input type="radio" name="scores[{{ $crit->id }}]" value="{{ $val }}" x-model="scores['{{ $crit->id }}']" {{ $isLocked ? 'disabled' : '' }} class="sr-only">
                                <span class="text-base font-black">{{ $val }}</span>
                                <span class="text-[9px] mt-1" :class="scores['{{ $crit->id }}'] == {{ $val }} ? 'text-purple-200' : 'text-slate-400'">
                                    {{ $val == 1 ? 'Sangat Kurang' : ($val == 2 ? 'Kurang' : ($val == 3 ? 'Cukup' : ($val == 4 ? 'Baik' : 'Sempurna'))) }}
                                </span>
                            </label>
                            @endfor
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- General Feedback -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-3">
                    <label class="block font-bold text-slate-800 text-xs uppercase tracking-wider">
                        Catatan & Evaluasi Kualitatif Dewan Juri
                    </label>
                    <textarea name="feedback" rows="4" {{ $isLocked ? 'disabled' : '' }} placeholder="Tuliskan masukan dan evaluasi komprehensif bagi tim mahasiswa..."
                        class="w-full p-4 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-purple-500 bg-slate-50 leading-relaxed">{{ old('feedback', $assessment?->general_feedback) }}</textarea>
                </div>

                <!-- Submit & Lock Action Buttons (Section 13 & Acceptance 08) -->
                @if(!$isLocked)
                <div class="bg-slate-900 rounded-2xl p-6 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xl">
                    <div>
                        <span class="text-slate-400 text-xs block">Simulasi Nilai Akhir (Skala 100):</span>
                        <div class="text-3xl font-black text-amber-400 mt-0.5">
                            <span x-text="calculateTotal()">85.00</span> <span class="text-xs text-slate-400">/ 100</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" name="action" value="draft" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs transition">
                            <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Draf
                        </button>

                        <button type="submit" name="action" value="lock" onclick="return confirm('PERINGATAN: Sesuai Acceptance 08, setelah nilai DIKUNCI Anda TIDAK DAPAT mengubah nilai ini lagi. Pastikan semua indikator sudah benar. Lanjutkan?')" class="px-6 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-black text-xs uppercase tracking-wider shadow-lg shadow-purple-600/30 transition">
                            <i class="fa-solid fa-lock mr-1"></i> Finalisasi & KUNCI Nilai
                        </button>
                    </div>
                </div>
                @endif
            </form>
        </div>

        <!-- Right Col: Detail Referensi Karya Mahasiswa -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4 text-xs">
                <h3 class="font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-cyan-600"></i> Ringkasan Inovasi
                </h3>

                <div>
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Masalah:</span>
                    <p class="text-slate-700 leading-relaxed mt-0.5">{{ $project->problem_statement }}</p>
                </div>

                <div>
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Solusi:</span>
                    <p class="text-slate-700 leading-relaxed mt-0.5">{{ $project->solution_description }}</p>
                </div>

                <div>
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Hasil Pengujian:</span>
                    <p class="text-slate-700 leading-relaxed mt-0.5">{{ $project->test_results ?? '-' }}</p>
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Tech Stack:</span>
                    <span class="font-bold text-slate-800">{{ $project->technology_stack ?? '-' }}</span>
                </div>

                @if($project->demo_url)
                <div class="pt-2">
                    <a href="{{ $project->demo_url }}" target="_blank" class="block w-full text-center py-2 rounded-xl bg-cyan-50 text-cyan-700 font-bold hover:bg-cyan-100 transition">
                        <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka Tautan Demo
                    </a>
                </div>
                @endif
            </div>

            <!-- Rumus Penilaian Resmi APTIKOM (Section 13) -->
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-xs space-y-2">
                <h4 class="font-bold text-slate-800 flex items-center gap-1.5">
                    <i class="fa-solid fa-calculator text-purple-600"></i> Rumus Penjurian (Section 13)
                </h4>
                <p class="text-slate-600 leading-relaxed text-[11px]">
                    Nilai indikator = <code>(skor / 5) &times; bobot</code>.
                    <br>Nilai maksimal per juri = 100. Nilai akhir karya adalah rata-rata penilaian final dari seluruh juri sah yang ditugaskan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
