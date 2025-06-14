<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemain', function (Blueprint $table) {
            $table->integer('goals_conceded')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('pemain', function (Blueprint $table) {
            $table->dropColumn('goals_conceded');
        });
    }
};
