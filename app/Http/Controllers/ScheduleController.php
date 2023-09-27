<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSchedule;  // 引入您的 ClassSchedule 模型
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    // 後端：在ScheduleController.php
    // 控制器中
    public function showSchedule()
    {
        $userId = auth()->id();
        $schedules = ClassSchedule::where('user_id', $userId)->get();
        return view('schedule-timings', ['schedules' => $schedules]);
    }



    public function saveSchedule(Request $request)
    {
        try {
            $startTime = $request->input('start_time');
            $endTime = $request->input('end_time');
            $day = $request->input('day');
            $userId = auth()->id();  // 假設用戶已經認證

            $schedule = new ClassSchedule();
            $schedule->user_id = $userId;
            $schedule->day_of_week = $day;
            $schedule->start_time = $startTime;
            $schedule->end_time = $endTime;
            $schedule->save();

            Log::info('Schedule saved', ['request' => $request->all()]);
            return response()->json(['message' => 'Schedule saved successfully']);
        } catch (\Exception $e) {
            Log::error('Error saving schedule', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error saving schedule'], 500);
        }
    }
}
