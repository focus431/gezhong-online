@extends('layout.mainlayout')
@section('content')
<!-- Page Content -->
<div class="bg-pattern-style">
	<div class="content">

		<!-- Login Tab Content -->
		<div class="account-content">
			<div class="account-box">
				<div class="login-right">
					<div class="login-header">
						<h3>Login <span>Mentoring</span></h3>
						<p class="text-muted">Access to our dashboard</p>
					</div>
					<div id="login-page"></div>
					<form id="loginForm">
						@csrf
						

						<div class="form-group">
							<label class="form-control-label">Email Address</label>
							<input name="email" type="email" class="form-control" autocomplete="email">
						</div>
						<div class="form-group">
							<label class="form-control-label">Password</label>
							<div class="pass-group">
								<input name="password" type="password" class="form-control pass-input" autocomplete="current-password">
								<span class="fas fa-eye toggle-password"></span>
							</div>
						</div>
						<div class="text-end">
							<a class="forgot-link" href="forgot-password">Forgot Password ?</a>
						</div>
						<button class="btn btn-primary login-btn" type="submit">Login</button>
						<div class="text-center dont-have">Don’t have an account? <a href="mentee-register">Register</a></div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Login Tab Content -->

	</div>

</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script>
    // 初始化計時器
    let loginTimer;

    // 初始化登入狀態
    let isLoggedInOnLogin = false; // 設置初始值為 false

    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');

        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Capture form data
            const formData = new FormData(loginForm);

            // Send Ajax request
            fetch('/login', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // 儲存用戶資料到 localStorage
                        localStorage.setItem('user_data', JSON.stringify(data.user_data));
                        
                        isLoggedIn = true;  // 更新登入狀態

                        // 根據 role 進行導航
                        if (data.role === 'mentee') {
                            window.location.href = '/profile-settings-mentee';
                        } else if (data.role === 'mentor') {
                            window.location.href = '/profile-settings-mentor';
                        }
                    } else {
                        alert(data.message); // 這裡會顯示"Invalid credentials"如果登錄失敗
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // 網頁載入完成後啟動或停用計時器
        window.addEventListener('load', function() {
            // 檢查是否在登入頁面
            if (document.getElementById('login-page')) {
                clearTimeout(loginTimer);  // 停用計時器
                isLoggedInOnLogin = false;  // 設置為未登入
            } else {
                startTimer();  // 啟動計時器
            }
        });
    });
</script>
@endsection
