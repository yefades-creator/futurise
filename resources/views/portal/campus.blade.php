@extends('layouts.app', ['title' => 'Portal PIC Kampus & Tim Mahasiswa | FUTURiSE 2026'])

@section('content')
<div class="gradient-brand text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Portal Peserta Akademik</span>
                <h1 class="text-2xl sm:text-3xl font-black mt-1">{{ $organization->name ?? 'Portal Kampus' }}</h1>
                <p class="text-xs text-slate-300 mt-1">PIC: <strong>{{ $organization->pic_name ?? auth()->user()->name }}</strong> &bull; {{ $organization->pic_email ?? auth()->user()->email }}</p>
            </div>
            @if($allocatedBooth)
            <div class="bg-white/10 border border-white/20 rounded-2xl px-5 py-3 text-right">
                <span class="text-[10px] text-cyan-300 uppercase font-bold tracking-wider block">Booth Kampus (BR-03)</span>
                <span class="text-xl font-black text-white">{{ $allocatedBooth->code }}</span>
                <span class="text-[11px] text-slate-300 block">{{ $allocatedBooth->size }} &bull; {{ $allocatedBooth->power_watt }}W</span>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10" x-data="{ activeTab: 'projects', editingProject: null }">
    @include('portal._organization-status')
    <!-- Portal Navigation Tabs (Section 4) -->
    <div class="flex flex-wrap items-center gap-2 border-b border-slate-200 pb-3 text-xs font-bold">
        <button @click="activeTab = 'projects'" :class="activeTab === 'projects' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center gap-2">
            <i class="fa-solid fa-laptop-code"></i> 2 Karya Mahasiswa (BR-03)
        </button>
        <button @click="activeTab = 'booth'" :class="activeTab === 'booth' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center gap-2">
            <i class="fa-solid fa-store"></i> Booth & Kebutuhan Teknis
        </button>
        <button @click="activeTab = 'finance'" :class="activeTab === 'finance' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center gap-2">
            <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan & Administrasi (BR-06)
        </button>
        <button @click="activeTab = 'meetings'" :class="activeTab === 'meetings' ? 'bg-indigo-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center gap-2">
            <i class="fa-solid fa-handshake"></i> Pertemuan Kolaborasi & H+30
        </button>
    </div>

    <!-- TAB 1: DUA KARYA MAHASISWA (Section 4 & BR-03) -->
    <div x-show="activeTab === 'projects'" class="space-y-6">
        @if(session('success'))<div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">{{ session('error') }}</div>@endif
        @if($errors->any())<div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm"><strong>Periksa data karya:</strong><ul class="list-disc ml-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <div class="bg-cyan-50 border border-cyan-200 rounded-2xl p-4 text-xs text-cyan-900 flex items-start gap-3">
            <i class="fa-solid fa-circle-info text-cyan-600 text-base mt-0.5"></i>
            <div>
                <strong>Ketentuan Bisnis BR-03:</strong> Dua karya berbagi satu booth kampus, tetapi memiliki profil, penilaian juri, status publikasi, dan feedback masing-masing.
                <br><strong>Status Terkunci BR-09:</strong> Materi karya otomatis terkunci saat diperiksa kurator; revisi dibuka hanya jika kurator meminta perbaikan.
            </div>
        </div>

        @if($roleSlug === 'tim-mahasiswa')
        <div class="p-4 rounded-2xl bg-indigo-50 border border-indigo-200 text-indigo-900 text-xs">Pendaftaran karya dilakukan oleh PIC Kampus. Hubungi PIC agar mendaftarkan karya dan menetapkannya ke tim Anda; setelah ditugaskan, karya akan tampil di portal ini untuk dikelola tim.</div>
        @elseif(!$organization || $organization->status !== 'verified')
        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs">Akun kampus belum terhubung ke organisasi terverifikasi. Hubungi PIC Kampus/Sekretariat untuk memastikan organisasi dan keanggotaan akun sudah terverifikasi.</div>
        @elseif($projectCount < 2)
        <details class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden" @if($errors->any()) open @endif>
            <summary class="cursor-pointer list-none p-5 flex flex-wrap items-center justify-between gap-3">
                <span><strong class="text-slate-900">Daftarkan Karya Baru</strong><span class="block text-xs text-slate-500 mt-1">Kampus dapat mendaftarkan maksimal dua karya ({{ $projectCount }}/2).</span></span>
                <span class="px-4 py-2 rounded-xl bg-indigo-900 text-white font-bold text-xs"><i class="fa-solid fa-plus mr-1"></i> Tambah Karya</span>
            </summary>
            <form action="{{ route('portal.projects.store') }}" method="POST" class="p-5 sm:p-7 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                @csrf
                @if($availableTeams->isNotEmpty())<div><label class="block font-bold text-slate-700 mb-1">TIM PENGUSUL (OPSIONAL)</label><select name="team_id" class="w-full p-2.5 border rounded-xl bg-white"><option value="">Pilih tim pengusul jika sudah ada</option>@foreach($availableTeams as $team)<option value="{{ $team->id }}" @selected(old('team_id') == $team->id)>{{ $team->name }}</option>@endforeach</select></div>@endif
                <div><label class="block font-bold text-slate-700 mb-1">JUDUL KARYA</label><input name="title" value="{{ old('title') }}" required maxlength="255" class="w-full p-2.5 border rounded-xl"></div>
                <div><label class="block font-bold text-slate-700 mb-1">BIDANG INOVASI</label><select name="category" required class="w-full p-2.5 border rounded-xl bg-white">@foreach(['AI/IoT', 'Smart City', 'FinTech', 'EdTech', 'HealthTech', 'Creative Media'] as $category)<option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>@endforeach</select></div>
                <div class="sm:col-span-2"><label class="block font-bold text-slate-700 mb-1">PERMASALAHAN YANG DISELESAIKAN</label><textarea name="problem_statement" rows="2" required class="w-full p-2.5 border rounded-xl">{{ old('problem_statement') }}</textarea></div>
                <div><label class="block font-bold text-slate-700 mb-1">PENGGUNA SASARAN</label><textarea name="target_users" rows="2" required class="w-full p-2.5 border rounded-xl">{{ old('target_users') }}</textarea></div>
                <div><label class="block font-bold text-slate-700 mb-1">SOLUSI & FITUR</label><textarea name="solution_description" rows="2" required class="w-full p-2.5 border rounded-xl">{{ old('solution_description') }}</textarea></div>
                <div><label class="block font-bold text-slate-700 mb-1">FITUR UTAMA</label><textarea name="key_features" rows="2" class="w-full p-2.5 border rounded-xl">{{ old('key_features') }}</textarea></div>
                <div><label class="block font-bold text-slate-700 mb-1">TECH STACK</label><input name="technology_stack" value="{{ old('technology_stack') }}" class="w-full p-2.5 border rounded-xl"></div>
                <div><label class="block font-bold text-slate-700 mb-1">TAHAP KESIAPAN / TRL</label><input name="readiness_level" value="{{ old('readiness_level', 'Prototipe Teruji') }}" required class="w-full p-2.5 border rounded-xl"></div>
                <div><label class="block font-bold text-slate-700 mb-1">TAUTAN DEMO</label><input type="url" name="demo_url" value="{{ old('demo_url') }}" placeholder="https://..." class="w-full p-2.5 border rounded-xl"></div>
                <div><label class="block font-bold text-slate-700 mb-1">TAUTAN VIDEO</label><input type="url" name="video_url" value="{{ old('video_url') }}" placeholder="https://..." class="w-full p-2.5 border rounded-xl"></div>
                <div class="sm:col-span-2"><label class="block font-bold text-slate-700 mb-1">KEBUTUHAN KOLABORASI</label><textarea name="collaboration_needs" rows="2" class="w-full p-2.5 border rounded-xl">{{ old('collaboration_needs') }}</textarea></div>
                <label class="sm:col-span-2 flex items-center gap-2"><input type="checkbox" name="is_published_consent" value="1" @checked(old('is_published_consent')) class="rounded"><span>Izinkan karya ditampilkan di katalog publik setelah disetujui</span></label>
                <div class="sm:col-span-2 flex justify-end"><button class="px-5 py-2.5 rounded-xl bg-indigo-900 text-white font-bold">Simpan sebagai Draft</button></div>
            </form>
        </details>
        @else
        <div class="p-4 rounded-2xl bg-slate-100 text-slate-600 text-xs">Batas dua karya untuk kampus ini sudah tercapai (BR-03).</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($projects as $proj)
            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-5 flex flex-col justify-between">
                <div class="space-y-4">
                    <!-- Badges -->
                    <div class="flex items-center justify-between gap-2">
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase bg-slate-100 text-slate-800">
                            {{ $proj->category }}
                        </span>
                        
                        <!-- Status Kurasi -->
                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase
                            {{ $proj->status === 'lolos' ? 'bg-emerald-100 text-emerald-800' : ($proj->status === 'perlu_revisi' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800') }}">
                            Status: {{ strtoupper(str_replace('_', ' ', $proj->status)) }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 leading-snug">{{ $proj->title }}</h3>
                        <p class="text-xs text-cyan-700 font-semibold mt-1">Tim: {{ $proj->team?->name ?? 'Tim Pengusul' }}</p>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="font-bold text-slate-600 block text-[10px] uppercase">Solusi:</span>
                            <p class="text-slate-700 line-clamp-2 mt-0.5">{{ $proj->solution_description }}</p>
                        </div>

                        <!-- Status Publikasi Terpisah (BR-11 Acceptance) -->
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-[11px]">
                            <span class="text-slate-500 font-medium">Status Publikasi Katalog:</span>
                            <span class="font-bold uppercase {{ $proj->publication_status === 'terbit' ? 'text-emerald-600' : 'text-slate-600' }}">
                                <i class="fa-solid fa-circle text-[8px] mr-1"></i> {{ strtoupper(str_replace('_', ' ', $proj->publication_status)) }}
                            </span>
                        </div>

                        <!-- BR-09 Lock Status Indicator -->
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-[11px]">
                            <span class="text-slate-500 font-medium">Kunci Materi Kurator:</span>
                            <span class="font-bold {{ $proj->is_locked ? 'text-rose-600' : 'text-emerald-600' }}">
                                <i class="fa-solid {{ $proj->is_locked ? 'fa-lock text-rose-500' : 'fa-lock-open text-emerald-500' }} mr-1"></i>
                                {{ $proj->is_locked ? 'Terkunci (Pemeriksaan Kurator)' : 'Terbuka untuk Diedit' }}
                            </span>
                        </div>

                        @if($proj->curator_notes)
                        <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-200/70 text-amber-900 text-[11px]">
                            <strong>Catatan Kurator:</strong> {{ $proj->curator_notes }}
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2">
                    <a href="{{ route('project.detail', $proj->slug) }}" target="_blank" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 flex items-center gap-1">
                        <i class="fa-solid fa-eye text-xs"></i> Lihat Tampilan Publik
                    </a>

                    <div class="flex items-center gap-2">
                        @if(!$proj->is_locked)
                        <button type="button" @click="editingProject = {{ $proj->id }}" class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit Materi
                        </button>
                        <form action="{{ route('portal.projects.submit', $proj->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition" title="Kunci dan ajukan ke kurator">
                                Ajukan Kurasi
                            </button>
                        </form>
                        @else
                        <span class="text-[11px] text-slate-400 italic">Materi terkunci (BR-09)</span>
                        @endif
                    </div>
                </div>

                <!-- In-Line Edit Modal/Form -->
                <div x-show="editingProject === {{ $proj->id }}" x-cloak class="mt-4 pt-4 border-t border-slate-200 space-y-3">
                    <h4 class="font-bold text-slate-800 text-xs">Edit Materi Karya: {{ $proj->title }}</h4>
                    <form action="{{ route('portal.projects.update', $proj->id) }}" method="POST" class="space-y-3 text-xs">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Judul Karya</label>
                            <input type="text" name="title" value="{{ $proj->title }}" required class="w-full p-2 border rounded-xl bg-slate-50">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Bidang Inovasi</label>
                            <select name="category" class="w-full p-2 border rounded-xl bg-slate-50">
                                @foreach(['AI/IoT', 'Smart City', 'FinTech', 'EdTech', 'HealthTech', 'Creative Media'] as $c)
                                    <option value="{{ $c }}" {{ $proj->category === $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Permasalahan</label>
                            <textarea name="problem_statement" rows="2" required class="w-full p-2 border rounded-xl bg-slate-50">{{ $proj->problem_statement }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Pengguna Sasaran</label>
                            <input type="text" name="target_users" value="{{ $proj->target_users }}" required class="w-full p-2 border rounded-xl bg-slate-50">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Solusi & Fitur</label>
                            <textarea name="solution_description" rows="3" required class="w-full p-2 border rounded-xl bg-slate-50">{{ $proj->solution_description }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Tech Stack</label>
                                <input type="text" name="technology_stack" value="{{ $proj->technology_stack }}" class="w-full p-2 border rounded-xl bg-slate-50">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Tahap Kesiapan (TRL)</label>
                                <input type="text" name="readiness_level" value="{{ $proj->readiness_level }}" class="w-full p-2 border rounded-xl bg-slate-50">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Tautan Demo Interaktif</label>
                            <input type="url" name="demo_url" value="{{ $proj->demo_url }}" class="w-full p-2 border rounded-xl bg-slate-50" placeholder="https://...">
                        </div>

                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_published_consent" value="1" {{ $proj->is_published_consent ? 'checked' : '' }} class="rounded text-cyan-600">
                                <span class="font-bold text-slate-700">Setujui Publikasi Katalog Karya (Section 2)</span>
                            </label>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <button type="button" @click="editingProject = null" class="px-3 py-1.5 rounded-xl bg-slate-200 text-slate-700 font-bold">Batal</button>
                            <button type="submit" class="px-4 py-1.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold">Simpan Snapshot Versi</button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-2 bg-white rounded-3xl p-12 text-center border border-slate-200">
                <p class="text-slate-500 text-xs">{{ $roleSlug === 'tim-mahasiswa' ? 'Belum ada karya yang ditugaskan ke tim Anda. Minta PIC Kampus mendaftarkan karya dan memilih tim Anda.' : 'Belum ada karya yang terdaftar untuk kampus Anda.' }}</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- TAB 2: BOOTH & KEBUTUHAN TEKNIS (Section 4 & 10) -->
    <div x-show="activeTab === 'booth'" x-cloak class="space-y-6">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-store text-cyan-600"></i> Informasi Alokasi Booth Kampus
            </h3>

            @if($allocatedBooth)
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Kode Booth</span>
                    <span class="text-xl font-black text-indigo-900 mt-1 block">{{ $allocatedBooth->code }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Ukuran Standar</span>
                    <span class="text-base font-bold text-slate-800 mt-1 block">{{ $allocatedBooth->size }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Daya Terpasang</span>
                    <span class="text-base font-bold text-slate-800 mt-1 block">{{ $allocatedBooth->power_watt }} Watt</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 uppercase font-bold text-[10px] block">Zona Lokasi</span>
                    <span class="text-xs font-bold text-slate-800 mt-1 block">{{ $allocatedBooth->zone }}</span>
                </div>
            </div>
            @else
            <p class="text-xs text-slate-500 italic">Alokasi booth sedang dalam proses penetapan oleh panitia Divisi Venue & Teknis Sabuga.</p>
            @endif

            <div class="pt-4 border-t border-slate-100 space-y-3">
                <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Kebutuhan Perangkat & Daya Khusus</h4>
                <p class="text-xs text-slate-500">Jika tim membutuhkan daya listrik di atas 450W atau kabel LAN khusus untuk server demo, silakan ajukan tiket bantuan.</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs">
                    <i class="fa-solid fa-plug text-cyan-600"></i> Ajukan Permintaan Teknis Booth
                </a>
            </div>
        </div>
    </div>

    <!-- TAB 3: TAGIHAN & PEMBAYARAN (BR-06 & BR-07) -->
    <div x-show="activeTab === 'finance'" x-cloak class="space-y-6">
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-xs text-amber-900 flex items-start gap-3">
            <i class="fa-solid fa-shield-halved text-amber-600 text-base mt-0.5"></i>
            <div>
                <strong>Aturan Bisnis BR-06:</strong> Status pembayaran terpisah dari status partisipasi institusi. Unggah bukti bayar menunggu verifikasi resmi dari bendahara/keuangan panitia sebelum status tagihan berubah menjadi "Lunas".
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice text-emerald-600"></i> Tagihan Partisipasi Kampus
            </h3>

            @forelse($invoices as $inv)
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50 space-y-4 text-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <span class="font-black text-slate-900 text-base">{{ $inv->invoice_number }}</span>
                        <span class="text-slate-400 block text-[11px]">Jatuh Tempo: {{ $inv->due_date->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider
                            {{ $inv->status === 'paid' ? 'bg-emerald-100 text-emerald-800' : ($inv->status === 'partially_paid' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">
                            {{ strtoupper($inv->status) }}
                        </span>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-200/80 flex items-center justify-between font-bold">
                    <span class="text-slate-600">Total Tagihan:</span>
                    <span class="text-base text-slate-900">Rp {{ number_format($inv->total_amount, 0, ',', '.') }}</span>
                </div>

                <!-- Upload Bukti Bayar Form (BR-06) -->
                @if($inv->availableBalance() > 0)
                <div class="pt-4 border-t border-slate-200/80">
                    <h5 class="font-bold text-slate-800 mb-2">Konfirmasi / Unggah Bukti Transfer:</h5>
                    <form action="{{ route('portal.invoices.pay', $inv->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2">
                        @csrf
                        <input type="number" name="amount" value="{{ $inv->availableBalance() }}" required placeholder="Nominal Bayar" class="p-2 border rounded-xl bg-white text-xs">
                        <input type="text" name="bank_source" required placeholder="Bank Pengirim (cth: BNI)" class="p-2 border rounded-xl bg-white text-xs">
                        <input type="text" name="account_holder" required placeholder="Nama Pemilik Rekening" class="p-2 border rounded-xl bg-white text-xs">
                        <input type="file" name="receipt_file" accept=".jpg,.jpeg,.png,.pdf" required class="p-2 border rounded-xl bg-white text-xs">
                        <input type="hidden" name="payment_date" value="{{ date('Y-m-d') }}">
                        <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition">
                            <i class="fa-solid fa-upload mr-1"></i> Unggah Bukti
                        </button>
                    </form>
                </div>
                @endif

                <!-- Payment History -->
                @if($inv->payments->count() > 0)
                <div class="pt-3 border-t border-slate-200/80 text-[11px]">
                    <span class="font-bold text-slate-500 uppercase tracking-wider block mb-1">Riwayat Pembayaran:</span>
                    @foreach($inv->payments as $p)
                    <div class="flex items-center justify-between py-1 text-slate-600">
                        <span>{{ $p->payment_number }} &bull; Rp {{ number_format($p->amount, 0, ',', '.') }} &bull; {{ $p->bank_source }} ({{ $p->account_holder }})</span>
                        <span class="font-bold uppercase {{ $p->status === 'verified' ? 'text-emerald-600' : 'text-amber-600' }}">
                            {{ $p->status === 'verified' ? 'Terverifikasi' : 'Menunggu Verifikasi (BR-06)' }}
                        </span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @empty
            <p class="text-xs text-slate-500 italic">Tidak ada tagihan tertunda untuk kampus Anda.</p>
            @endforelse
        </div>
    </div>

    <!-- TAB 4: PERTEMUAN KOLABORASI & TINDAK LANJUT H+30 (Section 4, 9, 15) -->
    <div x-show="activeTab === 'meetings'" x-cloak class="space-y-6">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-handshake text-cyan-600"></i> Jadwal Pertemuan Meja Kolaborasi (BR-13)
            </h3>

            @forelse($meetings as $m)
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-0.5 rounded text-[10px] font-black uppercase bg-indigo-100 text-indigo-900">
                        {{ $m->table_number }}
                    </span>
                    <span class="text-slate-500 font-semibold">{{ $m->start_time->format('d M &bull; H:i') }} - {{ $m->end_time->format('H:i') }} WIB</span>
                </div>
                <h4 class="font-bold text-slate-900 text-sm">{{ $m->agenda_topic }}</h4>
                <p class="text-slate-600">Pihak Terkait: <strong>{{ $m->requester->name }}</strong> & <strong>{{ $m->target->name }}</strong></p>
                @if($m->discussion_notes)
                    <p class="text-slate-500 italic bg-white p-2.5 rounded-lg border border-slate-100">Catatan Hasil: {{ $m->discussion_notes }}</p>
                @endif
            </div>
            @empty
            <p class="text-xs text-slate-500 italic">Belum ada jadwal pertemuan kolaborasi terkonfirmasi.</p>
            @endforelse
        </div>

        <!-- H+30 Follow Ups -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-4">
            <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-calendar-check text-purple-600"></i> Monitoring Tindak Lanjut Pasca Event (H+30)
            </h3>

            @forelse($followUps as $fu)
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-900 text-sm">{{ $fu->title }}</span>
                    <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase {{ $fu->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ strtoupper($fu->status) }}
                    </span>
                </div>
                <p class="text-slate-600">{{ $fu->action_plan }}</p>
                <div class="text-[11px] text-slate-400 pt-1 flex items-center justify-between">
                    <span>Tenggat Waktu: <strong class="text-slate-700">{{ $fu->deadline_h30->format('d M Y') }}</strong></span>
                    @if($fu->isOverdue())
                        <span class="text-rose-600 font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Terlambat</span>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-xs text-slate-500 italic">Belum ada data tindak lanjut H+30 tercatat.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
