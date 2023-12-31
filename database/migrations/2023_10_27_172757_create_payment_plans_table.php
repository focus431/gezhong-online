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
    Schema::create('payment_plans', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('lessons');
        $table->integer('price');
        $table->integer('duration')->nullable();  // 可選，可以用來表示有效期
        $table->text('description')->nullable();  // 可選
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_plans');
    }
};
