<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatContactsTable extends Migration
{
    public function up()
    {
        Schema::create('chat_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('contact_user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contact_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'contact_user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_contacts');
    }
}
