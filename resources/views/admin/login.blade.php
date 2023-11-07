@extends('layout.mainlayout_admin')
@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper login-body">
	<div class="login-wrapper">
		<div class="container">
			<div class="loginbox">
				<div class="login-left">
					<img class="img-fluid" src="../assets_admin/img/logo-white.png" alt="Logo">
				</div>
				<div class="login-right">
					<div class="login-right-wrap">
						<h1>Login</h1>
						<p class="account-subtitle">Mentor's Dashboard</p>

						<!-- Form -->
						<div class="form-group">
							<input id="email" class="form-control" type="text" placeholder="Email">
						</div>
						<div class="form-group">
							<input id="password" class="form-control" type="password" placeholder="Password">
						</div>
						<div class="form-group">
							<button id="loginButton" class="btn btn-primary btn-block" type="button">Login</button>
						</div>
						<!-- /Form -->

						<div class="text-center forgotpass"><a href="forgot-password">Forgot Password?</a></div>
						<div class="login-or">
							<span class="or-line"></span>
							<span class="span-or">or</span>
						</div>

						<!-- Social Login -->
						<div class="social-login">
							<span>Login with</span>
							<a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a>
						</div>
						<!-- /Social Login -->

						<div class="text-center dont-have">Don’t have an account? <a href="register">Register</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Main Wrapper -->
@endsection
@section('scripts')
<script>
document.getElementById('loginButton').addEventListener('click', function() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // 簡單的前端電子郵件驗證
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
        alert("請輸入有效的電子郵件地址");
        return;
    }

    fetch('/admin/ajax-login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({email, password})
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = `/admin/profile/${data.id}`;
        } else {
            alert(data.message);
        }
    });
});
</script>
@endsection