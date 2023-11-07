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
                        <h1>Register</h1>
                        <p class="account-subtitle">Access to our dashboard</p>

                        <!-- Form -->

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('admin.register.submit') }}" method="POST" id="registerForm">

                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" name="first_name" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" type="submit">Register</button>
                            </div>
                        </form>
                        <!-- /Form -->

                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">or</span>
                        </div>

                        <!-- Social Login -->
                        <div class="social-login">
                            <span>Register with</span>
                            <a href="/redirect-to-facebook" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a>
                        </div>
                        <!-- /Social Login -->

                        <div class="text-center dont-have">Already have an account? <a href="login">Login</a></div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', function(e) {
            const first_name = form['first_name'].value;
            const email = form['email'].value;
            const password = form['password'].value;
            const password_confirmation = form['password_confirmation'].value;
            if (!first_name.match(/^[a-zA-Z0-9]+$/)) {
                alert('名字應只包含字母和數字。');
                e.preventDefault();
            }

            if (!email.match(/\S+@\S+\.\S+/)) {
                alert('請輸入有效的電子郵件地址。');
                e.preventDefault();
            }

            if (password === '' || password_confirmation === '') {
                alert('密碼和確認密碼不能為空。');
                e.preventDefault();
            } else if (password !== password_confirmation) {
                alert('密碼和確認密碼不相符。');
                e.preventDefault();
            }
        });
        
    });
</script>

@endsection