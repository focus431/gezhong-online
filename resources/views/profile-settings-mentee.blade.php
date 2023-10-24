<?php $page = "profile-settings-mentee"; ?>
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
										<label>性別</label>
										<select class="form-control select form-select" name="gender">
											<option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>男</option>
											<option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>女</option>
											<option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>其他</option>
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
										<label>State</label>
										<input type="text" name="state" class="form-control" value="{{ $user->state }}">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Zip Code</label>
										<input type="text" name="zip_code" class="form-control" value="{{ $user->zip_code }}">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Country</label>
										<input type="text" name="country" class="form-control" value="{{ $user->country }}">
									</div>
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