<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trainee_id')
                ->constrained('trainees')
                ->cascadeOnDelete();

            $table->foreignId('trade_course_id')
                ->constrained('trade_courses')
                ->cascadeOnDelete();

            $table->decimal('assessment_score', 5, 2)
                ->nullable();

            $table->timestamps();

            $table->index(['trainee_id', 'trade_course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};