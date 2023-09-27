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
    Schema::table('class_schedules', function (Blueprint $table) {
        $table->string('status')->default('available'); // 狀態可以是 'available', 'booked', 'unavailable' 等。
    });
}

public function down()
{
    Schema::table('class_schedules', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
