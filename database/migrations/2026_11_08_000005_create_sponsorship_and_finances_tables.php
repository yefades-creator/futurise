<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsorship_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Platinum, Gold, Silver, Bronze, Media Partner
            $table->string('slug');
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('quota')->default(5);
            $table->text('benefits_summary')->nullable();
            $table->boolean('includes_booth')->default(false); // BR-04: booth sponsor shares industry quota
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['event_id', 'slug']);
        });

        Schema::create('sponsorship_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->nullable()->constrained('sponsorship_packages')->nullOnDelete();
            $table->string('agreement_number')->unique();
            $table->decimal('agreed_amount', 15, 2)->default(0);
            $table->enum('support_type', ['cash', 'in_kind', 'hybrid'])->default('cash'); // BR-08
            $table->text('in_kind_description')->nullable();
            $table->enum('status', ['draft', 'offered', 'agreed', 'signed', 'cancelled'])->default('draft');
            $table->dateTime('agreed_at')->nullable();
            $table->string('contract_document')->nullable();
            $table->timestamps();
        });

        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('sponsorship_packages')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('required_proof_type')->default('photo'); // photo, document, link, none
            $table->timestamps();
        });

        Schema::create('benefit_fulfillments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agreement_id')->constrained('sponsorship_agreements')->cascadeOnDelete();
            $table->foreignId('benefit_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'in_progress', 'fulfilled'])->default('pending');
            $table->string('proof_file')->nullable();
            $table->string('proof_url')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('verified_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->date('due_date');
            // BR-06: Status pembayaran terpisah dari partisipasi
            $table->enum('status', ['unpaid', 'partially_paid', 'paid', 'cancelled'])->default('unpaid');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('total_price', 15, 2)->default(0);
            $table->timestamps();
        });

        // BR-06: Bukti bayar menunggu verifikasi sebelum menjadi terbayar
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->string('payment_number')->unique();
            $table->decimal('amount', 15, 2);
            $table->date('payment_date');
            $table->string('payment_method')->default('bank_transfer'); // bank_transfer, cash, virtual_account
            $table->string('bank_source')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('receipt_file')->nullable();
            $table->enum('status', ['pending_verification', 'verified', 'rejected'])->default('pending_verification');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('verified_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        // BR-07: Penerimaan uang dicatat sekali; jumlah alokasi tidak melebihi penerimaan
        Schema::create('payment_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('invoice_item_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('allocated_amount', 15, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('category'); // venue, production, marketing, consumption, logistics, honorarium
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->date('expense_date');
            $table->string('receipt_file')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // BR-08: Dukungan barang/jasa terpisah dari kas
        Schema::create('in_kind_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agreement_id')->nullable()->constrained('sponsorship_agreements')->nullOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('item_name');
            $table->decimal('estimated_value', 15, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->string('unit')->default('unit');
            $table->text('description')->nullable();
            $table->enum('delivery_status', ['pledged', 'delivered', 'verified'])->default('pledged');
            $table->dateTime('received_at')->nullable();
            $table->string('receiver_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('in_kind_contributions');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('payment_allocations');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('benefit_fulfillments');
        Schema::dropIfExists('benefits');
        Schema::dropIfExists('sponsorship_agreements');
        Schema::dropIfExists('sponsorship_packages');
    }
};
