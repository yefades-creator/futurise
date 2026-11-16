<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // QR token is random token without direct personal data
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('registration_id')->nullable()->constrained()->nullOnDelete();
            $table->string('ticket_number')->unique();
            $table->string('qr_token', 64)->unique(); // Random secure token
            $table->enum('category', ['visitor', 'student_participant', 'pic_campus', 'industry_exhibitor', 'sponsor', 'judge', 'vip', 'panitia'])->default('visitor');
            $table->enum('status', ['active', 'checked_in', 'cancelled'])->default('active');
            $table->boolean('has_checked_in')->default(false);
            $table->dateTime('first_checked_in_at')->nullable();
            $table->timestamps();
        });

        // BR-10, BR-11: Unique visitor log & occupancy (in/out tracking)
        Schema::create('check_in_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('scan_type', ['in', 'out'])->default('in'); // For occupancy calculation
            $table->boolean('is_unique_first_entry')->default(false); // Only the very first 'in' scan per person counts as unique visitor
            $table->string('gate_location')->default('Gate 1 - Main Entrance');
            $table->foreignId('scanned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('scanned_at');
            $table->boolean('is_manual_override')->default(false); // Fallback procedure for offline/network disruption
            $table->text('override_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('division'); // sekretariat, kurasi, venue, publikasi, keuangan, pendaftaran
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->date('due_date');
            $table->enum('status', ['todo', 'in_progress', 'completed', 'blocked'])->default('todo');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->text('description')->nullable();
            $table->string('proof_file')->nullable();
            $table->timestamps();
        });

        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('ticket_code')->unique();
            $table->string('category')->default('pendaftaran'); // pendaftaran, teknis, booth, jadwal, pembayaran, bantuan
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['open', 'in_review', 'answered', 'closed'])->default('open');
            $table->enum('priority', ['normal', 'urgent'])->default('normal');
            $table->text('response_text')->nullable();
            $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('responded_at')->nullable();
            $table->timestamps();
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('category')->default('panduan'); // panduan, template, sk_panitia, laporan
            $table->string('file_path');
            $table->integer('file_size_kb')->default(0);
            $table->boolean('is_public')->default(true);
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('message');
            $table->string('action_url')->nullable();
            $table->boolean('is_read')->default(false);
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });

        // BR-13 Acceptance: Audit log for changes in payments, scores, booth allocation, publication
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action'); // payment_verified, score_locked, booth_allocated, publication_approved, etc.
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->text('reason')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->string('category')->default('Pengumuman'); // Pengumuman, Kurasi, Liputan, Berita
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('cover_image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'slug']);
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('Umum'); // Umum, Pendaftaran, Booth, Penjurian
            $table->string('question');
            $table->text('answer');
            $table->integer('sort_order')->default(1);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('news');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('support_tickets');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('check_in_logs');
        Schema::dropIfExists('tickets');
    }
};
