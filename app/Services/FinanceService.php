<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\PaymentAllocation;
use App\Models\InKindContribution;
use App\Models\Expense;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Exception;

class FinanceService
{
    /**
     * Submit payment proof (BR-06: upload proof != verified)
     */
    public function submitPaymentProof(int $invoiceId, array $data): Payment
    {
        return DB::transaction(function () use ($invoiceId, $data) {
            $invoice = Invoice::lockForUpdate()->findOrFail($invoiceId);
            $availableBalance = $invoice->availableBalance();
            if ((float) $data['amount'] <= 0 || (float) $data['amount'] > $availableBalance) {
                throw new Exception('Nominal pembayaran melebihi sisa tagihan yang belum dibayar atau menunggu verifikasi.');
            }

            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'payment_number' => 'PAY/' . date('Y/m/') . strtoupper(bin2hex(random_bytes(3))),
                'amount' => $data['amount'],
                'payment_date' => $data['payment_date'] ?? now()->toDateString(),
                'payment_method' => $data['payment_method'] ?? 'bank_transfer',
                'bank_source' => $data['bank_source'] ?? null,
                'account_number' => $data['account_number'] ?? null,
                'account_holder' => $data['account_holder'] ?? null,
                'receipt_file' => $data['receipt_file'] ?? null,
                'status' => 'pending_verification', // BR-06: pending until verified by finance
            ]);

            return $payment;
        });
    }

    /**
     * Verify payment and allocate funds (BR-06 & BR-07)
     * - BR-07: Penerimaan uang dicatat sekali; jumlah alokasi tidak melebihi penerimaan
     */
    public function verifyPayment(int $paymentId, int $verifierUserId, array $allocations = []): Payment
    {
        return DB::transaction(function () use ($paymentId, $verifierUserId, $allocations) {
            $payment = Payment::lockForUpdate()->findOrFail($paymentId);

            if ($payment->status === 'verified') {
                throw new Exception("Pembayaran ini sudah pernah diverifikasi sebelumnya.");
            }

            // BR-07 validation: Sum of allocations must not exceed payment amount
            $totalAllocated = 0;
            $seenInvoiceItems = [];
            foreach ($allocations as $itemAlloc) {
                $amount = (float) ($itemAlloc['amount'] ?? 0);
                if ($amount <= 0) continue;
                $invoiceItemId = (int) ($itemAlloc['invoice_item_id'] ?? 0);
                $invoiceItem = InvoiceItem::where('invoice_id', $payment->invoice_id)->find($invoiceItemId);
                if (!$invoiceItem) {
                    throw new Exception('Item alokasi harus berasal dari rincian tagihan pembayaran ini.');
                }
                if (in_array($invoiceItemId, $seenInvoiceItems, true)) {
                    throw new Exception('Setiap rincian tagihan hanya boleh dipilih satu kali dalam alokasi pembayaran.');
                }
                $seenInvoiceItems[] = $invoiceItemId;
                $totalAllocated += $amount;
            }

            if ($totalAllocated > (float)$payment->amount) {
                throw new Exception("Jumlah alokasi (Rp " . number_format($totalAllocated, 0, ',', '.') . ") melebihi total penerimaan pembayaran (Rp " . number_format($payment->amount, 0, ',', '.') . ").");
            }

            $old = ['status' => $payment->status];

            // Mark as verified
            $payment->update([
                'status' => 'verified',
                'verified_by' => $verifierUserId,
                'verified_at' => now(),
            ]);

            // Save allocations
            if (!empty($allocations)) {
                foreach ($allocations as $alloc) {
                    PaymentAllocation::create([
                        'payment_id' => $payment->id,
                        'invoice_item_id' => $alloc['invoice_item_id'] ?? null,
                        'allocated_amount' => $alloc['amount'],
                        'notes' => $alloc['notes'] ?? 'Alokasi pembayaran resmi',
                    ]);
                }
            } else {
                // Default allocate to invoice
                PaymentAllocation::create([
                    'payment_id' => $payment->id,
                    'invoice_item_id' => $payment->invoice->items->first()?->id,
                    'allocated_amount' => $payment->amount,
                    'notes' => 'Alokasi penuh ke tagihan ' . $payment->invoice->invoice_number,
                ]);
            }

            // Update Invoice status
            $invoice = $payment->invoice;
            $totalPaid = $invoice->totalPaid();
            if ($totalPaid >= (float)$invoice->total_amount) {
                $invoice->update(['status' => 'paid']);
            } elseif ($totalPaid > 0) {
                $invoice->update(['status' => 'partially_paid']);
            }

            // Audit log (BR-13 Acceptance)
            AuditLog::log(
                'payment_verified',
                'Payment',
                $payment->id,
                $old,
                ['status' => 'verified', 'amount' => $payment->amount],
                "Verifikasi pembayaran nomor {$payment->payment_number} sebesar Rp " . number_format($payment->amount, 0, ',', '.'),
                $invoice->event_id
            );

            return $payment;
        });
    }

    /**
     * Financial summary reporting (BR-08: in-kind separated from cash)
     */
    public function getFinanceSummary(int $eventId): array
    {
        $totalInvoiced = Invoice::where('event_id', $eventId)->sum('total_amount');
        
        // Cash receipts (verified only)
        $cashReceived = Payment::whereHas('invoice', fn($q) => $q->where('event_id', $eventId))
            ->where('status', 'verified')
            ->sum('amount');

        // Cash pending verification
        $cashPending = Payment::whereHas('invoice', fn($q) => $q->where('event_id', $eventId))
            ->where('status', 'pending_verification')
            ->sum('amount');

        // Cash expenses
        $cashExpenses = Expense::where('event_id', $eventId)->sum('amount');
        $cashBalance = $cashReceived - $cashExpenses;

        // BR-08: In-Kind (Barang/Jasa) separated from cash
        $inKindPledged = InKindContribution::whereHas('agreement', fn($q) => $q->where('event_id', $eventId))
            ->where('delivery_status', 'pledged')
            ->sum('estimated_value');

        $inKindDelivered = InKindContribution::whereHas('agreement', fn($q) => $q->where('event_id', $eventId))
            ->whereIn('delivery_status', ['delivered', 'verified'])
            ->sum('estimated_value');

        return [
            'total_invoiced' => (float)$totalInvoiced,
            'cash_received' => (float)$cashReceived,
            'cash_pending' => (float)$cashPending,
            'cash_expenses' => (float)$cashExpenses,
            'cash_balance' => (float)$cashBalance,
            'in_kind_pledged' => (float)$inKindPledged,
            'in_kind_delivered' => (float)$inKindDelivered,
            'total_in_kind' => (float)($inKindPledged + $inKindDelivered),
        ];
    }
}
