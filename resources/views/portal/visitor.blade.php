@extends('layouts.app', ['title' => 'Portal Pengunjung | E-Tiket & Voting FUTURiSE 2026'])

@section('content')
<div class="gradient-brand text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Portal Pengunjung Terdaftar</span>
        <h1 class="text-2xl sm:text-3xl font-black mt-1">Halo, {{ auth()->user()->name }}!</h1>
        <p class="text-xs text-slate-300 mt-1">E-Tiket resmi, hak voting People's Choice Award, dan survei kepuasan pengunjung.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- 1. E-TIKET RESMI DENGAN TOKEN QR AMAN (BR-17) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
            <div class="text-center">
                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-cyan-100 text-cyan-800">
                    E-Ticket Resmi Sabuga
                </span>
                <h3 class="text-xl font-black text-slate-900 mt-2">FUTURiSE 2026 Pass</h3>
                <p class="text-xs text-slate-500">Tunjukkan di meja registrasi Gate 1 Sabuga ITB</p>
            </div>

            <!-- QR ticket encodes only the random token (BR-17). -->
            <div class="bg-gradient-to-tr from-slate-900 to-indigo-950 p-6 rounded-2xl text-white text-center shadow-lg border border-slate-800 space-y-3">
                <div class="w-52 h-52 bg-white p-3 rounded-2xl mx-auto flex items-center justify-center shadow-md">
                    @if($ticket && $ticket->qr_token)
                        <div id="ticket-qr" data-qr-token="{{ $ticket->qr_token }}" class="w-full h-full flex items-center justify-center" aria-label="QR tiket FUTURiSE"></div>
                    @else
                        <p class="text-xs text-rose-700">QR tiket belum tersedia. Hubungi sekretariat.</p>
                    @endif
                </div>
                
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-bold block">Nomor Tiket:</span>
                    <span class="text-sm font-black text-amber-400 tracking-wider block font-mono">{{ $ticket->ticket_number ?? 'FTR-VIS-88899' }}</span>
                </div>

                <p class="pt-2 border-t border-slate-800 text-[10px] text-slate-400">Tunjukkan QR ini kepada petugas gate untuk check-in.</p>
            </div>

            <!-- Check-In Status Indicator (BR-11) -->
            <div class="p-4 rounded-xl {{ $ticket && $ticket->has_checked_in ? 'bg-emerald-50 border border-emerald-200 text-emerald-900' : 'bg-amber-50 border border-amber-200 text-amber-900' }} text-xs text-center space-y-1">
                <span class="font-bold block text-sm">
                    <i class="fa-solid {{ $ticket && $ticket->has_checked_in ? 'fa-circle-check text-emerald-600' : 'fa-clock text-amber-600' }} mr-1"></i>
                    {{ $ticket && $ticket->has_checked_in ? 'SUDAH CHECK-IN RESMI' : 'BELUM CHECK-IN DI VENUE' }}
                </span>
                @if($ticket && $ticket->has_checked_in)
                    <p class="text-[11px] text-emerald-700">Waktu Scan Pertama: {{ $ticket->first_checked_in_at ? $ticket->first_checked_in_at->format('d M Y H:i') : '-' }} WIB</p>
                    <p class="text-[10px] text-emerald-800 font-bold uppercase mt-1">&check; Hak Suara Voting Telah Aktif!</p>
                @else
                    <p class="text-[11px] text-amber-700">Scan QR ini saat tiba di pintu masuk Sabuga untuk mengaktifkan lanyard dan hak voting (Section 14).</p>
                @endif
            </div>
        </div>

        <!-- 2. VOTING & SURVEI KEPUASAN CSAT (Section 14) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Voting Status Box -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-award text-amber-500"></i> People's Choice Award (Section 14)
                    </h3>
                    <span class="text-xs text-slate-400 font-medium">1 Pengunjung = 1 Suara Terverifikasi</span>
                </div>

                @if($votedProject)
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div class="text-xs space-y-1">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-500 text-slate-950 uppercase">Suara Terverifikasi Tercatat</span>
                        <h4 class="font-bold text-slate-900 text-base">{{ $votedProject->project->title }}</h4>
                        <p class="text-cyan-700 font-semibold">{{ $votedProject->project->organization->name }} (Booth {{ $votedProject->project->booth?->code ?? '-' }})</p>
                        <p class="text-[11px] text-slate-400 pt-1">Suara Anda telah disimpan dengan aman dan dihitung terpisah dari penilaian dewan juri (BR-14).</p>
                    </div>
                </div>
                @else
                <div class="p-5 rounded-2xl bg-indigo-50 border border-indigo-100 text-xs text-indigo-950 space-y-2">
                    <p class="font-bold text-sm">Anda belum memberikan suara untuk People's Choice Award.</p>
                    <p class="text-indigo-800 leading-relaxed">Jelajahi 60 karya inovasi mahasiswa di halaman Showcase, lalu klik tombol "Vote Karya Ini" pada inovasi pilihan terbaik Anda.</p>
                    <div class="pt-2">
                        <a href="{{ route('showcase') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-900 text-white font-bold text-xs hover:bg-indigo-800 transition">
                            <i class="fa-solid fa-laptop-code"></i> Buka Katalog Showcase 60 Karya
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Survei Kepuasan CSAT (Section 14: Target >=85% puas) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <i class="fa-regular fa-face-smile text-cyan-600"></i> Survei Kepuasan Pengunjung Festival (CSAT)
                    </h3>
                    <span class="text-xs font-bold text-teal-700 bg-teal-50 px-2.5 py-0.5 rounded-full">Target &ge; 85% Puas</span>
                </div>

                <p class="text-xs text-slate-600 leading-relaxed">
                    Bantu kami meningkatkan kualitas penyelenggaraan festival APTIKOM Jawa Barat. Sesuai Section 14, respons bernilai 4 atau 5 dihitung sebagai pengunjung yang puas.
                </p>

                @if($surveyResponse)
                    <p class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold">Respons survei Anda sudah tercatat. Terima kasih telah membantu evaluasi acara.</p>
                @elseif($ticket && $ticket->has_checked_in)
                <form action="{{ route('survey.submit') }}" method="POST" class="space-y-4 text-xs pt-2">
                    @csrf
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-2">Seberapa Puas Anda dengan Penyelenggaraan FUTURiSE 2026? (Skala 1 - 5)</label>
                        <div class="grid grid-cols-5 gap-2 text-center">
                            <label class="p-3 rounded-xl border border-slate-200 hover:border-cyan-500 cursor-pointer bg-slate-50 flex flex-col items-center">
                                <input type="radio" name="satisfaction_score" value="1" required class="text-cyan-600">
                                <span class="text-lg mt-1 block">😞</span>
                                <span class="text-[10px] font-bold text-slate-500 mt-1">1 - Kurang</span>
                            </label>
                            <label class="p-3 rounded-xl border border-slate-200 hover:border-cyan-500 cursor-pointer bg-slate-50 flex flex-col items-center">
                                <input type="radio" name="satisfaction_score" value="2" class="text-cyan-600">
                                <span class="text-lg mt-1 block">😐</span>
                                <span class="text-[10px] font-bold text-slate-500 mt-1">2 - Cukup</span>
                            </label>
                            <label class="p-3 rounded-xl border border-slate-200 hover:border-cyan-500 cursor-pointer bg-slate-50 flex flex-col items-center">
                                <input type="radio" name="satisfaction_score" value="3" class="text-cyan-600">
                                <span class="text-lg mt-1 block">🙂</span>
                                <span class="text-[10px] font-bold text-slate-500 mt-1">3 - Baik</span>
                            </label>
                            <label class="p-3 rounded-xl border border-cyan-300 hover:border-cyan-600 cursor-pointer bg-cyan-50/50 flex flex-col items-center">
                                <input type="radio" name="satisfaction_score" value="4" class="text-cyan-600">
                                <span class="text-lg mt-1 block">😊</span>
                                <span class="text-[10px] font-bold text-cyan-800 mt-1">4 - Puas</span>
                            </label>
                            <label class="p-3 rounded-xl border border-cyan-400 hover:border-cyan-600 cursor-pointer bg-cyan-50 flex flex-col items-center">
                                <input type="radio" name="satisfaction_score" value="5" checked class="text-cyan-600">
                                <span class="text-lg mt-1 block">🤩</span>
                                <span class="text-[10px] font-bold text-cyan-900 mt-1">5 - Sangat Puas</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Masukan / Kesan & Pesan Tambahan</label>
                        <textarea name="feedback_text" rows="3" placeholder="Saran Anda untuk penyelenggaraan tahun berikutnya..."
                            class="w-full p-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-cyan-500 bg-slate-50"></textarea>
                    </div>

                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs uppercase tracking-wider transition">
                        Kirim Respons Survei Kepuasan
                    </button>
                </form>
                @else
                    <p class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-xs">Survei dapat diisi setelah tiket Anda tercatat check-in di venue.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@if($ticket && $ticket->qr_token)
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const qrElement = document.getElementById('ticket-qr');
        if (!qrElement) return;

        if (window.QRCode) {
            new QRCode(qrElement, {
                text: qrElement.dataset.qrToken,
                width: 184,
                height: 184,
                correctLevel: QRCode.CorrectLevel.H
            });
        } else {
            qrElement.innerHTML = '<span class="text-xs text-rose-700 text-center">QR gagal dimuat. Muat ulang halaman.</span>';
        }
    });
</script>
@endif
@endsection
