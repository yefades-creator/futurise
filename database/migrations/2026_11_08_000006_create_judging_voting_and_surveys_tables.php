<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rubric_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('version_name'); // e.g., 'Rubrik Final FUTURiSE v1.0'
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rubric_version_id')->constrained()->cascadeOnDelete();
            $table->string('code')->index(); // C1, C2, C3, C4, C5
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('weight_percent', 5, 2); // 25.00, 25.00, 20.00, 20.00, 10.00
            $table->integer('max_scale')->default(5); // Scale 1 - 5
            $table->integer('sort_order')->default(1);
            $table->timestamps();
        });

        Schema::create('judge_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Judge user
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->boolean('has_conflict_of_interest')->default(false);
            $table->text('conflict_declaration_notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['event_id', 'user_id', 'project_id']);
        });

        // BR-08 Acceptance / BR-09 / BR-14: Juri hanya menilai karya yang ditugaskan & terkunci saat final
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judge_assignment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['draft', 'locked'])->default('draft');
            $table->decimal('final_score', 5, 2)->default(0); // Max 100
            $table->text('general_feedback')->nullable();
            $table->dateTime('locked_at')->nullable();
            $table->foreignId('unlocked_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('unlock_reason')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'project_id']);
        });

        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('criterion_id')->constrained()->cascadeOnDelete();
            $table->integer('score_value'); // 1 to 5
            $table->decimal('weighted_score', 5, 2); // score / 5 * weight
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['assessment_id', 'criterion_id']);
        });

        // BR-07 Acceptance / BR-14: Satu pengunjung 1 suara, active after check-in, concurrency safe
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('ticket_id')->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'user_id']); // Enforces 1 vote per user per event
            $table->unique(['event_id', 'ticket_id']); // Enforces 1 vote per ticket
        });

        // Project feedback from visitors, judges, industry
        Schema::create('project_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('giver_category')->default('visitor'); // visitor, industry, judge, student
            $table->string('giver_name');
            $table->string('giver_organization')->nullable();
            $table->integer('rating')->default(5); // 1-5
            $table->text('comment');
            $table->text('suggestion')->nullable();
            $table->boolean('is_public')->default(true);
            $table->timestamps();
        });

        // Section 14: CSAT Survey Response
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('ticket_id')->nullable()->index();
            $table->integer('satisfaction_score'); // 1-5. 4 or 5 = satisfied
            $table->string('respondent_category')->default('visitor'); // visitor, campus, industry, school
            $table->text('feedback_text')->nullable();
            $table->boolean('would_recommend')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
        Schema::dropIfExists('project_feedbacks');
        Schema::dropIfExists('votes');
        Schema::dropIfExists('scores');
        Schema::dropIfExists('assessments');
        Schema::dropIfExists('judge_assignments');
        Schema::dropIfExists('criteria');
        Schema::dropIfExists('rubric_versions');
    }
};
