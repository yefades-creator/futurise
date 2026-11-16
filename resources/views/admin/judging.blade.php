@extends('layouts.admin', ['title' => 'Rekap Penjurian & Hasil Pemenang | Admin FUTURiSE'])

@section('content')
<div class="space-y-6" x-data="{ unlockModal: false, selectedUnlockUrl: null }">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-purple-600 uppercase tracking-widest">Divisi Program, Kurasi & Juri</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Rekapitulasi Penjurian & Pengesahan Hasil (BR-15)</h1>
            <p class="text-xs text-slate-500 mt-1">Standar 5 indikator (Section 13), pemisahan People's Choice (BR-14), dan sakelar publikasi hasil resmi.</p>
        </div>

        <!-- Publish Toggle Button (BR-15 & Acceptance 09) -->
        @if(auth()->user()->hasRole(['super-admin', 'ketua-pelaksana']))<form action="{{ route('admin.judging.publish-toggle') }}" method="POST">
            @csrf
            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengubah status publikasi hasil pemenang?')"
                class="px-5 py-2.5 rounded-xl font-black text-xs uppercase tracking-wider flex items-center gap-2 shadow-md transition
                {{ $event->is_results_published ? 'bg-amber-600 hover:bg-amber-700 text-white' : 'bg-emerald-600 hover:bg-emerald-700 text-white' }}">
                <i class="fa-solid {{ $event->is_results_published ? 'fa-eye-slash' : 'fa-bullhorn' }}"></i>
                {{ $event->is_results_published ? 'Tarik Kembali Publikasi Juara' : 'Sahkan & Rilis Hasil Juara ke Publik (BR-15)' }}
            </button>
        </form>
        @endif
    </div>

    <!-- Rule Alert (BR-14 & BR-15) -->
    <div class="bg-purple-50 border border-purple-200 rounded-2xl p-4 text-xs text-purple-950 space-y-1">
        <p><strong>Penegakan Aturan Bisnis Penjurian:</strong></p>
        <p class="text-purple-900">&bull; <strong>BR-14:</strong> Nilai dewan juri dan suara favorit publik (People's Choice Award) dihitung secara terpisah.</p>
        <p class="text-purple-900">&bull; <strong>BR-15 & Acceptance 09:</strong> Hasil penilaian dewan juri dan penetapan pemenang tidak otomatis terbit sebelum disahkan secara resmi oleh panitia berwenang.</p>
        <p class="text-purple-900">&bull; <strong>Section 13:</strong> Pembukaan ulang nilai terkunci memerlukan alasan tertulis dan tercatat dalam jejak audit.</p>
    </div>

    <section class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
        <div>
            <h2 class="font-black text-slate-900 flex items-center gap-2"><i class="fa-solid fa-user-plus text-purple-600"></i> Penugasan Juri</h2>
            <p class="text-xs text-slate-500 mt-1">Pilih akun berperan Juri dan karya yang sudah lolos kurasi. Juri akan melihat penugasan ini di `/juri`.</p>
        </div>

        @if(auth()->user()->hasRole(['super-admin', 'program-kurasi']))
        <form action="{{ route('admin.judging.assignments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-[1fr_1fr_auto] gap-3 items-end p-4 rounded-2xl bg-slate-50 border border-slate-200">
            @csrf
            <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Juri</label>
                <select name="judge_id" required class="w-full p-2.5 rounded-xl border border-slate-200 bg-white text-sm">
                    <option value="">Pilih juri</option>
                    @foreach($judges as $judge)<option value="{{ $judge->id }}">{{ $judge->name }} — {{ $judge->email }}</option>@endforeach
                </select>
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Karya (lolos kurasi)</label>
                <select name="project_id" required class="w-full p-2.5 rounded-xl border border-slate-200 bg-white text-sm">
                    <option value="">Pilih karya</option>
                    @foreach($assignableProjects as $project)<option value="{{ $project->id }}">{{ $project->title }} — {{ $project->organization->name }}</option>@endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2.5 rounded-xl bg-purple-700 hover:bg-purple-800 text-white font-bold text-sm"><i class="fa-solid fa-link mr-1"></i> Tugaskan</button>
            @if($judges->isEmpty() || $assignableProjects->isEmpty())
            <p class="md:col-span-3 text-xs text-amber-800">{{ $judges->isEmpty() ? 'Belum ada akun aktif dengan peran Juri.' : 'Belum ada karya berstatus lolos kurasi yang dapat ditugaskan.' }}</p>
            @endif
        </form>
        @endif

        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px]"><tr><th class="px-4 py-3">Juri</th><th class="px-4 py-3">Karya</th><th class="px-4 py-3">Status Penugasan</th><th class="px-4 py-3">Status Nilai</th></tr></thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($judgeAssignments as $assignment)
                    <tr>
                        <td class="px-4 py-3 font-semibold text-slate-800">{{ $assignment->judge->name }}</td>
                        <td class="px-4 py-3"><span class="font-semibold text-slate-800">{{ $assignment->project->title }}</span><span class="block text-slate-500">{{ $assignment->project->organization->name }}</span></td>
                        <td class="px-4 py-3"><span class="px-2 py-1 rounded-full font-bold {{ $assignment->has_conflict_of_interest ? 'bg-rose-100 text-rose-800' : ($assignment->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700') }}">{{ $assignment->has_conflict_of_interest ? 'Konflik kepentingan' : ($assignment->is_active ? 'Aktif' : 'Nonaktif') }}</span></td>
                        <td class="px-4 py-3 text-slate-600">{{ $assignment->assessment?->status === 'locked' ? 'Terkunci' : ($assignment->assessment ? 'Draf' : 'Belum dinilai') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada penugasan juri untuk edisi acara aktif.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- 1. Papan Peringkat Dewan Juri vs People's Choice (BR-14) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Klasemen Dewan Juri -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-trophy text-purple-600"></i> Peringkat Resmi Dewan Juri (Bobot 100 Poin)
                </h3>
                <span class="text-[10px] font-bold text-purple-800 bg-purple-100 px-2 py-0.5 rounded uppercase">Rata-rata Terkunci</span>
            </div>

            <div class="space-y-2.5 text-xs">
                @forelse($leaderboard['jury_rankings'] as $idx => $jr)
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl {{ $idx == 0 ? 'bg-amber-400 text-slate-950 font-black' : ($idx == 1 ? 'bg-slate-300 text-slate-900 font-bold' : ($idx == 2 ? 'bg-amber-700 text-white font-bold' : 'bg-slate-200 text-slate-700 font-bold')) }} flex items-center justify-center text-xs flex-shrink-0">
                            #{{ $idx + 1 }}
                        </span>
                        <div>
                            <span class="font-bold text-slate-900 block">{{ $jr->title }}</span>
                            <span class="text-[11px] text-cyan-700">{{ $jr->organization->name }} &bull; Booth {{ $jr->booth?->code ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="font-black text-purple-700 text-base block">{{ number_format($jr->assessments_avg_final_score, 2) }}</span>
                        <span class="text-[9px] text-slate-400 font-semibold">{{ $jr->assessments_count }} Juri Menilai</span>
                    </div>
                </div>
                @empty
                <p class="text-xs text-slate-400 italic py-2">Belum ada nilai final yang terkunci dari dewan juri.</p>
                @endforelse
            </div>
        </div>

        <!-- People's Choice Award (BR-14: Dihitung Terpisah) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-award text-amber-500"></i> People's Choice Award (Suara Publik - BR-14)
                </h3>
                <span class="text-[10px] font-bold text-amber-800 bg-amber-100 px-2 py-0.5 rounded uppercase">Voting Pengunjung</span>
            </div>

            <div class="space-y-2.5 text-xs">
                @forelse($leaderboard['peoples_choice'] as $idx => $pc)
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-amber-100 text-amber-900 font-bold flex items-center justify-center text-xs flex-shrink-0">
                            {{ $idx + 1 }}
                        </span>
                        <div>
                            <span class="font-bold text-slate-900 block">{{ $pc->title }}</span>
                            <span class="text-[11px] text-cyan-700">{{ $pc->organization->name }}</span>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="font-black text-amber-600 text-base block">{{ $pc->votes_count }}</span>
                        <span class="text-[9px] text-slate-400 uppercase font-semibold">Suara Sah</span>
                    </div>
                </div>
                @empty
                <p class="text-xs text-slate-400 italic py-2">Belum ada suara masuk dari pengunjung.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- 2. Lembar Nilai Juri & Opsi Buka Kunci dengan Audit (Section 13) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
        <h3 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-gavel text-indigo-600"></i> Rincian Penilaian per Juri & Kontrol Kunci Nilai
        </h3>

        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-3 px-4">Nama Dewan Juri</th>
                        <th class="py-3 px-4">Karya Mahasiswa</th>
                        <th class="py-3 px-4">Nilai Akhir</th>
                        <th class="py-3 px-4">Status Kunci</th>
                        <th class="py-3 px-4">Waktu Kunci</th>
                        <th class="py-3 px-4 text-right">Aksi Audit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($assessments as $asm)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-slate-800">{{ $asm->judge->name }}</td>
                        <td class="py-3 px-4 text-slate-700 max-w-xs truncate">{{ $asm->project->title }}</td>
                        <td class="py-3 px-4 font-black text-purple-700 text-sm">{{ $asm->final_score }} / 100</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $asm->status === 'locked' ? 'bg-purple-100 text-purple-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $asm->status === 'locked' ? 'Terkunci' : 'Draf' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-500">{{ $asm->locked_at ? $asm->locked_at->format('d M H:i') : '-' }}</td>
                        <td class="py-3 px-4 text-right">
                            @if($asm->status === 'locked' && auth()->user()->hasRole('super-admin'))
                            <button type="button" data-unlock-url="{{ route('admin.judging.unlock', $asm->id) }}" @click="selectedUnlockUrl = $el.dataset.unlockUrl; unlockModal = true" class="px-3 py-1 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-[11px] transition">
                                <i class="fa-solid fa-unlock mr-1"></i> Buka Kunci (Audit)
                            </button>
                            @elseif($asm->status === 'locked')
                            <span class="text-slate-400 italic text-[11px]">Nilai terkunci</span>
                            @else
                            <span class="text-slate-400 italic text-[11px]">Belum dikunci</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Unlock Score (Section 13 & Acceptance 13) -->
    @if(auth()->user()->hasRole('super-admin'))<div x-show="unlockModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 backdrop-blur-xs p-4">
        <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl border border-slate-200 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm">Pembukaan Kunci Nilai Juri</h3>
                <button type="button" @click="unlockModal = false" class="text-slate-400 hover:text-slate-600">&times;</button>
            </div>

            <p class="text-xs text-slate-600 leading-relaxed">
                Sesuai Section 13, pembukaan ulang nilai yang telah dikunci harus menyertakan alasan resmi yang disahkan panitia dan disimpan dalam log audit permanen.
            </p>

            <form x-bind:action="selectedUnlockUrl" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Alasan Pembukaan Kunci</label>
                    <textarea name="reason" rows="3" required minlength="8" maxlength="1000" placeholder="Tuliskan alasan resmi pembukaan kembali penilaian (minimal 8 karakter)..."
                        class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs focus:ring-2 focus:ring-purple-500"></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                    <button type="button" @click="unlockModal = false" class="px-4 py-2 rounded-xl bg-slate-200 text-slate-700 font-bold text-xs">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs">Buka Kunci & Catat Audit</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
