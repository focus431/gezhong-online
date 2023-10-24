<?php $page = "profile-settings-mentor"; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">Profile Settings</h2>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">

			<!-- Profile Sidebar -->
			<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

				<!-- Sidebar -->
				<div class="profile-sidebar">
					@include('layout.partials.sidebar')
				</div>
				<!-- /Sidebar -->

			</div>
			<!-- /Profile Sidebar -->

			<div class="col-md-7 col-lg-8 col-xl-9">
				<div class="card">
					<div class="card-body">

						<!-- Profile Settings Form -->
						<form id="profile-form" enctype="multipart/form-data">

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@csrf
							<div class="row form-row">
								<div class="col-12 col-md-12">
									<div class="form-group">
										<div class="change-avatar">
											<div class="profile-img">
											</div>
											<div class="upload-img">
												<div class="change-photo-btn">
													<span><i class="fa fa-upload"></i> Upload Photo</span>
													<input type="file" name="avatar" class="upload">

												</div>
												<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Date of Birth</label>
										<div class="cal-icon">
											<input type="date" name="date_of_birth" class="form-control datetimepicker" value="{{ $user->date_of_birth }}">
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Gender</label>
										<select class="form-control select form-select" name="gender">
											<option value="Male" {{ $user->gender == 'male' ? 'selected' : '' }}>男</option>
											<option value="Female" {{ $user->gender == 'female' ? 'selected' : '' }}>女</option>
											<option value="Other" {{ $user->gender == 'other' ? 'selected' : '' }}>其他</option>
										</select>
									</div>
								</div>


								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Email ID</label>
										<input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>

									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Mobile</label>
										<input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Google Meet Code</label>
										<input type="text" name="google_meet_code" class="form-control" value="{{ $user->google_meet_code }}">
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Address</label>
										<input type="text" name="address" class="form-control" value="{{ $user->address }}">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>City</label>
										<input type="text" name="city" class="form-control" value="{{ $user->city }}">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Country</label>
										<input type="text" name="country" class="form-control" value="{{ $user->country }}">
									</div>
								</div>
							</div>
							<!-- Education Background -->
							<div class="col-12">
								<div class="form-group">
									<label>Education Background</label>
									<textarea name="education_background" class="form-control">{{ $user->education_background }}</textarea>
								</div>
							</div>

							<!-- YouTube Embed -->
							<div class="col-12">
								<div class="form-group">
									<label>YouTube Link</label>
									<input type="text" name="youtube_link" id="youtube_link" class="form-control" value="{{ $user->youtube_link }}">
									<!-- 預覽區塊 -->
									<div id="youtube_preview"></div>
								</div>
							</div>

							<!-- About Me -->
							<div class="col-12">
								<div class="form-group">
									<label>About Me</label>
									<textarea id="about_me_editor" name="about_me" class="form-control">{!! e($user->about_me) !!}</textarea>
								</div>
							</div>
							<div class="submit-section">
								<button type="button" id="save-changes" class="btn btn-primary submit-btn">Save Changes</button>
							</div>
						</form>
						<!-- /Profile Settings Form -->

					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/ni5bamd3fda2nr4wtw85yjukd1nvwz52cu03mggezs53ti8z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
	var formData;
	document.addEventListener('DOMContentLoaded', function() {

		tinymce.init({
  selector: '#about_me_editor',
  init_instance_callback: function(editor) {
    // 現在您可以安全地使用 editor.getContent() 或 tinymce.get('about_me_editor').getContent()
    const editorContent = editor.getContent();
    // ...
  }
});

		
		// 初始化 YouTube 預覽
		function initializeYoutubePreview() {
			const existingYoutubeLink = document.getElementById('youtube_link').value;
			if (existingYoutubeLink) {
				updateYoutubePreview(existingYoutubeLink);
			}
		}

		// 更新 YouTube 預覽
		function updateYoutubePreview(link) {
			const match = link.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?([\w\-]+)/);
			if (match) {
				const embedCode = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${match[1]}" frameborder="0" allowfullscreen></iframe>`;
				document.getElementById('youtube_preview').innerHTML = embedCode;
			} else {
				document.getElementById('youtube_preview').innerHTML = '';
			}
		}

		// 監聽 YouTube 鏈接輸入框的變化
		const youtubeLinkElement = document.getElementById('youtube_link');
		if (youtubeLinkElement) {
			youtubeLinkElement.addEventListener('input', function() {
				updateYoutubePreview(this.value);
			});
		}

		initializeYoutubePreview();

		// 獲取 "Save Changes" 按鈕
		const saveChangesBtn = document.getElementById('save-changes');
if (saveChangesBtn) {
    saveChangesBtn.addEventListener('click', function() {
        // 收集表單數據
        formData = new FormData(document.getElementById('profile-form'));
        
        // 獲取 TinyMCE 的內容
        const editorContent = tinymce.get('about_me_editor').getContent();
        
        // 將其添加到 formData 中
        formData.set('about_me', editorContent);

        // 發送 AJAX 請求到 Laravel 後端
        fetch('/profile-settings-mentor', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            alert('Profile updated successfully.'); // 成功提示
        })
        .catch((error) => {
            console.log('Error:', error);
            alert('An error occurred. Please try again.'); // 失敗提示
        });
    });
}

		console.log(formData.get('about_me'));

	});
</script>


@endsection