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
        $table->text('day_of_week')->nullable()->change();
    });
}

public function down()
{
    Schema::table('class_schedules', function (Blueprint $table) {
        // 恢復原狀，例如改回到原來的數據類型
    });
}

};
