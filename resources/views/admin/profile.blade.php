@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">My Profile</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
						<li class="breadcrumb-item active">My Profile</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-md-12">
				<div class="profile-header">
					<div class="row align-items-center">
						<div class="col-auto profile-image">
							<a href="#">
								<img src="{{ asset('storage/' . (Auth::user()->avatar_path ?? 'default-avatar.jpg')) }}" width="31" alt="{{ Auth::user()->first_name }}">
							</a>
						</div>
						<div class="col ml-md-n2 profile-user-info">
							<h4 class="user-name mb-0">{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</h4>
							<h6 class="text-muted">{{ Auth::user()->email }}</h6>
							<div class="pb-3"><i class="fa fa-map-marker"></i> {{ Auth::user()->city }}</div>
							<div class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
						</div>
						<div class="col-auto profile-btn">
						</div>
					</div>
				</div>
				<div class="profile-menu">
					<ul class="nav nav-tabs nav-tabs-solid">
						<li class="nav-item">
							<a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
						</li>
					</ul>
				</div>
				<div class="tab-content profile-tab-cont">

					<!-- Personal Details Tab -->
					<div class="tab-pane fade show active" id="per_details_tab">

						<!-- Personal Details -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title d-flex justify-content-between">
											<span>Personal Details</span>
											<a class="edit-link" data-bs-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
										</h5>
										<div class="row">
											<p class="col-sm-2 text-muted mb-0 mb-sm-3">Name</p>
											<p class="col-sm-10">{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</p>
										</div>
										<div class="row">
											<p class="col-sm-2 text-muted mb-0 mb-sm-3">Date of Birth</p>
											<p class="col-sm-10">{{ Auth::user()->date_of_birth }}</p>
										</div>
										<div class="row">
											<p class="col-sm-2 text-muted mb-0 mb-sm-3">Email ID</p>
											<p class="col-sm-10">{{ Auth::user()->email }}</p>
										</div>
										<div class="row">
											<p class="col-sm-2 text-muted mb-0 mb-sm-3">Mobile</p>
											<p class="col-sm-10">{{ Auth::user()->mobile }}</p>
										</div>
										<div class="row">
											<p class="col-sm-2 text-muted mb-0">Address</p>
											<p class="col-sm-10 mb-0">{{ Auth::user()->address }}<br>

										</div>
									</div>
								</div>


							</div>


						</div>
						<!-- /Personal Details -->

					</div>
					<!-- /Personal Details Tab -->

					<!-- Change Password Tab -->
					<div id="password_tab" class="tab-pane fade">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Change Password</h5>
								<div class="row">
									<div class="col-md-10 col-lg-6">
										<form id="change-password-form">
											<div class="form-group">
												<label>Old Password</label>
												<input type="password" name="old_password" class="form-control">
											</div>
											<div class="form-group">
												<label>New Password</label>
												<input type="password" name="new_password" class="form-control">
											</div>
											<div class="form-group">
												<label>Confirm Password</label>
												<input type="password" name="confirm_password" class="form-control">
											</div>
											<button class="btn btn-primary" type="submit">Save Changes</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Change Password Tab -->

				</div>
			</div>
		</div>

	</div>
</div>
<!-- /Page Wrapper -->
<!-- Edit Details Modal -->
<div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Personal Details</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="editPersonalDetailsForm" enctype="multipart/form-data">
					<div class="row form-row">
						<!-- 在这里添加一个新的div来容纳头像上传功能 -->
						<div class="col-12">
							<div class="form-group">
								<label>Avatar</label>
								<input type="file" name="avatar" id="avatar" class="form-control">
								<!-- 添加这个 img 元素用于预览 -->
								<img id="avatarPreview" src="#" alt="your image" style="display:none;" />
							</div>
						</div>

						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Date of Birth</label>
								<div class="cal-icon">
									<input type="text" name="date_of_birth" class="form-control" value="{{ Auth::user()->date_of_birth }}">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Email ID</label>
								<input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Mobile</label>
								<input type="text" name="mobile" value="{{ Auth::user()->mobile }}" class="form-control" value="{{ Auth::user()->mobile }}">
							</div>
						</div>
						<div class="col-12">
							<h5 class="form-title"><span>Address</span></h5>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>City</label>
								<input type="text" name="city" class="form-control" value="{{ Auth::user()->city }}">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>State</label>
								<input type="text" name="state" class="form-control" value="{{ Auth::user()->state }}">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Zip Code</label>
								<input type="text" name="zip_code" class="form-control" value="22434">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Country</label>
								<input type="text" name="country" class="form-control" value="United States">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Details Modal -->
@endsection
@section('scripts')
<script>
	// 封裝成函數，處理更新個人信息表單提交
	function handleUpdateProfileForm() {
		const form = document.getElementById("editPersonalDetailsForm");
		form.addEventListener("submit", function(e) {
			e.preventDefault();
			const formData = new FormData(form);
			sendFetchRequest("/admin/update-profile", formData)
				.then(() => {
					$('#edit_personal_details').modal('hide'); // 關閉模態窗口
					alert("資料更新成功");
				})
				.catch((error) => {
					console.error("Error:", error);
					alert("資料更新失敗");
				});
		});
	}




	// 封裝成函數，發送 Fetch 請求
	function sendFetchRequest(apiEndpoint, data, contentType = 'multipart/form-data') {
		const headers = {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
		};

		if (contentType !== 'multipart/form-data') {
			headers['Content-Type'] = contentType;
		}

		return fetch(apiEndpoint, {
				method: "POST",
				body: data,
				headers: headers,
			})
			.then(response => {
				if (!response.ok) {
					return Promise.reject("Our backend server is down.");
				}
				return response.json();
			});
	}


		// 封裝成函數，處理更改密碼表單提交
		function handleChangePasswordForm() {
    const form = document.querySelector("#change-password-form");  // 使用 id 來選擇表單
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        const oldPassword = form['old_password'].value;
        const newPassword = form['new_password'].value;
        const confirmPassword = form['confirm_password'].value;

        // 新密碼和確認密碼不匹配
        if (newPassword !== confirmPassword) {
            alert("新密碼和確認密碼不匹配");
            return;
        }

        const data = {
            old_password: oldPassword,
            new_password: newPassword,
            new_password_confirmation: confirmPassword
        };

        sendFetchRequest("/admin/change-password", JSON.stringify(data), 'application/json')
        .then((response) => {
            // 根据后端返回的数据进行判断
            if (response.status === 'success') {
                alert("密碼已成功更改");
                // 回到 About 的Tab
                document.querySelector('[href="#per_details_tab"]').click();
            } else if (response.status === 'error') {
                if (response.reason === 'Incorrect old password') {
                    alert("舊密碼不正確");
                } else {
                    alert("更改密碼失敗");
                }
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("更改密碼失敗");
        });
    });
}


	// DOM 完全加載後執行
	document.addEventListener("DOMContentLoaded", function() {
		handleUpdateProfileForm();
		handleChangePasswordForm();
	});
</script>
@endsection