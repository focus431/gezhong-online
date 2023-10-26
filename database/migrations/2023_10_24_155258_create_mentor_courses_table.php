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
    Schema::create('mentor_courses', function (Blueprint $table) {
        $table->id(); // 主鍵
        $table->unsignedBigInteger('user_id'); // 與 users 表格相連
        $table->unsignedBigInteger('course_id'); // 與 courses 表格相連

        // 設定外鍵
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

        $table->timestamps(); // 建立時間和更新時間
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_courses');
    }
};
