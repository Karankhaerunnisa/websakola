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
        Schema::create('mitra_smk', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // industri, pendidikan, pemerintah, dll
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->text('partnership_type')->nullable(); // magang, rekrutmen, dll
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
        Schema::dropIfExists('mitra_smk');
    }
};
