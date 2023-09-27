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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->date('schedule_date');
        $table->string('day_of_week');
        $table->time('start_time');
        $table->time('end_time');
        $table->boolean('is_recurring')->default(false);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('bookings');
}

};
