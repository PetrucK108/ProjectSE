<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemain', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('nomor');
            $table->integer('umur');
            $table->string('jurusan');
            $table->string('angkatan'); // contoh: B27
            $table->integer('gol')->default(0);
            $table->integer('assist')->default(0);
            $table->integer('clean_sheet')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemain');
    }
};
