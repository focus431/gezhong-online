<?php $page = "schedule-timings"; ?>
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
						<li class="breadcrumb-item active" aria-current="page">Schedule Timings</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">Schedule Timings</h2>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

				<!-- Sidebar -->
				<div class="profile-sidebar">
				@include('layout.partials.sidebar')
				</div>
				<!-- /Sidebar -->

			</div>

			<div class="col-md-7 col-lg-8 col-xl-9">

				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Schedule Timings</h4>
								<div class="profile-box">
									<div class="row">
										<div class="col-md-12">
											<div class="card schedule-widget mb-0">

												<!-- Schedule Header -->
												<div class="schedule-header">
													<!-- New 5-course-name tabs -->
													<!-- <div class="schedule-nav course-nav">
														<ul class="nav nav-tabs nav-justified">
															@foreach($courses as $course)
															<li class="nav-item">
																<a class="nav-link" data-tab-type="course" data-active="false" data-course-id="{{ $course->id }}" href="#slot_{{ $course->name }}">{{ $course->name }}</a>
															</li>
															@endforeach
														</ul>
													</div> -->

													<!-- Schedule Nav -->
													<div class="schedule-nav">
														<ul class="nav nav-tabs nav-justified">

															<li class="nav-item">
																<a class="nav-link" data-tab-type="day" data-active="false" href="#slot_monday">Monday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-tab-type="day" data-active="false" href="#slot_tuesday">Tuesday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-tab-type="day" data-active="false" href="#slot_wednesday">Wednesday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-tab-type="day" data-active="false" href="#slot_thursday">Thursday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-tab-type="day" data-active="false" href="#slot_friday">Friday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-tab-type="day" data-active="false" href="#slot_saturday">Saturday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-tab-type="day" data-active="false" href="#slot_sunday">Sunday</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<h4 class="card-title d-flex justify-content-between">
									<span>Time Slots</span>
									<a class="edit-link" data-bs-toggle="modal" href="#edit_time_slot"><i class="fa fa-edit mr-1"></i>Edit</a>
								</h4>
							</div>
						</div>
					</div>
					<div class="card booking-schedule schedule-widget">
						<!-- Schedule Header -->
						<div class="schedule-header">
							<div class="row">
								<div class="col-md-12">
									<!-- Day Slot -->
									<div class="day-slot">
										<div class="row">

											<!--顯示今天的日期跟週幾-->
											<div class="col-12 col-sm-4 col-md-6">
												<h4 class="mb-1" id="current-date"></h4>
												<p class="text-muted" id="current-day"></p>
												@foreach ($classSchedules as $schedule)
												<p>{{ $schedule->schedule_date}}-{{ $schedule->day_of_week }} - {{ $schedule->start_time }} to {{ $schedule->end_time }}-{{ $schedule->status}}</p>
												@endforeach
											</div>
											<div class="row">
												<div class="col-md-1 d-flex justify-content-start">
													<!-- 左箭头 -->
													<div class="arrow-buttons">
														<button id="prevWeek" class="btn custom-btn">←</button>
													</div>
												</div>
												<div class="col-md-1 d-flex justify-content-end">
													<!-- 右箭头 -->
													<div class="arrow-buttons">
														<button id="nextWeek" class="btn custom-btn">→</button>
													</div>
												</div>
											</div>

										</div>
										<!-- Schedule Widget -->
										<div class="card booking-schedule schedule-widget">
											<!-- Schedule Header -->
											<div class="schedule-header">
												<div class="row align-items-center">

													<div class="col-md-12">
														<!-- Day Slot -->
														<div class="day-slot">
															<ul id="day-list">
																<!-- Your list items here -->
															</ul>
														</div>
													</div>

												</div>
											</div>
										</div>

									</div>
									<!-- /Day Slot -->
								</div>
							</div>
							<!-- Time Slot -->
							<div class="timing-container">
								<div class="time-slot">
									<ul id="time-list" class="clearfix no-bullets">
										<!-- 這裡會動態生成時間區段 -->
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script>
	let timingElements = {}; // 用於存儲每個時段對應的 DOM 元素

	document.addEventListener('DOMContentLoaded', function() {
		let needToUpdate = true;
		let eventListenerAdded = false;
		// 初始化基础设置和时间段
		basicInitialization();
		// 初始化选项卡点击事件
		initializeTabClicks();
		// 初始化保存更改按钮点击事件
		initializeSaveChanges();

		// 从服务器获取并比较时间表
		fetchAndCompareSchedules();
		// 生成接下来的七天的日期
		generateNextSevenDays();



		function createTimingElement(hour, minute) {
			const aElement = document.createElement("a");
			aElement.classList.add("timing");
			aElement.href = "#";

			const spanElement = document.createElement("span");
			const timeStart = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
			const timeEndHour = minute + 25 >= 60 ? hour + 1 : hour;
			const timeEndMinute = (minute + 25) % 60;
			const timeEnd = `${String(timeEndHour).padStart(2, '0')}:${String(timeEndMinute).padStart(2, '0')}`;

			spanElement.textContent = `${timeStart} - ${timeEnd}`;
			aElement.appendChild(spanElement);

			return aElement;
		}







		// 基础初始化
		function basicInitialization() {
			setCurrentDateAndDay();

			// 定義當前的開始日期為今天
			let currentStartDate = new Date();
			const weeklyParentElement = document.querySelector(".time-slot");
			generateNextSevenDays(currentStartDate);


			// 监听左右箭头点击事件
			setupWeekNavigation(currentStartDate, generateNextSevenDays);
		}


		// 设置周导航
		function setupWeekNavigation(currentStartDate, callback) {
			document.getElementById('prevWeek').addEventListener('click', function() {
				// 添加條件以防止導航到今天以前的日期
				if (moment(currentStartDate).isAfter(moment(), 'day')) {
					moveDateByDays(currentStartDate, -7);
					needToUpdate = true; // 設置為 true 以觸發更新
					if (needToUpdate) {
						fetchAndCompareSchedules();
						needToUpdate = false; // 重設標誌
					}
					console.log("Updated currentStartDate:", currentStartDate);
					callback(currentStartDate);
					updateTimings(currentStartDate); // 更新 time-slot 和 time-list
					fetchAndCompareSchedules(); // 重新获取和比较时间表
				}
			});

			document.getElementById('nextWeek').addEventListener('click', function() {
				moveDateByDays(currentStartDate, 7);
				needToUpdate = true; // 設置為 true 以觸發更新
				if (needToUpdate) {
					fetchAndCompareSchedules();
					needToUpdate = false; // 重設標誌
				}
				console.log("Updated currentStartDate:", currentStartDate);
				callback(currentStartDate);
				updateTimings(currentStartDate); // 更新 time-slot 和 time-list
				fetchAndCompareSchedules(); // 重新获取和比较时间表
			});
		}


		// 新增一個函數來更新 time-slot 和 time-list
		function updateTimings(startDate) {
			const timeListElement = document.querySelector("#time-list"); // 假設這是你的 time-list 的父元素

			// 清空目前的 time-list
			timeListElement.innerHTML = '';

			// 這裡重新生成 time-list，並為每個項目添加新的 data-date
			// ...（這取決於你具體的需求和 generateDailyTimings 函數的實現）
		}


		// 移动日期
		function moveDateByDays(date, days) {
			date.setDate(date.getDate() + days);
		}

		// 设置当前日期和天
		function setCurrentDateAndDay() {
			const dateElement = document.querySelector('.mb-1'); // h4 元素
			const dayElement = document.querySelector('#current-day'); // p 元素

			const now = new Date();
			const options = {
				year: 'numeric',
				month: 'long',
				day: 'numeric'
			};
			const formattedDate = now.toLocaleDateString('en-US', options);
			const formattedDay = now.toLocaleDateString('en-US', {
				weekday: 'long'
			});

			dateElement.textContent = formattedDate;
			dayElement.textContent = formattedDay;
		}

		// 生成接下来的七天
		function generateNextSevenDays(start = new Date()) {
			const ulElement = document.querySelector('.day-slot ul');

			// 如果 start 是 moment 對象，轉換為 JavaScript Date 對象
			if (moment.isMoment(start)) {
				start = start.toDate();
			}

			const now = new Date(start);

			// 移除現有的 li 元素（如果有的話）
			ulElement.innerHTML = '';

			for (let i = 0; i < 7; i++) {
				const liElement = document.createElement('li');
				const spanElement1 = document.createElement('span');
				const spanElement2 = document.createElement('span');
				const smallElement = document.createElement('small');

				spanElement1.textContent = now.toLocaleDateString('en-US', {
					weekday: 'short'
				});
				spanElement2.textContent = `${now.getDate()} ${now.toLocaleDateString('en-US', { month: 'short' })} `;
				smallElement.textContent = now.getFullYear();
				spanElement2.appendChild(smallElement);

				liElement.appendChild(spanElement1);
				liElement.appendChild(spanElement2);

				ulElement.appendChild(liElement);

				// 檢查是否為今天的日期，根據結果添加或移除相應樣式
				const currentDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
				const today = new Date();

				if (currentDate.toDateString() === today.toDateString()) {
					liElement.style.backgroundColor = "#1e88e5";
					liElement.style.color = "white";
				} else {
					liElement.style.backgroundColor = '';
					liElement.style.color = '';
				}

				// 增加一天
				now.setDate(now.getDate() + 1);
			}
		}

		// 生成周时间
		function generateWeeklyTimings(startHour, endHour, parentElement) {
			// 遍历每一天（从周一到周日）
			const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
			days.forEach(day => {

				// 创建一个单一的li元素
				const liElement = document.createElement("li");
				liElement.style.listStyleType = "none";
				liElement.classList.add(day);

				// 遍历每个小时
				for (let hour = startHour; hour < endHour; hour++) {

					// 两个时段：一个在小时开始，另一个在半小时
					[0, 30].forEach(minute => {
						const aElement = document.createElement("a");
						aElement.classList.add("timing");
						aElement.href = "#";

						const spanElement = document.createElement("span");
						const timeStart = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
						const timeEndHour = minute + 25 >= 60 ? hour + 1 : hour;
						const timeEndMinute = (minute + 25) % 60;
						const timeEnd = `${String(timeEndHour).padStart(2, '0')}:${String(timeEndMinute).padStart(2, '0')}`;

						spanElement.textContent = `${timeStart} - ${timeEnd}`;
						aElement.appendChild(spanElement);

						liElement.appendChild(aElement);
					});
				}

				// 将 li 元素添加到父元素
				parentElement.appendChild(liElement);
			});
		}

		// 生成每日时刻表
		function generateDailyTimings(date, dayOfWeek, startHour, endHour, parentElement) {
			const liElement = document.createElement("li");
			liElement.classList.add('day-timing');
			liElement.classList.add(dayOfWeek); // 添加星期幾作為類別
			liElement.setAttribute('data-date', date.toDateString()); // 設置日期

			for (let hour = startHour; hour < endHour; hour++) {
				[0, 30].forEach(minute => {
					const aElement = createTimingElement(hour, minute);
					liElement.appendChild(aElement);
				});
			}

			parentElement.appendChild(liElement);


			// 初始化时间选择器
			initCalendarTiming();
		}






		function updateTimings(startDate) {
			const timeListElement = document.querySelector("#time-list"); // 假設這是你的 time-list 的父元素

			// 清空目前的 time-list
			timeListElement.innerHTML = '';

			// 為接下來的七天生成時刻表
			const dates = Array.from({
				length: 7
			}, (_, i) => {
				const date = new Date(startDate);
				date.setDate(date.getDate() + i);
				return date;
			});

			// 重新生成 time-list
			dates.forEach(date => {
				const dayOfWeek = date.toLocaleDateString('en-US', {
					weekday: 'long'
				}); // 獲取星期幾
				generateDailyTimings(date, dayOfWeek, 8, 18, timeListElement);
			});
		}







		// Generate the list of next seven days
		const startDate = new Date(); // 從今天開始
		const dates = Array.from({
			length: 7
		}, (_, i) => {
			const date = new Date(startDate);
			date.setDate(date.getDate() + i);
			return date;
		});

		// 假設 parentElement 是你要將時刻表插入的 DOM 元素
		const parentElement = document.getElementById('time-list');

		// 為接下來的七天生成時刻表
		dates.forEach(date => {
			const dayOfWeek = date.toLocaleDateString('en-US', {
				weekday: 'long'
			}); // 獲取星期幾
			generateDailyTimings(date, dayOfWeek, 8, 24, parentElement);
		});







		// 创建单个时刻元素
		function createTimingElement(hour, minute) {
			const aElement = document.createElement("a");
			aElement.classList.add("timing");
			aElement.href = "#";

			const spanElement = document.createElement("span");
			const timeStart = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
			const timeEndHour = minute + 25 >= 60 ? hour + 1 : hour;
			const timeEndMinute = (minute + 25) % 60;
			const timeEnd = `${String(timeEndHour).padStart(2, '0')}:${String(timeEndMinute).padStart(2, '0')}`;

			spanElement.textContent = `${timeStart} - ${timeEnd}`;
			aElement.appendChild(spanElement);

			return aElement;
		}


		// 初始化时间时段
		function initializeTimeSlots() {
			createTimeOptionsForInitialSlot();
			document.getElementById('addSlot').addEventListener('click', addNewTimeSlot);
			document.getElementById('timeSlots').addEventListener('click', removeTimeSlot);
		}

		// 创建时间选项
		function createTimeOptions(element, startHour = 0, endHour = 24, interval = 30, offset = 0) {
			let currentTime = startHour * 60 + offset; // 轉為分鐘
			const endTime = endHour * 60; // 轉為分鐘
			while (currentTime < endTime) {
				const hour = Math.floor(currentTime / 60);
				const minute = currentTime % 60;
				const option = new Option(`${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`);
				element.add(option);
				currentTime += interval;
			}
		}

		// 为初始时间段创建时间选项
		function createTimeOptionsForInitialSlot() {
			const initialTimeSlot = document.querySelector('.timeSlot');
			createTimeOptions(initialTimeSlot.querySelector('.startTime'), 8, 24, 30); // 25分鐘課程 + 5分鐘休息 = 30分鐘
			createTimeOptions(initialTimeSlot.querySelector('.endTime'), 8, 24, 30, 25); // 從 08:25 開始

		}
		// Bootstrap 的模態框顯示事件
		$('#edit_time_slot').on('shown.bs.modal', function() {
			initializeTimeSlots();
		});
		// 添加新的时间段
		function addNewTimeSlot() {
			const initialTimeSlot = document.querySelector('.timeSlot');
			const newTimeSlot = initialTimeSlot.cloneNode(true);
			createTimeOptions(newTimeSlot.querySelector('.startTime'), 8, 24, 30);
			createTimeOptions(newTimeSlot.querySelector('.endTime'), 8, 24, 30, 25);
			document.getElementById('timeSlots').appendChild(newTimeSlot);
		}

		// 移除时间段
		function removeTimeSlot(e) {
			if (e.target.classList.contains('removeSlot')) {
				e.target.closest('.timeSlot').remove();
			}
		}








		// 初始化选项卡点击事件
		function initializeTabClicks() {
			const activeDays = [];
			const activeCourses = [];
			document.querySelectorAll('.nav-link').forEach(tab => {
				tab.addEventListener('click', function(e) {
					e.preventDefault();
					toggleTab(this, this.getAttribute('data-tab-type') === 'day' ? activeDays : activeCourses);
				});
			});
		}

		// 切换选项卡状态
		function toggleTab(tab, activeArray) {
			const isActive = tab.getAttribute('data-active') === 'true';
			const tabValue = tab.textContent.trim();
			tab.classList.toggle('active');
			tab.setAttribute('data-active', String(!isActive));
			const index = activeArray.indexOf(tabValue);
			if (index > -1) {
				activeArray.splice(index, 1);
			} else {
				activeArray.push(tabValue);
			}
		}

		// 初始化保存更改按钮点击事件
		function initializeSaveChanges() {
			document.getElementById('saveChanges').addEventListener('click', function() {
				const activeDays = getActiveDays(); // 获取选定的日期
				if (activeDays.length === 0) {
					alert('Please select a day of the week first!');
					return;
				}
				const timeSlots = Array.from(document.querySelectorAll('.timeSlot')).map(slot => ({
					start_time: slot.querySelector('.startTime').value,
					end_time: slot.querySelector('.endTime').value,
					day_of_week: getActiveDays() // 需要你自己实现这个函数
				}));

				// 检查 start_time 和 end_time 是否相同或者 start_time 是否大于等于 end_time
				for (const slot of timeSlots) {
					if (slot.start_time === slot.end_time) {
						alert("The start time cannot be the same as the end time."); // 或者你可以使用其他提示方式
						return; // 提前退出函数，不进行后续的 saveChanges 调用
					}

					if (slot.start_time >= slot.end_time) {
						alert("The start time must be less than the end time."); // 或者你可以使用其他提示方式
						return; // 提前退出函数，不进行后续的 saveChanges 调用
					}
				}

				saveChanges(timeSlots, getActiveDays()); // 需要你自己实现这个函数
			});
		}





		// 获取选定的日期
		function getActiveDays() {
			return getActiveTabValues('.nav-link[data-tab-type="day"]');
		}

		// 获取选定选项卡的值
		function getActiveTabValues(selector) {
			return Array.from(document.querySelectorAll(selector))
				.filter(tab => tab.getAttribute('data-active') === 'true')
				.map(tab => tab.getAttribute('data-course-id') || tab.textContent.trim());
		}

		// 保存更改
		function saveChanges(timeSlots, activeDays) {
			fetch('/schedule-timings', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					},
					body: JSON.stringify({
						timeSlots,
						activeDays,
						// courseIds: selectedCourses
					})
				})
				.then(response => response.json())
				.then(data => console.log('成功：', data))
				.catch(error => console.error('错误：', error));
			$('#edit_time_slot').modal('hide');
		}


		// 切换选项卡

		function initCalendarTiming() {
			if (eventListenerAdded) {
				return;
			}
			const parentElement = document.getElementById('time-list');
			parentElement.addEventListener("click", handleSchedule);
			eventListenerAdded = true;
		}



		// 監聽第一個 li 元素
		const ulElement = document.querySelector('.day-slot ul');
		const firstLiElement = ulElement.querySelector('li:first-child');

		// 獲取第二個 span 元素
		const secondSpanElement = firstLiElement.querySelector('span:nth-child(2)');

		// 監聽 span 元素的值變化
		let previousDate = secondSpanElement.textContent; // 保存之前的日期

		function checkDateChange() {
			const currentDate = secondSpanElement.textContent;

			// 檢查日期是否變化
			if (currentDate === previousDate) {
				// 日期沒有變化，可以保持原樣式
				firstLiElement.style.backgroundColor = '';
				firstLiElement.style.color = '';
			} else {
				// 日期變化了，設定新樣式
				const currentSpanDate = new Date().toLocaleDateString('en-US', {
					month: 'short'
				}) + ' ' + new Date().getDate();
				if (currentDate === currentSpanDate) {
					firstLiElement.style.backgroundColor = "#1e88e5";
					firstLiElement.style.color = "white";
				} else {
					firstLiElement.style.backgroundColor = '';
					firstLiElement.style.color = '';
				}
			}

			// 更新之前的日期
			previousDate = currentDate;
		}

		// 監聽 span 元素的值變化
		setInterval(checkDateChange, 1000); // 每秒檢查一次









		// 定義兩個變量來保存當前的開始日期和結束日期
		let currentStart = moment().subtract(6, 'days'); // 初始開始日期
		let currentEnd = moment(); // 初始結束日期

		// 函數：初始化日期選擇器
		// function initializeBookingRangePicker() {
		//     if ($('.bookingrange').length > 0) {
		//         let today = moment();

		//         function booking_range(start, end) {
		//             $('.bookingrange span').html(start.format('MMMM D, YYYY'));
		//         }

		//         $('.bookingrange').daterangepicker({
		//             startDate: today,
		//             endDate: today,
		//             ranges: {
		//                 'Today': [today, today] // 只保留 "Today"
		//             },
		//             minDate: today // 設置最小日期為今天
		//         }, booking_range);

		//         booking_range(today, today);

		//         // Special handler for the "Today" button
		//         $(document).on('click', '.daterangepicker .ranges li[data-range-key="Today"]', function() {
		//             $('.bookingrange').data('daterangepicker').setStartDate(today);
		//             $('.bookingrange').data('daterangepicker').setEndDate(today);
		//             booking_range(today, today); // Update the span content
		//         });
		//     }
		// }

		// 調用這個函數以初始化日期選擇器
		// initializeBookingRangePicker();


		// 函數：向前移動7天
		function moveBackwardSevenDays() {
			currentStart.subtract(7, 'days');
			currentEnd.subtract(7, 'days');
			$('.bookingrange').data('daterangepicker').setStartDate(currentStart);
			$('.bookingrange').data('daterangepicker').setEndDate(currentEnd);
		}

		// 函數：向後移動7天
		function moveForwardSevenDays() {
			currentStart.add(7, 'days');
			currentEnd.add(7, 'days');
			$('.bookingrange').data('daterangepicker').setStartDate(currentStart);
			$('.bookingrange').data('daterangepicker').setEndDate(currentEnd);
		}





		// 格式化時間，只保留時和分
		function formatTime(time) {
			const parts = time.split(':');
			return `${parts[0]}:${parts[1]}`;
		}

		// 從後端獲取時間表並進行比對
		async function fetchAndCompareSchedules() {
			try {
				// 從後端獲取資料
				const response = await fetch('/getschedule');
				if (!response.ok) {
					throw new Error('Network response was not ok');
				}
				const schedules = await response.json();
				console.log(schedules);

				// 創建查找表
				const lookup = {};

				// 獲取前端HTML中的day和time list
				const dayList = document.querySelectorAll('.day-timing');

				// 填充查找表
				dayList.forEach(dayElement => {
					const frontendDate = new Date(dayElement.getAttribute('data-date')).toLocaleDateString();
					const timeElements = dayElement.querySelectorAll('.timing');
					timeElements.forEach(timeElement => {
						const timeRange = timeElement.textContent.trim().split(' - ');
						const frontendStartTime = formatTime(timeRange[0]);
						const frontendEndTime = formatTime(timeRange[1]);
						const key = `${frontendDate}-${frontendStartTime}-${frontendEndTime}`;
						lookup[key] = timeElement;
					});
				});

				// 進行比對
				schedules.forEach(schedule => {
					const backendDate = new Date(schedule.schedule_date).toLocaleDateString();
					const backendStartTime = formatTime(schedule.start_time);
					const backendEndTime = formatTime(schedule.end_time);
					const key = `${backendDate}-${backendStartTime}-${backendEndTime}`;

					const matchingElement = lookup[key];
					if (matchingElement) {
						matchingElement.setAttribute('data-id', schedule.id); // 無論如何都設置 data-id
						if (schedule.status === 'available') {
							matchingElement.classList.add('selected');
						}
					} else {
						console.log('No match');
					}

				});

			} catch (error) {
				console.error('Error fetching or processing data:', error);
			}
		}
















		async function handleSchedule(event) {
			const target = event.target;

			if (target.matches(".timing, .timing *")) {
				event.preventDefault();
				const timing = target.closest(".timing");

				// 切換 'selected' 類
				if (timing.classList.contains('selected')) {
					timing.classList.remove('selected');
				} else {
					timing.classList.add('selected');
				}

				// 獲取所需數據
				const listItem = timing.closest('.day-timing');
				const existingDate = listItem.getAttribute('data-date');
				const existingDateObject = new Date(existingDate); // 创建日期对象

				// 获取日期的年、月、日
				const year = existingDateObject.getFullYear();
				const month = existingDateObject.getMonth() + 1; // 月份从 0 开始，所以要加 1
				const day = existingDateObject.getDate();

				// 格式化日期为 "YYYY-MM-DD" 形式
				const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

				const dayOfWeek = listItem.className.split(' ')[1];
				const [startTime, endTime] = timing.querySelector("span").textContent.split(' - ');

				console.log(existingDateObject); // 输出日期对象（Carbon 主机时间）
				console.log(formattedDate); // 输出格式化后的日期字符串




				// 組成對象
				const dataToSend = {
					existing_date: formattedDate,
					day_of_week: dayOfWeek,
					start_time: startTime,
					end_time: endTime,
					is_recurring: 0,
					status: timing.classList.contains('selected') ? 'available' : 'unavailable'
				};

				const url = '/handle-schedule'; // 新的整合後的路由
				const method = 'POST';

				try {
					const response = await fetch(url, {
						method,
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: JSON.stringify(dataToSend),
					});

					const data = await response.json();
					console.log("Data received from server:", data);

					if (response.status === 200) {
						console.log('Operation successful:', data);
						timing.setAttribute('data-id', data.id); // 更新或設置 data-id
					} else {
						console.error('Operation failed:', data);
					}
				} catch (error) {
					console.error('Error:', error);
				}
			}
		}

		function initCalendarTiming() {
			if (eventListenerAdded) {
				return;
			}
			const parentElement = document.getElementById('time-list');
			parentElement.addEventListener("click", handleSchedule);
			eventListenerAdded = true;
		}


















	});
</script>
@endsection