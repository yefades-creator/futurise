<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['campus', 'industry', 'partner', 'sponsor', 'school']);
            $table->string('name');
            $table->string('slug');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('pic_name');
            $table->string('pic_position')->nullable();
            $table->string('pic_email');
            $table->string('pic_phone')->nullable();
            $table->boolean('pic_contact_public')->default(false); // Section 10: contact privacy
            $table->enum('status', ['draft', 'pending_verification', 'verified', 'rejected'])->default('pending_verification');
            $table->text('verification_notes')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'slug']);
        });

        Schema::create('campus_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('rector_name')->nullable();
            $table->string('campus_type')->default('PTN'); // PTN, PTS
            $table->string('accreditation')->default('Unggul');
            $table->integer('student_count')->nullable();
            $table->string('faculty_name')->nullable();
            $table->timestamps();
        });

        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('sector')->nullable(); // IT, Telco, Fintech, Government, etc.
            $table->text('profile_summary')->nullable();
            $table->text('solutions_offered')->nullable();
            $table->text('collaboration_needs')->nullable();
            $table->boolean('is_exhibitor')->default(true);
            $table->boolean('is_sponsor')->default(false);
            $table->timestamps();
        });

        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('school_type')->default('SMK'); // SMK, SMA
            $table->string('principal_name')->nullable();
            $table->integer('total_students_group')->default(0);
            $table->integer('total_teachers_group')->default(0);
            $table->text('visit_purpose')->nullable();
            $table->timestamps();
        });

        Schema::create('organization_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('role_in_org')->default('member'); // pic, member, student, delegate
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['organization_id', 'user_id']);
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('nim_nisn')->nullable();
            $table->string('study_program')->nullable();
            $table->string('student_status')->default('Aktif');
            $table->boolean('is_leader')->default(false);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('category'); // campus, industry, partner, sponsor, school, visitor
            $table->string('registration_code')->unique();
            $table->enum('status', ['submitted', 'verified', 'confirmed', 'cancelled'])->default('submitted');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('organization_memberships');
        Schema::dropIfExists('school_profiles');
        Schema::dropIfExists('company_profiles');
        Schema::dropIfExists('campus_profiles');
        Schema::dropIfExists('organizations');
    }
};
