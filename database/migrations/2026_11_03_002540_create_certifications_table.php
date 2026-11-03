<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('enrollment_id')
                ->unique()
                ->constrained('enrollments')
                ->cascadeOnDelete();

            $table->string('cert_number')
                ->nullable()
                ->unique();

            $table->date('issue_date')->nullable();

            $table->string('cert_status')
                ->default('Needs Retake');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};