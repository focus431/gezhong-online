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

				<h2 class="breadcrumb-title" id="breadcrumb-title"></h2>
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
				<a href="dashboard_mentee">
					<i class="fas fa-long-arrow-alt-left"></i> <span>Back</span>
				</a>
				<!-- Search Filter -->
				<div class="card search-filter">
					<div class="card-header">
						<h4 class="card-title mb-0">Search Filter</h4>
					</div>
					<div class="card-body">
						<div class="filter-widget">
							<div class="cal-icon">
								<input type="text" class="form-control datetimepicker" placeholder="Select Date" name='date'>
							</div>
						</div>
						<div class="filter-widget">
							<input type="text" class="form-control" placeholder="Search by Mentor Name" name="mentor_name">
						</div>
						<div class="filter-widget">
							<h4>Gender</h4>
							<div>
								<label class="custom_check">
									<input type="radio" name="gender_type" value="male">
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
						<!-- 在 Blade 模板中的课程复选框区域 -->
						<div class="filter-widget" id="courseFilter" data-courses="{{ $courses->toJson() }}">
							<h4>Select Courses</h4>
							<!-- 课程复选框将在此处动态生成 -->
						</div>
						<div class="btn-search">
							<button type="button" class="btn btn-block w-100">Search</button>
						</div>
					</div>
				</div>
				<!-- /Search Filter -->
			</div>
			<div class="col-md-12 col-lg-8 col-xl-9">




				<!-- 在這裡添加一個 mentorListContainer div -->
				<div id="mentorListContainer">
					<!-- 原本的 mentor 卡片會在這裡生成 -->
				</div>


				@if($paginatedMentors->currentPage() > $paginatedMentors->lastPage())
				<!-- 显示当前页超过最后一页的提示或处理 -->
				@endif
				<div class="load-more text-center">
					{{ $paginatedMentors->links('pagination::bootstrap-4') }}
				</div>

				
			</div>
		</div>

	</div>

</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script>
	// 定義基礎 URL
	var baseUrl = "{{ asset('storage/') }}";

	// 在DOM加载完毕后执行
	document.addEventListener("DOMContentLoaded", function() {
		initializeCourseFilter();
		fetchMentorsWithPage();
		addSearchButtonEventListener();
	});

	function initializeCourseFilter() {
		// 讀取儲存在 HTML data-* 屬性的 $courses JSON
		var courseFilter = document.getElementById("courseFilter");
		var courses = JSON.parse(courseFilter.getAttribute("data-courses"));
		populateCourseFilter(courses, courseFilter);
	}

	function populateCourseFilter(courses, courseFilter) {
		courses.forEach(function(course) {
			var divElement = createCourseElement(course);
			// 將 div 添加到過濾器區域
			courseFilter.appendChild(divElement);
		});
	}

	function createCourseElement(course) {
		// 創建 div 元素
		var divElement = document.createElement("div");

		// 創建 label 元素並設置其屬性和內容
		var labelElement = document.createElement("label");
		labelElement.className = "custom_check";
		labelElement.appendChild(createInputElement(course));
		labelElement.appendChild(createSpanElement());
		labelElement.appendChild(document.createTextNode(" " + course.name));

		// 將 label 添加到 div
		divElement.appendChild(labelElement);

		return divElement;
	}

	function createInputElement(course) {
		// 創建 input 元素
		var inputElement = document.createElement("input");
		inputElement.type = "checkbox";
		inputElement.name = "select_specialist";
		inputElement.id = "course_" + course.id;
		inputElement.value = course.id;

		return inputElement;
	}

	function createSpanElement() {
		// 創建 span 元素
		var spanElement = document.createElement("span");
		spanElement.className = "checkmark";

		return spanElement;
	}

	function addSearchButtonEventListener() {
		document.querySelector('.btn-search').addEventListener('click', function() {
			fetchMentorsWithPage();
		});
	}

	function fetchMentorsWithPage(page = 1) {
		var filters = collectFilters();
		performFetch(filters, page);
	}

	function collectFilters() {
		var filters = {};
		var gender = getSelectedGender();
		var selectedCourses = getSelectedCourses();
		var date = getSelectedDate();
		var mentorName = getMentorName();

		if (gender) filters.gender = gender;
		if (selectedCourses.length > 0) filters.courses = selectedCourses;
		if (date) filters.date = date;
		if (mentorName) filters.name = mentorName;

		return filters;
	}

	function getSelectedGender() {
		var genderElement = document.querySelector('input[name="gender_type"]:checked');
		return genderElement ? genderElement.value : null;
	}

	function getSelectedCourses() {
		return Array.from(document.querySelectorAll('input[name="select_specialist"]:checked')).map(function(input) {
			return input.value;
		});
	}

	function getSelectedDate() {
		return document.querySelector('input[name="date"]').value;
	}

	function getMentorName() {
		return document.querySelector('input[name="mentor_name"]').value;
	}





	function performFetch(filters, page) {
		fetch('/getMentors', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify({
					...filters,
					page: page
				})
			})
			.then(response => response.json())
			.then(data => populateMentors(data));
	}






	function populateMentors(data) {
    const mentors = data.mentors;
    const encryptedMentorIds = data.encryptedMentorIds;
    const pagination = data.pagination;

    const mentorListContainer = document.getElementById('mentorListContainer');
    mentorListContainer.innerHTML = '';

    mentors.forEach((mentor, index) => {
        const mentorCard = createMentorCard(mentor, encryptedMentorIds[index]);
        mentorListContainer.appendChild(mentorCard);
    });

    // 更新總匹配數
    document.getElementById('breadcrumb-title').innerText = `${pagination.total} matches found`;

    // 添加分頁控件
    let paginationHtml = `<ul class="pagination">`;
    for (let i = 1; i <= pagination.last_page; i++) {
        paginationHtml += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
    }
    paginationHtml += `</ul>`;
    document.querySelector('.load-more').innerHTML = paginationHtml;

    // 添加事件監聽器
    document.querySelectorAll('.page-link').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            fetchMentorsWithPage(parseInt(this.getAttribute('data-page')));
        });
    });
}









	function createMentorCard(mentor, encryptedMentorId) {
		// 以下代碼會根据每个 mentor 生成一個完全一樣樣式的 mentor 卡片
		const mentorCard = document.createElement('div');
		mentorCard.className = 'card';
		mentorCard.id = 'mentorCard' + mentor.id;

		const cardBody = document.createElement('div');
		cardBody.className = 'card-body';

		const mentorWidget = document.createElement('div');
		mentorWidget.className = 'mentor-widget';

		const userInfoLeft = document.createElement('div');
		userInfoLeft.className = 'user-info-left';

		const mentorImg = document.createElement('div');
		mentorImg.className = 'mentor-img';

		const aTag = document.createElement('a');
		aTag.href = 'profile.html';

		const imgElement = document.createElement('img');
		imgElement.src = baseUrl + '/' + (mentor.avatar_path ? mentor.avatar_path : 'default-avatar.jpg');
		imgElement.width = 145;
		imgElement.alt = 'User Image';

		aTag.appendChild(imgElement);
		mentorImg.appendChild(aTag);

		const userInfoCont = document.createElement('div');
		userInfoCont.className = 'user-info-cont';

		const h4Tag = document.createElement('h4');
		h4Tag.className = 'usr-name';
		h4Tag.innerHTML = `<a href="profile-settings-mentor#${mentor.id}">${mentor.last_name}${mentor.first_name}</a>`;

		const pTag = document.createElement('p');
		pTag.className = 'mentor-type';

		const ratingDiv = document.createElement('div');
		ratingDiv.className = 'rating';
		ratingDiv.innerHTML = `
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star"></i>
        <span class="d-inline-block average-rating">(27)</span>
    `;

		const mentorDetails = document.createElement('div');
		mentorDetails.className = 'mentor-details';
		mentorDetails.innerHTML = `<p class="user-location"><i class="fas fa-map-marker-alt"></i> ${mentor.city}, ${mentor.country}</p>`;

		userInfoCont.appendChild(h4Tag);
		userInfoCont.appendChild(pTag);
		userInfoCont.appendChild(ratingDiv);
		userInfoCont.appendChild(mentorDetails);

		userInfoLeft.appendChild(mentorImg);
		userInfoLeft.appendChild(userInfoCont);

		const userInfoRight = document.createElement('div');
		userInfoRight.className = 'user-info-right';

		const userInfos = document.createElement('div');
		userInfos.className = 'user-infos';
		userInfos.innerHTML = `
        <ul>
            <li><i class="far fa-comment"></i> 35 Feedback</li>
            <li><i class="fas fa-map-marker-alt"></i> ${mentor.city}, ${mentor.country}</li>
            <li><i class="far fa-money-bill-alt"></i> $100 - $400 <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="Lorem Ipsum"></i></li>
        </ul>
    `;

		const mentorBooking = document.createElement('div');
		mentorBooking.className = 'mentor-booking';
		mentorBooking.innerHTML = `<a class="apt-btn" href="/booking/${encryptedMentorId}">Book Appointment</a>`;

		userInfoRight.appendChild(userInfos);
		userInfoRight.appendChild(mentorBooking);

		mentorWidget.appendChild(userInfoLeft);
		mentorWidget.appendChild(userInfoRight);

		cardBody.appendChild(mentorWidget);

		mentorCard.appendChild(cardBody);

		return mentorCard;
	}
</script>
@endsection