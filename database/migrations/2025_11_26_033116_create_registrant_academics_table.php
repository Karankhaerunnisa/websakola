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
        Schema::create('registrant_academics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained('registrants')->onDelete('cascade');

            $table->string('school_name', 150);
            $table->year('graduation_year');

            $table->decimal('math_score', 5, 2)->nullable(); // e.g., 95.50
            $table->decimal('indonesian_score', 5, 2)->nullable();
            $table->decimal('english_score', 5, 2)->nullable();
            $table->decimal('science_score', 5, 2)->nullable();
            $table->decimal('average_score', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrant_academics');
    }
};
