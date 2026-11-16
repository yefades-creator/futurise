@extends('layouts.app', ['title' => 'Showcase Katalog 60 Karya Inovasi Digital | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Katalog Terpublikasi (BR-11)</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Showcase 60 Karya Mahasiswa Kampus Jawa Barat</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Eksplorasi prototipe teknologi inovatif karya mahasiswa dari 30 perguruan tinggi se-Jawa Barat. Dua karya berbagi satu booth kampus (BR-03).
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    <!-- Search & Filter Bar -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <form action="{{ route('showcase') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <!-- Search Text -->
            <div class="sm:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul karya, teknologi, atau masalah..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50">
            </div>

            <!-- Category Filter -->
            <div class="sm:col-span-3">
                <select name="category" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50 text-slate-700">
                    <option value="">Semua Bidang (6 Kategori)</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campus Filter -->
            <div class="sm:col-span-3">
                <select name="campus_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-slate-50 text-slate-700">
                    <option value="">Semua Kampus (30 Kampus)</option>
                    @foreach($campuses as $camp)
                        <option value="{{ $camp->id }}" {{ $campusId == $camp->id ? 'selected' : '' }}>{{ $camp->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="sm:col-span-1 flex gap-1">
                <button type="submit" class="w-full py-2.5 rounded-xl bg-indigo-900 hover:bg-indigo-800 text-white font-bold text-xs flex items-center justify-center">
                    <i class="fa-solid fa-sliders"></i>
                </button>
                @if($search || $category || $campusId)
                    <a href="{{ route('showcase') }}" class="py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs flex items-center justify-center" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>

        <!-- Category Pills Shortcut -->
        <div class="flex flex-wrap items-center gap-1.5 pt-2 border-t border-slate-100 text-xs">
            <span class="text-slate-400 font-bold uppercase text-[10px] mr-1">Bidang Cepat:</span>
            <a href="{{ route('showcase') }}" class="px-2.5 py-1 rounded-lg {{ !$category ? 'bg-cyan-600 text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Semua</a>
            @foreach($categories as $c)
                <a href="{{ route('showcase', ['category' => $c]) }}" class="px-2.5 py-1 rounded-lg {{ $category === $c ? 'bg-cyan-600 text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">{{ $c }}</a>
            @endforeach
        </div>
    </div>

    <!-- Projects Grid -->
    @if($projects->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $proj)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition flex flex-col justify-between group">
            <div>
                <div class="p-5 pb-3">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-800">
                            {{ $proj->category }}
                        </span>
                        @if($proj->is_pitch_finalist)
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-amber-500 text-white flex items-center gap-1">
                                <i class="fa-solid fa-star"></i> Pitching Finalist
                            </span>
                        @endif
                    </div>

                    <a href="{{ route('project.detail', $proj->slug) }}" class="block font-bold text-slate-900 group-hover:text-cyan-600 transition text-base leading-snug">
                        {{ $proj->title }}
                    </a>
                    
                    <p class="text-xs text-cyan-700 font-semibold mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-building-columns text-[10px]"></i> {{ $proj->organization->name }}
                    </p>
                </div>

                <div class="px-5 pb-4 space-y-2 text-xs">
                    <p class="text-slate-600 line-clamp-3 leading-relaxed">
                        <strong class="text-slate-800">Solusi:</strong> {{ $proj->solution_description }}
                    </p>

                    <div class="pt-2 border-t border-slate-100 text-[11px] text-slate-500">
                        <span class="font-bold text-slate-700">Teknologi:</span> {{ $proj->technology_stack }}
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="p-5 pt-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500 font-medium">
                    <i class="fa-solid fa-store text-slate-400 mr-1"></i> Booth {{ $proj->booth?->code ?? '-' }}
                </span>
                <a href="{{ route('project.detail', $proj->slug) }}" class="font-bold text-cyan-600 hover:text-cyan-700 flex items-center gap-1">
                    Detail Karya <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pt-6">
        {{ $projects->links() }}
    </div>
    @else
    <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Karya Tidak Ditemukan</h3>
        <p class="text-xs text-slate-500 mt-1">Coba gunakan kata kunci lain atau bersihkan filter pencarian.</p>
        <a href="{{ route('showcase') }}" class="inline-block mt-4 px-4 py-2 rounded-xl bg-cyan-600 text-white font-bold text-xs">Reset Semua Filter</a>
    </div>
    @endif
</div>
@endsection
