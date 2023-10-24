<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToClassSchedulesTable extends Migration
{
    public function up()
{
    Schema::table('class_schedules', function (Blueprint $table) {
        if (!Schema::hasColumn('class_schedules', 'created_at')) {
            $table->timestamp('created_at')->nullable();
        }
        if (!Schema::hasColumn('class_schedules', 'updated_at')) {
            $table->timestamp('updated_at')->nullable();
        }
    });
}

    public function down()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->dropTimestamps();  // 這將移除 created_at 和 updated_at 欄位
        });
    }
}

