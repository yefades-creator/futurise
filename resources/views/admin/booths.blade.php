@extends('layouts.admin', ['title' => 'Alokasi & Denah 45 Booth | Admin FUTURiSE'])

@section('content')
<div class="space-y-6" x-data="{ openAllocateModal: false, selectedBoothId: null, selectedBoothCode: '' }">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Divisi Venue & Teknis Sabuga</span>
            <h1 class="text-2xl font-black text-slate-900 mt-0.5">Alokasi & Denah 45 Booth Pameran</h1>
            <p class="text-xs text-slate-500 mt-1">Pengendalian kuota alokasi: 30 Kampus, 10 Industri, 5 Mitra. Menolak duplikasi (BR-04, BR-05, Acceptance 03).</p>
        </div>
    </div>

    <!-- Business Rules Card -->
    <div class="bg-teal-50 border border-teal-200 rounded-2xl p-4 text-xs text-teal-950 flex items-start gap-3">
        <i class="fa-solid fa-store text-teal-600 text-lg mt-0.5"></i>
        <div class="space-y-1">
            <strong>Penegakan Aturan Bisnis Booth:</strong>
            <br>&bull; <strong>BR-04:</strong> Booth sponsor menggunakan kuota industri yang sama (tidak menambah alokasi booth baru di luar 10 booth industri).
            <br>&bull; <strong>BR-05 & Acceptance 03:</strong> Satu booth hanya untuk satu alokasi organisasi aktif pada edisi yang sama. Sistem menolak alokasi ganda secara concurrency-safe.
            <br>&bull; <strong>BR-03:</strong> Dua karya dari satu kampus berbagi satu booth kampus yang sama.
        </div>
    </div>

    <!-- Grid of 45 Booths Visual Layout -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <h2 class="text-lg font-bold text-slate-900">Visual Grid 45 Booth Hall Utama Sabuga</h2>
            <div class="flex items-center gap-4 text-xs">
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-cyan-600 inline-block"></span> Kampus (30)</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-indigo-600 inline-block"></span> Industri (10)</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-teal-600 inline-block"></span> Mitra (5)</span>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-9 gap-3">
            @foreach($booths as $b)
            @php
                $isAllocated = $b->isAllocated();
                $alloc = $b->allocation;
                $isCampus = $b->category === 'campus';
                $isInd = $b->category === 'industry';
            @endphp
            <div class="p-3 rounded-2xl border transition text-center flex flex-col justify-between 
                {{ $isCampus ? 'bg-cyan-50/60 border-cyan-200' : ($isInd ? 'bg-indigo-50/60 border-indigo-200' : 'bg-teal-50/60 border-teal-200') }}">
                <div>
                    <span class="font-black text-sm block {{ $isCampus ? 'text-cyan-800' : ($isInd ? 'text-indigo-800' : 'text-teal-800') }}">{{ $b->code }}</span>
                    <span class="text-[9px] font-bold uppercase text-slate-400 block">{{ $b->category }}</span>
                    
                    <div class="my-2 min-h-[36px] flex items-center justify-center">
                        @if($isAllocated)
                            <span class="text-[10px] font-bold text-slate-800 line-clamp-2 leading-tight" title="{{ $alloc->organization->name }}">
                                {{ $alloc->organization->name }}
                            </span>
                        @else
                            <span class="text-[10px] font-semibold text-slate-400 italic">Kosong</span>
                        @endif
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-200/60 flex items-center justify-center gap-1">
                    @if(auth()->user()->hasRole(['super-admin', 'venue-teknis']) && $isAllocated)
                        <form action="{{ route('admin.booths.release', $alloc->id) }}" method="POST" onsubmit="return confirm('Lepaskan alokasi booth {{ $b->code }} dari {{ $alloc->organization->name }}?')">
                            @csrf
                            <button type="submit" class="text-[10px] text-rose-600 hover:text-rose-800 font-bold px-1.5 py-0.5 rounded bg-rose-50 border border-rose-200">
                                Lepas
                            </button>
                        </form>
                    @elseif(auth()->user()->hasRole(['super-admin', 'venue-teknis']))
                        <button type="button" @click="selectedBoothId = {{ $b->id }}; selectedBoothCode = '{{ $b->code }}'; openAllocateModal = true" class="text-[10px] text-cyan-700 hover:text-cyan-900 font-bold px-2 py-0.5 rounded bg-white border border-cyan-200 shadow-xs">
                            Alokasikan
                        </button>
                    @elseif($isAllocated)
                        <span class="text-[10px] text-slate-400">Alokasi aktif</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Alokasi Booth -->
    @if(auth()->user()->hasRole(['super-admin', 'venue-teknis']))
    <div x-show="openAllocateModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 backdrop-blur-xs p-4">
        <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl border border-slate-200 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm">
                    Alokasikan Booth <span x-text="selectedBoothCode" class="text-cyan-600"></span>
                </h3>
                <button type="button" @click="openAllocateModal = false" class="text-slate-400 hover:text-slate-600">&times;</button>
            </div>

            <form action="{{ route('admin.booths.allocate') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="booth_id" :value="selectedBoothId">

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pilih Institusi / Organisasi</label>
                    <select name="organization_id" required class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                        @foreach($unallocatedOrgs as $org)
                            <option value="{{ $org->id }}">{{ $org->name }} ({{ strtoupper($org->type) }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Catatan Alokasi (Opsional)</label>
                    <input type="text" name="notes" placeholder="Misal: Sesuai kesepakatan sponsorship / PIC kampus" class="w-full p-2.5 border rounded-xl bg-slate-50 text-xs">
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                    <button type="button" @click="openAllocateModal = false" class="px-4 py-2 rounded-xl bg-slate-200 text-slate-700 font-bold text-xs">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs">Simpan Alokasi</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
