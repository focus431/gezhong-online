<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Mail\ActivationEmail;
use App\Http\Controllers\Auth\ActivationController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SearchMentorController;  // 確保你引入了MentorController
use App\Http\Controllers\ScheduleController;  // 用您實際的控制器名稱替換 "YourController"

//Mentor行事曆
Route::get('/schedule-timings', [ScheduleController::class, 'showSchedule'])->name('schedule-timings');
Route::post('/schedule-timings', [ScheduleController::class, 'saveSchedule'])->name('save-schedule');
Route::middleware(['auth'])->group(function () {
Route::get('/getschedule', [ScheduleController::class, 'getScheduleJson']);});

//更新行事曆的狀態
Route::post('/updateschedule/{id}', [ScheduleController::class, 'updateStatus']);





// 當訪問/search時，調用MentorController的index方法
Route::get('/search', [SearchMentorController::class, 'index']);  


// 定義一個 GET 路由，用於發送測試郵件
// 當用戶訪問 "/send-test-email" 時，會執行這個閉包函數
Route::get('/send-test-email', function () {Mail::to('recipient@example.com')->send(new ActivationEmail(0));
    
    return 'Test email sent!';});
    // 使用 Mail 類的 to 方法指定收件人，然後使用 send 方法發送 ActivationEmail 郵件
    // 這裡假設 ActivationEmail 的構造函數接受一個參數，我們傳入 0 作為示例

// --------------------------------------------------------------------------


// 定義一個 GET 路由，用於激活用戶帳戶
// 當用戶訪問 "/activate-account/{激活碼}" 時，
// 會調用 AuthController 控制器中的 "activateAccount" 方法

// 使用完全限定名（FQCN）
// Route::get('/activate-account/{activationCode}', [ActivationController::class, 'activateAccount']);
// 在 web.php
Route::get('/activate/{activationCode}', [ActivationController::class, 'activateAccount']);




//更新profile
Route::post('/profile-settings-mentee', function (Request $request, AuthController $controller) {
    return $controller->updateProfile($request);
});

Route::post('/profile-settings-mentor', function (Request $request, AuthController $controller) {
    return $controller->updateProfile($request);
});


// 註冊路由
Route::post('/mentee-register', [AuthController::class, 'menteeRegister']);
Route::post('/mentor-register', [AuthController::class, 'mentorRegister']);

// 登入路由
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');


Route::get('/profile-settings-mentor', [AuthController::class, 'showProfileSettingsMentor'])->middleware('auth');
Route::get('/profile-settings-mentee', [AuthController::class, 'showProfileSettingsMentee'])->middleware('auth');

//登出
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout']);


// //激活碼
// Route::get('activate/{code}', 'Auth\ActivationController@activate');

//logviewer
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');












Route::get('/', function () {
        return view('index');
    })->name('pagee');
    
    Route::get('/home', function () {
        return view('index');
    })->name('pagee');

Route::get('/index', function () {
    return view('index');
})->name('pagee');


Route::get('/dashboard-mentor', function () {
    return view('dashboard-mentor');
})->name('dashboard-mentor');


Route::get('/bookings', function () {
    return view('bookings');
})->name('bookings');






Route::get('/mentee-list', function () {
    return view('mentee-list');
})->name('mentee-list');
Route::get('/profile-mentee', function () {
    return view('profile-mentee');
})->name('profile-mentee');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');
Route::get('/blog-details', function () {
    return view('blog-details');
})->name('blog-details');
Route::get('/add-blog', function () {
    return view('add-blog');
})->name('add-blog');
Route::get('/edit-blog', function () {
    return view('edit-blog');
})->name('edit-blog');
Route::get('/chat', function () {
    return view('chat');
})->name('chat');
Route::get('/invoices', function () {
    return view('invoices');
})->name('invoices');
Route::get('/profile-settings', function () {
    return view('profile-settings');
})->name('profile-settings');
Route::get('/reviews', function () {
    return view('reviews');
})->name('reviews');
Route::get('/mentor-register', function () {
    return view('mentor-register');
})->name('mentor-register');
Route::get('/map-grid', function () {
    return view('map-grid');
})->name('map-grid');
Route::get('/map-list', function () {
    return view('map-list');
})->name('map-list');




// Route::get('/search', function () {
//     return view('search');
// })->name('search');





Route::get('/profile', function () {
    return view('profile');
})->name('profile');
Route::get('/bookings-mentee', function () {
    return view('bookings-mentee');
})->name('bookings-mentee');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');
Route::get('/booking-success', function () {
    return view('booking-success');
})->name('booking-success');



Route::get('/dashboard-mentee', function () {
    return view('dashboard-mentee');
})->name('dashboard-mentee');


Route::get('/favourites', function () {
    return view('favourites');
})->name('favourites');
Route::get('/chat-mentee', function () {
    return view('chat-mentee');
})->name('chat-mentee');

// Route::get('/profile-settings-mentee', function () {
//     return view('profile-settings-mentee');
// })->name('profile-settings-mentee');

Route::get('/change-password', function () {
    return view('change-password');
})->name('change-password');
Route::get('/voice-call', function () {
    return view('voice-call');
})->name('voice-call');
Route::get('/video-call', function () {
    return view('video-call');
})->name('video-call');
Route::get('/components', function () {
    return view('components');
})->name('components');
Route::get('/invoice-view', function () {
    return view('invoice-view');
})->name('invoice-view');
Route::get('/blank-page', function () {
    return view('blank-page');
})->name('blank-page');

// Route::get('/login', function () {
//     return view('login');
// })->name('login');


Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');
Route::get('/blog-list', function () {
    return view('blog-list');
})->name('blog-list');
Route::get('/blog-grid', function () {
    return view('blog-grid');
})->name('blog-grid');
Route::get('/appointments', function () {
    return view('appointments');
})->name('appointments');
Route::get('/booking', function () {
    return view('booking');
})->name('booking');


Route::get('/mentee-register', function () {
    return view('mentee-register');
})->name('mentee-register');



/*****************ADMIN ROUTES*******************/
Route::Group(['prefix' => 'admin'], function () { 
Route::get('/index_admin', function () {
return view('admin.index_admin');
})->name('page');
Route::get('/mentor', function () {
return view('admin.mentor');
})->name('mentor');
Route::get('/mentee', function () {
return view('admin.mentee');
})->name('mentee');
Route::get('/booking-list', function () {
return view('admin.booking-list');
})->name('booking-list');
Route::get('/categories', function () {
return view('admin.categories');
})->name('categories');
Route::get('/transactions-list', function () {
return view('admin.transactions-list');
})->name('transactions-list');
Route::get('/settings', function () {
return view('admin.settings');
})->name('settings');
Route::get('/invoice-report', function () {
return view('admin.invoice-report');
})->name('invoice-report');
Route::get('/profile', function () {
return view('admin.profile');
})->name('profile');
Route::get('/blog', function () {
return view('admin.blog');
})->name('blog');
Route::get('/blog-details', function () {
return view('admin.blog-details');
})->name('blog-details');
Route::get('/add-blog', function () {
return view('admin.add-blog');
})->name('add-blog');
Route::get('/edit-blog', function () {
return view('admin.edit-blog');
})->name('edit-blog');


Route::get('/amin-login', function () {
return view('admin.login');
})->name('admin-login');




Route::get('/register', function () {
return view('admin.register');
})->name('register');
Route::get('/forgot-password', function () {
return view('admin.forgot-password');
})->name('forgot-password');
Route::get('/lock-screen', function () {
return view('admin.lock-screen');
})->name('lock-screen');
Route::get('/error-404', function () {
return view('admin.error-404');
})->name('error-404');
Route::get('/error-500', function () {
return view('admin.error-500');
})->name('error-500');
Route::get('/blank-page', function () {
return view('admin.blank-page');
})->name('blank-page');
Route::get('/components', function () {
return view('admin.components');
})->name('components');
Route::get('/form-basic-inputs', function () {
return view('admin.form-basic-inputs');
})->name('form-basic-inputs');
Route::get('/form-input-groups', function () {
return view('admin.form-input-groups');
})->name('form-input-groups');
Route::get('/form-horizontal', function () {
return view('admin.form-horizontal');
})->name('form-horizontal');
Route::get('/form-vertical', function () {
return view('admin.form-vertical');
})->name('form-vertical');
Route::get('/form-mask', function () {
return view('admin.form-mask');
})->name('form-mask');
Route::get('/form-validation', function () {
return view('admin.form-validation');
})->name('form-validation');
Route::get('/tables-basic', function () {
return view('admin.tables-basic');
})->name('tables-basic');
Route::get('/data-tables', function () {
return view('admin.data-tables');
})->name('data-tables');
Route::get('/invoice', function () {
return view('admin.invoice');
})->name('invoice');
});
/********************ADMIN ROUTES END******************************/