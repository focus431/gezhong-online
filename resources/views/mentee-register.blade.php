@extends('layout.mainlayout')
@section('content')		
	<div class="content" style="min-height: 68px;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-4 offset-md-4">
						
							<!-- Account Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Mentee Register <a href="mentor-register">Not a Mentee?</a></h3>
										</div>
										
										<!-- Register Form -->
										<form id="mentee-register-form">
											@csrf
											<input type="hidden" name="role" value="mentee">
											<div class="form-group form-focus">
												<input type="email" name="email" class="form-control floating" autocomplete="email">
												<label class="focus-label">Email</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" name="password" class="form-control floating" autocomplete="new-password">
												<label class="focus-label">password</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" name="confirm-password" class="form-control floating" autocomplete="new-password">
												<label class="focus-label">Confirm Password</label>
											</div>
											<div class="text-end">
												<a class="forgot-link" href="login">Already have an account?</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
											<div class="login-or">
												<span class="or-line"></span>
												<span class="span-or">or</span>
											</div>
											<div class="row form-row social-login">
												<div class="col-6">
													<a href="#" class="btn btn-facebook btn-block w-100"><i class="fab fa-facebook-f me-1"></i> Login</a>
												</div>
												<div class="col-6">
													<a href="#" class="btn btn-google btn-block w-100"><i class="fab fa-google me-1"></i> Login</a>
												</div>
											</div>
										</form>
										<!-- /Register Form -->
										
									</div>
								</div>
							</div>
							<!-- /Account Content -->
								
						</div>
					</div>

				</div>

			</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('mentee-register-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            formData.append('role', 'mentee');
            fetch('/mentee-register', { // 請根據您的路由來設定這裡
                method: 'POST',
                redirect: 'follow',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Received data:", data);  // Debug: Log received data
                if (data.success) {
                    alert("激活碼己寄件，請檢查信箱");  // 添加這行來顯示對話框
                    console.log('About to redirect');
                    window.location.href = '/login';
                    console.log('Redirection should have occurred');
                } else {
                    console.log("Registration failed:", data.message);
                }
            })
            .catch(error => {
                console.log("Error:", error);  // Debug: Log any errors
            });
        });
    });
</script>
@endsection
