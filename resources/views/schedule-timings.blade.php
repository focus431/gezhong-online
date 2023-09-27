<?php $page="schedule-timings";?>
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
								<div class="user-widget">
									<div class="pro-avatar">JD</div>
									<div class="rating">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
									</div>
									<div class="user-info-cont">
										<h4 class="usr-name">Jonathan Doe</h4>
										<p class="mentor-type">English Literature (M.A)</p>
									</div>
								</div>
								<div class="progress-bar-custom">
									<h6>Complete your profiles ></h6>
									<div class="pro-progress">
										<div class="tooltip-toggle" tabindex="0"></div>
										<div class="tooltip">80%</div>
									</div>
								</div>
								<div class="custom-sidebar-nav">
									<ul>
										<li><a href="dashboard-mentor"><i class="fas fa-home"></i>Dashboard <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="bookings"><i class="fas fa-clock"></i>Bookings <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="schedule-timings" class="active"><i class="fas fa-hourglass-start"></i>Schedule Timings <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="chat"><i class="fas fa-comments"></i>Messages <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="invoices"><i class="fas fa-file-invoice"></i>Invoices <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="reviews"><i class="fas fa-eye"></i>Reviews <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="blog"><i class="fab fa-blogger-b"></i>Blog <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="profile-settings-mentor"><i class="fas fa-user-cog"></i>Profile <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="login"><i class="fas fa-sign-out-alt"></i>Logout <span><i class="fas fa-chevron-right"></i></span></a></li>
									</ul>
								</div>
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
															
																<!-- Schedule Nav -->
																<div class="schedule-nav">
																	<ul class="nav nav-tabs nav-justified">
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#slot_sunday">Sunday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link active" data-bs-toggle="tab" href="#slot_monday">Monday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#slot_tuesday">Tuesday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#slot_wednesday">Wednesday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#slot_thursday">Thursday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#slot_friday">Friday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#slot_saturday">Saturday</a>
																		</li>
																	</ul>
																</div>
																<!-- /Schedule Nav -->
																
															</div>
															<!-- /Schedule Header -->
															
															<!-- Schedule Content -->
															<div class="tab-content schedule-cont">
															
																<!-- Sunday Slot -->
																<div id="slot_sunday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-bs-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<p class="text-muted mb-0">Not Available</p>
																</div>
																<!-- /Sunday Slot -->

																<!-- Monday Slot -->
																<div id="slot_monday" class="tab-pane fade show active">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-bs-toggle="modal" href="#edit_time_slot"><i class="fa fa-edit mr-1"></i>Edit</a>
																	</h4>
																	
																	<!-- Slot List -->
																	<div class="user-times">
																		<div class="user-slot-list">
																			8:00 pm - 11:30 pm
																			<a href="javascript:void(0)" class="delete_schedule">
																				<i class="fa fa-times"></i>
																			</a>
																		</div>
																		<div class="user-slot-list">
																			11:30 pm - 1:30 pm
																			<a href="javascript:void(0)" class="delete_schedule">
																				<i class="fa fa-times"></i>
																			</a>
																		</div>
																		<div class="user-slot-list">
																			3:00 pm - 5:00 pm
																			<a href="javascript:void(0)" class="delete_schedule">
																				<i class="fa fa-times"></i>
																			</a>
																		</div>
																		<div class="user-slot-list">
																			6:00 pm - 11:00 pm
																			<a href="javascript:void(0)" class="delete_schedule">
																				<i class="fa fa-times"></i>
																			</a>
																		</div>
																	</div>
																	<!-- /Slot List -->
																	
																</div>
																<!-- /Monday Slot -->

																<!-- Tuesday Slot -->
																<div id="slot_tuesday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-bs-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<p class="text-muted mb-0">Not Available</p>
																</div>
																<!-- /Tuesday Slot -->

																<!-- Wednesday Slot -->
																<div id="slot_wednesday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-bs-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<p class="text-muted mb-0">Not Available</p>
																</div>
																<!-- /Wednesday Slot -->

																<!-- Thursday Slot -->
																<div id="slot_thursday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-bs-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<p class="text-muted mb-0">Not Available</p>
																</div>
																<!-- /Thursday Slot -->

																<!-- Friday Slot -->
																<div id="slot_friday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-bs-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<p class="text-muted mb-0">Not Available</p>
																</div>
																<!-- /Friday Slot -->

																<!-- Saturday Slot -->
																<div id="slot_saturday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-bs-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<p class="text-muted mb-0">Not Available</p>
																</div>
																<!-- /Saturday Slot -->

															</div>
															<!-- /Schedule Content -->
															
														</div>
														
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								
								
                            </div>
							<div class="row">
								<div class="col-12 col-sm-4 col-md-6">
									<h4 class="mb-1">11 November 2019</h4>
									<p class="text-muted">Monday</p>
								</div>
								<div class="col-12 col-sm-8 col-md-6 text-sm-end">
									<div class="bookingrange btn btn-white btn-sm mb-3">
										<i class="far fa-calendar-alt me-2"></i>
										<span>August 27, 2023 - September 25, 2023</span>
										<i class="fas fa-chevron-down ms-2"></i>
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
											<ul>
												<li class="left-arrow">
													<a href="">
														<i class="fa fa-chevron-left"></i>
													</a>
												</li>
												<li>
													<span>Mon</span>
													<span class="slot-date">11 Nov <small class="slot-year">2019</small></span>
												</li>
												<li>
													<span>Tue</span>
													<span class="slot-date">12 Nov <small class="slot-year">2019</small></span>
												</li>
												<li>
													<span>Wed</span>
													<span class="slot-date">13 Nov <small class="slot-year">2019</small></span>
												</li>
												<li>
													<span>Thu</span>
													<span class="slot-date">14 Nov <small class="slot-year">2019</small></span>
												</li>
												<li>
													<span>Fri</span>
													<span class="slot-date">15 Nov <small class="slot-year">2019</small></span>
												</li>
												<li>
													<span>Sat</span>
													<span class="slot-date">16 Nov <small class="slot-year">2019</small></span>
												</li>
												<li>
													<span>Sun</span>
													<span class="slot-date">17 Nov <small class="slot-year">2019</small></span>
												</li>
												<li class="right-arrow">
													<a href="">
														<i class="fa fa-chevron-right"></i>
													</a>
												</li>
											</ul>
										</div>
										<!-- /Day Slot -->
										
									</div>
								</div>
							</div>
							<!-- /Schedule Header -->
							
							<!-- Schedule Content -->
							<div class="schedule-cont">
								<div class="row">
									<div class="col-md-12">
									
										<!-- Time Slot -->
										<div class="time-slot">
											<ul class="clearfix">
												<li>
													<a class="timing" href="#">
														<span>9:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>10:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>11:00</span> <span>AM</span>
													</a>
												</li>
												<li>
													<a class="timing" href="#">
														<span>9:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>10:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>11:00</span> <span>AM</span>
													</a>
												</li>
												<li>
													<a class="timing" href="#">
														<span>9:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>10:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>11:00</span> <span>AM</span>
													</a>
												</li>
												<li>
													<a class="timing" href="#">
														<span>9:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>10:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>11:00</span> <span>AM</span>
													</a>
												</li>
												<li>
													<a class="timing" href="#">
														<span>9:00</span> <span>AM</span>
													</a>
													<a class="timing selected" href="#">
														<span>10:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>11:00</span> <span>AM</span>
													</a>
												</li>
												<li>
													<a class="timing" href="#">
														<span>9:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>10:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>11:00</span> <span>AM</span>
													</a>
												</li>
												<li>
													<a class="timing" href="#">
														<span>9:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>10:00</span> <span>AM</span>
													</a>
													<a class="timing" href="#">
														<span>11:00</span> <span>AM</span>
													</a>
												</li>
											</ul>
										</div>
										<!-- /Time Slot -->
										
									</div>
								</div>
							</div>
							<!-- /Schedule Content -->
							
						</div>
							

						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
@endsection