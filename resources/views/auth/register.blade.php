@extends('layouts.app', ['title' => 'Pendaftaran Akun Baru | FUTURiSE 2026'])

@section('content')
<div class="py-12 bg-slate-50 min-h-[85vh] flex items-center justify-center">
    <div class="max-w-2xl w-full mx-4" x-data="{ category: '{{ $category ?? 'pengunjung' }}' }">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-cyan-600 to-indigo-600 flex items-center justify-center text-white mx-auto shadow-md mb-3">
                    <i class="fa-solid fa-user-plus text-2xl"></i>
                </div>
                <h1 class="text-2xl font-black text-slate-900">Pendaftaran Akun FUTURiSE</h1>
                <p class="text-xs text-slate-500 mt-1">Pilih kategori partisipasi Anda untuk mendapatkan akses portal yang tepat</p>
            </div>

            <!-- Category Selector Tabs -->
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 mb-6">
                <button type="button" @click="category = 'pengunjung'" :class="category === 'pengunjung' ? 'bg-indigo-900 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="p-3 rounded-xl text-center text-xs font-bold transition flex flex-col items-center gap-1.5">
                    <i class="fa-solid fa-ticket text-sm"></i>
                    <span>Pengunjung</span>
                </button>
                <button type="button" @click="category = 'kampus'" :class="category === 'kampus' ? 'bg-indigo-900 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="p-3 rounded-xl text-center text-xs font-bold transition flex flex-col items-center gap-1.5">
                    <i class="fa-solid fa-building-columns text-sm"></i>
                    <span>Kampus</span>
                </button>
                <button type="button" @click="category = 'industri'" :class="category === 'industri' ? 'bg-indigo-900 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="p-3 rounded-xl text-center text-xs font-bold transition flex flex-col items-center gap-1.5">
                    <i class="fa-solid fa-industry text-sm"></i>
                    <span>Industri</span>
                </button>
                <button type="button" @click="category = 'sponsor'" :class="category === 'sponsor' ? 'bg-indigo-900 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="p-3 rounded-xl text-center text-xs font-bold transition flex flex-col items-center gap-1.5">
                    <i class="fa-solid fa-handshake text-sm"></i>
                    <span>Sponsor</span>
                </button>
                <button type="button" @click="category = 'sekolah'" :class="category === 'sekolah' ? 'bg-indigo-900 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="p-3 rounded-xl text-center text-xs font-bold transition flex flex-col items-center gap-1.5 col-span-2 sm:col-span-1">
                    <i class="fa-solid fa-school text-sm"></i>
                    <span>Sekolah Tur</span>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="category" :value="category">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap PIC / Pendaftar</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                            placeholder="Nama Lengkap">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp / HP</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                            placeholder="0812xxxxxxxx">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                        placeholder="email@institusi.ac.id">
                </div>

                <!-- Organization Name Field (For Non-Visitors) -->
                <div x-show="category !== 'pengunjung'" x-cloak>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        <span x-text="category === 'kampus' ? 'Nama Perguruan Tinggi / Universitas' : (category === 'industri' ? 'Nama Perusahaan / Organisasi' : (category === 'sponsor' ? 'Nama Instansi Sponsor' : 'Nama Sekolah (SMK/SMA)'))"></span>
                    </label>
                    <input type="text" name="organization_name" value="{{ old('organization_name') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                        placeholder="Misal: Institut Teknologi Bandung">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kata Sandi</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                            placeholder="Minimal 6 karakter">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50"
                            placeholder="Ulangi kata sandi">
                    </div>
                </div>

                <div class="text-[11px] text-slate-500 bg-slate-50 p-3 rounded-xl border border-slate-100 flex items-start gap-2">
                    <i class="fa-solid fa-shield-halved text-cyan-600 mt-0.5"></i>
                    <span>Dengan mendaftar, Anda menyetujui pemrosesan data identitas untuk kebutuhan verifikasi resmi acara APTIKOM Jawa Barat. Kontak pribadi tidak dipublikasikan tanpa izin (Section 10).</span>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-cyan-600 to-indigo-600 hover:from-cyan-700 hover:to-indigo-700 text-white font-bold text-sm shadow-md shadow-cyan-500/20 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> Selesaikan Pendaftaran
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center text-xs text-slate-500">
                Sudah memiliki akun terdaftar? 
                <a href="{{ route('login') }}" class="font-bold text-cyan-600 hover:text-cyan-700">Masuk di Sini</a>
            </div>
        </div>
    </div>
</div>
@endsection
