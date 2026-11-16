<section class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
    <div>
        <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest">Administrasi Pembayaran</span>
        <h2 class="text-xl font-black text-slate-900 mt-1">Tagihan Organisasi</h2>
        <p class="text-xs text-slate-500 mt-1">Unggah bukti transfer; status baru berubah setelah diverifikasi bagian Keuangan. Pembuatan atau perubahan tagihan dilakukan panitia Keuangan dari menu admin.</p>
    </div>
    @forelse($invoices as $invoice)
    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50 space-y-3 text-xs">
        <div class="flex flex-wrap justify-between gap-2">
            <strong>{{ $invoice->invoice_number }}</strong>
            <span class="font-bold uppercase">{{ str_replace('_', ' ', $invoice->status) }}</span>
        </div>
        <p>Total: <strong>Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</strong> &bull; Sisa yang dapat dibayar: <strong>Rp {{ number_format($invoice->availableBalance(), 0, ',', '.') }}</strong></p>
        @if($invoice->availableBalance() > 0)
        <form action="{{ route('portal.invoices.pay', $invoice->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2">
            @csrf
            <input type="number" name="amount" min="1" max="{{ $invoice->availableBalance() }}" value="{{ $invoice->availableBalance() }}" required placeholder="Nominal" class="p-2 border rounded-lg bg-white">
            <input type="text" name="bank_source" required placeholder="Bank pengirim" class="p-2 border rounded-lg bg-white">
            <input type="text" name="account_holder" required placeholder="Nama pemilik rekening" class="p-2 border rounded-lg bg-white">
            <input type="date" name="payment_date" value="{{ now()->toDateString() }}" required class="p-2 border rounded-lg bg-white">
            <input type="file" name="receipt_file" accept=".jpg,.jpeg,.png,.pdf" required class="p-2 border rounded-lg bg-white">
            <button class="sm:col-span-2 lg:col-span-5 px-4 py-2 rounded-lg bg-emerald-700 text-white font-bold">Kirim Bukti Pembayaran</button>
        </form>
        @endif
        @if($invoice->payments->isNotEmpty())
        <div class="pt-2 border-t border-slate-200">
            <strong>Riwayat pembayaran</strong>
            @foreach($invoice->payments as $payment)
            <p class="mt-1">{{ $payment->payment_number }} &bull; Rp {{ number_format($payment->amount, 0, ',', '.') }} &bull; {{ $payment->status === 'verified' ? 'Terverifikasi' : 'Menunggu Verifikasi' }}</p>
            @endforeach
        </div>
        @endif
    </div>
    @empty
    <p class="text-xs text-slate-500">Belum ada tagihan untuk organisasi ini.</p>
    @endforelse
</section>
