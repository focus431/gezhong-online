<?php $page="dashboard";?>
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
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
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
								<div class="custom-sidebar-nav">
									<ul>
									@include('layout.partials.sidebar')
									</ul>
								</div>
							</div>
							<!-- /Sidebar -->

						</div>
						
						<div class="col-md-7 col-lg-8 col-xl-9">

							<div class="row">
								<div class="col-md-12 col-lg-4 dash-board-list blue">
									<div class="dash-widget">
										<div class="circle-bar">
											<div class="icon-col">
												<i class="fas fa-users"></i>
											</div>
										</div>
										<div class="dash-widget-info">
											<h3>23</h3>
											<h6>Members</h6>															
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-lg-4 dash-board-list yellow">
									<div class="dash-widget">
										<div class="circle-bar">
											<div class="icon-col">
												<i class="fas fa-calendar-check"></i>
											</div>
										</div>
										<div class="dash-widget-info">
											<h3>33</h3>
											<h6>Appointments</h6>															
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-lg-4 dash-board-list pink">
									<div class="dash-widget">
										<div class="circle-bar">
											<div class="icon-col">
												<i class="fas fa-wallet"></i>
											</div>
										</div>
										<div class="dash-widget-info">
											<h3>$14</h3>
											<h6>Total Earned</h6>															
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<h4 class="mb-4">Mentee Lists</h4>
									<div class="card card-table">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>BASIC INFO</th>
															<th>CREATED DATE</th>
															<th class="text-center">TAGS</th>
															<th class="text-center">ACTION</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user2.jpg" alt="User Image"></a>
																	<a href="profile">Tyrone Roberts<span>tyroneroberts@adobe.com</span></a>				
																</h2>
															</td>
															<td>08 April 2020</td>
															<td class="text-center"><span class="pending">PENDING</span></td>
															<td class="text-center"><a href="profile" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a></td>
														</tr>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user1.jpg" alt="User Image"></a>
																	<a href="profile">Julie Pennington <span>julie@adobe.com</span></a>				
																</h2>
															</td>
															<td>08 April 2020</td>
															<td class="text-center"><span class="pending">PENDING</span></td>
															<td class="text-center"><a href="profile" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a></td>
														</tr>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user3.jpg" alt="User Image"></a>
																	<a href="profile">Allen Davis <span>allendavis@adobe.com</span></a>				
																</h2>
															</td>
															<td>08 April 2020</td>
															<td class="text-center"><span class="pending">PENDING</span></td>
															<td class="text-center"><a href="profile" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a></td>
														</tr>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user4.jpg" alt="User Image"></a>
																	<a href="profile">Patricia Manzi <span>patriciamanzi@adobe.com</span></a>				
																</h2>
															</td>
															<td>08 April 2020</td>
															<td class="text-center"><span class="accept">ACCEPTED</span></td>
															<td class="text-center"><a href="profile" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a></td>
														</tr>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user5.jpg" alt="User Image"></a>
																	<a href="profile">Olive Lawrence <span>olivelawrence@adobe.com</span></a>				
																</h2>
															</td>
															<td>08 April 2020</td>
															<td class="text-center"><span class="accept">ACCEPTED</span></td>
															<td class="text-center"><a href="profile" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a></td>
														</tr>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user6.jpg" alt="User Image"></a>
																	<a href="profile">Frances Foster <span>frances@adobe.com</span></a>				
																</h2>
															</td>
															<td>08 April 2020</td>
															<td class="text-center"><span class="accept">ACCEPTED</span></td>
															<td class="text-center"><a href="profile" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a></td>
														</tr>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="profile" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user7.jpg" alt="User Image"></a>
																	<a href="profile">Deloris Briscoe <span>delorisbriscoe@adobe.com</span></a>				
																</h2>
															</td>
															<td>08 April 2020</td>
															<td class="text-center"><span class="reject">REJECTED</span></td>
															<td class="text-center"><a href="profile" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a></td>
														</tr>
													</tbody>
												</table>		
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