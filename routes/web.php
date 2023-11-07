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
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MenteebookingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\PaymentPlanController;



//購買方案
Route::get('/paymentplan', [PaymentPlanController::class, 'index']);
Route::get('/checkout/{id?}', [PaymentPlanController::class, 'checkout']);

//顯示Mentor的自我介紹
Route::get('/profile/{userId?}', [AuthController::class, 'index'])->name('profile');


Route::get('/mentor_bookings', [MenteebookingController::class, 'showMentorBookings'])->name('mentor.bookings');

//Mentor行事曆
Route::get('/schedule-timings', [ScheduleController::class, 'showSchedule'])->name('schedule-timings');
Route::post('/schedule-timings', [ScheduleController::class, 'saveSchedule'])->name('save-schedule');
Route::middleware(['auth'])->group(function () {
    Route::get('/getschedule', [ScheduleController::class, 'getScheduleJson']);
});

//更新行事曆的狀態
Route::post('/handle-schedule', [ScheduleController::class, 'handleSchedule']);



//學生預約表
Route::get('/booking/{encryptedUserId}', [BookingController::class, 'show'])->name('booking')->middleware('auth');
Route::get('/get-class-schedule/{mentorId}', [BookingController::class, 'getClassSchedule'])->middleware('auth');;
Route::post('/update-booking-status', [BookingController::class, 'updateBookingStatus'])->middleware('auth');;
Route::post('/batch-update-booking-status', [BookingController::class, 'batchUpdate'])->middleware('auth');;




//Mentee預約名單
Route::get('/getBookingsForMentee', [ClassScheduleController::class, 'getBookingsForMentee']);
Route::get('/getBookingsForMentor', [ClassScheduleController::class, 'getBookingsForMentor']);



// 聊天室
Route::get('/chat', [ChatController::class, 'chatView'])->name('chatView')->middleware('auth');
Route::post('/api/sendMessage', [ChatController::class, 'sendMessage'])->name('sendMessage')->middleware('auth');
Route::get('/api/getMessages', [ChatController::class, 'getMessages'])->name('getMessages')->middleware('auth');
Route::get('/api/getUserName', [ChatController::class, 'getUserName'])->middleware('auth');

// 當訪問/search時，調用SearchMentorController的index方法
Route::get('/search', [SearchMentorController::class, 'index'])->name('search.index')->middleware('auth');
Route::post('/getMentors', [SearchMentorController::class, 'getMentors'])->name('getMentors');





// 定義一個 GET 路由，用於發送測試郵件
// 當用戶訪問 "/send-test-email" 時，會執行這個閉包函數
Route::get('/send-test-email', function () {
    Mail::to('recipient@example.com')->send(new ActivationEmail(0));

    return 'Test email sent!';
});
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


//激活碼
// Route::get('activate/{code}', 'Auth\ActivationController@activate');

//logviewer
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');



//Mentor_Bookings
Route::get('/bookings_mentor', function () {
    return view('bookings_mentor');
})->name('bookings_mentor');









// 當用戶訪問 '/home' 時，將會自動重定向到根路徑 '/'
Route::redirect('/home', '/');
// 當用戶訪問 '/index' 時，也將自動重定向到根路徑 '/'
Route::redirect('/index', '/');
// 定義根路徑 '/' 的 GET 請求，當訪問此路徑時，將返回 'index' 視圖
Route::get('/', function () {
    return view('index');
})->name('page'); // 給這個路由命名為 'page'，以便在應用程序的其他部分參照此路由




Route::get('/dashboard_mentor', function () {
    return view('dashboard_mentor');
})->name('dashboard_mentor');









Route::get('/mentee-list', function () {
    return view('mentee-list');
})->name('mentee-list');
Route::get('/profile-mentee', function () {
    return view('profile-mentee');
})->name('profile-mentee');



// Route::get('/blog', function () {
//     return view('blog');
// })->name('blog');
// Route::get('/blog-details', function () {
//     return view('blog-details');
// })->name('blog-details');
// Route::get('/add-blog', function () {
//     return view('add-blog');
// })->name('add-blog');
// Route::get('/edit-blog', function () {
//     return view('edit-blog');
// })->name('edit-blog');

// Route::get('/chat', function () {
//     return view('chat');
// })->name('chat');

// Route::get('/invoices', function () {
//     return view('invoices');
// })->name('invoices');
// Route::get('/profile-settings', function () {
//     return view('profile-settings');
// })->name('profile-settings');
// Route::get('/reviews', function () {
//     return view('reviews');
// })->name('reviews');
// Route::get('/mentor-register', function () {
//     return view('mentor-register');
// })->name('mentor-register');
// Route::get('/map-grid', function () {
//     return view('map-grid');
// })->name('map-grid');
// Route::get('/map-list', function () {
//     return view('map-list');
// })->name('map-list');




// Route::get('/search', function () {
//     return view('search');
// })->name('search');





// Route::get('/profile', function () {
//     return view('profile');
// })->name('profile');






// Route::get('/bookings_mentee', function () {
//     return view('bookings_mentee');
// })->name('bookings_mentee');




// Route::get('/checkout', function () {
//     return view('checkout');
// })->name('checkout');
// Route::get('/booking-success', function () {
//     return view('booking-success');
// })->name('booking-success');



// Route::get('/dashboard_mentee', function () {
//     return view('dashboard_mentee');
// })->name('dashboard_mentee');


// Route::get('/favourites', function () {
//     return view('favourites');
// })->name('favourites');
// Route::get('/chat-mentee', function () {
//     return view('chat-mentee');
// })->name('chat-mentee');

// Route::get('/profile-settings-mentee', function () {
//     return view('profile-settings-mentee');
// })->name('profile-settings-mentee');

// Route::get('/change-password', function () {
//     return view('change-password');
// })->name('change-password');
// Route::get('/voice-call', function () {
//     return view('voice-call');
// })->name('voice-call');
// Route::get('/video-call', function () {
//     return view('video-call');
// })->name('video-call');
// Route::get('/components', function () {
//     return view('components');
// })->name('components');
// Route::get('/invoice-view', function () {
//     return view('invoice-view');
// })->name('invoice-view');
// Route::get('/blank-page', function () {
//     return view('blank-page');
// })->name('blank-page');

// Route::get('/login', function () {
//     return view('login');
// })->name('login');


// Route::get('/register', function () {
//     return view('register');
// })->name('register');


Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');




// Route::get('/blog-list', function () {
//     return view('blog-list');
// })->name('blog-list');
// Route::get('/blog-grid', function () {
//     return view('blog-grid');
// })->name('blog-grid');
// Route::get('/appointments', function () {
//     return view('appointments');
// })->name('appointments');






// Route::get('/mentee-register', function () {
//     return view('mentee-register');
// })->name('mentee-register');


















/*****************ADMIN ROUTES*******************/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\BlogController;






//用臉書登入但不成功 晚一點在試
Route::get('/redirect-to-facebook', [SocialAuthController::class, 'redirectToFacebook']);
Route::get('/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);


//mentee , mentor 整合版
Route::post('toggle-activation/{id}', [AdminController::class, 'toggleActivation']);
//admin取得所有mentee,mentor
Route::get('/get-users/{role}', [AdminController::class, 'getUsersByRole']);

//所有課程
Route::get('/get-class-schedules', [AdminController::class, 'getClassSchedules']);

//儀表板功能 1104
Route::get('/counts', [AdminController::class, 'countEntities']);
// Route::get('/${role}/monthly-counts', [AdminController::class, 'getMonthlyMenteeCounts']);
Route::get('/{role}s/monthly-counts', [AdminController::class, 'getMonthlyCounts']);



//Admin 切換mentee的狀況
Route::post('change-mentee-status/{id}', [AdminController::class, 'changeStatus']);
//Admin 切換mentor的狀況
Route::post('change-mentor-status/{id}', [AdminController::class, 'changeStatus']);







// 添加這個路由來處理表單提交
Route::post('/update-website', [WebsiteController::class, 'update']);

// 對於不需要任何中間件的路由，Admin登入
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin-login');
Route::post('/admin/ajax-login', [AdminController::class, 'ajaxLogin'])->name('ajax-login');
// 在 routes/web.php 或 routes/api.php
Route::get('translations', [TranslationController::class, 'index']);






//admin註冊頁面
Route::get('/admin/register', [AdminController::class, 'register'])->name('register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');
Route::post('/admin/change-password', [AdminController::class, 'changePassword']);
Route::post('/admin/update-profile', [AdminController::class, 'updateProfile']);




//需要中間路由 Admin開頭
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    //Admin登出
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin-logout');
    //Admin的簡介
    Route::get('/profile/{id}', [AdminController::class, 'profile'])->name('adminprofile');
    
    
    
    
    // 使用資源路由而不是單獨的路由
    Route::resource('blog', BlogController::class)->names([
        'index' => 'admin.blog',
        'create' => 'admin.add-blog',
        'store' => 'admin.add-blog',
        'show' => 'admin.blog.show',
        'edit' => 'admin.edit-blog',
        'update' => 'admin.blog.update',
        'destroy' => 'admin.blog.destroy',
    ]);
    










    Route::get('/index_admin', [AdminController::class, 'indexAdmin'])->name('page');
    Route::get('/mentor', [AdminController::class, 'mentor'])->name('mentor');
    Route::get('/mentee', [AdminController::class, 'mentee'])->name('mentee');
    Route::get('/booking-list', [AdminController::class, 'bookingList'])->name('booking-list');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/transactions-list', [AdminController::class, 'transactionsList'])->name('transactions-list');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::get('/invoice-report', [AdminController::class, 'invoiceReport'])->name('invoice-report');




    // Route::get('/blog-details', [AdminController::class, 'blogDetails'])->name('blog-details');
    // Route::get('/add-blog', [AdminController::class, 'addBlog'])->name('add-blog');
    // Route::get('/edit-blog', [AdminController::class, 'editBlog'])->name('edit-blog');





    Route::get('/forgot-password', [AdminController::class, 'forgotPassword'])->name('forgot-password');
    Route::get('/lock-screen', [AdminController::class, 'lockScreen'])->name('lock-screen');
    Route::get('/error-404', [AdminController::class, 'error404'])->name('error-404');
    Route::get('/error-500', [AdminController::class, 'error500'])->name('error-500');
    Route::get('/blank-page', [AdminController::class, 'blankPage'])->name('blank-page');
    Route::get('/components', [AdminController::class, 'components'])->name('components');
    Route::get('/form-basic-inputs', [AdminController::class, 'formBasicInputs'])->name('form-basic-inputs');
    Route::get('/form-input-groups', [AdminController::class, 'formInputGroups'])->name('form-input-groups');
    Route::get('/form-horizontal', [AdminController::class, 'formHorizontal'])->name('form-horizontal');
    Route::get('/form-vertical', [AdminController::class, 'formVertical'])->name('form-vertical');
    Route::get('/form-mask', [AdminController::class, 'formMask'])->name('form-mask');
    Route::get('/form-validation', [AdminController::class, 'formValidation'])->name('form-validation');
    Route::get('/tables-basic', [AdminController::class, 'tablesBasic'])->name('tables-basic');
    Route::get('/data-tables', [AdminController::class, 'dataTables'])->name('data-tables');
    Route::get('/invoice', [AdminController::class, 'invoice'])->name('invoice');
});

/********************ADMIN ROUTES END******************************/
