@extends('layouts.app', ['title' => $news->title . ' | FUTURiSE 2026'])

@section('content')
<div class="gradient-brand text-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('news') }}" class="text-xs text-cyan-400 hover:text-cyan-300 flex items-center gap-1 font-semibold mb-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Berita
        </a>
        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
            <span class="px-2 py-0.5 rounded bg-white/10 text-cyan-300 font-bold uppercase">{{ $news->category }}</span>
            <span>&bull;</span>
            <span>{{ $news->published_at ? $news->published_at->format('d M Y') : 'Terbaru' }}</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-black leading-tight">{{ $news->title }}</h1>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-sm space-y-6">
        @if($news->cover_image)<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($news->cover_image) }}" alt="{{ $news->title }}" class="w-full max-h-[560px] object-cover rounded-2xl">@endif
        <div class="prose max-w-none text-slate-700 text-sm leading-relaxed space-y-4">
            <p class="font-semibold text-slate-900 text-base leading-relaxed">{{ $news->excerpt }}</p>
            <div class="pt-4 border-t border-slate-100 whitespace-pre-line">
                {{ $news->content }}
            </div>
        </div>

        @if($news->document_path)
        <div class="p-4 rounded-2xl bg-cyan-50 border border-cyan-100 flex flex-wrap items-center justify-between gap-3">
            <span class="text-sm font-bold text-slate-800"><i class="fa-solid fa-file-arrow-down text-cyan-700 mr-1"></i> {{ $news->document_name ?: 'Dokumen lampiran' }}</span>
            <a href="{{ route('news.document', $news->slug) }}" class="px-4 py-2 rounded-xl bg-cyan-700 text-white text-xs font-bold">Unduh Dokumen</a>
        </div>
        @endif

        <div class="pt-8 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Diterbitkan oleh: <strong>Sekretariat APTIKOM Jawa Barat</strong></span>
            <a href="{{ route('news') }}" class="font-bold text-cyan-600 hover:text-cyan-700">Lihat Berita Lainnya &rarr;</a>
        </div>
    </div>
</div>
@endsection
