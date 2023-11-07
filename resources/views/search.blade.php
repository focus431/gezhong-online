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

    let rowGrid; // 用於存放每一行的 mentors

    mentors.forEach((mentor, index) => {
        // 每三個 mentors 就新建一個 row
        if (index % 4 === 0) {
            rowGrid = document.createElement('div');
            rowGrid.className = 'row row-grid';
            mentorListContainer.appendChild(rowGrid);
        }

        const mentorCard = createMentorCard(mentor, encryptedMentorIds[index]);
        rowGrid.appendChild(mentorCard);
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
    

    // // 創建 row-grid
    // const rowGrid = document.createElement('div');
    // rowGrid.className = 'row row-grid';

    // 創建 col-md-6 col-lg-4 col-xl-3
    const colDiv = document.createElement('div');
    colDiv.className = 'col-md-3 col-lg-3 col-xl-3';

    // 創建 profile-widget
    const profileWidget = document.createElement('div');
    profileWidget.className = 'profile-widget';

    // 創建 user-avatar
    const userAvatar = document.createElement('div');
    userAvatar.className = 'user-avatar';

    const avatarLink = document.createElement('a');
    avatarLink.href = `/profile/${mentor.id}`;

    const avatarImg = document.createElement('img');
    avatarImg.className = 'img-fluid';
    avatarImg.alt = 'User Image';
    avatarImg.src = baseUrl + '/' + (mentor.avatar_path ? mentor.avatar_path : 'default-avatar.jpg');

    avatarLink.appendChild(avatarImg);

    const favBtn = document.createElement('a');
    favBtn.href = 'javascript:void(0)';
    favBtn.className = 'fav-btn';

    const favIcon = document.createElement('i');
    favIcon.className = 'far fa-bookmark';

    favBtn.appendChild(favIcon);

    userAvatar.appendChild(avatarLink);
    userAvatar.appendChild(favBtn);

    // 創建 pro-content
    const proContent = document.createElement('div');
    proContent.className = 'pro-content';

    const h3 = document.createElement('h3');
    h3.className = 'title';

    const aProfile = document.createElement('a');
    aProfile.href = `/profile/${mentor.id}`;
    aProfile.textContent = mentor.last_name + mentor.first_name;

    const iVerified = document.createElement('i');
    iVerified.className = 'fas fa-solid fa-user';
		iVerified.style.paddingLeft = '10px';
// 根據 mentor 的 gender 設定顏色
if (mentor.gender === 'Male') {
    iVerified.style.color = 'dodgerblue';  // 鮮藍色
} else if (mentor.gender === 'Female') {
    iVerified.style.color = 'lightcoral';  // 亮紅色
}


    h3.appendChild(aProfile);
    h3.appendChild(iVerified);

    const pSpeciality = document.createElement('p');
    pSpeciality.className = 'speciality';
    pSpeciality.textContent = mentor.speciality ? mentor.speciality : 'No speciality provided';

    const ratingDiv = document.createElement('div');
    ratingDiv.className = 'rating';

    for (let i = 0; i < 5; i++) {
        let star = document.createElement('i');
        star.className = 'fas fa-star filled';
        ratingDiv.appendChild(star);
    }

    const averageRating = document.createElement('span');
    averageRating.className = 'd-inline-block average-rating';
    averageRating.textContent = '(27)';

    ratingDiv.appendChild(averageRating);

    // 創建 available-info
    const availableInfo = document.createElement('ul');
    availableInfo.className = 'available-info';

    const li1 = document.createElement('li');
    const i1 = document.createElement('i');
    i1.className = 'fas fa-map-marker-alt';
    li1.appendChild(i1);
    li1.appendChild(document.createTextNode(` ${mentor.city}, ${mentor.country}`));
    availableInfo.appendChild(li1);

    // const li2 = document.createElement('li');
    // const i2 = document.createElement('i');
    // i2.className = 'far fa-clock';
    // li2.appendChild(i2);
    // li2.appendChild(document.createTextNode(' Available on Fri, 22 Mar'));
    // availableInfo.appendChild(li2);

    const li3 = document.createElement('li');
    const i3 = document.createElement('i');
		i3.className = 'fas fa-book';
    li3.appendChild(i3);
    li3.appendChild(document.createTextNode(' $100 - $400 '));
    
	const iInfo = document.createElement('i');
    // iInfo.className = 'fas fa-info-circle';
    iInfo.setAttribute('data-bs-toggle', 'tooltip');
    iInfo.setAttribute('title', 'Lorem Ipsum');
    li3.appendChild(iInfo);
    availableInfo.appendChild(li3);

    const rowSm = document.createElement('div');
    rowSm.className = 'row row-sm';

    const col6a = document.createElement('div');
    col6a.className = 'col-6';

    const viewProfileBtn = document.createElement('a');
viewProfileBtn.href = `/profile/${mentor.id}`;  // 使用模板字串來插入mentor的id
viewProfileBtn.className = 'btn view-btn';
viewProfileBtn.textContent = 'View Profile';


    col6a.appendChild(viewProfileBtn);

    const col6b = document.createElement('div');
    col6b.className = 'col-6';

    const bookNowBtn = document.createElement('a');
    bookNowBtn.href = `/booking/${encryptedMentorId}`;
    bookNowBtn.className = 'btn book-btn';
    bookNowBtn.textContent = 'Book Now';

    col6b.appendChild(bookNowBtn);

    rowSm.appendChild(col6a);
    rowSm.appendChild(col6b);

    proContent.appendChild(h3);
    proContent.appendChild(pSpeciality);
    proContent.appendChild(ratingDiv);
    proContent.appendChild(availableInfo);
    proContent.appendChild(rowSm);

    profileWidget.appendChild(userAvatar);
    profileWidget.appendChild(proContent);

    colDiv.appendChild(profileWidget);
    // rowGrid.appendChild(colDiv);

    return colDiv;
}
</script>
@endsection