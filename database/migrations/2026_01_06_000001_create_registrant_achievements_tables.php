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
        // Table untuk Prestasi Akademik (Peringkat Semester)
        Schema::create('registrant_academic_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained()->onDelete('cascade');
            $table->integer('semester')->comment('Semester 1-6');
            $table->string('peringkat')->nullable()->comment('Peringkat di kelas');
            $table->string('keterangan')->nullable()->comment('Keterangan tambahan atau lomba');
            $table->timestamps();
        });

        // Table untuk Prestasi Non-Akademik (Lomba/Kejuaraan)
        Schema::create('registrant_non_academic_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained()->onDelete('cascade');
            $table->string('nama_lomba')->comment('Nama lomba/kejuaraan');
            $table->enum('tingkat', ['sekolah', 'kecamatan', 'kabupaten', 'provinsi', 'nasional', 'internasional'])->comment('Tingkat lomba');
            $table->enum('peringkat', ['juara_1', 'juara_2', 'juara_3', 'harapan_1', 'harapan_2', 'harapan_3', 'peserta'])->comment('Peringkat/juara');
            $table->year('tahun')->nullable()->comment('Tahun lomba');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrant_non_academic_achievements');
        Schema::dropIfExists('registrant_academic_achievements');
    }
};
