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
						<li class="breadcrumb-item active" aria-current="page">Booking</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">Booking</h2>

			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-12">

				<div class="card">
					<div class="card-body">
						<div class="booking-user-info">
							<a href="profile" class="booking-user-img">
								<img src="{{ asset('storage/' . $mentor->avatar_path ?? 'default-avatar.jpg') }}" width="145" alt="User Image">
							</a>
							<div class="booking-info">
								<h4><a href="#">{{ $mentor->last_name }} {{ $mentor->first_name }}</a></h4>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star"></i>
								<span class="d-inline-block average-rating">35</span>
							</div>
							<p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> Newyork, USA</p>
						</div>
					</div>

				</div>
			</div>
			<div class="row">
				<a href="/bookings_mentee">
					<i class="fas fa-long-arrow-alt-left"></i> <span>Back</span>
				</a>
			</div>
			<!-- Schedule Widget -->
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
									</div>

									<div class="col-12 col-sm-8 col-md-6 text-sm-end">
										<div class="bookingrange btn btn-white btn-sm mb-3">
											<i class="far fa-calendar-alt me-2"></i>
											<span></span>
											<i class="fas fa-chevron-down ml-2"></i>
										</div>
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
			<!-- /Schedule Widget -->

			<!-- Submit Section -->
			<div class="submit-section proceed-btn text-end">
				<button id="proceedToBook" class="btn btn-primary submit-btn">Proceed To Book</button>
			</div>
			<!-- /Submit Section -->


		</div>
	</div>
</div>

</div>
<!-- /Page Content -->
@endsection

@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		// 在 script 的開頭，定義一個空陣列來保存選擇
		let selectedSlots = [];
		let changedSlots = [];

		let currentStartDate = new Date(); // 當前開始日期
		const timeListElement = document.querySelector("#time-list"); // 時刻表的父元素
		const dayListElement = document.querySelector("#day-list"); // 日期列表的父元素
		const mentorId = "{{ $mentor->id }}"; // 這是從 Laravel 傳過來的 mentorId
		fetchClassSchedule(mentorId); // 初始化時獲取數據
		var loggedInUserId = "{{ $user->id }}";

		function fetchClassSchedule(mentorId) {
			fetch(`/get-class-schedule/${mentorId}`)
				.then(response => response.json())
				.then(data => {
					console.log("Received data:", data);
					updateWeekDays(currentStartDate, data);
				})
				.catch(error => console.error('There was a problem with the fetch:', error));
		}










		function toggleBookingStatus(element, matchedItem) {
			let newStatus = '';
			if (loggedInUserId === mentorId) {
				alert("You cannot book your own time slot.");
				return;
			}

			if (element.classList.contains('selected')) {
				newStatus = 'booked';
			} else if (element.classList.contains('booked')) {
				newStatus = 'selected';
			}

			element.classList.remove('selected', 'booked');
			element.classList.add(newStatus);

			if (newStatus === 'booked') {
				element.style.backgroundColor = '#d6391a';
			} else if (newStatus === 'selected') {
				element.style.backgroundColor = '#1e88e5';
			}

			function formatDate(dateString) {
				const date = new Date(dateString);
				const year = date.getFullYear();
				const month = String(date.getMonth() + 1).padStart(2, '0');
				const day = String(date.getDate()).padStart(2, '0');
				return `${year}-${month}-${day}`;
			}

			const rawScheduleDate = element.closest('.day-timing').dataset.date;
			const scheduleDate = formatDate(rawScheduleDate);
			const payload = {
				mentorId: mentorId,
				scheduleDate: scheduleDate,
				startTime: matchedItem.start_time,
				endTime: matchedItem.end_time,
				newStatus: newStatus === 'booked' ? 'booked' : 'available',
				menteeId: element.classList.contains('booked') ? loggedInUserId : null
			};

			// 更新 selectedSlots
			if (newStatus === 'selected') {
				selectedSlots.push(payload);
			} else if (newStatus === 'booked') {
				selectedSlots = selectedSlots.filter(slot => slot.scheduleDate !== scheduleDate || slot.startTime !== payload.startTime);
			}

			// 更新 changedSlots
			changedSlots.push(payload);
		}





		function updateDateInfo(date) {
			const dateElement = document.getElementById('current-date');
			const formattedDate = date.getFullYear(); // 只獲取年份
			dateElement.textContent = formattedDate;
		}





		function updateWeekDays(startDate, fetchedData) {
			timeListElement.innerHTML = ''; // 清空目前的日期列表
			dayListElement.innerHTML = ''; // 清空目前的天數列表

			const dates = Array.from({
				length: 7
			}, (_, i) => {
				const date = new Date(startDate);
				date.setDate(date.getDate() + i);
				return date;
			});

			dates.forEach(date => {
				const liElement = document.createElement("li");
				liElement.className = 'day-timing';
				liElement.dataset.date = date.toDateString();
				updateTimings(date, liElement, fetchedData);
				timeListElement.appendChild(liElement);

				const liDayElement = document.createElement("li");
				const spanDay = document.createElement("span");
				spanDay.textContent = date.toLocaleDateString('en-US', {
					weekday: 'short'
				});
				const spanDate = document.createElement("span");
				spanDate.textContent = `${date.getMonth() + 1}月${date.getDate()}`;
				liDayElement.appendChild(spanDay);
				liDayElement.appendChild(spanDate);
				dayListElement.appendChild(liDayElement);
			});
		}






		function updateTimings(date, liElement, fetchedData) {
			let startHour = 8;
			let endHour = 18;

			for (let hour = startHour; hour < endHour; hour++) {
				let minute = 0;

				// 將當前日期 (date) 傳遞給 createTimingElement 函數
				const firstElement = createTimingElement(hour, minute, minute + 25, fetchedData, date);
				liElement.appendChild(firstElement);

				minute += 30;

				// 將當前日期 (date) 傳遞給 createTimingElement 函數
				const secondElement = createTimingElement(hour, minute, minute + 25, fetchedData, date);
				liElement.appendChild(secondElement);
			}
		}









		function createTimingElement(hour, startMinute, endMinute, fetchedData, currentDate) {
			const aElement = document.createElement("a");
			aElement.classList.add("timing");

			const spanElement = document.createElement("span");
			const timeStart = `${String(hour).padStart(2, '0')}:${String(startMinute).padStart(2, '0')}`;
			const timeEnd = `${String(hour).padStart(2, '0')}:${String(endMinute).padStart(2, '0')}`;

			// 將當前日期格式化為 "YYYY-MM-DD" 以便比對
			const year = currentDate.getFullYear();
			const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // 從 0 開始計數，所以要加 1
			const day = String(currentDate.getDate()).padStart(2, '0');
			const formattedCurrentDate = `${year}-${month}-${day}`;

			// 篩選出需要比對的數據
			const relevantData = fetchedData.filter(item => {
				return item.schedule_date === formattedCurrentDate &&
					item.start_time.substring(0, 5) === timeStart &&
					item.end_time.substring(0, 5) === timeEnd;
			});

			// 尋找是否有符合的數據
			let matchedItem = relevantData.find(item => {
				const startTime = item.start_time.substring(0, 5);
				const endTime = item.end_time.substring(0, 5);
				return `${startTime}-${endTime}` === `${timeStart}-${timeEnd}`;
			});
			if (matchedItem) {
				// 根據狀態設置類
				if (matchedItem.status === 'available') {
					aElement.classList.add('selected');
				} else if (matchedItem.status === 'booked') {
					aElement.classList.add('booked');
					// 如果當前登入用戶的 ID 不等於 mentee_id，則禁用此時段
					if (String(matchedItem.mentee_id) !== String(loggedInUserId)) {
						console.log("matchedItem.mentee_id:", matchedItem.mentee_id);
						console.log("loggedInUserId:", loggedInUserId);

						aElement.classList.add('disabled');
						aElement.addEventListener('click', function(event) {
							event.preventDefault(); // 防止點選
						});
					}
				} else {
					// 如果狀態不是 'available' 或 'booked'，則禁用這個時段
					aElement.classList.add('disabled');
					aElement.addEventListener('click', function(event) {
						event.preventDefault(); // 防止點選
					});
				}
			} else {
				// 如果沒有匹配的項目，也禁用這個時段
				aElement.classList.add('disabled');
				aElement.addEventListener('click', function(event) {
					event.preventDefault(); // 防止點選
				});
			}

			spanElement.textContent = `${timeStart} - ${timeEnd}`;
			aElement.appendChild(spanElement);

			// 添加點擊事件，但只有當它不是 'disabled' 時
			if (!aElement.classList.contains('disabled')) {
				aElement.addEventListener('click', function() {
					toggleBookingStatus(this, matchedItem);
				});
			}



			return aElement;
		}












		const prevWeekButton = document.getElementById('prevWeek');
		const nextWeekButton = document.getElementById('nextWeek');

		prevWeekButton.addEventListener('click', function() {
			const newStartDate = new Date(currentStartDate);
			newStartDate.setDate(newStartDate.getDate() - 7);
			const today = new Date();
			today.setHours(0, 0, 0, 0);

			if (newStartDate >= today) {
				currentStartDate.setDate(currentStartDate.getDate() - 7);
				updateDateInfo(currentStartDate);
				fetchClassSchedule(mentorId); // 重新獲取數據
			} else {
				alert("不能查看過去的日期");
			}
		});

		nextWeekButton.addEventListener('click', function() {
			currentStartDate.setDate(currentStartDate.getDate() + 7);
			updateDateInfo(currentStartDate);
			fetchClassSchedule(mentorId); // 重新獲取數據
		});

		updateDateInfo(currentStartDate);


		// 新增：当用户点击 "Proceed to Pay" 按钮时的操作
		document.querySelector('.proceed-btn').addEventListener('click', function() {
			// 首先创建一个包含所有将要更新的时间段的字符串
			const slotDescriptions = changedSlots.map(slot => {
				return `${slot.scheduleDate} ${slot.startTime} - ${slot.endTime}`;
			}).join('\n');

			// 弹出确认对话框
			const userConfirmed = window.confirm(`您确定要更新以下时间段吗？\n${slotDescriptions}`);

			if (userConfirmed) {
				// 用户点击了“确认”，执行保存操作
				fetch('/batch-update-booking-status', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: JSON.stringify({
							slots: changedSlots
						}) // 只更新 changedSlots 数组中的时间段
					})
					.then(response => response.json())
					.then(data => {
						console.log(data.message);
						changedSlots = []; // 清空 changedSlots 数组
						// 添加成功提示
						alert('更新成功！');
						// 自动跳转到上一页
						window.history.back();

					})
					.catch(error => {
						console.error('There was a problem with the fetch:', error);
						// 添加失败提示
						alert('更新失败，请稍后重试。');
					});
			} else {
				// 用户点击了“取消”或关闭了对话框，不执行任何操作
			}
		});





	});
</script>
@endsection