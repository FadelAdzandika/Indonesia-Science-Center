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
        if (!Schema::hasTable('competitions')) {
            Schema::create('competitions', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Nama kompetisi
                $table->date('date'); // Tanggal kompetisi
                $table->string('image')->nullable(); // Gambar kompetisi (opsional)
                $table->timestamps(); // Kolom created_at dan updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
