@extends('layouts.app', ['title' => 'Kontak Sekretariat Panitia | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Layanan Bantuan</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Kontak Sekretariat Resmi</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Hubungi panitia APTIKOM Jawa Barat untuk pertanyaan teknis pameran, sponsorship, registrasi rombongan sekolah, atau kemitraan.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Contact Info (1 Col) -->
        <div class="bg-slate-900 rounded-3xl p-8 text-white space-y-6 shadow-xl">
            <div>
                <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest">Sekretariat Pelaksana</span>
                <h2 class="text-xl font-bold mt-1">APTIKOM Wilayah IV Jawa Barat</h2>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">
                    Pusat koordinasi festival, administrasi peserta kampus, dan layanan informasi publik.
                </p>
            </div>

            <div class="space-y-4 text-xs pt-4 border-t border-slate-800">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-cyan-400 flex-shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Alamat Sekretariat:</span>
                        <span class="font-medium text-slate-200">Gedung Labtek V ITB / Sekretariat APTIKOM Jabar, Jl. Ganesha No. 10 Bandung 40132</span>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-cyan-400 flex-shrink-0">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Email Resmi:</span>
                        <span class="font-medium text-slate-200">sekretariat@aptikom-jabar.id</span>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-cyan-400 flex-shrink-0">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold">Telepon & WhatsApp:</span>
                        <span class="font-medium text-slate-200">+62 22 2504444 / 0811-2233-4403</span>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-800 text-[11px] text-slate-400">
                Jam Layanan Sekretariat: <br>
                <strong class="text-slate-300">Senin - Jumat &bull; 08.30 - 17.00 WIB</strong>
            </div>
        </div>

        <!-- Contact Form (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-sm space-y-6">
            <div>
                <h2 class="text-xl font-black text-slate-900">Formulir Bantuan & Pertanyaan</h2>
                <p class="text-xs text-slate-500 mt-1">Sampaikan pertanyaan Anda dan tim sekretariat akan merespon melalui email terdaftar.</p>
            </div>

            <form action="{{ route('portal.support.submit') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Nama Pengirim</label>
                        <input type="text" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                            placeholder="Nama Lengkap">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Email Pengirim</label>
                        <input type="email" name="email" value="{{ auth()->check() ? auth()->user()->email : '' }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                            placeholder="email@anda.com">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Kategori Pertanyaan (Section 2)</label>
                    <select name="category" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-cyan-500 bg-slate-50 text-slate-700 font-semibold">
                        <option value="pendaftaran">Pendaftaran Kampus & Karya Mahasiswa</option>
                        <option value="booth">Fasilitas & Kebutuhan Teknis Booth</option>
                        <option value="jadwal">Rundown Acara & Sesi Pitching</option>
                        <option value="sponsor">Sponsorship & Kemitraan Industri</option>
                        <option value="sekolah">Kunjungan Rombongan Sekolah / Tur</option>
                        <option value="bantuan">Bantuan Teknis Sistem / Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Subjek Pesan</label>
                    <input type="text" name="subject" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                        placeholder="Ringkasan kendala atau pertanyaan">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Isi Pesan Detail</label>
                    <textarea name="message" rows="5" required
                        class="w-full p-4 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-cyan-500 bg-slate-50 leading-relaxed"
                        placeholder="Jelaskan kebutuhan, pertanyaan, atau kendala Anda secara lengkap..."></textarea>
                </div>

                <button type="submit" class="px-6 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs uppercase tracking-wider shadow-md transition flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Pertanyaan ke Panitia
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
