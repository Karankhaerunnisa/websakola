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
        Schema::create('registrant_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained('registrants')->onDelete('cascade');

            $table->text('street_address'); // Alamat lengkap
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('village');    // Kelurahan
            $table->string('district');   // Kecamatan
            $table->string('city');       // Kota
            $table->string('province');   // Provinsi
            $table->string('postal_code', 10);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrant_addresses');
    }
};
