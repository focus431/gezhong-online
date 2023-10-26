<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ClassScheduleController extends Controller
{




    public function getBookingsForMentee(Request $request)
    {

        $loggedInUserId = auth()->id();  // 獲取當前登入用戶的ID

        // 獲取前端傳過來的 status
        $status = $request->input('status', 'booked');  // 默認為 'booked'
        $user = User::find($loggedInUserId);

        // 初始化查詢構造器
        $classSchedules = ClassSchedule::where('mentee_id', $loggedInUserId);

        // 使用 status 來過濾數據
        if ($status) {
            $classSchedules->where('status', $status);
        }

        // 執行查詢並獲取結果
        $classSchedules = $classSchedules->paginate(10);  // 每頁10條記錄

        // 找到所有可能的 mentors
        $users = User::where('role', 'mentor')->get();

        // 返回給前端
        return response()->json(['user' => $user, 'classSchedules' => $classSchedules, 'users' => $users]);
    }






    public function getBookingsForMentor(Request $request)
    {
        $loggedInUserId = auth()->id();  // 獲取當前登入用戶的ID

        // 獲取前端傳過來的 status
        $status = $request->input('status', 'booked');  // 默認為 'booked'
        $user = User::find($loggedInUserId);

        // 初始化查詢構造器
        $classSchedules = ClassSchedule::where('user_id', $loggedInUserId);

        // 使用 status 來過濾數據
        if ($status) {
            $classSchedules->where('status', $status);
        }

        // 執行查詢並獲取結果
        $classSchedules = $classSchedules->paginate(10);  // 每頁10條記錄

        Log::info("classSchedules", ['$user' => $classSchedules]);        // 找到匹配的用戶

        // 找到所有可能的 mentors
        $users = User::where('role', 'mentee')->get();

        // 返回給前端
        return response()->json(['user' => $user, 'classSchedules' => $classSchedules, 'users' => $users]);
    }
}
