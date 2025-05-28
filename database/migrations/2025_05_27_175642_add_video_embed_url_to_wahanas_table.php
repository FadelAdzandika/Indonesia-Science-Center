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
        Schema::table('wahanas', function (Blueprint $table) {
            $table->string('video_embed_url')->nullable()->after('image'); // Tambahkan kolom setelah kolom 'image'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wahanas', function (Blueprint $table) {
            $table->dropColumn('video_embed_url');
        });
    }
};
