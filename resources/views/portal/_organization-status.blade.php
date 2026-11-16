@if(isset($organization) && $organization && $organization->status !== 'verified')
<div class="rounded-2xl border {{ $organization->status === 'rejected' ? 'border-rose-200 bg-rose-50 text-rose-900' : 'border-amber-200 bg-amber-50 text-amber-950' }} p-4 text-xs">
    <strong>Status organisasi: {{ strtoupper(str_replace('_', ' ', $organization->status)) }}</strong>
    <p class="mt-1">{{ $organization->verification_notes ?: 'Panitia sedang meninjau pendaftaran organisasi Anda.' }} Jika perlu perbaikan data, hubungi Sekretariat.</p>
</div>
@endif
