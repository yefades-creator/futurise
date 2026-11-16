@extends('layouts.admin')

@section('title', 'Jejak Audit & Tata Kelola (Acceptance 13)')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-900 border border-slate-800 p-6 rounded-2xl">
        <div>
            <div class="flex items-center gap-2 text-sky-400 font-semibold text-xs tracking-wider uppercase mb-1">
                <i class="fa-solid fa-shield-halved"></i> Tata Kelola & Integritas Data (Acceptance 13)
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Jejak Audit Aktivitas Sistem</h1>
            <p class="text-sm text-slate-400 mt-1">
                Rekaman historis mutlak tak terhapus untuk setiap perubahan krusial: verifikasi pembayaran, alokasi/pembatalan booth, penguncian/pembukaan nilai juri, dan kurasi karya.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.export', 'audit') }}" class="px-4 py-2.5 bg-sky-600 hover:bg-sky-500 text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-sky-900/30">
                <i class="fa-solid fa-file-csv"></i> Unduh Log CSV
            </a>
        </div>
    </div>

    <!-- Alert / Notice Box -->
    <div class="bg-sky-950/40 border border-sky-800/60 rounded-xl p-4 flex items-start gap-3 text-xs text-sky-300">
        <i class="fa-solid fa-circle-info text-base mt-0.5 text-sky-400"></i>
        <div>
            <strong class="font-bold">Kriteria Keamanan & Akuntabilitas (Acceptance 13):</strong>
            Setiap aksi panitia/juri yang mempengaruhi integritas kompetisi (alokasi booth, approval kurasi, penguncian & permohonan pembukaan gembok nilai, serta verifikasi bukti bayar) wajib menyimpan metadata aktor, IP address, waktu, kondisi sebelum, dan kondisi sesudah.
        </div>
    </div>

    <!-- Audit Log Table -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="px-6 py-4 border-b border-slate-800 flex items-center justify-between">
            <h2 class="text-sm font-bold text-slate-200 uppercase tracking-wider flex items-center gap-2">
                <i class="fa-solid fa-list-check text-sky-400"></i> Riwayat Transaksi & Perubahan (Total: {{ $logs->total() }})
            </h2>
            <span class="text-xs text-slate-500">Menampilkan 25 entri per halaman</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-950/80 text-slate-400 border-b border-slate-800 font-semibold uppercase tracking-wider">
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4">Aktor / Pengguna</th>
                        <th class="py-3 px-4">Aksi</th>
                        <th class="py-3 px-4">Entitas Terkait</th>
                        <th class="py-3 px-4">Detail Perubahan (Sebelum &rarr; Sesudah)</th>
                        <th class="py-3 px-4">Alasan / Catatan</th>
                        <th class="py-3 px-4">IP / Info</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-slate-300 font-normal">
                    @forelse($logs as $log)
                    <tr class="hover:bg-slate-800/40 transition">
                        <!-- Waktu -->
                        <td class="py-3 px-4 whitespace-nowrap text-slate-400">
                            <div class="font-semibold text-slate-200">{{ $log->created_at->format('d M Y') }}</div>
                            <div class="text-[11px] font-mono text-slate-500">{{ $log->created_at->format('H:i:s') }} WIB</div>
                        </td>

                        <!-- Aktor -->
                        <td class="py-3 px-4">
                            @if($log->user)
                                <div class="font-semibold text-white">{{ $log->user->name }}</div>
                                <div class="text-[11px] text-slate-400 font-mono">{{ $log->user->email }}</div>
                            @else
                                <span class="italic text-slate-500">Sistem / Tamu</span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="py-3 px-4 whitespace-nowrap">
                            @php
                                $badgeClass = match(true) {
                                    str_contains($log->action, 'verify') || str_contains($log->action, 'payment') => 'bg-emerald-950/80 text-emerald-400 border-emerald-800',
                                    str_contains($log->action, 'unlock') => 'bg-rose-950/80 text-rose-400 border-rose-800',
                                    str_contains($log->action, 'lock') => 'bg-amber-950/80 text-amber-400 border-amber-800',
                                    str_contains($log->action, 'booth') => 'bg-cyan-950/80 text-cyan-400 border-cyan-800',
                                    str_contains($log->action, 'curate') || str_contains($log->action, 'project') => 'bg-purple-950/80 text-purple-400 border-purple-800',
                                    default => 'bg-slate-800 text-slate-300 border-slate-700'
                                };
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-mono font-bold border {{ $badgeClass }}">
                                {{ $log->action }}
                            </span>
                        </td>

                        <!-- Entitas -->
                        <td class="py-3 px-4 font-mono text-[11px]">
                            <div class="text-cyan-400 font-semibold">{{ class_basename($log->auditable_type ?? 'N/A') }}</div>
                            @if($log->auditable_id)
                                <div class="text-slate-500">ID: #{{ $log->auditable_id }}</div>
                            @endif
                        </td>

                        <!-- Detail Perubahan -->
                        <td class="py-3 px-4 max-w-xs">
                            @if($log->old_values || $log->new_values)
                                <div class="space-y-1 font-mono text-[11px]">
                                    @if($log->old_values)
                                        <div class="text-rose-400 bg-rose-950/30 px-2 py-1 rounded border border-rose-900/50 truncate" title="{{ json_encode($log->old_values) }}">
                                            <span class="font-bold text-[10px] text-rose-500 uppercase">Lama:</span> {{ json_encode($log->old_values) }}
                                        </div>
                                    @endif
                                    @if($log->new_values)
                                        <div class="text-emerald-400 bg-emerald-950/30 px-2 py-1 rounded border border-emerald-900/50 truncate" title="{{ json_encode($log->new_values) }}">
                                            <span class="font-bold text-[10px] text-emerald-500 uppercase">Baru:</span> {{ json_encode($log->new_values) }}
                                        </div>
                                    @endif
                                </div>
                            @else
                                <span class="text-slate-500 italic">-</span>
                            @endif
                        </td>

                        <!-- Alasan / Catatan -->
                        <td class="py-3 px-4 max-w-xs">
                            @if($log->reason)
                                <span class="text-slate-300 block truncate" title="{{ $log->reason }}">
                                    {{ $log->reason }}
                                </span>
                            @else
                                <span class="text-slate-500 italic">-</span>
                            @endif
                        </td>

                        <!-- IP & Agent -->
                        <td class="py-3 px-4 whitespace-nowrap font-mono text-[11px] text-slate-500">
                            <div>{{ $log->ip_address ?? '127.0.0.1' }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-500">
                            <i class="fa-solid fa-folder-open text-3xl mb-2 block"></i>
                            Belum ada riwayat audit log tercatat dalam basis data.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
        <div class="px-6 py-4 border-t border-slate-800 bg-slate-950">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
