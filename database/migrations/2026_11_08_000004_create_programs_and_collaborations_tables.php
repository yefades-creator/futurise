<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->enum('type', ['keynote', 'panel', 'pitching', 'workshop', 'tour', 'networking', 'awarding'])->default('panel');
            $table->string('stage_or_room')->default('Main Stage');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('event_sessions')->cascadeOnDelete();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('organization')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });

        // Tour slot for school visits
        Schema::create('tour_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('slot_name'); // Sesi Pagi 1, Sesi Siang 1, etc.
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_capacity')->default(150);
            $table->integer('booked_count')->default(0);
            $table->string('guide_name')->nullable();
            $table->enum('status', ['open', 'full', 'closed'])->default('open');
            $table->timestamps();
        });

        Schema::create('school_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_slot_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete(); // School organization
            $table->integer('student_count')->default(0);
            $table->integer('teacher_count')->default(0);
            $table->string('pic_name');
            $table->string('pic_phone');
            $table->string('qr_group_token')->unique(); // Section 8: QR rombongan hanya administrasi kelompok
            $table->enum('arrival_status', ['registered', 'confirmed', 'arrived', 'completed'])->default('registered');
            $table->dateTime('arrived_at')->nullable();
            $table->integer('actual_attendees')->default(0); // Separated from group count
            $table->text('arrival_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('collaboration_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('target_partner_type')->default('industry'); // campus, industry, investor, government
            $table->string('scope_of_work')->nullable();
            $table->timestamps();
        });

        // BR-13: Pertemuan tidak boleh bentrok untuk pihak atau meja yang sama
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requester_org_id')->constrained('organizations')->cascadeOnDelete();
            $table->foreignId('target_org_id')->constrained('organizations')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('table_number')->default('Meja Kolaborasi 1');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('agenda_topic');
            $table->enum('status', ['requested', 'confirmed', 'rescheduled', 'completed', 'cancelled'])->default('requested');
            $table->text('discussion_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('meeting_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('role')->default('participant'); // host, invitee, mediator
            $table->enum('status', ['invited', 'confirmed', 'declined'])->default('invited');
            $table->timestamps();
        });

        // H+30 Follow Ups
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('meeting_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pic_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->text('action_plan');
            $table->date('deadline_h30');
            $table->enum('status', ['open', 'in_progress', 'completed', 'overdue'])->default('open');
            $table->text('result_summary')->nullable();
            $table->text('h30_notes')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
        Schema::dropIfExists('meeting_participants');
        Schema::dropIfExists('meetings');
        Schema::dropIfExists('collaboration_needs');
        Schema::dropIfExists('school_visits');
        Schema::dropIfExists('tour_slots');
        Schema::dropIfExists('speakers');
        Schema::dropIfExists('event_sessions');
    }
};
