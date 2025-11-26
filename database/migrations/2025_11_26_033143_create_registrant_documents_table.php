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
        Schema::create('registrant_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained('registrants')->onDelete('cascade');

            $table->string('document_type', 100); // e.g., 'birth_certificate', 'diploma', 'photo', etc.
            $table->string('file_path'); // Path to the stored document file
            $table->string('file_name')->nullable(); // Original file name

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrant_documents');
    }
};
