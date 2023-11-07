<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\CarbonPeriod;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.index_admin');
    }

    public function mentor()
    {
        return view('admin.mentor');
    }

    public function mentee()
    {
        return view('admin.mentee');
    }

    public function bookingList()
    {
        return view('admin.booking-list');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function transactionsList()
    {
        return view('admin.transactions-list');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function invoiceReport()
    {
        return view('admin.invoice-report');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function blog()
    {
        return view('admin.blog');
    }

    public function blogDetails()
    {
        return view('admin.blog-details');
    }

    public function addBlog()
    {
        return view('admin.add-blog');
    }

    public function editBlog()
    {
        return view('admin.edit-blog');
    }

    public function adminLogin()
    {
        return view('admin.login');
    }








    public function ajaxLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return response()->json([
                    'status' => 'success',
                    'id' => Auth::user()->id
                ]);
            } else {
                Auth::logout();
                return response()->json([
                    'status' => 'fail',
                    'message' => '您不是管理員'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => '登錄失敗'
            ]);
        }
    }








    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|alpha_num',
                'email' => 'required|email|unique:users,email|min:6',
                'password' => 'required|confirmed'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User;
            $user->first_name = $request->first_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'admin';
            $user->save();


            return redirect()->route('profile')->with('success', 'Registration successful');
        }

        return view('admin.register');
    }





    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // 获取当前用户

        // 确保 $user 不是 null 并且是 Eloquent 模型
        if (!is_null($user) && $user instanceof \Illuminate\Database\Eloquent\Model) {
            // 验证请求的数据
            $request->validate([
                'first_name' => 'required',
                // ...其他验证规则...
            ]);

            // 更新用户的数据
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->mobile = $request->input('mobile');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->address = $request->input('address');
            $user->city = $request->input('city');

            // 检查是否有上传的文件
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();

                // 存储头像到 'storage/app/public/avatars' 文件夹
                $avatar->storeAs('avatars', $filename, 'public');

                // 更新用户模型
                $user->avatar_path = 'avatars/' . $filename;
            }

            $user->save();  // 保存到数据库

            return response()->json(['status' => 'success']); // 返回成功的 JSON 响应
        } else {
            // 如果无法获取当前用户或者用户不是 Eloquent 模型
            return response()->json(['status' => 'error', 'message' => '无法获取当前用户或当前用户不是一个有效的 Eloquent 模型']);
        }
    }








    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->new_password);
            $user->save();

            return response()->json(['status' => 'success', 'message' => '密码已成功更改']);
        } else {
            return response()->json(['status' => 'error', 'message' => '旧密码不正确']);
        }
    }








    public function getUsersByRole(Request $request, $role)
    {
        $sortField = $request->get('sortField', 'last_name');
        $sortDirection = $request->get('sortDirection', 'asc');
        $perPage = $request->get('perPage', 10);
        $searchTerm = strtolower($request->get('search', ''));

        $users = User::where('role', $role)
            ->where(function ($query) use ($searchTerm) {
                $query->whereRaw('lower(first_name) like ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('lower(last_name) like ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('lower(email) like ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('lower(gender) like ?', ['%' . $searchTerm . '%'])
                    ->orWhere('mobile', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return response()->json($users);
    }










    public function changeStatus($id, Request $request)
    {
        // 根據ID查找用戶
        $user = User::find($id);

        // 檢查用戶是否存在
        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => 'User not found']);
        }

        // 檢查用戶角色並執行相應的代碼
        if ($user->role == 'mentor') {
            // 如果用戶是mentor，執行這裡的代碼
            // ...
            $user->activated = $request->input('activated');
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Mentor status changed']);
        } elseif ($user->role == 'mentee') {
            // 如果用戶是mentee，執行這裡的代碼
            // ...
            $user->activated = $request->input('activated');
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Mentee status changed']);
        } else {
            // 如果用戶既不是mentor也不是mentee，返回錯誤信息
            return response()->json(['status' => 'failed', 'message' => 'Invalid role']);
        }
    }













    public function getClassSchedules(Request $request)
    {
        $sortField = $request->query('sortField', 'id');
        $sortDirection = $request->query('sortDirection', 'asc');
        $perPage = $request->query('perPage', 10);
        $searchValue = $request->query('search', '');

        $schedulesQuery = ClassSchedule::with(['mentor', 'course', 'mentee'])
            ->whereNotNull('mentee_id');

        if ($sortField == 'mentor.full_name') {
            $schedulesQuery->select('class_schedules.*')
                ->join('mentors', 'class_schedules.mentor_id', '=', 'mentors.id')
                ->orderByRaw("CONCAT(mentors.last_name, ' ', mentors.first_name) $sortDirection");
        } else {
            $schedulesQuery->orderBy($sortField, $sortDirection);
        }

        if ($searchValue !== '') {
            $schedulesQuery->where(function ($query) use ($searchValue) {
                $query->whereHas('mentor', function ($q) use ($searchValue) {
                    $q->whereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$searchValue}%"]);
                })
                    ->orWhereHas('mentee', function ($q) use ($searchValue) {
                        $q->whereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$searchValue}%"]);
                    })
                    ->orWhere('day_of_week', 'LIKE', "%{$searchValue}%")
                    ->orWhereRaw("DATE_FORMAT(schedule_date, '%Y-%m-%d') LIKE ?", ["%{$searchValue}%"])
                    ->orWhereRaw("TIME_FORMAT(start_time, '%H:%i') LIKE ?", ["%{$searchValue}%"])
                    ->orWhereRaw("TIME_FORMAT(end_time, '%H:%i') LIKE ?", ["%{$searchValue}%"])
                    ->orWhere('status', 'LIKE', "%{$searchValue}%");
            });
        }
        $schedules = $schedulesQuery->paginate($perPage);

        $schedulesData = $schedules->getCollection()->map(function ($schedule) {
            if ($schedule->mentor) {
                $schedule->mentor->full_name = $schedule->mentor->last_name . ' ' . $schedule->mentor->first_name;
            }
            if ($schedule->mentee) {
                $schedule->mentee->full_name = $schedule->mentee->last_name . ' ' . $schedule->mentee->first_name;
            }
            return $schedule;
        });

        return response()->json([
            'data' => $schedulesData,
            'recordsTotal' => $schedules->total(),
            'recordsFiltered' => $schedules->total(),
        ]);
    }








    public function countEntities()
    {
        $currentYear = Carbon::now()->year;
        $startOfYear = Carbon::createFromDate($currentYear, 1, 1);
        $endOfYear = Carbon::createFromDate($currentYear, 12, 31);

        $menteeCount = DB::table('users')
            ->where('role', 'mentee')
            ->whereYear('created_at', $currentYear)
            ->count();

        $mentorCount = DB::table('users')
            ->where('role', 'mentor')
            ->whereYear('created_at', $currentYear)
            ->count();

        $bookedCount = DB::table('class_schedules')
            ->whereBetween('schedule_date', [$startOfYear, $endOfYear])
            ->where('status', 'booked')
            ->count();

        return response()->json([
            'mentee_count' => $menteeCount,
            'mentor_count' => $mentorCount,
            'booked_classes_count' => $bookedCount
        ]);
    }














    public function getMonthlyCounts($role)
{
    if (!in_array($role, ['mentee', 'mentor'])) {
        return response()->json(['error' => 'Invalid role specified'], 400);
    }

    $start = now()->startOfYear();
    $end = now()->endOfYear();

    $monthlyCounts = DB::table('users')
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->where('role', $role)
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get()
        ->pluck('count', 'month')
        ->all();

    $monthlyData = array_fill(1, 12, 0); // 注意这里是从1开始填充，因为月份是从1开始的

    foreach ($monthlyCounts as $month => $count) {
        $monthlyData[$month] = $count; // 直接使用月份作为键，不需要减1
    }

    return response()->json($monthlyData);
}









    public function toggleActivation(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // 確保用戶是 mentor 或 mentee
        if (!in_array($user->role, ['mentor', 'mentee'])) {
            return response()->json(['error' => 'Invalid role'], 400);
        }

        $user->activated = !$user->activated; // 切換激活狀態
        $user->save();

        return response()->json(['success' => 'Activation status toggled']);
    }










    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }




    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }

    public function lockScreen()
    {
        return view('admin.lock-screen');
    }

    public function error404()
    {
        return view('admin.error-404');
    }

    public function error500()
    {
        return view('admin.error-500');
    }

    public function blankPage()
    {
        return view('admin.blank-page');
    }

    public function components()
    {
        return view('admin.components');
    }

    public function formBasicInputs()
    {
        return view('admin.form-basic-inputs');
    }

    public function formInputGroups()
    {
        return view('admin.form-input-groups');
    }

    public function formHorizontal()
    {
        return view('admin.form-horizontal');
    }

    public function formVertical()
    {
        return view('admin.form-vertical');
    }

    public function formMask()
    {
        return view('admin.form-mask');
    }

    public function formValidation()
    {
        return view('admin.form-validation');
    }

    public function tablesBasic()
    {
        return view('admin.tables-basic');
    }

    public function dataTables()
    {
        return view('admin.data-tables');
    }

    public function invoice()
    {
        return view('admin.invoice');
    }
}
