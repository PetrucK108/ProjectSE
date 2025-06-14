<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'skill_level')) {
                $table->string('skill_level')->nullable();
            }

            if (!Schema::hasColumn('users', 'gaya_bermain')) {
                $table->string('gaya_bermain')->nullable();
            }
        });
    }



    public function down(): void
    {
        //
    }
};
