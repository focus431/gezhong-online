@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Bookings</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
						<li class="breadcrumb-item active">Bookings</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class="col-md-12">

				<!-- Recent Orders -->
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="datatable table table-hover table-center mb-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Mentor Name</th>
										<th>Weekly</th>
										<th>Mentee Name</th>
										<th>Booking Time</th>
										<th class="text-end">Status</th>
										<!-- <th class="text-end">Amount</th> -->
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<!-- <h2 class="table-avatar">
												<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="../assets_admin/img/user/user.jpg" alt="User Image"></a>
												<a href="profile">Jonathan Doe </a>
											</h2> -->
										</td>
										<td>

										</td>
										<td></td>
										<td>

										</td>
										<td>

										</td>
										<td>

										</td>
										<!-- <td class="text-center">
											$200.00
										</td> -->
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /Recent Orders -->

			</div>
		</div>
	</div>
</div>
<!-- /Page Wrapper -->
@endsection
// Booking-list.blade.php 的 scripts 部分

@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		if ($.fn.DataTable.isDataTable('#myTable')) {
			$('#myTable').DataTable().clear().destroy();
		}

		$('#myTable').DataTable({
			processing: true,
			serverSide: true,
			searching: true,
			ajax: function(data, callback, settings) {
				const sortField = data.columns[data.order[0].column].data;
				const sortDirection = data.order[0].dir;
				const perPage = data.length;
				const currentPage = (data.start / perPage) + 1;
				const searchValue = data.search.value;

				fetch(`/get-class-schedules?sortField=${sortField}&sortDirection=${sortDirection}&page=${currentPage}&perPage=${perPage}&search=${searchValue}`)
					.then(response => response.json())
					.then(json => {
						callback({
							recordsTotal: json.recordsTotal,
							recordsFiltered: json.recordsFiltered,
							data: json.data
						});
					});
			},
			columns: [{
					data: 'id'
				},
				{
					data: 'mentor',
					render: function(data, type, row) {
						if (data) {
							return `
                            <h2 class="table-avatar">
                                <a href="profile/${data.id}" class="avatar avatar-sm me-2">
                                    <img class="avatar-img rounded-circle" src="/storage/${data.avatar_path}" alt="User Image">
                                </a>
                                <a href="profile/${data.id}">${data.last_name} ${data.first_name}</a>
                            </h2>
                        `;
						}
						return '';
					}
				},
				{
					data: 'day_of_week'
				},
				{
					data: 'mentee',
					render: function(data, type, row) {
						console.log(data);
						if (data) {
							return `
                <h2 class="table-avatar">
                    <a href="profile/${data.id}" class="avatar avatar-sm me-2">
											<img class="avatar-img rounded-circle" src="/storage/${data.avatar_path}" alt="User Image">
                    </a>
                    <a href="profile/${data.id}">${data.last_name} ${data.first_name}</a>
                </h2>`;
						}
						return '';
					}
				},

				{
					data: 'schedule_date',
					render: function(data, type, row) {
						var startTime = row.start_time ? row.start_time.substring(0, 5) : '';
						var endTime = row.end_time ? row.end_time.substring(0, 5) : '';
						return `${data} <span class="text-primary d-block">${startTime} - ${endTime}</span>`;
					}
				},
				{
					data: 'status'
				},
				// ... 其他列配置
			],
			// ... 其他 DataTables 配置
			language: {
				// ... 你的語言配置
			},
			lengthMenu: [10, 25, 50, 100], // 允許用戶選擇每頁顯示多少條記錄
			pageLength: 10, // 預設每頁的記錄數
		});
	});
</script>
@endsection