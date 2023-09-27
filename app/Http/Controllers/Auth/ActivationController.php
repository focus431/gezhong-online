<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function activate($code)
    {
        $user = User::where('activation_code', $code)->firstOrFail();
    
        $user->activated = true;
        $user->activation_code = null;
        $user->save();
    
        // 登錄用戶並重定向
        Auth::login($user);
    
        return redirect('/home');
    }
    
    /*
     * 激活帳戶
     *
     * @param  string  $activationCode  激活碼
     * @return \Illuminate\Http\Response
     */
    public function activateAccount($activationCode)
    {
        // 使用激活碼查找相對應的用戶
        $user = User::where('activation_code', $activationCode)->firstOrFail();

        // 將用戶設置為已激活
        $user->activated = true;

        // 清除激活碼字段
        $user->activation_code = null;

        // 保存更改到數據庫
        $user->save();

        // 重定向到登錄頁面並顯示激活成功的消息
        return redirect('/login')->with('status', '您的帳戶已成功激活。');
    }


}
