<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Log;

class SearchMentorController extends Controller
{
    public function index()
    {
        // 獲取分頁的mentors
        $paginatedMentors = User::where('role', 'mentor')->paginate(2);  // 2個每頁

        // 獲取所有課程
        $courses = Course::all();

        // 獲取並加密所有mentor IDs
        $mentorIds = $paginatedMentors->pluck('id');
        log::info($mentorIds);
        $encryptedMentorIds = array_map(function ($id) {
            return encrypt($id);
        }, $mentorIds->toArray());
        Log::info('Encrypted Mentor IDs: ', ['encryptedMentorIds' => $encryptedMentorIds]);

        // 將所有數據傳遞給視圖
        return view('search', [
            'paginatedMentors' => $paginatedMentors,
            'courses' => $courses,
            'encryptedMentorIds' => json_encode($encryptedMentorIds)  // 將加密後的mentor IDs也傳遞給視圖
        ]);
    }






    public function getMentors(Request $request)
    {
        Log::info('Received Request:', ['request' => $request->all()]);

        $query = User::where('role', 'mentor');

        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
            Log::info('Filtering by gender:', ['gender' => $request->gender]);
        }

        if ($request->has('courses')) {
            $courseIds = $request->courses;
            Log::info('Filtering by courses:', ['courses' => $courseIds]);
            $query->whereHas('courses', function ($q) use ($courseIds) {
                $q->whereIn('course_id', $courseIds);
            });
        }

        if ($request->has('date')) {
            $query->whereHas('classSchedules', function ($q) use ($request) {
                $q->whereDate('schedule_date', $request->date);
            });
        }

        if ($request->has('name')) {
            $name = $request->name;
            $query->where(function ($query) use ($name) {
                $query->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%');
            });
        }


        $paginatedMentors = $query->paginate(2);  // 每頁 2 條數據

        $mentorIds = $paginatedMentors->pluck('id');


        Log::info('Mentor IDs:', ['mentorIds' => $mentorIds]);
        $encryptedMentorIds = array_map(function ($id) {
            return encrypt($id);
        }, $mentorIds->toArray());

        Log::info('Encrypted Mentor IDs:', ['encryptedMentorIds' => $encryptedMentorIds]);

        return response()->json([
            'mentors' => $paginatedMentors->items(),
            'encryptedMentorIds' => $encryptedMentorIds,
            'pagination' => [
                'total' => $paginatedMentors->total(),
                'per_page' => $paginatedMentors->perPage(),
                'current_page' => $paginatedMentors->currentPage(),
                'last_page' => $paginatedMentors->lastPage(),
            ]
        ]);
        
        
    }
}
