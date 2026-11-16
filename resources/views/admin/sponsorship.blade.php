@extends('layouts.admin', ['title' => 'Sponsorship & Manfaat | Admin FUTURiSE'])

@section('content')
<div class="space-y-7">
    <div>
        <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">Industri, Sponsor & Publikasi</span>
        <h1 class="text-2xl font-black text-slate-900 mt-0.5">Kesepakatan Sponsorship & Pemenuhan Manfaat</h1>
        <p class="text-sm text-slate-500 mt-1">Data yang disimpan di sini akan tampil di portal PIC Sponsor. Bukti pelaksanaan disimpan privat dan hanya dapat diunduh oleh pihak berwenang.</p>
    </div>

    @if($errors->any())
    <div class="rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-800 text-sm">
        <p class="font-bold">Data belum dapat disimpan:</p>
        <ul class="list-disc pl-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-7 space-y-4">
        <div>
            <h2 class="font-black text-slate-900"><i class="fa-solid fa-file-circle-plus text-indigo-600 mr-1"></i> Tambah Kesepakatan</h2>
            <p class="text-xs text-slate-500 mt-1">Untuk satu organisasi, gunakan satu kesepakatan aktif. Jika sudah ada, perbarui kesepakatan tersebut di daftar bawah.</p>
        </div>
        <form action="{{ route('admin.sponsorship.agreements.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            @csrf
            <div class="lg:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">ORGANISASI</label><select name="organization_id" required class="w-full p-2.5 border rounded-xl text-xs"><option value="">Pilih sponsor/industri terverifikasi</option>@foreach($organizations as $organization)<option value="{{ $organization->id }}" @selected(old('organization_id') == $organization->id)>{{ $organization->name }} ({{ strtoupper($organization->type) }})</option>@endforeach</select></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">NOMOR KESEPAKATAN (OPSIONAL)</label><input name="agreement_number" value="{{ old('agreement_number') }}" maxlength="100" placeholder="Otomatis jika kosong" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">PAKET</label><select name="package_id" class="w-full p-2.5 border rounded-xl text-xs"><option value="">Pilih paket</option>@foreach($packages as $package)<option value="{{ $package->id }}" @selected(old('package_id') == $package->id)>{{ $package->name }}</option>@endforeach</select></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">NILAI KOMITMEN (RP)</label><input type="number" name="agreed_amount" min="0" step="0.01" value="{{ old('agreed_amount', 0) }}" required class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">TIPE DUKUNGAN</label><select name="support_type" required class="w-full p-2.5 border rounded-xl text-xs"><option value="cash">Tunai</option><option value="in_kind">Barang/Jasa</option><option value="hybrid">Gabungan</option></select></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">STATUS KESEPAKATAN</label><select name="status" required class="w-full p-2.5 border rounded-xl text-xs"><option value="draft">Draf</option><option value="offered">Ditawarkan</option><option value="agreed">Disepakati</option><option value="signed">Ditandatangani</option><option value="cancelled">Dibatalkan</option></select></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">TANGGAL KESEPAKATAN</label><input type="datetime-local" name="agreed_at" value="{{ old('agreed_at') }}" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div class="lg:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">RINCIAN DUKUNGAN BARANG/JASA</label><input name="in_kind_description" value="{{ old('in_kind_description') }}" maxlength="4000" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div class="lg:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">TAUTAN/LOKASI DOKUMEN KONTRAK (OPSIONAL)</label><input name="contract_document" value="{{ old('contract_document') }}" maxlength="2048" placeholder="Tautan dokumen atau path publik" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div class="sm:col-span-2 lg:col-span-4 flex justify-end"><button class="px-5 py-2.5 rounded-xl bg-indigo-700 hover:bg-indigo-800 text-white font-bold text-xs"><i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Kesepakatan</button></div>
        </form>
    </section>

    <section class="space-y-4">
        <h2 class="text-lg font-black text-slate-900">Kesepakatan dan Manfaat</h2>
        @forelse($agreements as $agreement)
        <article class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 bg-slate-50 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div><h3 class="font-black text-slate-900">{{ $agreement->organization->name }} · {{ $agreement->agreement_number }}</h3><p class="text-xs text-slate-500">{{ $agreement->package?->name ?? 'Tanpa paket' }} · Rp {{ number_format($agreement->agreed_amount, 0, ',', '.') }} · {{ strtoupper($agreement->status) }}</p></div>
                <span class="text-[10px] text-slate-500">{{ $agreement->fulfillments->count() }} manfaat tercatat</span>
            </div>
            <div class="p-5 space-y-6">
                <details>
                    <summary class="cursor-pointer text-xs font-bold text-indigo-700">Ubah rincian kesepakatan</summary>
                    <form action="{{ route('admin.sponsorship.agreements.update', $agreement->id) }}" method="POST" class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                        @csrf @method('PUT')
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">NOMOR</label><input name="agreement_number" value="{{ $agreement->agreement_number }}" required maxlength="100" class="w-full p-2.5 border rounded-xl text-xs"></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">PAKET</label><select name="package_id" class="w-full p-2.5 border rounded-xl text-xs"><option value="">Tanpa paket</option>@foreach($packages as $package)<option value="{{ $package->id }}" @selected($agreement->package_id == $package->id)>{{ $package->name }}</option>@endforeach</select></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">NILAI KOMITMEN (RP)</label><input type="number" name="agreed_amount" min="0" step="0.01" value="{{ $agreement->agreed_amount }}" required class="w-full p-2.5 border rounded-xl text-xs"></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">TIPE DUKUNGAN</label><select name="support_type" required class="w-full p-2.5 border rounded-xl text-xs"><option value="cash" @selected($agreement->support_type === 'cash')>Tunai</option><option value="in_kind" @selected($agreement->support_type === 'in_kind')>Barang/Jasa</option><option value="hybrid" @selected($agreement->support_type === 'hybrid')>Gabungan</option></select></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">STATUS</label><select name="status" required class="w-full p-2.5 border rounded-xl text-xs">@foreach(['draft' => 'Draf', 'offered' => 'Ditawarkan', 'agreed' => 'Disepakati', 'signed' => 'Ditandatangani', 'cancelled' => 'Dibatalkan'] as $value => $label)<option value="{{ $value }}" @selected($agreement->status === $value)>{{ $label }}</option>@endforeach</select></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">TANGGAL KESEPAKATAN</label><input type="datetime-local" name="agreed_at" value="{{ $agreement->agreed_at?->format('Y-m-d\\TH:i') }}" class="w-full p-2.5 border rounded-xl text-xs"></div>
                        <div class="sm:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">RINCIAN BARANG/JASA</label><input name="in_kind_description" value="{{ $agreement->in_kind_description }}" maxlength="4000" class="w-full p-2.5 border rounded-xl text-xs"></div>
                        <div class="sm:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">TAUTAN/LOKASI DOKUMEN KONTRAK</label><input name="contract_document" value="{{ $agreement->contract_document }}" maxlength="2048" class="w-full p-2.5 border rounded-xl text-xs"></div>
                        <div class="sm:col-span-2 lg:col-span-4 flex justify-end"><button class="px-4 py-2 rounded-lg bg-indigo-700 text-white font-bold text-xs">Simpan Kesepakatan</button></div>
                    </form>
                </details>

                <div class="space-y-3 border-t border-slate-100 pt-5">
                    <h4 class="text-sm font-bold text-slate-900">Pemenuhan Manfaat & Bukti Pelaksanaan</h4>
                    @forelse($agreement->fulfillments as $fulfillment)
                    <form action="{{ route('admin.sponsorship.fulfillments.update', $fulfillment->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                        @csrf @method('PUT')
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">MANFAAT</label><select name="benefit_id" required class="w-full p-2 border rounded-lg">@foreach($agreement->package?->benefits ?? [] as $benefit)<option value="{{ $benefit->id }}" @selected($fulfillment->benefit_id === $benefit->id)>{{ $benefit->name }}</option>@endforeach</select></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">STATUS</label><select name="status" class="w-full p-2 border rounded-lg"><option value="pending" @selected($fulfillment->status === 'pending')>Menunggu</option><option value="in_progress" @selected($fulfillment->status === 'in_progress')>Dalam proses</option><option value="fulfilled" @selected($fulfillment->status === 'fulfilled')>Terpenuhi</option></select></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">TAUTAN BUKTI (OPSIONAL)</label><input type="url" name="proof_url" value="{{ $fulfillment->proof_url }}" class="w-full p-2 border rounded-lg"></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">GANTI/UNGGAH BUKTI</label><input type="file" name="proof_file" accept=".jpg,.jpeg,.png,.pdf" class="w-full p-1.5 border rounded-lg bg-white"><span class="text-[9px] text-slate-400">Maks. 10 MB @if($fulfillment->proof_file) · File sudah tersimpan @endif</span></div>
                        <div><label class="block text-[10px] font-bold text-slate-500 mb-1">CATATAN</label><input name="notes" value="{{ $fulfillment->notes }}" maxlength="4000" class="w-full p-2 border rounded-lg"></div>
                        <div class="sm:col-span-2 lg:col-span-5 flex flex-wrap items-center justify-between gap-2">
                            <span class="text-slate-500">{{ $fulfillment->verified_at ? 'Diverifikasi ' . $fulfillment->verified_at->format('d M Y H:i') . ' oleh ' . ($fulfillment->verifier?->name ?? 'panitia') : 'Belum diverifikasi' }}
                                @if($fulfillment->proof_file)<a href="{{ route('admin.sponsorship.fulfillments.proof', $fulfillment->id) }}" class="ml-2 text-cyan-700 font-bold">Lihat file</a>@endif
                                @if($fulfillment->proof_url)<a href="{{ $fulfillment->proof_url }}" target="_blank" rel="noopener" class="ml-2 text-cyan-700 font-bold">Buka tautan</a>@endif
                            </span>
                            <button class="px-4 py-2 rounded-lg bg-slate-900 text-white font-bold">Simpan Pemenuhan</button>
                        </div>
                    </form>
                    @empty
                        <p class="text-xs text-slate-500">Belum ada pemenuhan manfaat yang dicatat.</p>
                    @endforelse

                    @if($agreement->package?->benefits?->isNotEmpty())
                    <details class="rounded-xl border border-dashed border-teal-300 p-4">
                        <summary class="cursor-pointer text-xs font-bold text-teal-800">Tambah catatan pemenuhan manfaat</summary>
                        <form action="{{ route('admin.sponsorship.fulfillments.store', $agreement->id) }}" method="POST" enctype="multipart/form-data" class="mt-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 text-xs">
                            @csrf
                            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">MANFAAT PAKET</label><select name="benefit_id" required class="w-full p-2 border rounded-lg">@foreach($agreement->package->benefits as $benefit)<option value="{{ $benefit->id }}">{{ $benefit->name }}</option>@endforeach</select></div>
                            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">STATUS</label><select name="status" class="w-full p-2 border rounded-lg"><option value="pending">Menunggu</option><option value="in_progress">Dalam proses</option><option value="fulfilled">Terpenuhi</option></select></div>
                            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">TAUTAN BUKTI</label><input type="url" name="proof_url" class="w-full p-2 border rounded-lg"></div>
                            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">FILE BUKTI</label><input type="file" name="proof_file" accept=".jpg,.jpeg,.png,.pdf" class="w-full p-1.5 border rounded-lg bg-white"></div>
                            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">CATATAN</label><input name="notes" maxlength="4000" class="w-full p-2 border rounded-lg"></div>
                            <div class="sm:col-span-2 lg:col-span-5 flex justify-end"><button class="px-4 py-2 rounded-lg bg-teal-700 text-white font-bold">Tambah Pemenuhan</button></div>
                        </form>
                    </details>
                    @else
                    <p class="text-xs text-amber-700">Paket belum memiliki daftar manfaat. Pilih paket yang sudah memiliki benefit untuk mencatat realisasi.</p>
                    @endif
                </div>
            </div>
        </article>
        @empty
            <p class="rounded-2xl bg-white border border-slate-200 p-8 text-center text-sm text-slate-500">Belum ada kesepakatan sponsorship.</p>
        @endforelse
    </section>
</div>
@endsection
