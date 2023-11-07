<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;


class SocialAuthController extends Controller
{
    /**
     * 將用戶重定向到 Facebook 的 OAuth 服務。
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * 從 Facebook 的 OAuth 服務獲取用戶資訊。
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
{
    try {
        $socialiteUser = Socialite::driver('facebook')->user();

        // 查找或創建用戶
        $user = User::firstOrCreate(
            ['email' => $socialiteUser->getEmail()],
            ['name' => $socialiteUser->getName(), 'password' => bcrypt(Str::random(16))]
        );

        // 登入用戶
        Auth::login($user, true);

        return redirect('/home');  // 或其他您想重定向的路由

    } catch (Exception $e) {
        return redirect('/login');  // 或其他錯誤處理路由
    }
}
}

