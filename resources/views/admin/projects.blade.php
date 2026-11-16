@extends('layouts.admin', ['title' => 'Kurasi & Manajemen Karya Mahasiswa | Admin FUTURiSE'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Divisi Program & Kurasi</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Manajemen Kurasi & Publikasi Karya Mahasiswa</h1>
            <p class="text-xs text-slate-500 mt-1">Pemeriksaan materi, penguncian saat kurasi (BR-09), persetujuan publikasi terpisah (BR-11), dan penetapan 10 finalis pitching.</p>
        </div>
    </div>

    @if(auth()->user()->hasRole(['super-admin', 'publikasi']))
    <section class="bg-white rounded-3xl border border-cyan-200 shadow-sm overflow-hidden">
        <details @if(session('success') || $errors->any()) open @endif>
            <summary class="cursor-pointer list-none p-6 flex flex-wrap items-center justify-between gap-3 bg-cyan-50/60">
                <span><strong class="text-slate-900"><i class="fa-solid fa-newspaper text-cyan-700 mr-1"></i> CMS Berita & Publikasi</strong><span class="block text-xs text-slate-500 mt-1">Buat berita berisi gambar/dokumen; berita terbit tampil di halaman publik /berita.</span></span>
                <span class="px-4 py-2 rounded-xl bg-cyan-800 text-white text-xs font-bold"><i class="fa-solid fa-plus mr-1"></i> Kelola Berita</span>
            </summary>
            <div class="p-6 space-y-6 border-t border-slate-100">
                @if(session('success'))<div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs">{{ session('success') }}</div>@endif
                @if($errors->any())<div class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs"><strong>Periksa kembali:</strong><ul class="list-disc ml-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 rounded-2xl bg-slate-50 border border-slate-200 text-xs">
                    @csrf
                    <h3 class="sm:col-span-2 text-sm font-black text-slate-900">Buat Posting Berita</h3>
                    <div><label class="block font-bold text-slate-600 mb-1">JUDUL</label><input name="title" value="{{ old('title') }}" required maxlength="255" class="w-full p-2.5 border rounded-xl"></div>
                    <div><label class="block font-bold text-slate-600 mb-1">KATEGORI</label><select name="category" required class="w-full p-2.5 border rounded-xl bg-white">@foreach($newsCategories as $category)<option value="{{ $category }}" @selected(old('category', 'CMS') === $category)>{{ $category }}</option>@endforeach</select></div>
                    <div class="sm:col-span-2"><label class="block font-bold text-slate-600 mb-1">RINGKASAN</label><textarea name="excerpt" rows="2" maxlength="1000" class="w-full p-2.5 border rounded-xl">{{ old('excerpt') }}</textarea></div>
                    <div class="sm:col-span-2"><label class="block font-bold text-slate-600 mb-1">ISI BERITA</label><textarea name="content" rows="7" required maxlength="50000" class="w-full p-2.5 border rounded-xl">{{ old('content') }}</textarea></div>
                    <div><label class="block font-bold text-slate-600 mb-1">GAMBAR SAMPUL (JPG/PNG/WEBP, MAKS. 5 MB)</label><input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp" class="w-full p-2 border rounded-xl bg-white"></div>
                    <div><label class="block font-bold text-slate-600 mb-1">DOKUMEN LAMPIRAN (PDF/DOC/XLS/PPT, MAKS. 20 MB)</label><input type="file" name="document" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="w-full p-2 border rounded-xl bg-white"></div>
                    <div><label class="block font-bold text-slate-600 mb-1">WAKTU PUBLIKASI (OPSIONAL)</label><input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full p-2.5 border rounded-xl"></div>
                    <label class="flex items-center gap-2 self-end p-2"><input type="checkbox" name="is_published" value="1" @checked(old('is_published')) class="rounded"><span class="font-bold text-slate-700">Terbitkan ke halaman publik</span></label>
                    <div class="sm:col-span-2 flex justify-end"><button class="px-5 py-2.5 rounded-xl bg-cyan-800 text-white font-bold">Simpan Berita</button></div>
                </form>

                <div class="space-y-3">
                    <h3 class="text-sm font-black text-slate-900">Posting Berita ({{ $newsItems->count() }})</h3>
                    @forelse($newsItems as $newsItem)
                    <details class="border border-slate-200 rounded-2xl overflow-hidden">
                        <summary class="cursor-pointer list-none p-4 flex flex-wrap justify-between items-center gap-2 bg-white"><span><strong>{{ $newsItem->title }}</strong><span class="block text-[11px] text-slate-500">{{ $newsItem->category }} · {{ $newsItem->is_published ? 'Terbit' : 'Draft' }}</span></span><span class="text-xs font-bold text-cyan-700">Edit</span></summary>
                        <div class="p-4 border-t border-slate-100 space-y-3">
                            <form action="{{ route('admin.news.update', $newsItem->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                @csrf @method('PUT')
                                <div><label class="block font-bold text-slate-600 mb-1">JUDUL</label><input name="title" value="{{ $newsItem->title }}" required maxlength="255" class="w-full p-2.5 border rounded-xl"></div>
                                <div><label class="block font-bold text-slate-600 mb-1">KATEGORI</label><select name="category" required class="w-full p-2.5 border rounded-xl bg-white">@foreach($newsCategories as $category)<option value="{{ $category }}" @selected($newsItem->category === $category)>{{ $category }}</option>@endforeach</select></div>
                                <div class="sm:col-span-2"><label class="block font-bold text-slate-600 mb-1">RINGKASAN</label><textarea name="excerpt" rows="2" maxlength="1000" class="w-full p-2.5 border rounded-xl">{{ $newsItem->excerpt }}</textarea></div>
                                <div class="sm:col-span-2"><label class="block font-bold text-slate-600 mb-1">ISI BERITA</label><textarea name="content" rows="6" required maxlength="50000" class="w-full p-2.5 border rounded-xl">{{ $newsItem->content }}</textarea></div>
                                <div><label class="block font-bold text-slate-600 mb-1">GANTI GAMBAR SAMPUL</label><input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp" class="w-full p-2 border rounded-xl bg-white">@if($newsItem->cover_image)<span class="text-slate-500 block mt-1">Gambar saat ini tersimpan</span>@endif</div>
                                <div><label class="block font-bold text-slate-600 mb-1">GANTI DOKUMEN</label><input type="file" name="document" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="w-full p-2 border rounded-xl bg-white">@if($newsItem->document_name)<span class="text-slate-500 block mt-1">{{ $newsItem->document_name }}</span>@endif</div>
                                <div><label class="block font-bold text-slate-600 mb-1">WAKTU PUBLIKASI</label><input type="datetime-local" name="published_at" value="{{ $newsItem->published_at?->format('Y-m-d\\TH:i') }}" class="w-full p-2.5 border rounded-xl"></div>
                                <label class="flex items-center gap-2 self-end p-2"><input type="checkbox" name="is_published" value="1" @checked($newsItem->is_published) class="rounded"><span class="font-bold">Terbit</span></label>
                                <div class="sm:col-span-2 flex justify-end"><button class="px-4 py-2 rounded-xl bg-cyan-800 text-white font-bold">Simpan Perubahan</button></div>
                            </form>
                            <form action="{{ route('admin.news.destroy', $newsItem->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini beserta gambar dan dokumennya?')" class="flex justify-between items-center border-t pt-3">@csrf @method('DELETE')<a href="{{ route('news.detail', $newsItem->slug) }}" target="_blank" class="text-cyan-700 font-bold text-xs">Lihat halaman publik</a><button class="px-3 py-2 rounded-xl bg-rose-50 text-rose-700 font-bold text-xs">Hapus Berita</button></form>
                        </div>
                    </details>
                    @empty
                    <p class="p-4 rounded-xl bg-slate-50 text-xs text-slate-500">Belum ada posting berita.</p>
                    @endforelse
                </div>
            </div>
        </details>
    </section>
    @endif

    <!-- Rule Alert -->
    <div class="bg-indigo-50 border border-indigo-200 rounded-2xl p-4 text-xs text-indigo-950 space-y-1">
        <p><strong>Ketentuan Alur Proses (Section 6 & BR-11 Acceptance):</strong></p>
        <p class="text-indigo-800">Status karya (Draft, Diajukan, Dalam Pemeriksaan, Perlu Revisi, Lolos, Tidak Lolos) terpisah dari Status Publikasi (Belum Disetujui, Siap Publikasi, Terbit, Diarsipkan). <em>Lolos kurasi tidak otomatis berarti boleh dipublikasikan.</em> Materi yang belum berizin tidak tampil pada website publik.</p>
    </div>

    <!-- Filters Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-wrap items-center justify-between gap-3 text-xs">
        <form action="{{ route('admin.projects') }}" method="GET" class="flex flex-wrap items-center gap-2 flex-grow">
            <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul / kampus..." class="px-3 py-1.5 border rounded-xl bg-slate-50 text-xs w-56">
            
            <select name="status" class="px-3 py-1.5 border rounded-xl bg-slate-50 text-xs">
                <option value="">Semua Status Kurasi</option>
                <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="diajukan" {{ $status === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                <option value="dalam_pemeriksaan" {{ $status === 'dalam_pemeriksaan' ? 'selected' : '' }}>Dalam Pemeriksaan</option>
                <option value="perlu_revisi" {{ $status === 'perlu_revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                <option value="lolos" {{ $status === 'lolos' ? 'selected' : '' }}>Lolos</option>
                <option value="tidak_lolos" {{ $status === 'tidak_lolos' ? 'selected' : '' }}>Tidak Lolos</option>
            </select>

            <select name="pub_status" class="px-3 py-1.5 border rounded-xl bg-slate-50 text-xs">
                <option value="">Semua Status Publikasi</option>
                <option value="belum_disetujui" {{ $pubStatus === 'belum_disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                <option value="siap_publikasi" {{ $pubStatus === 'siap_publikasi' ? 'selected' : '' }}>Siap Publikasi</option>
                <option value="terbit" {{ $pubStatus === 'terbit' ? 'selected' : '' }}>Terbit</option>
                <option value="diarsipkan" {{ $pubStatus === 'diarsipkan' ? 'selected' : '' }}>Diarsipkan</option>
            </select>

            <button type="submit" class="px-4 py-1.5 rounded-xl bg-slate-900 text-white font-bold">Filter</button>
        </form>

        <a href="{{ route('admin.export', 'projects') }}" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold flex items-center gap-1.5">
            <i class="fa-solid fa-file-csv text-cyan-600"></i> Ekspor CSV
        </a>
    </div>

    <!-- Table of 60 Projects -->
    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm" x-data="{ curatingId: null }">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4">Judul Karya & Institusi</th>
                        <th class="py-3 px-4">Kategori & Booth</th>
                        <th class="py-3 px-4">Status Kurasi</th>
                        <th class="py-3 px-4">Kunci Materi (BR-09)</th>
                        <th class="py-3 px-4">Status Publikasi (BR-11)</th>
                        <th class="py-3 px-4">Pitching</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($projects as $p)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3 px-4 max-w-xs">
                            <span class="font-bold text-slate-900 block truncate">{{ $p->title }}</span>
                            <span class="text-[11px] text-cyan-700 font-medium block truncate">{{ $p->organization->name }} ({{ $p->team?->name ?? 'Tim' }})</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-slate-800">{{ $p->category }}</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Booth: {{ $p->booth?->code ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase
                                {{ $p->status === 'lolos' ? 'bg-emerald-100 text-emerald-800' : ($p->status === 'perlu_revisi' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ strtoupper(str_replace('_', ' ', $p->status)) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold {{ $p->is_locked ? 'text-rose-600' : 'text-emerald-600' }}">
                                <i class="fa-solid {{ $p->is_locked ? 'fa-lock' : 'fa-lock-open' }} mr-1"></i>
                                {{ $p->is_locked ? 'Terkunci' : 'Terbuka' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold uppercase text-[10px] {{ $p->publication_status === 'terbit' ? 'text-emerald-600' : 'text-slate-500' }}">
                                <i class="fa-solid fa-circle text-[7px] mr-1"></i> {{ strtoupper(str_replace('_', ' ', $p->publication_status)) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            @if($p->is_pitch_finalist)
                                <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-bold text-[10px]">
                                    Finalis #{{ $p->pitch_order }}
                                </span>
                            @else
                                <span class="text-slate-400 italic text-[11px]">Tidak</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right">
                            <button type="button" @click="curatingId = (curatingId === {{ $p->id }} ? null : {{ $p->id }})" class="px-3 py-1 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition">
                                {{ auth()->user()->hasRole(['super-admin', 'program-kurasi']) ? 'Kurasi Karya' : 'Atur Publikasi' }}
                            </button>
                        </td>
                    </tr>

                    <!-- Curate Inline Row -->
                    <tr x-show="curatingId === {{ $p->id }}" x-cloak class="bg-indigo-50/50">
                        <td colspan="7" class="p-6">
                            @if(auth()->user()->hasRole(['super-admin', 'program-kurasi']))
                            <form action="{{ route('admin.projects.curate', $p->id) }}" method="POST" class="space-y-4 max-w-3xl mx-auto bg-white p-6 rounded-2xl border border-indigo-100 shadow-sm">
                                @csrf
                                <h4 class="font-bold text-slate-800 text-xs uppercase border-b border-slate-100 pb-2">
                                    Pemeriksaan & Kurasi: {{ $p->title }}
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-bold text-slate-700 mb-1">Status Kelulusan Kurasi</label>
                                        <select name="status" class="w-full p-2 border rounded-xl bg-slate-50 text-xs">
                                            <option value="draft" {{ $p->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="diajukan" {{ $p->status === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                            <option value="dalam_pemeriksaan" {{ $p->status === 'dalam_pemeriksaan' ? 'selected' : '' }}>Dalam Pemeriksaan</option>
                                            <option value="perlu_revisi" {{ $p->status === 'perlu_revisi' ? 'selected' : '' }}>Perlu Revisi (Buka Akses Tim)</option>
                                            <option value="lolos" {{ $p->status === 'lolos' ? 'selected' : '' }}>Lolos Seleksi Festival</option>
                                            <option value="tidak_lolos" {{ $p->status === 'tidak_lolos' ? 'selected' : '' }}>Tidak Lolos</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-[11px] text-slate-500">Penguncian mengikuti status: Perlu Revisi membuka materi; status pemeriksaan dan keputusan menguncinya.</p>
                                    </div>

                                    <div class="flex items-center gap-3 pt-6">
                                        <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                                            <input type="checkbox" name="is_pitch_finalist" value="1" {{ $p->is_pitch_finalist ? 'checked' : '' }} class="rounded text-amber-500">
                                            <span>Tetapkan sebagai Finalis Pitching</span>
                                        </label>
                                        <input type="number" name="pitch_order" value="{{ $p->pitch_order }}" placeholder="Urutan (1-10)" class="w-24 p-1.5 border rounded-lg text-xs bg-slate-50">
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-bold text-slate-700 mb-1">Catatan Kurator / Arahan Revisi</label>
                                    <textarea name="curator_notes" rows="2" class="w-full p-2 border rounded-xl bg-slate-50 text-xs" placeholder="Catatan perbaikan teknis atau materi...">{{ $p->curator_notes }}</textarea>
                                </div>

                                <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                                    <button type="button" @click="curatingId = null" class="px-3 py-1.5 rounded-xl bg-slate-200 text-slate-700 font-bold">Tutup</button>
                                    <button type="submit" class="px-4 py-1.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold">Simpan Keputusan Kurator</button>
                                </div>
                            </form>
                            @endif

                            @if(auth()->user()->hasRole(['super-admin', 'publikasi']))
                            <form action="{{ route('admin.projects.publication', $p->id) }}" method="POST" class="space-y-4 max-w-3xl mx-auto mt-4 bg-white p-6 rounded-2xl border border-cyan-100 shadow-sm">
                                @csrf
                                <h4 class="font-bold text-slate-800 text-xs uppercase border-b border-slate-100 pb-2">Persetujuan Publikasi Terpisah (BR-15)</h4>
                                <label class="block text-xs font-bold text-slate-700">Status Publikasi
                                    <select name="publication_status" class="mt-1 w-full p-2 border rounded-xl bg-slate-50" required>
                                        @foreach(['belum_disetujui' => 'Belum Disetujui', 'siap_publikasi' => 'Siap Publikasi', 'terbit' => 'Terbit di Katalog Publik', 'diarsipkan' => 'Diarsipkan'] as $value => $label)
                                            <option value="{{ $value }}" {{ $p->publication_status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <textarea name="remarks" rows="2" maxlength="1000" class="w-full p-2 border rounded-xl bg-slate-50 text-xs" placeholder="Catatan persetujuan / arsip (opsional)"></textarea>
                                <p class="text-[11px] text-slate-500">Status Terbit hanya dapat dipilih jika karya lolos kurasi dan pemilik telah memberi izin publikasi.</p>
                                <div class="flex justify-end"><button type="submit" class="px-4 py-1.5 rounded-xl bg-cyan-700 text-white font-bold">Simpan Status Publikasi</button></div>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-500">Tidak ada karya yang sesuai dengan filter.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
