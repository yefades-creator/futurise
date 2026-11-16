@extends('layouts.app', ['title' => 'Portal Sponsor Resmi | FUTURiSE 2026'])

@section('content')
<div class="gradient-brand text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Portal Mitra Sponsorship</span>
        <h1 class="text-2xl sm:text-3xl font-black mt-1">{{ $organization->name ?? 'Portal Sponsor' }}</h1>
        <p class="text-xs text-slate-300 mt-1">Kesepakatan Paket: <strong class="text-amber-400">{{ $agreement?->package?->name ?? 'Belum ditentukan' }}</strong> &bull; PIC: <strong>{{ $organization->pic_name ?? auth()->user()->name }}</strong></p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
    @include('portal._organization-status')
    @include('portal._invoices')
    <!-- Kesepakatan & Nilai Kontrak (Section 4 & BR-08) -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
        <h2 class="text-xl font-black text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-file-contract text-indigo-600"></i> Rincian Kesepakatan Sponsorship
        </h2>

        <p class="text-xs text-slate-500">Rincian kontrak dikelola oleh panitia Industri & Sponsor. Hubungi PIC panitia jika ada koreksi; perubahan akan tercatat di audit log.</p>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 uppercase font-bold text-[10px] block">Nomor Kesepakatan</span>
                <span class="font-bold text-slate-800 text-sm mt-1 block">{{ $agreement?->agreement_number ?? 'Belum tersedia' }}</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 uppercase font-bold text-[10px] block">Nilai Komitmen</span>
                <span class="font-black text-emerald-700 text-base mt-1 block">{{ $agreement ? 'Rp ' . number_format($agreement->agreed_amount, 0, ',', '.') : 'Belum tersedia' }}</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 uppercase font-bold text-[10px] block">Tipe Dukungan (BR-08)</span>
                <span class="font-bold text-slate-800 text-sm mt-1 block uppercase">{{ $agreement?->support_type ?? 'Cash' }}</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 uppercase font-bold text-[10px] block">Status Kontrak</span>
                <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase {{ $agreement && in_array($agreement->status, ['agreed', 'signed'], true) ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }} mt-1 inline-block">
                    {{ strtoupper($agreement?->status ?? 'Belum tersedia') }}
                </span>
            </div>
        </div>
        @if($agreement?->in_kind_description)
            <div class="rounded-xl bg-slate-50 border border-slate-100 p-4 text-xs"><strong class="block text-slate-500 uppercase text-[10px] mb-1">Rincian dukungan barang/jasa</strong>{{ $agreement->in_kind_description }}</div>
        @endif
        @if($agreement?->contract_document)
            <a href="{{ $agreement->contract_document }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs font-bold text-indigo-700"><i class="fa-solid fa-file-arrow-up"></i> Buka dokumen kesepakatan</a>
        @endif
    </div>

    <!-- Pemenuhan Manfaat & Bukti Pelaksanaan (Section 4 & 7) -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
        <div>
            <span class="text-xs font-bold text-teal-600 uppercase tracking-widest">Eksekusi Benefit</span>
            <h2 class="text-xl font-black text-slate-900 mt-0.5">Pemenuhan Manfaat & Bukti Pelaksanaan</h2>
            <p class="text-xs text-slate-500 mt-1">Laporan transparan mengenai pemenuhan hak publikasi, tayangan LED, dan fasilitas booth sesuai kesepakatan.</p>
        </div>

        <div class="space-y-4 text-xs">
            @forelse($agreement?->fulfillments ?? [] as $ful)
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="font-bold text-slate-900 text-sm">{{ $ful->benefit->name }}</span>
                    <p class="text-slate-600">{{ $ful->notes ?? 'Benefit telah direalisasikan oleh panitia publikasi dan media center Sabuga.' }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $ful->status === 'fulfilled' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $ful->status === 'fulfilled' ? 'Terpenuhi (Selesai)' : 'Dalam Proses' }}
                    </span>
                    @if($ful->proof_file)
                    <a href="{{ route('portal.sponsorship.proofs.download', $ful->id) }}" class="px-3 py-1 rounded-xl bg-cyan-700 text-white font-bold text-xs flex items-center gap-1">
                        <i class="fa-solid fa-file-arrow-down"></i> Unduh Bukti
                    </a>
                    @endif
                    @if($ful->proof_url)
                    <a href="{{ $ful->proof_url }}" target="_blank" rel="noopener" class="px-3 py-1 rounded-xl bg-cyan-600 text-white font-bold text-xs flex items-center gap-1">
                        <i class="fa-solid fa-image"></i> Bukti
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-xs text-slate-500 italic">Daftar pemenuhan manfaat sedang dipersiapkan oleh tim Industri & Sponsor.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
