<?php

namespace App\Http\Controllers;

use Carbon\Carbon;  // 引入 Carbon 用於時間操作
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        if (empty($timeSlots)) {
            return response()->json(['message' => '時段或課程 ID 為空'], 400);
        }

        $result = $this->createSchedulesArray($userId, $timeSlots);
        $schedules = $result['schedules'];
        $isAnyNewScheduleAdded = $result['isAnyNewScheduleAdded'];

        if ($isAnyNewScheduleAdded) {
            DB::transaction(function () use ($schedules) {
                ClassSchedule::insert($schedules);
            }, 5);
            Log::info('Ending saveSchedule function');
            return response()->json(['message' => '时段已成功储存']);
        } else {
            Log::info('Ending saveSchedule function');
            return response()->json(['message' => '没有新的时段需要储存']);
        }
    }






    private function validateRequest(Request $request)
     {
        Log::info('Starting validateRequest function');  // Fixed log message
        $request->validate([
            'timeSlots.*.start_time' => 'required|date_format:H:i',
            'timeSlots.*.end_time' => 'required|date_format:H:i|after:timeSlots.*.start_time',
            // 'courseIds.*' => 'required|exists:courses,id'
        ]);
        Log::info('Ending validateRequest function');  // Fixed log message
     }

    
    
    
     private function createSchedulesArray($userId, $timeSlots)
     {
         Log::info('Starting createSchedulesArray function');
     
         $schedules = [];
         $isAnyNewScheduleAdded = false;  // 用于标识是否有新的时间段被添加
     
         $today = Carbon::today();
         for ($daysAhead = 0; $daysAhead <= 31; $daysAhead++) {
             $currentDay = $today->copy()->addDays($daysAhead);
     
             foreach ($timeSlots as $slot) {
                 foreach ($slot['day_of_week'] as $day) {
                     if (strtolower($currentDay->format('l')) == strtolower($day)) {
                         $startTime = Carbon::createFromFormat('Y-m-d H:i', $currentDay->toDateString() . ' ' . $slot['start_time']);
                         $endTime = Carbon::createFromFormat('Y-m-d H:i', $currentDay->toDateString() . ' ' . $slot['end_time']);
     
                         $duration = 25;
                         $break = 5;
     
                         while ($startTime->lt($endTime)) {
                             $nextTime = $startTime->copy()->addMinutes($duration);
                             if ($nextTime->gt($endTime)) {
                                 break;
                             }
     
                             // 查詢是否已存在相同的排程
                             $existingSchedule = ClassSchedule::where('user_id', $userId)  // 加入 user_id 作為過濾條件
                                 ->where('schedule_date', $currentDay->toDateString())
                                 ->where('day_of_week', $day)
                                 ->where('start_time', $startTime->format('H:i'))
                                 ->where('end_time', $nextTime->format('H:i'))
                                 ->first();
     
                             // 如果不存在相同的排程，則添加到 $schedules 陣列
                             if (!$existingSchedule) {
                                 $schedules[] = [
                                     'user_id' => $userId,
                                     'schedule_date' => $currentDay->toDateString(),
                                     'day_of_week' => $day,
                                     'start_time' => $startTime->format('H:i'),
                                     'end_time' => $nextTime->format('H:i'),
                                     'is_recurring' => 0,
                                 ];
                                 $isAnyNewScheduleAdded = true;  // 设置标识为 true，因为有新的时间段被添加
                             }
     
                             $startTime = $nextTime->addMinutes($break);
                         }
                     }
                 }
             }
         }
     
         Log::info('Schedules array:', $schedules);
         Log::info('Ending createSchedulesArray function');
     
         return ['schedules' => $schedules, 'isAnyNewScheduleAdded' => $isAnyNewScheduleAdded];
     }
     





    public function showSchedule()
     {
        Log::info('Starting showSchedule function');

        // 獲取課程資料
        $courses = DB::table('courses')->select('id', 'name', 'description')->get();

        // 檢查是否有用戶已登入
        if (Auth::check()) {
            $userId = Auth::id();

            // 只獲取當前登入用戶的班級時間表資料
            $classSchedules = ClassSchedule::where('user_id', $userId)->get();

            return view('schedule-timings', ['courses' => $courses, 'classSchedules' => $classSchedules]);
        } else {
            return redirect('/login');  // 若用戶未登入，重定向到登入頁
        }
    }

   
   
    public function getScheduleJson()
        {
        if (Auth::check()) {
            $userId = Auth::id();
            $classSchedules = ClassSchedule::where('user_id', $userId)->get();
            return response()->json($classSchedules);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }






    public function handleSchedule(Request $request)
    {
        $userId = Auth::id();
        // 获取现有计划的日期
        $existingDate = $request->input('existing_date');
        $dayOfWeek = $request->input('day_of_week');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $status = $request->input('status', 'available'); // Default to 'unavailable'

        // Find existing schedule based on the provided conditions
        $existingSchedule = ClassSchedule::where('user_id', $userId)
            ->where('schedule_date', $existingDate)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if ($existingSchedule) {
            // Update existing schedule

            $existingSchedule->status = $status;
            $existingSchedule->save();
            return response()->json(['message' => 'Schedule updated successfully', 'id' => $existingSchedule->id]);
        } else {
            // Create new schedule
            $newSchedule = ClassSchedule::create([
                'user_id' => $userId,
                'schedule_date' => $existingDate,
                'day_of_week' => $dayOfWeek,
                'start_time' => $startTime,
                'end_time' => $endTime,



                'is_recurring' => $request->input('is_recurring', 0), // Default to 0
                'status' => $status
            ]);
            return response()->json(['message' => 'New schedule created', 'id' => $newSchedule->id]);
        }
    }








}
