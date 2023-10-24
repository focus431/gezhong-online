<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->unsignedBigInteger('chat_room_id')->nullable();
            $table->text('content');
            $table->string('file_path')->nullable();
            $table->timestamps();

            $table->foreign('from_user_id')->references('id')->on('users');
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->foreign('chat_room_id')->references('id')->on('chat_rooms'); // 假設你有一個 chat_rooms 表
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
