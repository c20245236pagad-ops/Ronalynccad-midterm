<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('trainee_name', 150);
            $table->string('trainee_email', 150)->unique();
            $table->timestamps();

            $table->index('trainee_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};