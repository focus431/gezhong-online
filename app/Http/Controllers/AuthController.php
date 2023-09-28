<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ActivationEmail;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'showProfileSettingsMentor', 'showProfileSettingsMentee']]);
    }


    // 顯示登錄表單
    public function showLoginForm()
    {
        return view('login');
    }

    // Mentee 註冊
    public function menteeRegister(Request $request)
    {
        // 表單驗證
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // 創建新 Mentee
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'mentee';

        // 生成激活碼
        $activationCode = Str::random(60);
        $user->activation_code = $activationCode;

        // 保存用戶和激活碼
        $user->save();

        // 發送激活郵件
        Mail::to($user->email)->send(new ActivationEmail($activationCode));

        return response()->json(['message' => 'Mentor registered successfully', 'activation_message' => '激活碼已寄件，請檢查信箱', 'success' => true]);
    }






    // Mentor 註冊（這裡也可以添加激活碼和郵件驗證）
    public function mentorRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'mentor';
        // 生成激活碼
        $activationCode = Str::random(60);
        $user->activation_code = $activationCode;

        // 保存用戶和激活碼
        $user->save();

        // 發送激活郵件
        Mail::to($user->email)->send(new ActivationEmail($activationCode));


        return response()->json(['message' => 'Mentor registered successfully', 'activation_message' => '激活碼已寄件，請檢查信箱', 'success' => true]);
    }





    // 登錄
    public function login(Request $request)
    {
        // 獲取用戶提供的 email 和 password
        $credentials = $request->only('email', 'password');

        // 嘗試使用提供的憑證進行身份驗證
        if (Auth::attempt($credentials)) {
            // 獲取當前已認證的用戶
            $user = Auth::user();

            // 檢查用戶是否已經激活
            if (!$user->activated) {
                // 如果用戶未激活，則登出並返回錯誤信息
                Auth::logout();
                return response()->json(['message' => 'Your account is not activated yet', 'success' => false]);
            }

            // 如果用戶已激活，則繼續執行後續的登入操作
            session()->flash('success', 'Successfully logged in as ' . $user->role);
            return response()->json(['message' => 'Login successful', 'success' => true, 'role' => $user->role, 'user_data' => $user]);
        } else {
            // 如果身份驗證失敗，則返回錯誤信息
            session()->flash('error', 'Invalid credentials');
            return response()->json(['message' => 'Login failed', 'success' => false]);
        }
    }






    public function showMentorProfile()
    {
        // ...您的邏輯
        return view('profile-settings-mentor');
    }





    // 顯示 Mentor 設定頁面
    public function showProfileSettingsMentor()
    {
        $user = Auth::user();
        if ($user->role !== 'mentor') {
            return redirect('login')->with('message', '您不是 mentor，不能訪問這個頁面！');
        }
        return view('profile-settings-mentor', compact('user'));
    }

    // 顯示 Mentee 設定頁面
    public function showProfileSettingsMentee()
    {
        $user = Auth::user();
        if ($user->role !== 'mentee') {
            return redirect('login')->with('message', '您不是 mentee，不能訪問這個頁面！');
        }
        return view('profile-settings-mentee', compact('user'));
    }





    // 登出
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/index');

    }




    // 更新個人資料（這個函數比較長，所以只是示例，您可以根據需要進行調整）
    public function updateProfile(Request $request)
    {
        // 記錄日誌：表示進入了這個方法
        Log::info('Update profile method hit');
        // 記錄日誌：顯示所有傳入的請求數據
        Log::info('Update Profile Request', $request->all());

        // 從 session 中獲取當前登錄的用戶
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 初始化要更新的數據陣列
        $updateData = [];

        // 驗證基本請求數據
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'nullable|min:6', // 密碼是可選的，但如果提供，至少需要6個字符
            // ... (其他驗證規則)
        ]);

        // 檢查請求是否包含 'avatar' 文件
        if ($request->hasFile('avatar')) {
            // 驗證文件
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // 存儲文件並獲取存儲路徑
            $path = $request->file('avatar')->store('avatars', 'public');

            // 將存儲路徑保存到要更新的數據中
            $updateData['avatar_path'] = $path;
        }

        // 補充其他要更新的字段
        $updateData += [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            // ... 其他需要更新的字段
        ];

        // 如果 'blood_type' 字段有值，則添加到更新數據中（使其成為選填）
        if ($request->filled('blood_type')) {
            $updateData['blood_type'] = $request->blood_type;
        }

        // 如果 'password' 字段有值，則對其進行加密後添加到更新數據中
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // 在數據庫中更新用戶記錄
        $user->update($updateData);

        // 記錄日誌：顯示已更新的數據
        Log::info('User updated with data:', $updateData);

        // 回應：更新成功
        return response()->json(['success' => true]);




        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 注意，我加了 png
            ]);

            $path = $request->file('avatar')->store('avatars', 'public');

            $updateData['avatar_path'] = $path;
        }
    }
}
