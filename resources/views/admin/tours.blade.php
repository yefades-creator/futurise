@extends('layouts.admin', ['title' => 'Jadwal Tur Sekolah | Admin FUTURiSE'])

@section('content')
<div class="space-y-6">
    <div>
        <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">Super Admin / Kampus dan Sekolah</span>
        <h1 class="text-2xl font-black text-slate-900 mt-0.5">Jadwal Slot Tur Sekolah</h1>
        <p class="text-sm text-slate-500 mt-1">Buat slot kunjungan untuk PIC Sekolah. Kuota dihitung berdasarkan jumlah siswa dan guru yang sudah memesan.</p>
    </div>

    @if($errors->any())
    <div class="rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-800 text-sm">
        <p class="font-bold">Periksa kembali data slot:</p>
        <ul class="list-disc pl-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-7">
        <h2 class="font-black text-slate-900 mb-4"><i class="fa-solid fa-circle-plus text-cyan-700 mr-1"></i> Tambah Slot Tur</h2>
        <form action="{{ route('admin.tours.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @csrf
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama slot</label>
                <input name="slot_name" value="{{ old('slot_name') }}" required maxlength="100" placeholder="Contoh: Tur Pagi Sesi 1" class="w-full p-2.5 border border-slate-200 rounded-xl text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ old('date') }}" min="{{ $event->start_date?->format('Y-m-d') }}" max="{{ $event->end_date?->format('Y-m-d') }}" required class="w-full p-2.5 border border-slate-200 rounded-xl text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kuota total orang</label>
                <input type="number" name="max_capacity" value="{{ old('max_capacity', 150) }}" min="1" max="2000" required class="w-full p-2.5 border border-slate-200 rounded-xl text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Mulai</label>
                <input type="time" name="start_time" value="{{ old('start_time', '09:00') }}" required class="w-full p-2.5 border border-slate-200 rounded-xl text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Selesai</label>
                <input type="time" name="end_time" value="{{ old('end_time', '11:00') }}" required class="w-full p-2.5 border border-slate-200 rounded-xl text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Pemandu</label>
                <input name="guide_name" value="{{ old('guide_name') }}" maxlength="255" placeholder="Nama pemandu" class="w-full p-2.5 border border-slate-200 rounded-xl text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full p-2.5 border border-slate-200 rounded-xl text-sm"><option value="open" @selected(old('status', 'open') === 'open')>Dibuka untuk pemesanan</option><option value="closed" @selected(old('status') === 'closed')>Ditutup</option></select>
            </div>
            <div class="sm:col-span-2 lg:col-span-4 flex justify-end">
                <button class="px-5 py-2.5 rounded-xl bg-cyan-700 hover:bg-cyan-800 text-white font-bold text-sm"><i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Slot</button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-7 space-y-4">
        <h2 class="font-black text-slate-900">Slot Acara {{ $event->name }} ({{ $slots->count() }})</h2>
        @forelse($slots as $slot)
        <form action="{{ route('admin.tours.update', $slot->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-8 gap-3 items-end p-4 border border-slate-200 rounded-2xl">
            @csrf @method('PUT')
            <div class="lg:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">NAMA SLOT</label><input name="slot_name" value="{{ $slot->slot_name }}" required maxlength="100" class="w-full p-2 border rounded-lg text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">TANGGAL</label><input type="date" name="date" value="{{ $slot->date->format('Y-m-d') }}" min="{{ $event->start_date?->format('Y-m-d') }}" max="{{ $event->end_date?->format('Y-m-d') }}" required class="w-full p-2 border rounded-lg text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">MULAI</label><input type="time" name="start_time" value="{{ substr($slot->start_time, 0, 5) }}" required class="w-full p-2 border rounded-lg text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">SELESAI</label><input type="time" name="end_time" value="{{ substr($slot->end_time, 0, 5) }}" required class="w-full p-2 border rounded-lg text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">KUOTA</label><input type="number" name="max_capacity" value="{{ $slot->max_capacity }}" min="{{ max(1, $slot->booked_count) }}" max="2000" required class="w-full p-2 border rounded-lg text-xs"><span class="text-[10px] text-slate-400">Terpesan {{ $slot->booked_count }}</span></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">PEMANDU</label><input name="guide_name" value="{{ $slot->guide_name }}" maxlength="255" class="w-full p-2 border rounded-lg text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">STATUS</label><select name="status" class="w-full p-2 border rounded-lg text-xs"><option value="open" @selected($slot->status === 'open')>Dibuka</option><option value="full" @selected($slot->status === 'full')>Penuh</option><option value="closed" @selected($slot->status === 'closed')>Ditutup</option></select></div>
            <div class="lg:col-span-8 flex items-center justify-between gap-3">
                <span class="text-[11px] font-bold {{ $slot->status === 'closed' ? 'text-slate-500' : ($slot->booked_count >= $slot->max_capacity ? 'text-rose-700' : 'text-emerald-700') }}">{{ $slot->status === 'closed' ? 'Ditutup' : ($slot->booked_count >= $slot->max_capacity ? 'Kuota penuh' : 'Terbuka') }} · {{ $slot->visits_count }} rombongan terdaftar</span>
                <button class="px-4 py-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs"><i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Slot</button>
            </div>
        </form>
        @empty
        <p class="py-10 text-center text-sm text-slate-500">Belum ada slot tur. Buat slot pertama menggunakan formulir di atas.</p>
        @endforelse
    </section>
</div>
@endsection
