<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('wahanas', function (Blueprint $table) {
            $table->boolean('is_new')->default(false)->after('image'); // Sesuaikan 'after' jika perlu
        });
    }

    public function down()
    {
        Schema::table('wahanas', function (Blueprint $table) {
            $table->dropColumn('is_new');
        });
    }
};
