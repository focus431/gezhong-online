<?php $page = "bookings-mentee"; ?>
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
						<li class="breadcrumb-item active" aria-current="page">My Classes</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">My Classes</h2>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->


<!-- Page Content -->
<div class="content">
	<div class="container-fluid">

		<div class="row">

			<!-- Sidebar -->
			<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
				<div class="profile-sidebar">
					@include('layout.partials.sidebar')
				</div>
			</div>
			<!-- /Sidebar -->

			<!-- Booking summary -->
			<div class="col-md-7 col-lg-8 col-xl-9">
				<h3 class="pb-3">Booking Summary</h3>

				<!-- Tabs navigation -->
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming" data-status="booked">Upcoming</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" data-status="Completed">Completed</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="cancel-tab" data-toggle="tab" href="#canceled" data-status="Canceled">Cancelation</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="absent-tab" data-toggle="tab" href="#absent" data-status="Absent">Absent</a>
					</li>
				</ul>

				<!-- Tabs content -->
				<div class="tab-content">

					<div class="tab-pane fade" id="upcoming">
						<!-- Your table for Upcoming will go here -->
					</div>
					<div class="tab-pane fade" id="completed">
						<!-- Your table for Completed will go here -->
					</div>
					<div class="tab-pane fade" id="canceled">
						<!-- Your table for Cancel will go here -->
					</div>
					<div class="tab-pane fade" id="absent">
						<!-- Your table for Absent will go here -->
					</div>
				</div>

				<!-- Existing Mentee List Tab -->
				<div class="tab-pane show active" id="mentee-list">
					<div class="card card-table">
						<div class="card-body">
						<div class="filter-section">
								<input type="text" id="filterInput" placeholder="輸入名字進行過濾" style="margin-bottom: 20px; padding: 5px;">
							</div>
							<div class="table-responsive">
								<table class="table table-hover table-center mb-0">
									<thead>
										<tr>
											<th class="text-center">序號</th>
											<th>MENTEE LISTS</th>
											<th>SCHEDULED DATE</th>
											<th class="text-center">SCHEDULED TIMINGS</th>
											<th class="text-center">STATUS</th>
											<th class="text-center">ACTION</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
								<div id="paginationDiv"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Mentee List Tab -->
			</div>
			<!-- /Booking summary -->
		</div>
	</div>
</div>
<!-- /Page Content -->
@endsection

@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', () => {
		// 初始化：預設加載 'booked' 的數據
		fetchBookingsForMentee('booked');
		// 監聽選項卡變化
		handleTabFocus();
		// 添加表格排序功能
		addTableSorting();
		//搜尋欄位
		initializeFilter();
	});

	// 當前排序的列和方向
	let currentSortColumn = null;
	let currentSortDirection = 'asc';

	// 表格排序函數
	function sortTable(column, direction, tbody) {
		const rows = Array.from(tbody.querySelectorAll('tr'));
		const sortedRows = rows.sort((rowA, rowB) => {
			const cellA = rowA.querySelector(`td:nth-child(${column})`).textContent;
			const cellB = rowB.querySelector(`td:nth-child(${column})`).textContent;
			return cellA < cellB ? (direction === 'asc' ? -1 : 1) : (direction === 'asc' ? 1 : -1);
		});
		tbody.innerHTML = '';
		sortedRows.forEach((row, index) => {
			row.querySelector('td:first-child').textContent = index + 1;
			tbody.appendChild(row);
		});
	}







	// 將預定資料的生成進行封裝
	function generateBookingRows(data, tbody, currentPage) {
		const itemsPerPage = 10; // 或者您從服務器獲取的實際數字
		const startingIndex = (currentPage - 1) * itemsPerPage;

		if (Array.isArray(data.classSchedules.data)) {
			data.classSchedules.data.forEach((schedule, index) => {
				const tr = document.createElement('tr');
				tr.setAttribute('data-id', schedule.id);

				// Serial Number
				const tdSerial = document.createElement('td');
				tdSerial.className = 'text-center';
				tdSerial.textContent = startingIndex + index + 1; // 這裡加上了 startingIndex
				tr.appendChild(tdSerial);

				// Name
				const tdName = document.createElement('td');
				const h2 = document.createElement('h2');
				h2.className = 'table-avatar';
				const aName = document.createElement('a');
				aName.href = 'profile';
				const mentor = data.users.find(users => users.id === schedule.user_id);
				const fullName = mentor ? `${mentor.last_name} ${mentor.first_name}` : 'Unknown';
				aName.textContent = fullName;
				h2.appendChild(aName);
				tdName.appendChild(h2);
				tr.appendChild(tdName);

				// Date
				const tdDate = document.createElement('td');
				tdDate.textContent = schedule.schedule_date;
				tr.appendChild(tdDate);

				// Time
				const tdTime = document.createElement('td');
				tdTime.className = 'text-center';
				const timeSpan = document.createElement('span');
				timeSpan.className = 'pending';
				const startTime = schedule.start_time.substring(0, 5);
				const endTime = schedule.end_time.substring(0, 5);
				timeSpan.textContent = `${startTime} - ${endTime}`;
				tdTime.appendChild(timeSpan);
				tr.appendChild(tdTime);

				// Status
				const tdStatus = document.createElement('td');
				tdStatus.className = 'text-center';
				const selectStatus = document.createElement('select');
				selectStatus.className = 'form-control';
				const options = ['Select', 'Completed', 'Canceled', 'Absent'];
				options.forEach(option => {
					const optElement = document.createElement('option');
					optElement.value = option;
					optElement.textContent = option;
					if (schedule.status === option) {
						optElement.selected = true;
						selectStatus.disabled = true;
					}
					selectStatus.appendChild(optElement);
				});

				// Add event listener for status change
				selectStatus.addEventListener('change', async function() {
					console.log("Triggered for schedule:", schedule); // 新增這行來調試

					const selectedStatus = this.value;
					const isConfirmed = window.confirm(`您確定要將狀態更改為 ${selectedStatus} 嗎？一旦變更後無法更改。`);
					if (isConfirmed) {
						// Your logic to send the data to the backend
						// ...

						// Disable the select after change
						this.disabled = true;
					} else {
						// Reset the select option to the original status
						this.value = schedule.status;
					}
				});

				tdStatus.appendChild(selectStatus);
				tr.appendChild(tdStatus);

				// google meet link
				const tdAction = document.createElement('td');
tdAction.className = 'text-center';
const actionBtn = document.createElement('a');
actionBtn.className = 'btn btn-sm bg-info-light';
actionBtn.innerHTML = '<i class="fab fa-google"></i> Meet';

const googlemeetId = data.users.find(user => user.id === schedule.user_id);

if (googlemeetId && mentor.google_meet_code) {
    actionBtn.setAttribute('data-meeting-url', mentor.google_meet_code);
} else {
    console.error('No matching mentor found or google_meet_code is missing');
    actionBtn.setAttribute('data-meeting-url', ''); // Set to an empty string or some default value
}

// 檢查後端資料表中的 status
if (schedule.status !== 'booked') {
    // 禁止點擊 Google Meet 按鈕
    actionBtn.addEventListener('click', function(e) {
        e.preventDefault();
        alert('此連結在當前狀態下不可用。');
    });
} else {
    // 允許點擊 Google Meet 按鈕
    actionBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const meetingUrl = this.getAttribute('data-meeting-url');
        if (meetingUrl) {
            window.open(meetingUrl, '_blank');
        } else {
            console.error('No meeting URL found');
        }
    });
}

tdAction.appendChild(actionBtn);
tr.appendChild(tdAction);

tbody.appendChild(tr);

			});
		} else {
			console.error("data.classSchedules.data is not an array:", data.classSchedules.data);
		}

	}







	// 添加表格排序功能
	function addTableSorting() {
		document.querySelectorAll('th').forEach((headerCell, index) => {
			headerCell.addEventListener('click', () => {
				const tableElement = document.querySelector('table');
				const tbodyElement = tableElement.querySelector('tbody');
				const rows = Array.from(tbodyElement.querySelectorAll('tr'));
				const sortedRows = rows.sort((a, b) => {
					const aColText = a.querySelector(`td:nth-child(${index + 1})`).textContent.trim();
					const bColText = b.querySelector(`td:nth-child(${index + 1})`).textContent.trim();
					return aColText.localeCompare(bColText);
				});
				tbodyElement.innerHTML = '';
				sortedRows.forEach(row => {
					tbodyElement.appendChild(row);
				});
			});
		});
	}







	// 分頁功能
	function renderPagination(data) {
		const paginationDiv = document.createElement('div');
		paginationDiv.className = 'pagination';

		if (data.classSchedules.prev_page_url) {
			const prevLink = document.createElement('a');
			prevLink.href = '#';
			prevLink.innerHTML = '&laquo;';
			prevLink.addEventListener('click', (e) => {
				e.preventDefault(); // 阻止默認行為
				fetchBookingsForMentee(currentStatus, data.classSchedules.current_page - 1);
			});
			paginationDiv.appendChild(prevLink);
		}

		if (data.classSchedules.next_page_url) {
			const nextLink = document.createElement('a');
			nextLink.href = '#';
			nextLink.innerHTML = '&raquo;';
			nextLink.addEventListener('click', (e) => {
				e.preventDefault(); // 阻止默認行為
				fetchBookingsForMentee(currentStatus, data.classSchedules.current_page + 1);
			});
			paginationDiv.appendChild(nextLink);
		}

		document.getElementById('paginationDiv').innerHTML = '';
		document.getElementById('paginationDiv').appendChild(paginationDiv);
	}



	// 添加狀態更改的事件監聽器
	function addStatusChangeEventListener(selectStatus, tr, schedule) {
		// console.log("找到的 schedule 是：", schedule);
		// 添加這個檢查
		if (!schedule) {
			console.error('schedule 是 undefined，不會添加事件監聽器');
			return; // 直接返回，避免後續代碼執行
		}
		selectStatus.addEventListener('change', async function() {
			const selectedStatus = this.value;
			const classScheduleId = tr.getAttribute('data-id');
			const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			const payload = {
				newStatus: selectedStatus,
				classScheduleId: schedule.id,
				menteeId: schedule.mentee_id,
				mentorId: schedule.user_id,
				scheduleDate: schedule.schedule_date,
				startTime: schedule.start_time,
				endTime: schedule.end_time,
			};
			// console.log("schedule.id 的值是：", schedule.mentee_id);

			try {
				const updateResponse = await fetch('/update-booking-status', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': csrfToken,
					},
					body: JSON.stringify(payload)
				});
				if (updateResponse.ok) {
    const responseData = await updateResponse.json();
    console.log('Success:', responseData);
    alert('狀態已成功更新');  // 顯示提示訊息
} else {
    console.error('Failed to update status. HTTP status:', updateResponse.status);
}

			} catch (error) {
				console.error('Error:', error);
			}
		});
	}

	// 當前狀態和頁數
	let currentStatus = 'booked';
	let currentPage = 1;

	// 異步獲取預定資料
	async function fetchBookingsForMentee(status = 'booked', page = 1) {
		console.log(`Fetching bookings for status: ${status}`);
		try {
			currentStatus = status;
			currentPage = page;
			const response = await fetch(`/getBookingsForMentee?status=${status}&page=${page}`);
			if (!response.ok) {
				throw new Error('Network response was not ok');
			}
			const data = await response.json();
			const tbody = document.querySelector('tbody');
			if (!tbody) {
				console.error('No tbody found');
				return;
			}
			tbody.innerHTML = '';
			generateBookingRows(data, tbody, currentPage);
			renderPagination(data);

			// 遍歷每一行，添加狀態更改事件監聽器
			tbody.querySelectorAll('tr').forEach(tr => {
				const selectStatus = tr.querySelector('select');
				if (selectStatus) {
					const schedule = data.classSchedules.data.find(schedule => schedule.id === parseInt(tr.getAttribute('data-id')));
					addStatusChangeEventListener(selectStatus, tr, schedule);
				}
			});

		} catch (error) {
			console.error('Error fetching or processing data:', error);
		}
	}





	// 處理選項卡焦點
	function handleTabFocus() {
		document.querySelectorAll('.nav-link').forEach(tab => {
			tab.addEventListener('click', (event) => {
				document.querySelectorAll('.nav-link').forEach(innerTab => {
					innerTab.classList.remove('active');
				});
				event.target.classList.add('active');
				const status = event.target.getAttribute('data-status');
				fetchBookingsForMentee(status);
			});
		});
	}
// 初始化預設的 active tab
const defaultActiveTab = document.querySelector('.nav-link.active');
    if (defaultActiveTab) {
        defaultActiveTab.style.backgroundColor = "#1e88e5";
        defaultActiveTab.style.color = "#FFF";
    }

function handleTabFocus() {
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', (event) => {
            document.querySelectorAll('.nav-link').forEach(innerTab => {
                innerTab.classList.remove('active');
                innerTab.style.backgroundColor = ""; // 移除背景色
                innerTab.style.color = ""; // 移除字體顏色
            });
            event.target.classList.add('active');
            event.target.style.backgroundColor = "#1e88e5"; // 添加背景色
            event.target.style.color = "#FFF"; // 添加字體顏色
            const status = event.target.getAttribute('data-status');
            fetchBookingsForMentee(status);
        });
    });
}






	// 初始化名單過濾功能
	function initializeFilter() {
		const filterInput = document.getElementById('filterInput');
		const tableBody = document.querySelector('tbody');
		filterInput.addEventListener('input', () => filterTable(filterInput, tableBody));
	}
	// 添加名單過濾功能
	function filterTable(inputElement, tbody) {
		const filterText = inputElement.value.toLowerCase();
		const rows = Array.from(tbody.querySelectorAll('tr'));
		rows.forEach(row => {
			const nameCell = row.querySelector('td:nth-child(2)'); // 假設名字在第二列
			if (nameCell) {
				const nameText = nameCell.textContent.toLowerCase();
				if (nameText.includes(filterText)) {
					row.style.display = '';
				} else {
					row.style.display = 'none';
				}
			}
		});
	}
</script>
@endsection