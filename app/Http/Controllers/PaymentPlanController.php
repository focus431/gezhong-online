<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentPlan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PaymentPlanController extends Controller
{
    public function index()
    {
        $plans = PaymentPlan::all();  // 獲取所有方案
        $isLoggedIn = Auth::check();  // 檢查用戶是否登入
        $isMentee = false;
    
        if ($isLoggedIn) {
            $user = Auth::user();
            $isMentee = $user->role === 'mentee';  // 這裡假設您在用戶模型中有一個 'role' 屬性
        }
    
        return view('paymentplan', ['plans' => $plans, 'isLoggedIn' => $isLoggedIn, 'isMentee' => $isMentee]);  // 將數據傳遞到視圖
    }
    





    public function checkout(Request $request, $id = null)
    {
        // 登入者ID
        $user_id = Auth::user()->id;
        // 使用ID從User模型中查找用戶
        $user = User::find($user_id);

        $plan = null;

        // 檢查是否傳遞了card_id作為查詢參數
        if ($request->has('card_id')) {
            // 從查詢參數中獲取 card_id
            $cardId = $request->input('card_id');
            // 根據 $cardId 從資料庫中獲取相應的 plan
            $plan = PaymentPlan::find($cardId);
        }
        // 檢查是否傳遞了 id 作為URL參數
        elseif ($id !== null) {
            // 查找指定ID的資料
            $plan = PaymentPlan::find($id);
        }

        // 將用戶和 plan 資料一起傳遞到Blade模板
        return view('checkout', ['user' => $user, 'plan' => $plan]);
    }
}
