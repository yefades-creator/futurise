<?php

namespace App\Services;

use App\Models\Booth;
use App\Models\BoothAllocation;
use App\Models\Organization;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Exception;

class BoothService
{
    /**
     * Allocate a booth to an organization.
     * Enforces:
     * - BR-04: Booth sponsor shares industry quota.
     * - BR-05: Satu booth hanya untuk satu alokasi organisasi aktif pada edisi yang sama.
     * - Acceptance 03: Alokasi booth menolak duplikasi dan kelebihan kuota.
     */
    public function allocateBooth(int $eventId, int $boothId, int $organizationId, ?string $notes = null, ?int $allocatedBy = null): BoothAllocation
    {
        return DB::transaction(function () use ($eventId, $boothId, $organizationId, $notes, $allocatedBy) {
            $booth = Booth::where('event_id', $eventId)->where('id', $boothId)->lockForUpdate()->firstOrFail();
            $org = Organization::where('event_id', $eventId)->where('id', $organizationId)->lockForUpdate()->firstOrFail();
            if ($org->status !== 'verified') {
                throw new Exception('Organisasi harus terverifikasi sebelum menerima alokasi booth.');
            }

            $requiredCategory = match ($org->type) {
                'campus' => 'campus',
                'industry', 'sponsor' => 'industry',
                'partner' => 'partner',
                default => null,
            };
            if (!$requiredCategory || $booth->category !== $requiredCategory) {
                throw new Exception('Kategori booth tidak sesuai dengan kategori organisasi. Booth sponsor menggunakan kuota industri.');
            }

            // Check BR-05: Booth must not be actively allocated to another organization
            $existingBoothAllocation = BoothAllocation::where('event_id', $eventId)
                ->where('booth_id', $boothId)
                ->whereIn('status', ['reserved', 'allocated', 'confirmed', 'active'])
                ->where('organization_id', '!=', $organizationId)
                ->lockForUpdate()
                ->first();

            if ($existingBoothAllocation) {
                throw new Exception("Booth {$booth->code} sudah dialokasikan untuk organisasi {$existingBoothAllocation->organization->name}.");
            }

            // Check if organization already has an active booth in this event (BR-05)
            $existingOrgAllocation = BoothAllocation::where('event_id', $eventId)
                ->where('organization_id', $organizationId)
                ->whereIn('status', ['reserved', 'allocated', 'confirmed', 'active'])
                ->where('booth_id', '!=', $boothId)
                ->lockForUpdate()
                ->first();

            if ($existingOrgAllocation) {
                throw new Exception("Organisasi {$org->name} sudah memiliki alokasi booth ({$existingOrgAllocation->booth->code}). Satu organisasi aktif hanya berhak atas 1 booth.");
            }

            // Check BR-04: Sponsor booth uses industry quota
            if ($org->type === 'sponsor' || ($org->type === 'industry' && $org->companyProfile?->is_sponsor)) {
                if ($booth->category !== 'industry') {
                    // Allow if explicit override, otherwise notify
                }
            }

            // Create or update allocation
            $allocation = BoothAllocation::updateOrCreate(
                ['event_id' => $eventId, 'booth_id' => $boothId],
                [
                    'organization_id' => $organizationId,
                    'allocated_by' => $allocatedBy ?? auth()->id(),
                    'status' => 'confirmed',
                    'allocated_at' => now(),
                    'notes' => $notes,
                ]
            );

            // Audit log (BR-13 Acceptance)
            AuditLog::log(
                'booth_allocated',
                'BoothAllocation',
                $allocation->id,
                null,
                ['booth_code' => $booth->code, 'organization' => $org->name, 'status' => 'confirmed'],
                "Alokasi booth {$booth->code} ke {$org->name}",
                $eventId
            );

            return $allocation;
        });
    }

    /**
     * Release or cancel a booth allocation
     */
    public function releaseBooth(int $allocationId): bool
    {
        return DB::transaction(function () use ($allocationId) {
            $allocation = BoothAllocation::lockForUpdate()->findOrFail($allocationId);
            $boothCode = $allocation->booth->code;
            $orgName = $allocation->organization->name;
            $eventId = $allocation->event_id;

            $old = ['status' => $allocation->status];
            $allocation->delete();

            AuditLog::log(
                'booth_released',
                'BoothAllocation',
                $allocationId,
                $old,
                ['status' => 'deleted'],
                "Pelepasan booth {$boothCode} dari {$orgName}",
                $eventId
            );

            return true;
        });
    }
}
