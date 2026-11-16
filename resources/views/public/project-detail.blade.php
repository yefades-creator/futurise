@extends('layouts.app', ['title' => $project->title . ' | FUTURiSE 2026'])

@section('content')
<!-- Header Banner -->
<div class="gradient-brand text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center gap-2 mb-3">
            <a href="{{ route('showcase') }}" class="text-xs text-cyan-400 hover:text-cyan-300 flex items-center gap-1 font-semibold">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Showcase
            </a>
            <span class="text-slate-500">/</span>
            <span class="text-xs px-2.5 py-0.5 rounded bg-white/10 text-cyan-300 font-bold uppercase">{{ $project->category }}</span>
            @if($project->is_pitch_finalist)
                <span class="text-xs px-2.5 py-0.5 rounded bg-amber-500 text-slate-950 font-black uppercase flex items-center gap-1">
                    <i class="fa-solid fa-star"></i> Finalis Pitching Arena #{{ $project->pitch_order }}
                </span>
            @endif
        </div>

        <h1 class="text-2xl sm:text-4xl font-black max-w-4xl leading-tight">{{ $project->title }}</h1>
        
        <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-slate-300">
            <span class="flex items-center gap-1.5"><i class="fa-solid fa-building-columns text-cyan-400"></i> {{ $project->organization->name }}</span>
            <span>&bull;</span>
            <span class="flex items-center gap-1.5"><i class="fa-solid fa-users text-cyan-400"></i> {{ $project->team?->name ?? 'Tim Inovator' }}</span>
            <span>&bull;</span>
            <span class="flex items-center gap-1.5"><i class="fa-solid fa-store text-cyan-400"></i> Booth {{ $project->booth?->code ?? '-' }} ({{ $project->booth?->zone ?? 'Hall Utama' }})</span>
            <span>&bull;</span>
            <span class="flex items-center gap-1.5"><i class="fa-solid fa-layer-group text-cyan-400"></i> {{ $project->readiness_level }}</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Details (Left 2 Cols) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- 1. Ringkasan Masalah & Solusi (Section 3 & 10) -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                <div>
                    <h2 class="text-sm uppercase font-bold text-slate-400 tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-rose-500"></i> Masalah yang Diselesaikan
                    </h2>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $project->problem_statement }}</p>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <h2 class="text-sm uppercase font-bold text-slate-400 tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-users-viewfinder text-indigo-500"></i> Pengguna Sasaran (Target Audience)
                    </h2>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $project->target_users }}</p>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <h2 class="text-sm uppercase font-bold text-slate-400 tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-lightbulb text-amber-500"></i> Solusi yang Ditawarkan
                    </h2>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $project->solution_description }}</p>
                </div>

                @if($project->key_features)
                <div class="pt-6 border-t border-slate-100">
                    <h2 class="text-sm uppercase font-bold text-slate-400 tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-teal-500"></i> Fitur Utama Sistem
                    </h2>
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $project->key_features }}</p>
                </div>
                @endif
            </div>

            <!-- 2. Kesiapan Teknologi & Hasil Uji (Section 3) -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-microchip text-cyan-600"></i> Spesifikasi Teknis & Kesiapan
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="font-bold text-slate-400 uppercase text-[10px] block">Technology Stack</span>
                        <span class="font-bold text-slate-800 text-sm mt-1 block">{{ $project->technology_stack ?? '-' }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="font-bold text-slate-400 uppercase text-[10px] block">Tahap Kesiapan (TRL)</span>
                        <span class="font-bold text-slate-800 text-sm mt-1 block">{{ $project->readiness_level }}</span>
                    </div>
                </div>

                @if($project->test_results)
                <div>
                    <h3 class="text-xs uppercase font-bold text-slate-400 tracking-wider mb-1">Hasil Pengujian & Validasi</h3>
                    <p class="text-xs text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $project->test_results }}</p>
                </div>
                @endif

                @if($project->limitations)
                <div>
                    <h3 class="text-xs uppercase font-bold text-slate-400 tracking-wider mb-1">Keterbatasan Sistem Saat Ini</h3>
                    <p class="text-xs text-slate-700 leading-relaxed bg-amber-50/50 p-4 rounded-xl border border-amber-200/50 text-amber-900">{{ $project->limitations }}</p>
                </div>
                @endif

                <!-- Links Demo & Video -->
                @if($project->demo_url || $project->video_url)
                <div class="flex flex-wrap gap-3 pt-2">
                    @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="px-4 py-2 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs flex items-center gap-2 shadow-sm transition">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Coba Demo Interaktif
                    </a>
                    @endif
                    @if($project->video_url)
                    <a href="{{ $project->video_url }}" target="_blank" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs flex items-center gap-2 shadow-sm transition">
                        <i class="fa-brands fa-youtube"></i> Tonton Video Presentasi
                    </a>
                    @endif
                </div>
                @endif
            </div>

            <!-- 3. Kebutuhan Kolaborasi (Section 3 & 9) -->
            @if($project->collaboration_needs)
            <div class="bg-gradient-to-tr from-cyan-900 to-indigo-950 rounded-2xl p-6 sm:p-8 text-white space-y-3">
                <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold bg-cyan-400 text-slate-950 uppercase tracking-wider">
                    Peluang Kemitraan & Matchmaking
                </span>
                <h3 class="text-lg font-bold">Kebutuhan Kolaborasi Tim</h3>
                <p class="text-xs text-slate-300 leading-relaxed">{{ $project->collaboration_needs }}</p>
                @auth
                    @if(auth()->user()->hasRole(['pic-industri', 'super-admin']))
                        <a href="{{ route('portal.dashboard') }}" class="inline-flex items-center gap-2 mt-2 px-4 py-2 rounded-xl bg-white text-slate-900 font-bold text-xs hover:bg-slate-100 transition">
                            <i class="fa-solid fa-handshake"></i> Jadwalkan Pertemuan Meja di Portal Industri
                        </a>
                    @endif
                @else
                    <p class="text-[11px] text-cyan-300 mt-2"><i class="fa-solid fa-circle-info mr-1"></i> Pelaku industri dapat masuk ke portal untuk mengajukan pertemuan bisnis langsung dengan tim ini.</p>
                @endauth
            </div>
            @endif

            <!-- 4. Feedback & Masukan Pengunjung (Section 2 & 14) -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <i class="fa-regular fa-comments text-cyan-600"></i> Feedback & Ulasan Pengunjung ({{ $project->feedbacks->count() }})
                    </h3>
                </div>

                <!-- Feedback List -->
                @if($project->feedbacks->count() > 0)
                <div class="space-y-3">
                    @foreach($project->feedbacks as $fb)
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-1.5 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-slate-800">{{ $fb->giver_name }} <span class="text-slate-400 font-normal">({{ ucfirst($fb->giver_category) }})</span></span>
                            <div class="flex text-amber-400 text-[10px]">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star {{ $i <= $fb->rating ? '' : 'text-slate-200' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="text-slate-700 leading-relaxed">{{ $fb->comment }}</p>
                        @if($fb->suggestion)
                            <p class="text-slate-500 italic"><strong class="text-slate-600">Saran:</strong> {{ $fb->suggestion }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-xs text-slate-400 italic">Belum ada feedback untuk karya ini. Jadilah yang pertama memberikan masukan konstruktif!</p>
                @endif

                <!-- Feedback Form -->
                <div class="pt-4 border-t border-slate-100">
                    <h4 class="text-xs uppercase font-bold text-slate-700 mb-3">Kirimkan Feedback & Masukan Anda</h4>
                    <form action="{{ route('project.feedback', $project->id) }}" method="POST" class="space-y-3 text-xs">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <input type="text" name="giver_name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required placeholder="Nama Anda"
                                class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-cyan-500 bg-slate-50">
                            
                            <select name="giver_category" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-cyan-500 bg-slate-50 text-slate-700">
                                <option value="visitor">Pengunjung Umum</option>
                                <option value="industry">Praktisi Industri</option>
                                <option value="academic">Dosen / Akademisi</option>
                                <option value="student">Mahasiswa</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-600 mb-1">Rating Penilaian (1 - 5 Bintang):</label>
                            <select name="rating" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-bold">
                                <option value="5">⭐⭐⭐⭐⭐ 5 - Sangat Luar Biasa</option>
                                <option value="4">⭐⭐⭐⭐ 4 - Bagus & Menjanjikan</option>
                                <option value="3">⭐⭐⭐ 3 - Cukup Baik</option>
                                <option value="2">⭐⭐ 2 - Perlu Penyempurnaan</option>
                                <option value="1">⭐ 1 - Kurang Relevan</option>
                            </select>
                        </div>

                        <textarea name="comment" rows="3" required placeholder="Tuliskan ulasan Anda mengenai inovasi ini..."
                            class="w-full p-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-cyan-500 bg-slate-50"></textarea>

                        <input type="text" name="suggestion" placeholder="Saran perbaikan / peluang adopsi (opsional)"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-cyan-500 bg-slate-50">

                        <label class="flex items-start gap-2 text-[11px] text-slate-600">
                            <input type="checkbox" name="publish_feedback" value="1" class="mt-0.5 rounded border-slate-300">
                            <span>Saya mengizinkan nama dan feedback ini ditampilkan secara publik pada halaman karya.</span>
                        </label>

                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold text-xs transition">
                            Kirim Feedback
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info (Right 1 Col) -->
        <div class="space-y-6">
            <!-- VOTING BOX (Section 14 & BR-14) -->
            <div class="bg-gradient-to-tr from-indigo-900 via-slate-900 to-indigo-950 rounded-2xl p-6 text-white border border-indigo-800 shadow-md">
                <div class="flex items-center gap-2 text-amber-400 text-xs font-extrabold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-award"></i> People's Choice Award
                </div>
                <h3 class="text-lg font-black">Dukung Karya Favorit Anda!</h3>
                <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                    Satu pengunjung terverifikasi berhak memberikan 1 suara untuk karya terfavorit (BR-14). Hak suara aktif setelah check-in resmi di Sabuga.
                </p>

                <div class="mt-4 pt-4 border-t border-slate-800">
                    <div class="flex items-center justify-between text-xs mb-3">
                        <span class="text-slate-400">Total Suara Saat Ini:</span>
                        <span class="font-black text-amber-400 text-base">{{ $project->votes()->count() }} Suara</span>
                    </div>

                    @auth
                        @if($hasVoted)
                            <div class="p-3 rounded-xl bg-slate-800 text-cyan-300 text-xs text-center font-bold">
                                <i class="fa-solid fa-circle-check mr-1"></i> Anda telah memberikan suara untuk festival ini.
                            </div>
                        @elseif($canVote)
                            <form action="{{ route('project.vote', $project->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black text-xs uppercase tracking-wider shadow-md transition">
                                    <i class="fa-solid fa-check-to-slot mr-1"></i> Vote Karya Ini Sekarang
                                </button>
                            </form>
                        @else
                            <div class="p-3 rounded-xl bg-slate-800/80 text-amber-200 text-xs text-center">
                                <p class="font-bold"><i class="fa-solid fa-lock mr-1"></i> Hak Suara Belum Aktif</p>
                                @if(!$votingPeriodOpen)
                                    <p class="text-[11px] text-slate-400 mt-1">Periode voting {{ $event->voting_start_at && now()->lt($event->voting_start_at) ? 'belum dibuka' : 'telah ditutup' }}. {{ $event->voting_start_at?->copy()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}{{ $event->voting_start_at && $event->voting_end_at ? ' – ' : '' }}{{ $event->voting_end_at?->copy()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB.</p>
                                @else
                                    <p class="text-[11px] text-slate-400 mt-1">Lakukan check-in di meja registrasi Sabuga untuk mengaktifkan hak voting Anda (Section 14).</p>
                                @endif
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs">
                            Masuk untuk Memberikan Suara
                        </a>
                    @endauth
                </div>
            </div>

            <!-- TIM INOVATOR (Section 3: Tim yang diizinkan tampil, tanpa bocor kontak pribadi Section 10) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-user-group text-cyan-600"></i> Tim Inovator Kampus
                </h3>

                <div class="text-xs space-y-3">
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Nama Tim:</span>
                        <span class="font-bold text-slate-800 text-sm">{{ $project->team?->name ?? 'Tim Pengusul' }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Anggota Tim:</span>
                        <ul class="mt-1 space-y-1.5">
                            @forelse($project->team?->members ?? [] as $m)
                            <li class="flex items-center justify-between p-2 rounded-lg bg-slate-50 border border-slate-100">
                                <div>
                                    <span class="font-bold text-slate-800 block">{{ $m->name }}</span>
                                    <span class="text-[10px] text-slate-500">{{ $m->study_program ?? 'Mahasiswa' }}</span>
                                </div>
                                @if($m->is_leader)
                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-cyan-100 text-cyan-800">Ketua</span>
                                @endif
                            </li>
                            @empty
                            <li class="text-slate-400 italic">Data tim terverifikasi panitia.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="pt-3 border-t border-slate-100 text-[11px] text-slate-500">
                        <i class="fa-solid fa-lock text-slate-400 mr-1"></i> Kontak pribadi mahasiswa dilindungi sesuai aturan privasi (Section 10).
                    </div>
                </div>
            </div>

            <!-- BOOTH & TEKNIS LOKASI (BR-03) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-3 text-xs">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-map-pin text-rose-500"></i> Lokasi Booth di Venue
                </h3>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                    <span class="font-bold text-slate-800 text-sm">Booth {{ $project->booth?->code ?? '-' }}</span>
                    <p class="text-slate-500">{{ $project->booth?->zone ?? 'Hall Utama Sabuga' }}</p>
                    <p class="text-[11px] text-slate-400 pt-1">Ukuran {{ $project->booth?->size ?? '3x3 m' }} &bull; Daya {{ $project->booth?->power_watt ?? 450 }}W</p>
                    <p class="text-[11px] text-indigo-700 font-semibold pt-1">
                        <i class="fa-solid fa-circle-info mr-1"></i> Berbagi booth dengan karya kampus serumpun (BR-03)
                    </p>
                </div>
                <a href="{{ route('venue') }}" class="block text-center py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition">
                    Lihat Denah 45 Booth
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
