<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trade_courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('instructor_id')
                ->constrained('instructors')
                ->restrictOnDelete();

            $table->string('course_name', 150);
            $table->unsignedInteger('training_hours');
            $table->decimal('passing_grade', 5, 2);

            $table->timestamps();

            $table->index('course_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trade_courses');
    }
};
