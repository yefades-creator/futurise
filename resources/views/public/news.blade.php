@extends('layouts.app', ['title' => 'Berita & Pengumuman Resmi | FUTURiSE 2026'])

@section('content')
<!-- Header -->
<div class="gradient-brand text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Informasi Publik</span>
        <h1 class="text-3xl sm:text-4xl font-black mt-1">Berita & Pengumuman Resmi Festival</h1>
        <p class="text-slate-300 text-sm mt-2 max-w-2xl leading-relaxed">
            Informasi terkini mengenai kurasi karya, technical meeting exhibitor, dan jadwal agenda APTIKOM Jawa Barat.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <form method="GET" action="{{ route('news') }}" class="mb-8 flex flex-wrap items-center gap-2">
        <label for="news-category" class="text-sm font-bold text-slate-700">Kategori</label>
        <select id="news-category" name="category" class="p-2.5 border border-slate-200 rounded-xl bg-white text-sm">
            <option value="">Semua kategori</option>
            @foreach($categories as $newsCategory)<option value="{{ $newsCategory }}" @selected($category === $newsCategory)>{{ $newsCategory }}</option>@endforeach
        </select>
        <button class="px-4 py-2.5 rounded-xl bg-indigo-900 text-white text-xs font-bold">Terapkan</button>
    </form>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($newsList as $item)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
            @if($item->cover_image)
            <a href="{{ route('news.detail', $item->slug) }}" class="block aspect-video bg-slate-100"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->cover_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover"></a>
            @endif
            <div class="p-6">
                <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                    <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-semibold">{{ $item->category }}</span>
                    <span>&bull;</span>
                    <span>{{ $item->published_at ? $item->published_at->format('d M Y') : 'Terbaru' }}</span>
                </div>
                <h2 class="font-bold text-slate-900 text-base leading-snug">
                    <a href="{{ route('news.detail', $item->slug) }}" class="hover:text-cyan-600 transition">{{ $item->title }}</a>
                </h2>
                <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">{{ $item->excerpt ?: \Illuminate\Support\Str::limit($item->content, 180) }}</p>
                @if($item->document_path)<span class="inline-flex mt-3 px-2 py-1 rounded-lg bg-cyan-50 text-cyan-800 text-[10px] font-bold"><i class="fa-solid fa-paperclip mr-1"></i> Dokumen tersedia</span>@endif
            </div>
            <div class="px-6 pb-6 pt-0">
                <a href="{{ route('news.detail', $item->slug) }}" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 flex items-center gap-1">
                    Baca Selengkapnya <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>
        @endforeach
        @if($newsList->isEmpty())<div class="md:col-span-2 lg:col-span-3 p-10 text-center text-slate-500">Belum ada berita yang dipublikasikan.</div>@endif
    </div>

    <div class="pt-8">
        {{ $newsList->links() }}
    </div>
</div>
@endsection
