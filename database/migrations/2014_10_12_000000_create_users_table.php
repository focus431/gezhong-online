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
    Schema::create('users', function (Blueprint $table) {
        $table->id();  // 主鍵，自動遞增
        $table->string('role')->default('mentee');
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->date('date_of_birth')->nullable();
        $table->string('blood_group')->nullable();
        $table->string('email')->unique()->nullable();
        $table->string('mobile')->nullable();
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('zip_code')->nullable();
        $table->string('country')->nullable();
        $table->timestamps();  // created_at 和 updated_at
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
