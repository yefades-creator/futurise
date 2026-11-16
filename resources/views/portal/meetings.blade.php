@extends('layouts.app', ['title' => 'Pertemuan Kolaborasi | FUTURiSE'])

@section('content')
<div class="gradient-brand text-white py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('portal.dashboard') }}" class="text-cyan-300 text-xs font-bold">&larr; Kembali ke Portal</a>
        <span class="block text-cyan-300 font-extrabold text-xs uppercase tracking-widest mt-5">Business Matchmaking (BR-13)</span>
        <h1 class="text-2xl sm:text-3xl font-black mt-1">Jadwalkan Pertemuan</h1>
        <p class="text-sm text-slate-300 mt-2">Ajukan waktu dan meja kolaborasi dengan organisasi lain. Panitia akan mengonfirmasi permintaan setelah pemeriksaan bentrok.</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    @if(session('success'))<div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm"><strong>Periksa kembali data:</strong><ul class="list-disc ml-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <section class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <h2 class="text-lg font-black text-slate-900 mb-5">Formulir Penjadwalan Meja Kolaborasi</h2>
        <form action="{{ route('portal.meetings.request') }}" method="POST" class="space-y-4 text-sm">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><label class="block font-bold text-slate-700 text-xs uppercase mb-1">Organisasi tujuan</label><select name="target_org_id" required class="w-full p-3 border rounded-xl bg-white"><option value="">Pilih organisasi</option>@foreach($organizations as $target)<option value="{{ $target->id }}" @selected(old('target_org_id') == $target->id)>{{ $target->name }} · {{ ucfirst($target->type) }}</option>@endforeach</select>@if($organizations->isEmpty())<p class="text-xs text-amber-700 mt-1">Belum ada organisasi terverifikasi lain untuk dipilih.</p>@endif</div>
                <div><label class="block font-bold text-slate-700 text-xs uppercase mb-1">Meja kolaborasi</label><select name="table_number" required class="w-full p-3 border rounded-xl bg-white">@for($i = 1; $i <= 10; $i++)<option value="Meja Kolaborasi {{ $i }}" @selected(old('table_number') === "Meja Kolaborasi $i")>Meja Kolaborasi {{ $i }}</option>@endfor</select></div>
                <div><label class="block font-bold text-slate-700 text-xs uppercase mb-1">Waktu mulai</label><input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required class="w-full p-3 border rounded-xl"></div>
                <div><label class="block font-bold text-slate-700 text-xs uppercase mb-1">Waktu selesai</label><input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required class="w-full p-3 border rounded-xl"></div>
            </div>
            <div><label class="block font-bold text-slate-700 text-xs uppercase mb-1">Topik agenda / kebutuhan solusi</label><input type="text" name="agenda_topic" value="{{ old('agenda_topic') }}" maxlength="255" required placeholder="Jelaskan topik pertemuan" class="w-full p-3 border rounded-xl"></div>
            @if($projectId)<input type="hidden" name="project_id" value="{{ $projectId }}">@endif
            <div class="flex justify-end"><button type="submit" @disabled($organizations->isEmpty()) class="px-5 py-3 rounded-xl bg-indigo-900 hover:bg-indigo-800 disabled:opacity-50 text-white font-bold">Jadwalkan Pertemuan</button></div>
        </form>
    </section>

    <section class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-lg font-black text-slate-900">Permintaan dan Jadwal Pertemuan</h2>
        @forelse($meetings as $meeting)
            <article class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-sm space-y-1">
                <div class="flex flex-wrap justify-between gap-2"><strong>{{ $meeting->table_number }}</strong><span class="text-slate-500">{{ $meeting->start_time->format('d M Y, H:i') }}–{{ $meeting->end_time->format('H:i') }} WIB</span></div>
                <p class="font-bold text-slate-900">{{ $meeting->agenda_topic }}</p>
                <p class="text-slate-600">{{ $meeting->requester->name }} ↔ {{ $meeting->target->name }}</p>
                @if($meeting->discussion_notes)<p class="text-slate-600">Catatan: {{ $meeting->discussion_notes }}</p>@endif
            </article>
        @empty
            <p class="text-sm text-slate-500">Belum ada permintaan atau jadwal pertemuan.</p>
        @endforelse
    </section>
</div>
@endsection
