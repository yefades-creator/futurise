<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FUTURiSE 2026 - West Java Digital Innovation Festival' }} | APTIKOM Jawa Barat</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#0d9488',
                            600: '#0f766e',
                            700: '#115e59',
                            800: '#134e4a',
                            900: '#042f2e',
                        },
                        futurise: {
                            navy: '#0f172a',
                            indigo: '#1e1b4b',
                            cyan: '#06b6d4',
                            amber: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .gradient-brand {
            background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 50%, #042f2e 100%);
        }
        .text-gradient {
            background: linear-gradient(90deg, #38bdf8, #818cf8, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans flex flex-col min-h-screen antialiased selection:bg-cyan-500 selection:text-white">

    @if(app()->environment(['local', 'testing']))
    <!-- Demo role switcher is available only outside production. -->
    <div class="bg-slate-900 border-b border-slate-800 text-xs text-slate-300 py-1.5 px-4 sticky top-0 z-50 overflow-x-auto whitespace-nowrap shadow-md">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-500 text-slate-950 uppercase tracking-wider animate-pulse">
                    <i class="fa-solid fa-flask-vial mr-1"></i> Demo UAT Switcher
                </span>
                <span class="text-slate-400">Masuk Cepat:</span>
            </div>
            <div class="flex items-center gap-1.5 overflow-x-auto">
                <a href="{{ route('quick.login', 'admin@futurise.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-indigo-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-crown text-amber-400"></i> Super Admin
                </a>
                <a href="{{ route('quick.login', 'keuangan@futurise.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-emerald-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-receipt text-emerald-400"></i> Keuangan
                </a>
                <a href="{{ route('quick.login', 'kurator@futurise.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-blue-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-clipboard-check text-blue-400"></i> Kurator
                </a>
                <a href="{{ route('quick.login', 'venue@futurise.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-teal-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-map-location-dot text-teal-400"></i> Venue & Teknis
                </a>
                <a href="{{ route('quick.login', 'juri@futurise.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-purple-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-gavel text-purple-400"></i> Juri
                </a>
                <a href="{{ route('quick.login', 'registrasi@futurise.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-rose-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-qrcode text-rose-400"></i> Registrasi Gate
                </a>
                <span class="text-slate-600">|</span>
                <a href="{{ route('quick.login', 'kampus@itb.ac.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-sky-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-building-columns text-sky-400"></i> PIC ITB
                </a>
                <a href="{{ route('quick.login', 'tim@itb.ac.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-cyan-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-user-graduate text-cyan-400"></i> Tim Mahasiswa
                </a>
                <a href="{{ route('quick.login', 'industri@telkom.co.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-red-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-industry text-red-400"></i> PT Telkom
                </a>
                <a href="{{ route('quick.login', 'sponsor@bankbjb.co.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-blue-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-handshake text-blue-400"></i> Bank BJB
                </a>
                <a href="{{ route('quick.login', 'sekolah@smkn4bdg.sch.id') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-amber-600 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-school text-amber-400"></i> SMKN 4 Bdg
                </a>
                <a href="{{ route('quick.login', 'pengunjung@gmail.com') }}" class="px-2 py-1 rounded bg-slate-800 hover:bg-slate-700 text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-ticket text-teal-400"></i> Pengunjung
                </a>
            </div>
            @auth
            <div class="flex items-center gap-2 pl-2 border-l border-slate-700">
                <span class="text-slate-400">Masuk: <strong class="text-white">{{ auth()->user()->name }}</strong> ({{ auth()->user()->activeRole?->name }})</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-rose-400 hover:text-rose-300 underline text-xs">Keluar</button>
                </form>
            </div>
            @endauth
        </div>
    </div>
    @endif

    <!-- MAIN NAVBAR -->
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 sticky top-7 z-40 shadow-sm" x-data="{ mobileMenu: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                <!-- Brand Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <img src="{{ asset('logo-futurise.png') }}" alt="FUTURiSE 2026 - West Java Digital Innovation Festival" class="h-20 w-auto object-contain group-hover:opacity-90 transition">
                    </a>
                </div>

                <!-- Navigation Desktop Links (Menu Publik Sesuai Spesifikasi) -->
                <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
                    <a href="{{ route('home') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('home') ? 'text-cyan-600 font-bold' : '' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('about') ? 'text-cyan-600 font-bold' : '' }}">Tentang</a>
                    <!-- <a href="{{ route('showcase') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('showcase*') ? 'text-cyan-600 font-bold' : '' }}">Showcase (60 Karya)</a> -->
                    <!-- <a href="{{ route('industries') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('industries') ? 'text-cyan-600 font-bold' : '' }}">Industri & Mitra</a> -->
                    <!-- <a href="{{ route('sponsors') }}" class="hover:text-cyan-600 transition {{ request()->routeIs('sponsors') ? 'text-cyan-600 font-bold' : '' }}">Sponsor</a> -->
                    
                    <!-- Submenu Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="flex items-center gap-1 hover:text-cyan-600 transition">
                            <span>Informasi</span>
                            <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="{'rotate-180': open}"></i>
                        </button>
                        <div x-show="open" x-cloak class="absolute left-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 text-xs">
                            <!-- <a href="{{ route('participant.info') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700 hover:text-cyan-600 font-medium"><i class="fa-solid fa-circle-info w-5 text-slate-400"></i> Informasi Peserta</a> -->
                            <!-- <a href="{{ route('venue') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700 hover:text-cyan-600 font-medium"><i class="fa-solid fa-map-location-dot w-5 text-slate-400"></i> Venue & Denah Booth</a> -->
                            <a href="{{ route('news') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700 hover:text-cyan-600 font-medium"><i class="fa-solid fa-newspaper w-5 text-slate-400"></i> Berita & Pengumuman</a>
                            <!-- <a href="{{ route('contact') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700 hover:text-cyan-600 font-medium"><i class="fa-solid fa-headset w-5 text-slate-400"></i> Kontak Sekretariat</a> -->
                        </div>
                    </div>
                </nav>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        @if(auth()->user()->isPanitia())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center gap-2 shadow-sm transition">
                                <i class="fa-solid fa-gauge-high text-cyan-400"></i> Dashboard Panitia
                            </a>
                        @elseif(auth()->user()->hasRole('juri'))
                            <a href="{{ route('juri.dashboard') }}" class="px-4 py-2.5 rounded-xl bg-purple-900 hover:bg-purple-800 text-white font-bold text-xs flex items-center gap-2 shadow-sm transition">
                                <i class="fa-solid fa-gavel text-amber-400"></i> Portal Juri
                            </a>
                        @else
                            <a href="{{ route('portal.dashboard') }}" class="px-4 py-2.5 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold text-xs flex items-center gap-2 shadow-sm transition">
                                <i class="fa-solid fa-user-circle text-cyan-400"></i> Portal Saya
                            </a>
                        @endif

                        <!-- User Profile Dropdown -->
                        <div class="relative" x-data="{ userMenu: false }" @click.outside="userMenu = false">
                            <button @click="userMenu = !userMenu" class="flex items-center gap-2 pl-2 text-slate-700 hover:text-slate-900">
                                <div class="w-9 h-9 rounded-full bg-slate-200 border-2 border-slate-300 flex items-center justify-center font-bold text-xs text-slate-700">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </div>
                                <i class="fa-solid fa-caret-down text-xs text-slate-400"></i>
                            </button>
                            <div x-show="userMenu" x-cloak class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 text-xs">
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="font-bold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-slate-500 text-[11px] truncate">{{ auth()->user()->email }}</p>
                                    <span class="mt-1 inline-block px-2 py-0.5 rounded text-[10px] font-semibold bg-cyan-50 text-cyan-700">{{ auth()->user()->activeRole?->name }}</span>
                                </div>

                                <!-- Role Switcher for Multi-Role users (BR-10) -->
                                @if(auth()->user()->roles->count() > 1 || auth()->user()->isSuperAdmin())
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="text-[10px] uppercase font-bold text-slate-400 mb-1">Ganti Peran Aktif:</p>
                                    <form action="{{ route('switch.role') }}" method="POST">
                                        @csrf
                                        <select name="role_id" onchange="this.form.submit()" class="w-full text-xs border border-slate-200 rounded p-1.5 bg-slate-50">
                                            @foreach(auth()->user()->isSuperAdmin() ? \App\Models\Role::all() : auth()->user()->roles as $r)
                                                <option value="{{ $r->id }}" {{ auth()->user()->active_role_id == $r->id ? 'selected' : '' }}>
                                                    {{ $r->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                @endif

                                <a href="{{ route('portal.dashboard') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700">Ke Portal Peserta</a>
                                <form action="{{ route('logout') }}" method="POST" class="border-t border-slate-100">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-rose-50 text-rose-600 font-semibold">Keluar Akun</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 hover:border-slate-400 text-slate-700 font-bold text-xs transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-cyan-600 to-indigo-600 hover:from-cyan-700 hover:to-indigo-700 text-white font-bold text-xs shadow-md shadow-cyan-500/20 transition">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex lg:hidden items-center">
                    <button @click="mobileMenu = !mobileMenu" class="p-2 rounded-lg text-slate-600 hover:text-slate-900 focus:outline-none">
                        <i class="fa-solid fa-bars text-xl" x-show="!mobileMenu"></i>
                        <i class="fa-solid fa-xmark text-xl" x-show="mobileMenu" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenu" x-cloak class="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Beranda</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Tentang Acara</a>
            <a href="{{ route('agenda') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Program & Agenda</a>
            <a href="{{ route('showcase') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Showcase 60 Karya</a>
            <a href="{{ route('industries') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Industri & Mitra</a>
            <a href="{{ route('sponsors') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Paket Sponsor</a>
            <a href="{{ route('venue') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Venue & Denah Booth</a>
            <a href="{{ route('news') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Berita & Pengumuman</a>
            <a href="{{ route('participant.info') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Informasi Peserta & FAQ</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-slate-800 font-semibold hover:bg-slate-50">Kontak Sekretariat</a>
            <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    <a href="{{ route('portal.dashboard') }}" class="w-full text-center px-4 py-2.5 rounded-xl bg-indigo-900 text-white font-bold text-xs">Akses Portal</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-center px-4 py-2 rounded-xl text-rose-600 font-bold text-xs">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-full text-center px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold text-xs">Masuk</a>
                    <a href="{{ route('register') }}" class="w-full text-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white font-bold text-xs">Daftar Akun Baru</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full" x-data="{ show: true }" x-show="show">
        <div class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 text-sm flex items-start justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                <div>
                    <span class="font-bold">Berhasil:</span> {{ session('success') }}
                </div>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full" x-data="{ show: true }" x-show="show">
        <div class="rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-800 text-sm flex items-start justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-triangle-exclamation text-rose-500 text-lg"></i>
                <div>
                    <span class="font-bold">Peringatan:</span> {{ session('error') }}
                </div>
            </div>
            <button @click="show = false" class="text-rose-500 hover:text-rose-700"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    @endif

    <!-- MAIN BODY CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-950 text-slate-400 text-sm border-t border-slate-800 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: About -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-white rounded-lg px-2 py-1 inline-flex">
                            <img src="{{ asset('logo-futurise.png') }}" alt="FUTURiSE 2026" class="h-10 w-auto object-contain">
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        West Java Digital Innovation Festival diselenggarakan oleh APTIKOM Jawa Barat. Menghubungkan 30 perguruan tinggi, 60 karya teknologi inovatif mahasiswa, industri terkemuka, dan mitra strategis.
                    </p>
                    <div class="text-xs space-y-1 text-slate-400">
                        <p><i class="fa-solid fa-location-dot w-4 text-cyan-400"></i> Sasana Budaya Ganesha (Sabuga) ITB Bandung</p>
                        <p><i class="fa-solid fa-envelope w-4 text-cyan-400"></i> sekretariat@aptikom-jabar.id</p>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-4">Navigasi Utama</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-cyan-400 transition">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-cyan-400 transition">Tentang APTIKOM Jabar</a></li>
                        <li><a href="{{ route('agenda') }}" class="hover:text-cyan-400 transition">7 Program & Rundown</a></li>
                        <li><a href="{{ route('showcase') }}" class="hover:text-cyan-400 transition">Katalog 60 Karya Inovasi</a></li>
                        <li><a href="{{ route('industries') }}" class="hover:text-cyan-400 transition">Direktori Industri & Mitra</a></li>
                        <li><a href="{{ route('sponsors') }}" class="hover:text-cyan-400 transition">Paket Kemitraan Sponsorship</a></li>
                    </ul>
                </div>

                <!-- Col 3: Portal & Partisipasi -->
                <div>
                    <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-4">Portal & Layanan</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('register', ['category' => 'pengunjung']) }}" class="hover:text-cyan-400 transition">Daftar Tiket Pengunjung (Gratis)</a></li>
                        <li><a href="{{ route('register', ['category' => 'kampus']) }}" class="hover:text-cyan-400 transition">Registrasi Kampus & Tim</a></li>
                        <li><a href="{{ route('register', ['category' => 'industri']) }}" class="hover:text-cyan-400 transition">Pendaftaran Exhibitor Industri</a></li>
                        <li><a href="{{ route('register', ['category' => 'sekolah']) }}" class="hover:text-cyan-400 transition">Pengajuan Rombongan Sekolah</a></li>
                        <li><a href="{{ route('venue') }}" class="hover:text-cyan-400 transition">Peta Denah 45 Booth</a></li>
                        <li><a href="{{ route('participant.info') }}" class="hover:text-cyan-400 transition">Unduh Panduan & Template</a></li>
                    </ul>
                </div>

                <!-- Col 4: Penyelenggara & Legal -->
                <div>
                    <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-4">Penyelenggara Resmi</h4>
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 text-xs space-y-2">
                        <p class="font-bold text-white">APTIKOM Wilayah IV Jawa Barat</p>
                        <p class="text-slate-400 text-[11px]">Asosiasi Pendidikan Tinggi Informatika dan Komputer</p>
                        <div class="pt-2 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                            <span>Versi Sistem: 1.0</span>
                            <span class="text-emerald-400 font-semibold"><i class="fa-solid fa-circle text-[8px] mr-1"></i> MySQL Live</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; 2026 FUTURiSE - West Java Digital Innovation Festival. All rights reserved. APTIKOM Jawa Barat.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('about') }}" class="hover:text-slate-400">Kebijakan Privasi</a>
                    <a href="{{ route('participant.info') }}" class="hover:text-slate-400">Ketentuan Layanan</a>
                    <a href="{{ route('contact') }}" class="hover:text-slate-400">Bantuan & Kontak</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
