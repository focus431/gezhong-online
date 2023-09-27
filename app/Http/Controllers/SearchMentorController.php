<?php

namespace App\Http\Controllers;
use App\Models\User;
class SearchMentorController extends Controller
{
    public function index()
{
    $mentors = User::where('role', 'mentor')->get(); // 只獲取role為"mentor"的用戶
    return view('search', ['mentors' => $mentors]);  // 將mentors數據傳遞給'search'視圖
}
}
