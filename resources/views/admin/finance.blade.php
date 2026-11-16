@extends('layouts.admin', ['title' => 'Keuangan & Sponsorship | Admin FUTURiSE'])

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Divisi Keuangan & Sponsorship</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Manajemen Keuangan, Tagihan & Kemitraan</h1>
            <p class="text-xs text-slate-500 mt-1">Verifikasi pembayaran manual (BR-06), pembukuan kas vs barang/jasa in-kind (BR-08), dan alokasi penerimaan (BR-07).</p>
        </div>

        <a href="{{ route('admin.export', 'finance') }}" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm self-start sm:self-auto">
            <i class="fa-solid fa-file-csv text-cyan-400"></i> Ekspor Laporan Keuangan (CSV)
        </a>
    </div>

    <!-- Rule Banner (BR-06, BR-07, BR-08) -->
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 text-xs text-emerald-950 space-y-1">
        <p><strong>Penegakan Aturan Bisnis Keuangan:</strong></p>
        <p class="text-emerald-900">&bull; <strong>BR-06 & Acceptance 05:</strong> Status pembayaran terpisah dari partisipasi. Unggah bukti bayar bukan berarti otomatis lunas; harus diverifikasi panitia keuangan.</p>
        <p class="text-emerald-900">&bull; <strong>BR-07:</strong> Penerimaan uang dicatat sekali; jumlah alokasi ke item tagihan tidak boleh melebihi total pembayaran.</p>
        <p class="text-emerald-900">&bull; <strong>BR-08:</strong> Dukungan barang/jasa (in-kind) dicatat terpisah secara ketat dari saldo kas tunai.</p>
    </div>

    <!-- Financial KPI Summary Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Total Tagihan Diterbitkan</span>
            <span class="text-xl font-black text-slate-900 mt-1 block">Rp {{ number_format($summary['total_invoiced'], 0, ',', '.') }}</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Kas Masuk Terverifikasi (BR-06)</span>
            <span class="text-xl font-black text-emerald-700 mt-1 block">Rp {{ number_format($summary['cash_received'], 0, ',', '.') }}</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Pengeluaran Operasional</span>
            <span class="text-xl font-black text-rose-700 mt-1 block">Rp {{ number_format($summary['cash_expenses'], 0, ',', '.') }}</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Dukungan Barang/Jasa (BR-08)</span>
            <span class="text-xl font-black text-teal-700 mt-1 block">Rp {{ number_format($summary['total_in_kind'], 0, ',', '.') }}</span>
        </div>
    </div>

    @if(auth()->user()->hasRole(['super-admin', 'keuangan']))
    <section class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
        <div>
            <h2 class="text-base font-black text-slate-900"><i class="fa-solid fa-file-circle-plus text-emerald-600 mr-1"></i> Buat Tagihan Organisasi</h2>
            <p class="text-xs text-slate-500 mt-1">Tagihan baru akan langsung muncul di portal organisasi terpilih. Total dihitung dari subtotal − diskon + pajak.</p>
        </div>
        <form action="{{ route('admin.finance.invoices.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            @csrf
            <div class="lg:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">ORGANISASI</label><select name="organization_id" required class="w-full p-2.5 border rounded-xl text-xs"><option value="">Pilih organisasi terverifikasi</option>@foreach($invoiceOrganizations as $organization)<option value="{{ $organization->id }}">{{ $organization->name }} ({{ strtoupper($organization->type) }})</option>@endforeach</select></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">NOMOR TAGIHAN (OPSIONAL)</label><input name="invoice_number" maxlength="100" placeholder="Otomatis jika kosong" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">JATUH TEMPO</label><input type="date" name="due_date" required class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div class="lg:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">RINCIAN TAGIHAN</label><input name="description" required maxlength="255" placeholder="Contoh: Paket sponsorship Gold" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">SUBTOTAL (RP)</label><input type="number" name="subtotal" min="0.01" step="0.01" required class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">DISKON (RP)</label><input type="number" name="discount" min="0" step="0.01" value="0" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div><label class="block text-[10px] font-bold text-slate-500 mb-1">PAJAK (RP)</label><input type="number" name="tax" min="0" step="0.01" value="0" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div class="sm:col-span-2 lg:col-span-3"><label class="block text-[10px] font-bold text-slate-500 mb-1">CATATAN UNTUK ORGANISASI</label><input name="notes" maxlength="2000" class="w-full p-2.5 border rounded-xl text-xs"></div>
            <div class="sm:col-span-2 lg:col-span-4 flex justify-end"><button class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs"><i class="fa-solid fa-floppy-disk mr-1"></i> Terbitkan Tagihan</button></div>
        </form>

        <div class="space-y-3 border-t border-slate-100 pt-5">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Tagihan & Pengubahan</h3>
            @forelse($invoices as $invoice)
            <details class="border border-slate-200 rounded-2xl overflow-hidden">
                <summary class="cursor-pointer list-none p-4 flex flex-wrap items-center justify-between gap-3 bg-slate-50">
                    <span><strong class="text-slate-900">{{ $invoice->invoice_number }}</strong><span class="block text-[11px] text-slate-500">{{ $invoice->organization->name }} · Jatuh tempo {{ $invoice->due_date->format('d M Y') }}</span></span>
                    <span class="text-right"><strong class="text-emerald-800">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</strong><span class="block text-[10px] uppercase text-slate-500">{{ str_replace('_', ' ', $invoice->status) }}</span></span>
                </summary>
                <form action="{{ route('admin.finance.invoices.update', $invoice->id) }}" method="POST" class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
                    @csrf @method('PUT')
                    <div class="lg:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">RINCIAN TAGIHAN</label><input name="description" value="{{ $invoice->items->first()?->description ?? $invoice->notes }}" required maxlength="255" class="w-full p-2.5 border rounded-lg"></div>
                    <div><label class="block text-[10px] font-bold text-slate-500 mb-1">SUBTOTAL (RP)</label><input type="number" name="subtotal" min="0.01" step="0.01" value="{{ $invoice->subtotal }}" required class="w-full p-2.5 border rounded-lg"></div>
                    <div><label class="block text-[10px] font-bold text-slate-500 mb-1">DISKON (RP)</label><input type="number" name="discount" min="0" step="0.01" value="{{ $invoice->discount }}" class="w-full p-2.5 border rounded-lg"></div>
                    <div><label class="block text-[10px] font-bold text-slate-500 mb-1">PAJAK (RP)</label><input type="number" name="tax" min="0" step="0.01" value="{{ $invoice->tax }}" class="w-full p-2.5 border rounded-lg"></div>
                    <div><label class="block text-[10px] font-bold text-slate-500 mb-1">JATUH TEMPO</label><input type="date" name="due_date" value="{{ $invoice->due_date->format('Y-m-d') }}" required class="w-full p-2.5 border rounded-lg"></div>
                    <div class="sm:col-span-2"><label class="block text-[10px] font-bold text-slate-500 mb-1">CATATAN</label><input name="notes" value="{{ $invoice->notes }}" maxlength="2000" class="w-full p-2.5 border rounded-lg"></div>
                    <div class="sm:col-span-2 lg:col-span-4 flex items-center justify-between gap-3"><span class="text-[10px] text-slate-500">Dibayar: Rp {{ number_format($invoice->totalPaid(), 0, ',', '.') }} · Menunggu: Rp {{ number_format($invoice->payments->where('status', 'pending_verification')->sum('amount'), 0, ',', '.') }}</span><button class="px-4 py-2 rounded-lg bg-slate-900 text-white font-bold">Simpan Perubahan</button></div>
                </form>
            </details>
            @empty
                <p class="text-xs text-slate-500">Belum ada tagihan pada acara ini.</p>
            @endforelse
        </div>
    </section>
    @endif

    <!-- 1. Daftar Pembayaran Menunggu Verifikasi (BR-06) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-amber-500"></i> Bukti Bayar Menunggu Verifikasi ({{ $pendingPayments->count() }})
            </h2>
            <span class="text-[11px] text-amber-800 bg-amber-100 px-2.5 py-0.5 rounded-full font-bold">Acceptance 05</span>
        </div>

        @if($pendingPayments->count() > 0)
        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-3 px-4">No Pembayaran</th>
                        <th class="py-3 px-4">Institusi & Invoice</th>
                        <th class="py-3 px-4">Nominal</th>
                        <th class="py-3 px-4">Metode & Rekening</th>
                        <th class="py-3 px-4">Tanggal Transfer</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pendingPayments as $pay)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-mono font-bold text-slate-900">{{ $pay->payment_number }}</td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-slate-800 block">{{ $pay->invoice->organization->name }}</span>
                            <span class="text-[10px] text-slate-400">{{ $pay->invoice->invoice_number }}</span>
                        </td>
                        <td class="py-3 px-4 font-black text-emerald-800">Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-slate-600">
                            {{ $pay->bank_source }} (an {{ $pay->account_holder ?? '-' }})
                        </td>
                        <td class="py-3 px-4 text-slate-500">{{ $pay->payment_date->format('d M Y') }}</td>
                        <td class="py-3 px-4 text-right">
                            @if(auth()->user()->hasRole(['super-admin', 'keuangan']))
                            @if($pay->receipt_file)<a href="{{ route('admin.finance.receipt', $pay->id) }}" class="inline-block px-3 py-1.5 mb-1 rounded-xl bg-slate-100 text-slate-700 font-bold">Lihat Bukti</a>@endif
                            <form action="{{ route('admin.finance.verify', $pay->id) }}" method="POST" class="space-y-2 min-w-[250px]" onsubmit="return confirm('Konfirmasi verifikasi pembayaran nomor {{ $pay->payment_number }} sebesar Rp {{ number_format($pay->amount, 0, ',', '.') }}?')">
                                @csrf
                                <details class="text-left border border-slate-200 rounded-lg p-2 bg-slate-50">
                                    <summary class="cursor-pointer font-bold text-indigo-800">Atur alokasi ke rincian tagihan</summary>
                                    @if($pay->invoice->items->isNotEmpty())
                                    <div class="space-y-2 mt-2">
                                        @foreach($pay->invoice->items as $item)
                                        <label class="block text-[10px] text-slate-600">{{ $item->description }} · Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                            <input type="hidden" name="allocations[{{ $loop->index }}][invoice_item_id]" value="{{ $item->id }}">
                                            <input type="number" name="allocations[{{ $loop->index }}][amount]" min="0" max="{{ $pay->amount }}" step="0.01" value="{{ $loop->first ? number_format($pay->amount, 2, '.', '') : '0' }}" class="w-full p-2 mt-1 border rounded-lg text-xs">
                                        </label>
                                        @endforeach
                                    </div>
                                    <p class="text-[9px] text-slate-500 mt-2">Jumlah alokasi tidak boleh melebihi Rp {{ number_format($pay->amount, 0, ',', '.') }}. Default-nya, seluruh pembayaran dialokasikan ke rincian pertama; ubah nominal baris untuk membaginya ke rincian lain.</p>
                                    @else
                                    <p class="text-[10px] text-slate-500 mt-2">Tagihan ini belum memiliki rincian. Pembayaran akan dialokasikan ke tagihan secara umum.</p>
                                    @endif
                                </details>
                                <button type="submit" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold transition whitespace-nowrap">
                                    <i class="fa-solid fa-check mr-1"></i> Verifikasi Lunas (BR-07)
                                </button>
                            </form>
                            @else
                            <span class="text-slate-400">Menunggu verifikasi bagian Keuangan</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-xs text-slate-400 italic py-2">Semua bukti transfer yang masuk telah selesai diverifikasi.</p>
        @endif
    </div>

    <!-- 2. Pembukuan Kas Terverifikasi & Barang/Jasa In-Kind (BR-08) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Kas Masuk Terverifikasi -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600"></i> Riwayat Kas Masuk Sah (Penerimaan Sekali - BR-07)
            </h3>
            <div class="space-y-2">
                @foreach($verifiedPayments as $vp)
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="font-bold text-slate-800 block">{{ $vp->invoice->organization->name }}</span>
                        <span class="text-[10px] text-slate-400">{{ $vp->payment_number }} &bull; Verifikator: {{ $vp->verifier?->name ?? 'Keuangan' }}</span>
                        @if($vp->allocations->isNotEmpty())
                        <span class="block text-[10px] text-slate-500 mt-1">Alokasi: @foreach($vp->allocations as $allocation){{ $allocation->invoiceItem?->description ?? 'Tagihan umum' }} Rp {{ number_format($allocation->allocated_amount, 0, ',', '.') }}@if(!$loop->last); @endif @endforeach</span>
                        @endif
                    </div>
                    <span class="font-black text-emerald-800 text-sm">Rp {{ number_format($vp->amount, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- In-Kind (Barang/Jasa) Terpisah dari Kas (BR-08) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-boxes-packing text-teal-600"></i> Dukungan Barang/Jasa (In-Kind - BR-08)
            </h3>
            <div class="space-y-2">
                @foreach($inKindContributions as $ink)
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="font-bold text-slate-800 block">{{ $ink->item_name }}</span>
                        <span class="text-[10px] text-slate-400">Pemberi: {{ $ink->organization->name }} &bull; Status: {{ strtoupper($ink->delivery_status) }}</span>
                    </div>
                    <span class="font-black text-teal-800 text-sm">Rp {{ number_format($ink->estimated_value, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
