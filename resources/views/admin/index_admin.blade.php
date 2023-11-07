@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">

	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Welcome Admin!</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item active">Dashboard</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-primary border-primary">
								<i class="fe fe-users"></i>
							</span>
							<div class="dash-count">
								<h3><span id="mentee-count"></span></h3>
							</div>
						</div>
						<div class="dash-widget-info">
							<h6 class="text-muted">Mentees</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-primary w-50"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-success">
								<i class="fe fe-credit-card"></i>
							</span>
							<div class="dash-count">
								<h3><span id="booked-classes-count"></span></h3>
							</div>
						</div>
						<div class="dash-widget-info">

							<h6 class="text-muted">Appointments</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-success w-50"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-danger border-danger">
								<i class="fe fe-users"></i>
							</span>
							<div class="dash-count">
								<h3><span id="mentor-count"></span></h3>
							</div>
						</div>
						<div class="dash-widget-info">

							<h6 class="text-muted">Mentors</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-danger w-50"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-warning border-warning">
								<i class="fe fe-folder"></i>
							</span>
							<div class="dash-count">
								<h3>$62523</h3>
							</div>
						</div>
						<div class="dash-widget-info">

							<h6 class="text-muted">Revenue</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-warning w-50"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-6">
				<!-- Sales Chart -->
				<div class="card card-chart">
					<div class="card-header">
						<h4 class="card-title">Mentees</h4>
					</div>
					<div class="card-body">
						<canvas id="menteeChart"></canvas>

					</div>
				</div>
				<!-- /Sales Chart -->
			</div>
			<div class="col-md-12 col-lg-6">
				<!-- Invoice Chart -->
				<div class="card card-chart">
					<div class="card-header">
						<h4 class="card-title">Mentors</h4>
					</div>
					<div class="card-body">
						<canvas id="mentorChart"></canvas>

					</div>
				</div>
				<!-- /Invoice Chart -->

			</div>
		</div>
		

	</div>
</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
@endsection
@section('scripts')
<script>
	// 確保 DOM 完全加載
	document.addEventListener('DOMContentLoaded', function() {
		fetchCounts();
		// 移除了没有参数的错误调用
		fetchMonthlyCountsAndRenderChart('mentee', 'bar', 'rgba(27, 90, 144, 0.5)');
		fetchMonthlyCountsAndRenderChart('mentor', 'line', 'rgba(231, 76, 60, 0.5)');

	});




	function fetchCounts() {
		fetch('/counts') // 確保這個 URL 與 Laravel 路由匹配
			.then(response => response.json())
			.then(data => {
				// 將數據渲染到前端
				console.log(data.booked_classes_count);
				document.getElementById('mentee-count').textContent = data.mentee_count;
				document.getElementById('mentor-count').textContent = data.mentor_count;
				document.getElementById('booked-classes-count').textContent = data.booked_classes_count;
			})
			.catch(error => {
				console.error('Error fetching counts:', error);
			});
	}

	function fetchMonthlyCountsAndRenderChart(role, chartType, chartColor) {
		// 打印 role 值到控制台
		console.log('Role:', role);

		// 如果 role 没有值，打印一个错误消息并返回
		if (!role) {
			console.error('No role provided!');
			return; // 终止函数执行
		}
		fetch(`/${role}s/monthly-counts`)
			.then(response => response.json())
			.then(data => {
				const labels = Array.from({
					length: 12
				}, (v, i) => i + 1);
				const chartData = {
					labels: labels,
					datasets: [{
						label: `${role.charAt(0).toUpperCase() + role.slice(1)}`, // Capitalize the first letter
						data: Object.keys(data).map(month => data[month]),
						fill: chartType === 'line' ? false : true,
						backgroundColor: chartType === 'line' ? 'transparent' : chartColor,
						borderColor: chartColor,
						pointBackgroundColor: chartColor,
						tension: 0.1
					}]
				};
				renderChart(`${role}Chart`, chartData, chartType);
			})
			.catch(error => {
				console.error(`Error fetching monthly ${role} counts:`, error);
			});
	}

	function renderChart(chartId, chartData, chartType) {
		const ctx = document.getElementById(chartId).getContext('2d');
		const config = {
			type: chartType,
			data: chartData,
			options: {
				/* ... */ }
		};
		new Chart(ctx, config);
	}
</script>
@endsection