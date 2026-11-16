@extends('layouts.admin', ['title' => 'Pengaturan Konfigurasi Acara | Admin FUTURiSE'])

@section('content')
<div class="space-y-6">
    <div>
        <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Super Administrator</span>
        <h1 class="text-2xl font-black text-slate-900 mt-0.5">Pengaturan Konfigurasi Acara (BR-02)</h1>
        <p class="text-xs text-slate-500 mt-1">Tanggal, venue, tarif, kuota kampus/industri, dan parameter target festival dapat dikonfigurasi fleksibel oleh panitia.</p>
    </div>

    <!-- Rule Alert -->
    <div class="bg-cyan-50 border border-cyan-200 rounded-2xl p-4 text-xs text-cyan-950 flex items-start gap-3">
        <i class="fa-solid fa-sliders text-cyan-600 text-lg mt-0.5"></i>
        <div>
            <strong>Aturan Bisnis BR-01 & BR-02:</strong> Semua data terikat pada edisi acara aktif. Kuota dan tarif pendaftaran dapat diubah oleh administrator berwenang tanpa mengganggu integritas data historis.
        </div>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm max-w-3xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 text-xs">
            @csrf

            <!-- Edisi & Nama Acara -->
            <div class="space-y-4">
                <h3 class="font-bold text-slate-900 uppercase tracking-wider text-xs border-b border-slate-100 pb-2">Identitas & Edisi Acara</h3>
                
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Resmi Acara</label>
                    <input type="text" name="name" value="{{ $event->name }}" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Tema Acara</label>
                    <input type="text" name="theme" value="{{ $event->theme }}" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                </div>
            </div>

            <!-- Tanggal & Venue (Section 3: Countdown hanya aktif setelah disahkan) -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="font-bold text-slate-900 uppercase tracking-wider text-xs border-b border-slate-100 pb-2">Tanggal & Venue Pelaksanaan</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ $event->start_date ? $event->start_date->format('Y-m-d') : '' }}" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ $event->end_date ? $event->end_date->format('Y-m-d') : '' }}" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Nama Gedung Venue</label>
                        <input type="text" name="venue_name" value="{{ $event->venue_name }}" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Status Pengesahan Tanggal & Venue (Section 3)</label>
                        <select name="is_date_confirmed" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs font-bold text-cyan-800">
                            <option value="1" {{ $event->is_date_confirmed ? 'selected' : '' }}>Tanggal & Venue DISAHKAN (Countdown Aktif)</option>
                            <option value="0" {{ !$event->is_date_confirmed ? 'selected' : '' }}>Belum Disahkan (Tampilkan "Akan Diumumkan")</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="font-bold text-slate-900 uppercase tracking-wider text-xs border-b border-slate-100 pb-2">Periode Voting People's Choice</h3>
                <p class="text-slate-500">Masukkan waktu dalam WIB. Voting dibuka pada waktu mulai dan ditutup tepat pada waktu selesai. Kosongkan kedua kolom untuk tidak membatasi periode voting.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Mulai Voting</label>
                        <input type="datetime-local" name="voting_start_at" value="{{ $event->voting_start_at?->copy()->setTimezone('Asia/Jakarta')->format('Y-m-d\\TH:i') }}" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Akhir Voting (eksklusif)</label>
                        <input type="datetime-local" name="voting_end_at" value="{{ $event->voting_end_at?->copy()->setTimezone('Asia/Jakarta')->format('Y-m-d\\TH:i') }}" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                </div>
                @if($event->voting_start_at && $event->voting_end_at)
                    <div class="rounded-xl border p-3 text-xs {{ now()->lt($event->voting_start_at) ? 'border-amber-200 bg-amber-50 text-amber-900' : (now()->lt($event->voting_end_at) ? 'border-emerald-200 bg-emerald-50 text-emerald-900' : 'border-slate-200 bg-slate-50 text-slate-700') }}">
                        Status saat ini:
                        <strong>{{ now()->lt($event->voting_start_at) ? 'Belum dibuka' : (now()->lt($event->voting_end_at) ? 'Sedang dibuka' : 'Sudah ditutup') }}</strong>
                        · {{ $event->voting_start_at->copy()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} – {{ $event->voting_end_at->copy()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                    </div>
                @endif
            </div>

            <!-- Kuota & Target Parameter (Section 1) -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="font-bold text-slate-900 uppercase tracking-wider text-xs border-b border-slate-100 pb-2">Kuota & Parameter Awal (Section 1)</h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Kuota Kampus</label>
                        <input type="number" name="quota_campus" value="{{ $event->quota_campus }}" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Kuota Industri</label>
                        <input type="number" name="quota_industry" value="{{ $event->quota_industry }}" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Kuota Mitra</label>
                        <input type="number" name="quota_partner" value="{{ $event->quota_partner }}" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Target Pengunjung</label>
                        <input type="number" name="target_visitors" value="{{ $event->target_visitors }}" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Target Kepuasan (%)</label>
                        <input type="number" step="0.1" name="target_satisfaction_rate" value="{{ $event->target_satisfaction_rate }}" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Min Respons Survei</label>
                        <input type="number" name="min_survey_responses" value="{{ $event->min_survey_responses }}" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-6 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs uppercase tracking-wider shadow-md transition">
                    <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Konfigurasi Acara
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
