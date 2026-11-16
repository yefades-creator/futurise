<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Total 45 booths: 30 campus, 10 industry, 5 partner
        Schema::create('booths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('code')->index(); // B-01, B-02, ...
            $table->enum('category', ['campus', 'industry', 'partner']);
            $table->string('size')->default('3x3 m');
            $table->integer('power_watt')->default(450);
            $table->integer('max_projects')->default(2); // Campus allows 2 projects sharing 1 booth (BR-03)
            $table->string('zone')->default('Hall A');
            $table->string('location_description')->nullable();
            $table->integer('x_coord')->nullable(); // For interactive map
            $table->integer('y_coord')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['event_id', 'code']);
        });

        // BR-05: Satu booth hanya untuk satu alokasi organisasi aktif pada edisi yang sama
        Schema::create('booth_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booth_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('allocated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['reserved', 'allocated', 'confirmed', 'active', 'cancelled'])->default('allocated');
            $table->dateTime('allocated_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'booth_id']); // Enforces BR-05
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('booth_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->string('category')->default('AI/IoT'); // AI/IoT, Smart City, FinTech, EdTech, HealthTech, Creative Media
            $table->text('problem_statement');
            $table->text('target_users');
            $table->text('solution_description');
            $table->text('key_features')->nullable();
            $table->string('technology_stack')->nullable();
            $table->string('readiness_level')->default('Prototipe Teruji'); // TRL / Kesiapan
            $table->text('test_results')->nullable();
            $table->text('limitations')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('poster_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('collaboration_needs')->nullable();
            $table->boolean('is_published_consent')->default(false); // Section 2 detail karya: izin publikasi
            // Status karya: Draft, Diajukan, Dalam Pemeriksaan, Perlu Revisi, Lolos, Tidak Lolos
            $table->enum('status', ['draft', 'diajukan', 'dalam_pemeriksaan', 'perlu_revisi', 'lolos', 'tidak_lolos'])->default('draft');
            $table->boolean('is_locked')->default(false); // BR-09: Materi terkunci saat pemeriksaan
            $table->text('curator_notes')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('reviewed_at')->nullable();
            // Status publikasi terpisah: Belum Disetujui, Siap Publikasi, Terbit, Diarsipkan
            $table->enum('publication_status', ['belum_disetujui', 'siap_publikasi', 'terbit', 'diarsipkan'])->default('belum_disetujui');
            $table->boolean('is_pitch_finalist')->default(false);
            $table->integer('pitch_order')->nullable();
            $table->integer('view_count')->default(0);
            $table->timestamps();
            $table->unique(['event_id', 'slug']);
        });

        // Project revision history
        Schema::create('project_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->integer('version_number')->default(1);
            $table->json('snapshot_data');
            $table->text('revision_notes')->nullable();
            $table->foreignId('submitted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('project_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('file_path');
            $table->enum('type', ['image', 'poster', 'document', 'video'])->default('image');
            $table->string('title')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_public')->default(true);
            $table->timestamps();
        });

        Schema::create('technical_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->text('device_list')->nullable();
            $table->integer('device_count')->default(1);
            $table->integer('power_watt')->default(300);
            $table->enum('internet_type', ['wifi_standard', 'wifi_high_speed', 'lan_cable'])->default('wifi_standard');
            $table->string('demo_area_type')->default('Standard Booth Table');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['draft', 'submitted', 'verified', 'fulfilled'])->default('submitted');
            $table->text('verifier_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('publication_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('approved_by')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['approved', 'rejected'])->default('approved');
            $table->text('remarks')->nullable();
            $table->dateTime('approved_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publication_approvals');
        Schema::dropIfExists('technical_requirements');
        Schema::dropIfExists('project_media');
        Schema::dropIfExists('project_versions');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('booth_allocations');
        Schema::dropIfExists('booths');
    }
};
