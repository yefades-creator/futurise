@extends('layouts.admin', ['title' => 'Registrasi & QR Gate Check-In | Admin FUTURiSE'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-rose-600 uppercase tracking-widest">Divisi Registrasi & Layanan Gate</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Pemindai QR & Prosedur Check-in Sabuga</h1>
            <p class="text-xs text-slate-500 mt-1">Pemindaian QR acak aman (BR-17), deteksi scan ulang (Acceptance 06), dan prosedur manual fallback (Section 17).</p>
        </div>

        <a href="{{ route('admin.export', 'checkins') }}" class="px-4 py-2 rounded-xl bg-slate-900 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm self-start sm:self-auto">
            <i class="fa-solid fa-file-csv text-rose-400"></i> Ekspor Log Presensi (CSV)
        </a>
    </div>

    <!-- Attendance Live Metrics Bar (BR-11 & BR-12) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Pengunjung Unik Kumulatif (BR-11)</span>
            <span class="text-2xl font-black text-rose-700 mt-1 block">{{ $metrics['unique_visitors_cumulative'] }}</span>
            <span class="text-[10px] text-slate-500">Scan pertama sah (Acceptance 06)</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Okupansi Bersamaan Saat Ini (BR-12)</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">{{ $metrics['concurrent_occupancy'] }} / {{ $metrics['concurrent_capacity'] }}</span>
            <span class="text-[10px] text-emerald-600 font-bold">Kapasitas Sabuga ({{ $metrics['occupancy_percent'] }}%)</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Total Pemindaian Masuk (IN)</span>
            <span class="text-2xl font-black text-indigo-700 mt-1 block">{{ $metrics['total_in_scans'] }}</span>
            <span class="text-[10px] text-slate-400">Termasuk scan keluar-masuk ulang</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-slate-400 font-bold uppercase text-[10px] block">Total Pemindaian Keluar (OUT)</span>
            <span class="text-2xl font-black text-slate-700 mt-1 block">{{ $metrics['total_out_scans'] }}</span>
            <span class="text-[10px] text-slate-400">Penghitungan okupansi real-time</span>
        </div>
    </div>

    @if(session('success'))<div class="p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 text-sm">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="p-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="p-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm"><strong>Periksa kembali:</strong><ul class="list-disc ml-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <section class="xl:col-span-2 bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-4">
            <div>
                <h3 class="font-black text-slate-900"><i class="fa-solid fa-magnifying-glass text-cyan-700 mr-1"></i> Pencarian Peserta & Tiket</h3>
                <p class="text-xs text-slate-500 mt-1">Cari berdasarkan nama, email, atau nomor tiket. Pilih tiket untuk mengisi token pada alat pemindai.</p>
            </div>
            <form method="GET" action="{{ route('admin.checkin') }}" class="flex gap-2">
                <input name="q" value="{{ $search }}" placeholder="Nama, email, atau nomor tiket" class="flex-1 p-3 border rounded-xl text-sm">
                <button class="px-5 rounded-xl bg-slate-900 text-white font-bold text-sm">Cari</button>
                @if($search)<a href="{{ route('admin.checkin') }}" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold text-sm">Reset</a>@endif
            </form>
            <div class="overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[10px]"><tr><th class="p-3">Peserta</th><th class="p-3">No. Tiket</th><th class="p-3">Kategori</th><th class="p-3">Status</th><th class="p-3 text-right">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-slate-100">
                    @forelse($participants as $ticket)
                        <tr><td class="p-3 font-semibold">{{ $ticket->user->name }}<span class="block text-slate-400 font-normal">{{ $ticket->user->email }}</span></td><td class="p-3 font-mono">{{ $ticket->ticket_number }}</td><td class="p-3">{{ str_replace('_', ' ', strtoupper($ticket->category)) }}</td><td class="p-3">{{ $ticket->has_checked_in ? 'Sudah check-in' : ($ticket->status === 'cancelled' ? 'Dibatalkan' : 'Belum check-in') }}</td><td class="p-3 text-right"><button type="button" data-ticket-token="{{ $ticket->qr_token }}" class="fill-ticket-token px-3 py-1.5 rounded-lg bg-cyan-700 text-white font-bold">Pilih Tiket</button></td></tr>
                    @empty
                        <tr><td colspan="5" class="p-5 text-center text-slate-500">Tidak ada peserta/tiket yang cocok.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div>{{ $participants->links() }}</div>
        </section>

        <section class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-3">
            <div class="flex items-center justify-between"><h3 class="font-black text-slate-900"><i class="fa-solid fa-list-ol text-amber-600 mr-1"></i> Antrean Check-in</h3><span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-800 font-bold">{{ $checkInQueueCount }}</span></div>
            <p class="text-xs text-slate-500">10 dari {{ $checkInQueueCount }} tiket aktif yang belum check-in, diurutkan dari pendaftaran terlama.</p>
            @forelse($checkInQueue as $ticket)
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-2 text-xs"><div class="min-w-0"><strong class="block truncate">{{ $ticket->user->name }}</strong><span class="text-slate-500 font-mono">{{ $ticket->ticket_number }}</span></div><button type="button" data-ticket-token="{{ $ticket->qr_token }}" class="fill-ticket-token shrink-0 px-2.5 py-1.5 rounded-lg bg-indigo-900 text-white font-bold">Pilih</button></div>
            @empty
            <p class="p-4 text-xs text-slate-500 rounded-xl bg-slate-50">Antrean kosong, semua tiket aktif sudah check-in.</p>
            @endforelse
        </section>
    </div>

    <section class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between"><div><h3 class="font-black text-slate-900"><i class="fa-solid fa-life-ring text-rose-600 mr-1"></i> Tiket Bantuan</h3><p class="text-xs text-slate-500 mt-1">Tiket terbuka dari peserta; tandai sedang ditangani atau kirim jawaban.</p></div><span class="text-xs px-2 py-1 rounded-full bg-rose-100 text-rose-800 font-bold">{{ $supportTickets->count() }} terbuka</span></div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @forelse($supportTickets as $supportTicket)
            <article class="p-4 rounded-2xl border border-slate-200 space-y-3 text-xs">
                <div class="flex justify-between gap-3"><div><strong>{{ $supportTicket->subject }}</strong><span class="block text-slate-500">{{ $supportTicket->ticket_code }} · {{ $supportTicket->user->name }} ({{ $supportTicket->user->email }})</span></div><span class="h-fit px-2 py-1 rounded-full bg-amber-100 text-amber-800 font-bold uppercase">{{ str_replace('_', ' ', $supportTicket->status) }}</span></div>
                <p class="text-slate-600 whitespace-pre-line">{{ $supportTicket->message }}</p>
                <form method="POST" action="{{ route('admin.checkin.support.update', $supportTicket->id) }}" class="space-y-2">@csrf
                    <textarea name="response_text" rows="2" maxlength="2000" placeholder="Jawaban untuk peserta (wajib jika status Dijawab)" class="w-full p-2.5 border rounded-xl">{{ old('response_text') }}</textarea>
                    <div class="flex flex-wrap justify-end gap-2"><button name="status" value="in_review" class="px-3 py-2 rounded-lg bg-amber-100 text-amber-900 font-bold">Tandai Ditinjau</button><button name="status" value="answered" class="px-3 py-2 rounded-lg bg-cyan-700 text-white font-bold">Kirim Jawaban</button><button name="status" value="closed" class="px-3 py-2 rounded-lg bg-slate-200 text-slate-700 font-bold">Tutup</button></div>
                </form>
            </article>
            @empty
            <p class="text-xs text-slate-500">Tidak ada tiket bantuan yang menunggu penanganan.</p>
            @endforelse
        </div>
    </section>

    <!-- Scan Result Flash Alert (If Any) -->
    @if(session('scan_result'))
    @php $res = session('scan_result'); @endphp
    <div class="p-6 rounded-3xl border {{ $res['repeated_scan'] ? 'bg-amber-50 border-amber-300 text-amber-900' : 'bg-emerald-50 border-emerald-300 text-emerald-900' }} shadow-md space-y-2">
        <div class="flex items-center gap-3">
            <i class="fa-solid {{ $res['repeated_scan'] ? 'fa-triangle-exclamation text-amber-600' : 'fa-circle-check text-emerald-600' }} text-2xl"></i>
            <div>
                <h3 class="font-black text-base">{{ $res['message'] }}</h3>
                <p class="text-xs">Tiket: <strong>{{ $res['ticket']->ticket_number }}</strong> &bull; Nama: <strong>{{ $res['user']->name }}</strong> &bull; Gate: {{ $res['gate'] }}</p>
            </div>
        </div>
        @if($res['repeated_scan'])
        <div class="mt-2 text-xs bg-amber-100/60 p-2.5 rounded-xl border border-amber-200">
            <strong>Penegakan Acceptance 06:</strong> Pemindaian ini dicatat sebagai riwayat akses, tetapi <em>TIDAK MENAMBAH</em> jumlah pengunjung unik kumulatif.
        </div>
        @endif
    </div>
    @endif

    @if(session('group_scan_result'))
    <div class="p-5 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-900">
        <strong>Check-in rombongan berhasil.</strong>
        <span>{{ session('group_scan_result')->school->name }} &bull; {{ session('group_scan_result')->actual_attendees }} orang hadir.</span>
        <p class="text-xs mt-1">Jumlah rombongan sekolah dicatat terpisah dari hitungan pengunjung unik individu.</p>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- 1. Scanner Simulator Tool (1 Col) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-4">
            <h3 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-qrcode text-rose-600"></i> Alat Pemindai QR & Presensi
            </h3>

            <form id="checkin-scan-form" action="{{ route('admin.checkin.scan') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pindai / Masukkan QR Token (BR-17)</label>
                    <div class="relative">
                        <input id="qr-token-input" type="text" name="qr_token" required autocomplete="off" placeholder="Ketik atau tempel token QR..."
                            class="w-full pl-3 pr-10 py-2.5 rounded-xl border border-slate-200 font-mono text-xs focus:ring-2 focus:ring-rose-500 bg-slate-50">
                        <i class="fa-solid fa-barcode absolute right-3 top-3 text-slate-400"></i>
                    </div>
                    <span class="text-[10px] text-slate-400 block mt-1">Pindai dengan kamera atau gunakan scanner USB / input manual.</span>
                </div>

                <div class="space-y-2">
                    <button id="start-camera-scan" type="button" class="w-full py-2.5 rounded-xl border border-indigo-200 bg-indigo-50 text-indigo-800 font-bold hover:bg-indigo-100 transition">
                        <i class="fa-solid fa-camera mr-1"></i> Buka Kamera Pemindai
                    </button>
                    <div id="qr-reader" class="hidden overflow-hidden rounded-xl border border-slate-200"></div>
                    <p id="qr-scan-status" class="text-[10px] text-slate-500" aria-live="polite"></p>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Jumlah hadir aktual (khusus QR rombongan)</label>
                    <input type="number" name="actual_attendees" min="1" max="500" placeholder="Isi sebelum scan QR rombongan"
                        class="w-full p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-xs">
                    <span class="text-[10px] text-slate-400 block mt-1">Dikosongkan untuk tiket individu. Jumlah rombongan tidak menambah pengunjung unik.</span>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Arah Gerbang (BR-12 Okupansi)</label>
                    <div class="grid grid-cols-2 gap-2 text-center font-bold">
                        <label class="p-2.5 rounded-xl border border-emerald-300 bg-emerald-50 text-emerald-900 cursor-pointer flex items-center justify-center gap-1.5">
                            <input type="radio" name="scan_type" value="in" checked class="text-emerald-600">
                            <span>MASUK (IN)</span>
                        </label>
                        <label class="p-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 cursor-pointer flex items-center justify-center gap-1.5">
                            <input type="radio" name="scan_type" value="out" class="text-rose-600">
                            <span>KELUAR (OUT)</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Posisi Gerbang Sabuga</label>
                    <select name="gate" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                        <option value="Gate 1 - Main Entrance Sabuga">Gate 1 - Main Entrance Sabuga</option>
                        <option value="Gate 2 - Sayap Barat">Gate 2 - Sayap Barat</option>
                        <option value="Gate Bus - Khusus Rombongan Sekolah">Gate Bus - Khusus Rombongan Sekolah</option>
                        <option value="Gate VIP & Media Center">Gate VIP & Media Center</option>
                    </select>
                </div>

                <!-- Prosedur Manual Fallback Offline (Section 17 & Acceptance 14) -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                        <input type="checkbox" name="is_manual" value="1" class="rounded text-rose-600">
                        <span>Prosedur Override Gangguan Jaringan (Section 17)</span>
                    </label>
                    <input type="text" name="reason" placeholder="Wajib diisi jika override manual" class="w-full p-2 border rounded-lg bg-white text-xs">
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-black text-xs uppercase tracking-wider shadow-md shadow-rose-600/20 transition">
                    <i class="fa-solid fa-expand mr-1.5"></i> Proses Pemindaian
                </button>
            </form>
        </div>

        <!-- 2. Live Scan Feed & Audit Presensi (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-indigo-600"></i> Log Pemindaian Terkini (Real-time Feed)
                </h3>
                <span class="text-xs text-slate-400 font-semibold">15 Pemindaian Terakhir</span>
            </div>

            <div class="overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px]">
                        <tr>
                            <th class="py-3 px-3">Nama & Tiket</th>
                            <th class="py-3 px-3">Tipe</th>
                            <th class="py-3 px-3">Pengunjung Unik? (BR-11)</th>
                            <th class="py-3 px-3">Lokasi Gate</th>
                            <th class="py-3 px-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recentLogs as $log)
                        <tr class="hover:bg-slate-50">
                            <td class="py-2.5 px-3">
                                <span class="font-bold text-slate-900 block">{{ $log->user->name }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $log->ticket->ticket_number ?? '-' }}</span>
                            </td>
                            <td class="py-2.5 px-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase {{ $log->scan_type === 'in' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700' }}">
                                    {{ strtoupper($log->scan_type) }}
                                </span>
                            </td>
                            <td class="py-2.5 px-3">
                                @if($log->is_unique_first_entry)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500 text-white">
                                        &check; YA (Unik)
                                    </span>
                                @else
                                    <span class="text-slate-400 text-[11px] italic">
                                        Scan Ulang (Acceptance 06)
                                    </span>
                                @endif
                            </td>
                            <td class="py-2.5 px-3 text-slate-600 text-[11px]">{{ $log->gate_location }}</td>
                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">{{ $log->scanned_at->format('H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js" defer onerror="this.onerror=null;this.src='https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js'"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const startButton = document.getElementById('start-camera-scan');
        const reader = document.getElementById('qr-reader');
        const tokenInput = document.getElementById('qr-token-input');
        const form = document.getElementById('checkin-scan-form');
        const actualAttendeesInput = form.querySelector('[name="actual_attendees"]');
        const status = document.getElementById('qr-scan-status');
        let scanner;

        document.querySelectorAll('.fill-ticket-token').forEach((button) => {
            button.addEventListener('click', () => {
                tokenInput.value = button.dataset.ticketToken || '';
                status.textContent = 'Tiket dipilih. Periksa arah gate, lalu klik “Proses Pemindaian”.';
                tokenInput.focus();
                document.getElementById('checkin-scan-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        });

        startButton.addEventListener('click', async () => {
            if (!window.Html5Qrcode) {
                status.textContent = 'Library pemindai tidak berhasil dimuat. Periksa koneksi lalu muat ulang, atau gunakan scanner USB/input manual.';
                return;
            }

            startButton.disabled = true;
            status.textContent = 'Meminta izin kamera…';
            reader.classList.remove('hidden');

            try {
                scanner = scanner || new Html5Qrcode('qr-reader');
                await scanner.start(
                    { facingMode: 'environment' },
                    { fps: 10, qrbox: { width: 220, height: 220 } },
                    async (decodedText) => {
                        tokenInput.value = decodedText.trim();
                        await scanner.stop();
                        startButton.disabled = false;
                        if (tokenInput.value.startsWith('GRP-') && !actualAttendeesInput.value.trim()) {
                            status.textContent = 'QR rombongan terbaca. Isi jumlah hadir aktual, lalu klik “Proses Pemindaian”.';
                            actualAttendeesInput.focus();
                            return;
                        }
                        status.textContent = 'QR terbaca. Memproses check-in…';
                        form.requestSubmit();
                    },
                    () => {}
                );
                status.textContent = 'Arahkan kamera ke QR tiket.';
            } catch (error) {
                reader.classList.add('hidden');
                const detail = error?.message ? ` (${error.message})` : '';
                status.textContent = 'Kamera tidak dapat dibuka. Izinkan akses kamera pada browser, tutup aplikasi lain yang memakai kamera, dan gunakan localhost/HTTPS.' + detail;
                startButton.disabled = false;
            }
        });
    });
</script>
@endsection
