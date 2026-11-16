@extends('layouts.app', ['title' => 'Informasi Peserta & FAQ | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Pedoman Teknis</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Informasi Peserta & Unduhan Dokumen</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Persyaratan karya inovasi mahasiswa, fasilitas booth, ketentuan teknis operasional Sabuga, dan jawaban atas pertanyaan umum (FAQ).
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- 1. Persyaratan Karya & Fasilitas Booth (Section 2 & 10) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h2 class="text-lg font-bold text-slate-900">Persyaratan Karya Mahasiswa</h2>
            </div>
            <ul class="text-xs text-slate-600 space-y-3 leading-relaxed">
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-cyan-600 mt-1"></i>
                    <span>Tiap kampus mengusulkan maksimal <strong>2 karya terpilih</strong> (BR-03) yang diajukan oleh PIC Kampus resmi terverifikasi.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-cyan-600 mt-1"></i>
                    <span>Karya berstatus prototipe fungsional teruji (minimal TRL 4 ke atas) dan siap didemonstrasikan langsung selama festival.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-cyan-600 mt-1"></i>
                    <span>Materi deskripsi, poster, video demo, dan tautan uji diserahkan lengkap sebelum tenggat pendaftaran ditutup.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-cyan-600 mt-1"></i>
                    <span>Materi akan <strong>terkunci saat proses kurasi</strong> (BR-09). Perbaikan hanya dapat dilakukan jika kurator meminta revisi.</span>
                </li>
            </ul>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-store"></i>
                </div>
                <h2 class="text-lg font-bold text-slate-900">Fasilitas Standar Booth</h2>
            </div>
            <ul class="text-xs text-slate-600 space-y-3 leading-relaxed">
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-indigo-600 mt-1"></i>
                    <span>Partisi booth standar R8 sistem modular ukuran <strong>3x3 meter</strong> berkarpet di Hall Utama Sabuga.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-indigo-600 mt-1"></i>
                    <span>Daya listrik terpasang <strong>450 Watt / 2 Ampere</strong> dan stop kontak 2 lubang (dapat diajukan penambahan jika butuh daya tinggi).</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-indigo-600 mt-1"></i>
                    <span>1 Meja display pameran, 2 kursi lipat, papan nama booth (fascia board), dan lampu penerangan sorot LED.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa-solid fa-check text-indigo-600 mt-1"></i>
                    <span>Koneksi Wi-Fi 6 khusus exhibitor dan ID Card resmi untuk 3 orang perwakilan tim mahasiswa per karya.</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- 2. Dokumen Unduhan (Section 2 & 10) -->
    <div class="bg-slate-900 rounded-3xl p-8 sm:p-10 text-white shadow-xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Pusat Berkas</span>
                <h2 class="text-2xl font-black mt-1">Dokumen Resmi & Panduan Unduhan</h2>
            </div>
            <span class="text-xs text-slate-400">Diperbarui berkala oleh Sekretariat APTIKOM</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($documents as $doc)
            <div class="bg-slate-800/80 border border-slate-700 rounded-2xl p-5 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-xl bg-red-500/20 text-red-400 border border-red-500/30 flex items-center justify-center text-xl flex-shrink-0">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm leading-snug">{{ $doc->title }}</h4>
                        <p class="text-[11px] text-slate-400 mt-1">{{ strtoupper($doc->category) }} &bull; {{ number_format($doc->file_size_kb / 1024, 1) }} MB &bull; {{ $doc->download_count }}x diunduh</p>
                    </div>
                </div>

                <a href="{{ $doc->file_path }}" target="_blank" class="px-4 py-2 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white font-bold text-xs flex items-center gap-1.5 flex-shrink-0 transition">
                    <i class="fa-solid fa-download"></i> Unduh
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 3. Frequently Asked Questions (FAQ) -->
    <div class="space-y-6">
        <div class="text-center max-w-xl mx-auto">
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Bantuan Pertanyaan</span>
            <h2 class="text-3xl font-black text-slate-900 mt-1">Tanya Jawab Seputar Festival (FAQ)</h2>
        </div>

        <div class="max-w-3xl mx-auto space-y-4" x-data="{ activeFaq: null }">
            @foreach($faqs as $f)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <button type="button" @click="activeFaq = (activeFaq === {{ $f->id }} ? null : {{ $f->id }})"
                    class="w-full text-left p-5 flex items-center justify-between text-sm font-bold text-slate-800 hover:text-cyan-600 transition">
                    <span>{{ $f->question }}</span>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform" :class="{'rotate-180': activeFaq === {{ $f->id }}}"></i>
                </button>
                <div x-show="activeFaq === {{ $f->id }}" x-cloak class="px-5 pb-5 pt-0 text-xs text-slate-600 leading-relaxed border-t border-slate-50">
                    <p class="pt-3">{{ $f->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
