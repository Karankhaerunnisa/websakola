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
        Schema::table('majors', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('description');
            $table->string('photo1')->nullable()->after('content');
            $table->string('photo2')->nullable()->after('photo1');
            $table->string('youtube_url')->nullable()->after('photo2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn(['content', 'photo1', 'photo2', 'youtube_url']);
        });
    }
};
