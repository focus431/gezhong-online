<?php

// app/Http/Controllers/BookingController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class BookingController extends Controller
{
    public function show($encryptedUserId)
    {
        try {
            $mentor_id = decrypt($encryptedUserId);
        } catch (\Exception $e) {
            abort(404, 'Invalid user ID');
        }

        $mentor = \App\Models\User::find($mentor_id);

        if (!$mentor) {
            abort(404, 'Mentor not found');
        }

        return view('booking', ['mentor' => $mentor]);
    }



    public function getClassSchedule($mentorId)
    {
        $schedule = ClassSchedule::where('user_id', $mentorId)->get();
        return response()->json($schedule);
    }








    public function updateBookingStatus(Request $request)
    {
        $mentorId = $request->input('mentorId');
        $scheduleDate = $request->input('scheduleDate');  // 新添加的
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $menteeId = $request->input('menteeId');
        $newStatus = $request->input('newStatus');
        $classScheduleId = $request->input('classScheduleId');

        // 尋找符合條件的 ClassSchedule
        $classSchedule = ClassSchedule::where('user_id', $mentorId)
            ->where('schedule_date', $scheduleDate)  // 注意這裡
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->where('mentee_id', $menteeId)
            ->where('user_id', $mentorId)
            ->where('id', $classScheduleId)  // 添加這一行
            ->first();


        if ($classSchedule) {
            // 更新狀態
            $classSchedule->status = $newStatus;
            $classSchedule->save();
            return response()->json(['message' => 'Booking status updated successfully']);
        } else {
            return response()->json(['message' => 'Time slot not found'], 404);
        }
    }









    public function batchUpdate(Request $request)
    {
        $slots = $request->input('slots');

        // 輸入驗證可以在這裡添加

        DB::beginTransaction();

        try {
            foreach ($slots as $slot) {
                $mentorId = $slot['mentorId'];
                $scheduleDate = $slot['scheduleDate'];
                $startTime = $slot['startTime'];
                $endTime = $slot['endTime'];
                $newStatus = $slot['newStatus'];
                $menteeId = $slot['menteeId'];

                $classSchedule = ClassSchedule::where('user_id', $mentorId)
                    ->where('schedule_date', $scheduleDate)
                    ->where('start_time', $startTime)
                    ->where('end_time', $endTime)
                    ->first();

                if (!$classSchedule) {
                    // 回滾事務並返回錯誤消息
                    DB::rollback();
                    return response()->json(['message' => 'Time slot not found'], 404);
                }

                $classSchedule->status = $newStatus;
                $classSchedule->mentee_id = $menteeId;
                $classSchedule->save();
            }

            DB::commit();
            return response()->json(['message' => 'Successfully updated']);
        } catch (\Exception $e) {
            DB::rollback();
            // 這裡可以添加更多的錯誤處理邏輯
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }








    
    

    



}
