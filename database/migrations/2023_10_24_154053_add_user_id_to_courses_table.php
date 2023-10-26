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
    Schema::table('courses', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable();  // 設置為 nullable 以允許 null 值

        // 如果你想要添加外鍵約束，可以取消以下註釋
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('courses', function (Blueprint $table) {
        // 如果你有添加外鍵約束，先移除它
        // $table->dropForeign(['user_id']);

        $table->dropColumn('user_id');
    });
}

};
