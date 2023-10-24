<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMentorIdToMenteeIdInClassSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->renameColumn('mentor_id', 'mentee_id');
        });
    }

    public function down()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->renameColumn('mentee_id', 'mentor_id');
        });
    }
}

