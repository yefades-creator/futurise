<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('edition')->default('2026');
            $table->string('theme')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('venue_name')->nullable();
            $table->text('venue_address')->nullable();
            $table->string('city')->default('Bandung');
            $table->integer('quota_campus')->default(30);
            $table->integer('quota_projects_per_campus')->default(2);
            $table->integer('quota_industry')->default(10);
            $table->integer('quota_partner')->default(5);
            $table->integer('target_pitching_finalists')->default(10);
            $table->integer('target_collaboration_meetings')->default(30);
            $table->integer('target_visitors')->default(1000);
            $table->integer('target_h30_followups')->default(10);
            $table->decimal('target_satisfaction_rate', 5, 2)->default(85.00);
            $table->integer('min_survey_responses')->default(200);
            $table->dateTime('registration_deadline')->nullable();
            $table->dateTime('voting_start_at')->nullable();
            $table->dateTime('voting_end_at')->nullable();
            $table->boolean('is_date_confirmed')->default(false);
            $table->boolean('is_results_published')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('map_embed_url')->nullable();
            $table->string('floor_plan_image')->nullable();
            $table->integer('concurrent_capacity')->default(500); // BR-12: concurrent capacity separated from cumulative
            $table->json('facilities')->nullable();
            $table->text('transport_guide')->nullable();
            $table->timestamps();
        });

        Schema::create('event_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('key');
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, json, boolean, integer
            $table->string('group')->default('general');
            $table->timestamps();
            $table->unique(['event_id', 'key']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'role_id']);
        });

        // Modify users table to support role switching, phone, active status
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->foreignId('active_role_id')->nullable()->after('password');
            $table->string('status')->default('active')->after('active_role_id');
            $table->boolean('is_verified')->default(true)->after('status');
        });

        // BR-10: Single person identity across multiple roles
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('identity_number')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('position')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persons');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'active_role_id', 'status', 'is_verified']);
        });
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('event_settings');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('events');
    }
};
