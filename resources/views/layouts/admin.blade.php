<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Panitia' }} | FUTURiSE 2026 Admin</title>
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
                            500: '#0d9488',
                            600: '#0f766e',
                            700: '#115e59',
                            800: '#134e4a',
                            900: '#042f2e',
                        }
                    }
                }
            }
        }
    </script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- Top Admin Bar -->
    <header class="bg-slate-900 border-b border-slate-800 text-white sticky top-0 z-50">
        <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="bg-white rounded-lg px-2 py-1 flex items-center">
                            <img src="{{ asset('logo-futurise.png') }}" alt="FUTURiSE 2026" class="h-8 w-auto object-contain group-hover:opacity-90 transition">
                        </div>
                        <span class="text-[10px] bg-slate-800 text-cyan-300 font-extrabold px-1.5 py-0.5 rounded uppercase">PANITIA</span>
                    </a>
            </div>

            <!-- Demo Switcher & Active Role -->
            <div class="flex items-center gap-3 text-xs">
                <a href="{{ route('home') }}" class="hidden md:inline-flex items-center gap-1 text-slate-400 hover:text-white px-2 py-1 rounded bg-slate-800 transition">
                    <i class="fa-solid fa-globe"></i> Lihat Website Publik
                </a>

                <!-- Role Switcher Form (BR-10) -->
                @if(auth()->user()->roles->count() > 1 || auth()->user()->isSuperAdmin())
                <form action="{{ route('switch.role') }}" method="POST" class="hidden sm:inline-flex items-center gap-1.5 bg-slate-800 px-2 py-1 rounded border border-slate-700">
                    @csrf
                    <span class="text-slate-400 text-[10px] font-bold">PERAN:</span>
                    <select name="role_id" onchange="this.form.submit()" class="bg-transparent text-cyan-300 font-semibold focus:outline-none text-xs cursor-pointer">
                        @foreach(auth()->user()->isSuperAdmin() ? \App\Models\Role::all() : auth()->user()->roles as $r)
                            <option value="{{ $r->id }}" {{ auth()->user()->active_role_id == $r->id ? 'selected' : '' }} class="bg-slate-900 text-white">
                                {{ $r->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                @endif

                <div class="flex items-center gap-2 pl-3 border-l border-slate-700">
                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center font-bold text-xs text-white">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <span class="hidden md:inline font-semibold text-slate-200">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-rose-400 hover:text-rose-300 ml-2" title="Keluar"><i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="flex-grow flex">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-slate-900 border-r border-slate-800 text-slate-300 flex-shrink-0 hidden md:block">
            <div class="p-4 space-y-6">
                <!-- Group 1: Inti Acara -->
                <div>
                    <p class="text-[10px] uppercase font-bold text-slate-500 tracking-wider mb-2">Manajemen Acara</p>
                    <nav class="space-y-1 text-xs font-semibold">
                        @if(auth()->user()->hasRole(['super-admin', 'ketua-pelaksana']))<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-chart-pie w-4 text-cyan-400"></i> Dashboard Lintas Divisi
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'sekretariat', 'kampus-sekolah', 'industri-sponsor']))<a href="{{ route('admin.organizations') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.organizations*') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-building w-4 text-indigo-400"></i> Verifikasi Organisasi
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'kampus-sekolah']))<a href="{{ route('admin.tours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.tours*') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-bus w-4 text-amber-400"></i> Jadwal Tur Sekolah
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'program-kurasi', 'publikasi']))<a href="{{ route('admin.projects') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.projects') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-laptop-code w-4 text-blue-400"></i> Kampus & Kurasi Karya
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'venue-teknis', 'kampus-sekolah', 'industri-sponsor']))<a href="{{ route('admin.booths') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.booths') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-store w-4 text-teal-400"></i> Alokasi 45 Booth (BR-05)
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'registrasi-layanan']))<a href="{{ route('admin.checkin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.checkin') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-qrcode w-4 text-rose-400"></i> Registrasi & QR Gate (BR-11)
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'program-kurasi', 'ketua-pelaksana']))<a href="{{ route('admin.judging') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.judging') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-gavel w-4 text-purple-400"></i> Penjurian & Pemenang
                        </a>@endif
                    </nav>
                </div>

                <!-- Group 2: Finansial & Kemitraan -->
                <div>
                    <p class="text-[10px] uppercase font-bold text-slate-500 tracking-wider mb-2">Keuangan & Kemitraan</p>
                    <nav class="space-y-1 text-xs font-semibold">
                        @if(auth()->user()->hasRole(['super-admin', 'ketua-pelaksana', 'keuangan']))<a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.finance') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-money-bill-wave w-4 text-emerald-400"></i> Keuangan & Verifikasi (BR-06/07)
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'industri-sponsor']))<a href="{{ route('admin.sponsorship') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.sponsorship*') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-handshake-angle w-4 text-amber-400"></i> Sponsorship & Manfaat
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'ketua-pelaksana', 'sekretariat', 'program-kurasi', 'industri-sponsor', 'venue-teknis']))<a href="{{ route('admin.meetings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.meetings') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-handshake-simple w-4 text-amber-400"></i> Pertemuan Meja (BR-13)
                        </a>@endif
                        @if(auth()->user()->hasRole(['super-admin', 'ketua-pelaksana', 'sekretariat', 'program-kurasi', 'industri-sponsor']))<a href="{{ route('admin.followups') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.followups') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-calendar-check w-4 text-indigo-400"></i> Tindak Lanjut H+30
                        </a>@endif
                    </nav>
                </div>

                <!-- Group 3: Sistem & Tata Kelola -->
                <div>
                    <p class="text-[10px] uppercase font-bold text-slate-500 tracking-wider mb-2">Sistem & Audit</p>
                    <nav class="space-y-1 text-xs font-semibold">
                        @if(auth()->user()->hasRole(['super-admin', 'ketua-pelaksana', 'sekretariat']))<a href="{{ route('admin.audit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.audit') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-shield-halved w-4 text-sky-400"></i> Jejak Audit Log (Acceptance 13)
                        </a>@endif
                        @if(auth()->user()->hasRole('super-admin'))<a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.users*') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-users-gear w-4 text-amber-400"></i> Data User
                        </a>@endif
                        @if(auth()->user()->hasRole('super-admin'))<a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.settings') ? 'bg-cyan-600 text-white font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                            <i class="fa-solid fa-sliders w-4 text-slate-400"></i> Pengaturan Acara (BR-02)
                        </a>@endif
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Main Workspace Area -->
        <main class="flex-grow p-4 sm:p-6 lg:p-8 overflow-y-auto">
            <!-- Flash Message Alerts -->
            @if($errors->any())
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-800 text-sm shadow-sm">
                <strong>Periksa kembali formulir:</strong>
                <ul class="list-disc pl-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif
            @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 text-sm flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-800 text-sm flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-rose-500 text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
