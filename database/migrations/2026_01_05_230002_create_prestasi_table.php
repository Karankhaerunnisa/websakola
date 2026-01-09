<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // akademik, non-akademik, olahraga, seni
            $table->string('level'); // sekolah, kota, provinsi, nasional, internasional
            $table->string('rank')->nullable(); // juara 1, 2, 3, dll
            $table->string('student_name')->nullable();
            $table->string('event_name')->nullable();
            $table->date('achievement_date')->nullable();
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
