<?php $page = "profile"; ?>
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
						<li class="breadcrumb-item active" aria-current="page">Mentor Profile</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">Mentor Profile</h2>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10">

				<!-- Mentor Widget -->
				<div class="card">
					<div class="card-body">
						<div class="mentor-widget">
							<div class="user-info-left align-items-center">
								<div class="mentor-img d-flex flex-wrap justify-content-center">
									<div class="pro-avatar">
										<img src="{{ asset('storage/' . ($schedule->avatar_path ?? 'default-avatar.jpg')) }}" alt="User Image" style="width: 100%; height: 100%; object-fit: cover;">
									</div>
									<div class="rating text-center">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
									</div>

								</div>
								<div class="user-info-cont">
									<div class="mentor-details m-0">
										<!-- HTML部分 -->
										<p class="user-location m-0" id="country-placeholder">
											<span id="country-name" class="flag-icon"></span> {{$schedule->country}}
										</p>
									</div>
									<h4 class="usr-name">{{$schedule->last_name}}{{$schedule->first_name}} {{$schedule->gender}}</h4>
									<p class="mentor-type">{{ ucfirst($schedule->role) }}</p>
									<div class="mentor-action">
										<p class="mentor-type social-title">Personal Information</p>
										<a href="javascript:void(0)" class="btn-blue">
											<i class="fas fa-comments"></i>
										</a>
										<a href="chat" class="btn-blue">
											<i class="fas fa-envelope"></i>
										</a>
										<a href="javascript:void(0)" class="btn-blue" data-bs-toggle="modal" data-bs-target="#voice_call">
											<i class="fas fa-phone-alt"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="user-info-right d-flex align-items-end flex-wrap">
								<div class="hireme-btn text-center">
									<span class="hire-rate">$500 / Hour</span>
									<a class="blue-btn-radius" href="{{ route('booking', ['encryptedUserId' => encrypt($schedule->id)]) }}">Booking Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Mentor Widget -->

				<!-- Mentor Details Tab -->
				<div class="card">
					<div class="card-body custom-border-card pb-0">

						<!-- About Details -->
						<div class="widget about-widget custom-about mb-0">
							<h4 class="widget-title">About Me</h4>
							<hr />
							{!! $schedule->about_me !!} <p>
								<!-- /About Details -->
						</div>
					</div>
					<div class="card">
						<div class="card-body custom-border-card pb-0">

<!-- Teaching Experience -->
<div class="widget experience-widget mb-0">
                                <h4 class="widget-title">Teaching Experience</h4>
                                <hr />
                                <div class="experience-box">
                                    <ul class="experience-list profile-custom-list">
                                        <li>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <span>Undergraduate College</span>
                                                    <div class="row-result">Coimbatore University</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <span>Undergraduate Major</span>
                                                    <div class="row-result">Mathematics</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <span>Graduate College</span>
                                                    <div class="row-result">Coimbatore University</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Teaching Experience -->
						</div>
					</div>	
					<div class="card">
						<div class="card-body custom-border-card pb-0">

							<!-- Qualification Details -->
							<div class="widget experience-widget mb-0">
								<h4 class="widget-title">Qualification</h4>
								<hr />
								<div class="experience-box">
									<ul class="experience-list profile-custom-list">
										<li>
											<div class="experience-content">
												<div class="timeline-content">
													<span>Undergraduate College</span>
													<div class="row-result">Coimbatore University</div>
												</div>
											</div>
										</li>
										<li>
											<div class="experience-content">
												<div class="timeline-content">
													<span>Undergraduate Major</span>
													<div class="row-result">Mathematics</div>
												</div>
											</div>
										</li>
										<li>
											<div class="experience-content">
												<div class="timeline-content">
													<span>Graduate College</span>
													<div class="row-result">Coimbatore University</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!-- /Qualification Details -->
							
						</div>
					</div>

					<div class="card">
						<div class="card-body pb-1 custom-border-card" id="youtubeContainer">
							<!-- YouTube 影片將在這裡 -->
						</div>
					</div>

					<!-- /Mentor Details Tab -->

				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->

	@endsection
	@section('scripts')
	<script>
		// 假設從後端獲取的 YouTube URL 存儲在變數中
		var youtubeLink = "{{ $schedule->youtube_link }}"; // Laravel blade 語法
		var video_id = new URLSearchParams(new URL(youtubeLink).search).get("v");

		if (video_id) {
			var iframe = document.createElement('iframe');
			iframe.width = "100%";
			iframe.height = "500";
			iframe.src = "https://www.youtube.com/embed/" + video_id;
			iframe.frameBorder = "0";
			iframe.allowFullscreen = true;

			document.getElementById('youtubeContainer').appendChild(iframe);
		}


		// JavaScript部分
		// 假設您已經有了一個對應國家名稱到國旗圖示的映射
		const countryToFlag = {
			'USA': '🇺🇸',
			'Taiwan': '🇹🇼',
			'台灣': '🇹🇼',
			'Philippines': '🇵🇭',
			'菲律賓': '🇵🇭',
			// ... 其他國家
		};


		// 假設 $schedule->country 的值會被儲存到一個變數中，例如：
		const countryNameFromSchedule = 'Taiwan'; // 這個應該來自 $schedule->country

		// 找到HTML元素並更改它的內容
		const countryNameElement = document.getElementById('country-name');
		countryNameElement.textContent = countryToFlag[countryNameFromSchedule] || countryNameFromSchedule;
	</script>
	@endsection