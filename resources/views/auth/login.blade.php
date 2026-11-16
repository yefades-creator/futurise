@extends('layouts.app', ['title' => 'Masuk ke Portal FUTURiSE 2026'])

@section('content')
<div class="py-12 bg-slate-50 min-h-[80vh] flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-900 to-cyan-500 flex items-center justify-center text-white mx-auto shadow-md mb-3">
                    <i class="fa-solid fa-lock text-2xl"></i>
                </div>
                <h1 class="text-2xl font-black text-slate-900">Masuk ke Portal</h1>
                <p class="text-xs text-slate-500 mt-1">Satu akun untuk seluruh portal peserta, juri, dan panitia FUTURiSE</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 bg-slate-50"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-key absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 bg-slate-50"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        <span>Ingat saya</span>
                    </label>
                    <span class="text-slate-400">Password default: <code class="bg-slate-100 px-1 py-0.5 rounded text-slate-700">password</code></span>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-600 to-indigo-600 hover:from-cyan-700 hover:to-indigo-700 text-white font-bold text-sm shadow-md shadow-cyan-500/20 transition flex items-center justify-center gap-2 mt-2">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center text-xs text-slate-500">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="font-bold text-cyan-600 hover:text-cyan-700">Daftar Akun Baru</a>
            </div>
        </div>

        <!-- Quick 1-Click Login Helper for Reviewer -->
        <div class="mt-6 bg-slate-900 rounded-2xl p-5 text-white shadow-lg border border-slate-800">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-amber-400 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> 1-Click Demo Login
                </span>
                <span class="text-[10px] bg-slate-800 text-slate-300 px-2 py-0.5 rounded">Pengujian Cepat</span>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <a href="{{ route('quick.login', 'admin@futurise.id') }}" class="p-2 rounded bg-slate-800 hover:bg-indigo-600 text-left transition flex items-center justify-between">
                    <span>👑 Super Admin</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
                <a href="{{ route('quick.login', 'kurator@futurise.id') }}" class="p-2 rounded bg-slate-800 hover:bg-blue-600 text-left transition flex items-center justify-between">
                    <span>📋 Kurator Karya</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
                <a href="{{ route('quick.login', 'keuangan@futurise.id') }}" class="p-2 rounded bg-slate-800 hover:bg-emerald-600 text-left transition flex items-center justify-between">
                    <span>💰 Keuangan</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
                <a href="{{ route('quick.login', 'venue@futurise.id') }}" class="p-2 rounded bg-slate-800 hover:bg-teal-600 text-left transition flex items-center justify-between">
                    <span>🎪 Venue & Booth</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
                <a href="{{ route('quick.login', 'juri@futurise.id') }}" class="p-2 rounded bg-slate-800 hover:bg-purple-600 text-left transition flex items-center justify-between">
                    <span>⚖️ Juri Ahli</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
                <a href="{{ route('quick.login', 'registrasi@futurise.id') }}" class="p-2 rounded bg-slate-800 hover:bg-rose-600 text-left transition flex items-center justify-between">
                    <span>📱 Registrasi Gate</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
                <a href="{{ route('quick.login', 'kampus@itb.ac.id') }}" class="p-2 rounded bg-slate-800 hover:bg-sky-600 text-left transition flex items-center justify-between">
                    <span>🏛️ PIC ITB</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
                <a href="{{ route('quick.login', 'pengunjung@gmail.com') }}" class="p-2 rounded bg-slate-800 hover:bg-amber-600 text-left transition flex items-center justify-between">
                    <span>🎫 Pengunjung</span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
