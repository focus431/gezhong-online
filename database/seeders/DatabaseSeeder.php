<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Course::factory(50)->create(); // 生成 50 個 Course 模型的假數據並保存到資料庫
        \App\Models\ClassSchedule::factory(50)->create(); // 生成 50 個 ClassSchedule 模型的假數據並保存到資料庫

    }

}
