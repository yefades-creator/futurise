@extends('layouts.app', ['title' => 'Paket Kemitraan Sponsorship | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Peluang Kemitraan</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Paket Sponsorship & Dukungan Kemitraan</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Tingkatkan visibilitas brand perusahaan Anda di hadapan ribuan talenta digital, pimpinan 30 perguruan tinggi, dan ekosistem inovasi Jawa Barat.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Download Proposal Banner -->
    <div class="bg-gradient-to-r from-cyan-900 to-indigo-900 rounded-3xl p-8 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
        <div class="space-y-2">
            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-cyan-400 text-slate-950">Dokumen Resmi</span>
            <h2 class="text-2xl font-black">Unduh Proposal Sponsorship Lengkap (PDF)</h2>
            <p class="text-xs text-slate-300 max-w-xl">
                Pelajari rincian skema paket kemitraan, exposure publikasi panggung utama, hak booth, dan rincian benefit seremonial.
            </p>
        </div>
        <a href="{{ route('participant.info') }}" class="px-6 py-3.5 rounded-xl bg-white hover:bg-slate-100 text-slate-950 font-black text-xs uppercase tracking-wider flex items-center gap-2 shadow-lg flex-shrink-0 transition">
            <i class="fa-solid fa-file-arrow-down text-base text-cyan-700"></i> Unduh Proposal PDF
        </a>
    </div>

    <!-- Sponsorship Packages (Section 2 & 10) -->
    <div>
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-3xl font-black text-slate-900">Pilihan Paket Sponsorship</h2>
            <p class="text-xs text-slate-500 mt-2">Dukungan dapat berupa dana tunai maupun dukungan barang/jasa fasilitas teknologi (BR-08).</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($packages as $pkg)
            <div class="bg-white rounded-3xl border {{ $pkg->slug === 'platinum' ? 'border-cyan-500 ring-2 ring-cyan-500 shadow-xl' : 'border-slate-200 shadow-sm' }} p-8 flex flex-col justify-between relative">
                @if($pkg->slug === 'platinum')
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-cyan-600 text-white font-black text-[10px] uppercase tracking-wider shadow-sm">
                    Paling Bergengsi
                </span>
                @endif

                <div class="space-y-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $pkg->name }}</span>
                        <div class="mt-2 flex items-baseline gap-1">
                            <span class="text-xs font-bold text-slate-500">Rp</span>
                            <span class="text-3xl font-black text-slate-900">{{ number_format($pkg->price, 0, ',', '.') }}</span>
                        </div>
                        <span class="text-[11px] text-slate-400 block mt-0.5">Kuota terbatas {{ $pkg->quota }} Mitra</span>
                    </div>

                    <p class="text-xs text-slate-600 leading-relaxed pt-2 border-t border-slate-100">{{ $pkg->benefits_summary }}</p>

                    <!-- Feature List -->
                    <div class="pt-4 border-t border-slate-100 space-y-2.5 text-xs text-slate-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-cyan-600"></i>
                            <span>{{ $pkg->includes_booth ? 'Termasuk Booth Korporat di Hall Utama' : 'Penayangan Branding Media Digital' }}</span>
                        </div>
                        @foreach($pkg->benefits as $b)
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-cyan-600"></i>
                            <span>{{ $b->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-8 mt-6 border-t border-slate-100">
                    <a href="{{ route('register', ['category' => 'sponsor']) }}" class="block w-full text-center py-3 rounded-xl {{ $pkg->slug === 'platinum' ? 'bg-cyan-600 hover:bg-cyan-700 text-white shadow-md' : 'bg-slate-900 hover:bg-slate-800 text-white' }} font-bold text-xs uppercase tracking-wider transition">
                        Pilih Paket {{ $pkg->name }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- DUKUNGAN BARANG/JASA (BR-08: Terpisah dari kas) -->
    <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200 space-y-6">
        <div>
            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-teal-100 text-teal-800 tracking-wider">
                Skema In-Kind (BR-08)
            </span>
            <h3 class="text-xl font-bold text-slate-900 mt-2">Dukungan Barang / Jasa (In-Kind Contribution)</h3>
            <p class="text-xs text-slate-600 mt-1 max-w-3xl leading-relaxed">
                Selain dana tunai, panitia APTIKOM Jawa Barat menerima dukungan fasilitas dan layanan bernilai tambah seperti penyediaan bandwidth internet cepat, cloud hosting voucher pemenang, server GPU, coffee break, media exposure, dan fasilitas pendukung lainnya yang dicatat secara transparan terpisah dari pembukuan kas (BR-08).
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($inKindContributions as $ink)
            <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-boxes-packing"></i>
                </div>
                <div class="text-xs space-y-1">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-900 text-sm">{{ $ink->item_name }}</span>
                        <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] font-bold">Terverifikasi</span>
                    </div>
                    <p class="text-slate-500">Pemberi Dukungan: <strong class="text-slate-700">{{ $ink->organization->name }}</strong></p>
                    <p class="text-slate-600">{{ $ink->description }}</p>
                    <span class="text-slate-400 block pt-1 text-[11px]">Estimasi Nilai: <strong>Rp {{ number_format($ink->estimated_value, 0, ',', '.') }}</strong></span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
