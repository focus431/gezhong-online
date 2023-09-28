<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\ClassSchedule;

class ScheduleController extends Controller
{
    public function saveSchedule(Request $request)
    {
        Log::info('Starting saveSchedule function');
        DB::enableQueryLog();

        if (!auth()->check()) {
            return response()->json(['message' => '用戶未認證'], 401);
        }

        $userId = auth()->id();

        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['message' => '验证失败', 'errors' => $e->errors()], 422);
        }

        $timeSlots = $request->input('timeSlots');
        $courseIds = $request->input('courseIds');

        if (empty($timeSlots) || empty($courseIds)) {
            return response()->json(['message' => '時段或課程 ID 為空'], 400);
        }

        $schedules = $this->createSchedulesArray($userId, $timeSlots, $courseIds);

        DB::transaction(function () use ($schedules) {
            ClassSchedule::insert($schedules);
        }, 5);

        Log::info(DB::getQueryLog());
        Log::info('Ending saveSchedule function');  // Fixed log message
        return response()->json(['message' => '时段已成功储存']);
    }

    private function validateRequest(Request $request)
    {
        Log::info('Starting validateRequest function');  // Fixed log message
        $request->validate([
            'timeSlots.*.start_time' => 'required|date_format:H:i',
            'timeSlots.*.end_time' => 'required|date_format:H:i|after:timeSlots.*.start_time',
            'courseIds.*' => 'required|exists:courses,id'
        ]);
        Log::info('Ending validateRequest function');  // Fixed log message
    }

    private function createSchedulesArray($userId, $timeSlots, $courseIds)
    {
        Log::info('Starting createSchedulesArray function');  // Fixed log message
        $schedules = [];
        foreach ($courseIds as $courseId) {
            Log::info("Processing courseId: $courseId");
            foreach ($timeSlots as $slot) {
                foreach ($slot['day_of_week'] as $day) {
                    $schedules[] = [
                        'user_id' => $userId,
                        'course_id' => $courseId,
                        'schedule_date' => now(),
                        'day_of_week' => $day,
                        'start_time' => $slot['start_time'],
                        'end_time' => $slot['end_time'],
                        'is_recurring' => 0,
                    ];
                }
            }
        }
        Log::info('Schedules array:', $schedules);
        Log::info('Ending createSchedulesArray function');  // Fixed log message
        return $schedules;
    }

    public function showSchedule()
    {
        Log::info('Starting showSchedule function');  // Fixed log message
        $courses = DB::table('courses')->select('id', 'name', 'description')->get();
        return view('schedule-timings', ['courses' => $courses]);
    }
}
