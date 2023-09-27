<?php $page = "search"; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-8 col-12">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Search</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">2245 matches found for : Mentors In Florida</h2>
			</div>
			<div class="col-md-4 col-12 d-md-block d-none">
				<div class="sort-by">
					<span class="sort-title">Sort by</span>
					<span class="sortby-fliter">
						<select class="select">
							<option>Select</option>
							<option class="sorting">Rating</option>
							<option class="sorting">Popular</option>
							<option class="sorting">Latest</option>
							<option class="sorting">Free</option>
						</select>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

				<!-- Search Filter -->
				<div class="card search-filter">
					<div class="card-header">
						<h4 class="card-title mb-0">Search Filter</h4>
					</div>
					<div class="card-body">
						<div class="filter-widget">
							<div class="cal-icon">
								<input type="text" class="form-control datetimepicker" placeholder="Select Date">
							</div>
						</div>
						<div class="filter-widget">


							<input type="text" class="form-control" placeholder="Search by Mentor Name" name="mentor_name">
						</div>

						<div class="filter-widget">
							<h4>Gender</h4>
							<div>
								<label class="custom_check">
									<input type="radio" name="gender_type" value="male" checked>
									<span class="checkmark"></span> Male
								</label>
							</div>
							<div>
								<label class="custom_check">
									<input type="radio" name="gender_type" value="female">
									<span class="checkmark"></span> Female
								</label>
							</div>
						</div>
						<div class="filter-widget">
							<h4>Select Courses</h4>
							<div>
								<label class="custom_check">
									<input type="checkbox" name="select_specialist" checked>
									<span class="checkmark"></span> Digital Marketer

								</label>
							</div>
							<div>
								<label class="custom_check">
									<input type="checkbox" name="select_specialist" checked>
									<span class="checkmark"></span> UNIX, Calculus, Trigonometry
								</label>
							</div>
							<div>
								<label class="custom_check">
									<input type="checkbox" name="select_specialist">
									<span class="checkmark"></span> Computer Programming
								</label>
							</div>
							<div>
								<label class="custom_check">
									<input type="checkbox" name="select_specialist">
									<span class="checkmark"></span> ASP.NET,Computer Gaming
								</label>
							</div>
							<div>
								<label class="custom_check">
									<input type="checkbox" name="select_specialist">
									<span class="checkmark"></span> HTML, Css
								</label>
							</div>
							<div>
								<label class="custom_check">
									<input type="checkbox" name="select_specialist">
									<span class="checkmark"></span> VB, VB.net
								</label>
							</div>
						</div>
						<div class="btn-search">
							<button type="button" class="btn btn-block w-100">Search</button>
						</div>
					</div>
				</div>
				<!-- /Search Filter -->

			</div>

			<div class="col-md-12 col-lg-8 col-xl-9">

				<!-- Mentor Widget -->
				@foreach($mentors as $mentor)
				<div class="card">
					<div class="card-body">
						<div class="mentor-widget">
							<div class="user-info-left">
								<div class="mentor-img">
									<a href="{{ url('profile/' . $mentor->id) }}">
										<img src="{{ asset('storage/' . ($mentor->avatar_path ?? 'default-avatar.jpg')) }}" class="img-fluid" alt="User Image" >

									</a>
								</div>
								<div class="user-info-cont">
									<h4 class="usr-name"><a href="{{ url('profile/' . $mentor->id) }}">{{ $mentor->last_name }}{{ $mentor->first_name }}</a></h4>
									
									<p class="mentor-type">{{ $mentor->specialty }}</p>
									<div class="rating">
										<!-- 這裡插入評分的HTML或Blade代碼 -->
									</div>
									<div class="mentor-details">
										<p class="user-location"><i class="fas fa-map-marker-alt"></i> {{ $mentor->location }}</p>
									</div>
								</div>
							</div>
							<!-- 其他信息，如有需要 -->
						</div>
					</div>
				</div>
				@endforeach

				<div class="load-more text-center">
					<a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a>
				</div>
			</div>
		</div>

	</div>

</div>
<!-- /Page Content -->
@endsection