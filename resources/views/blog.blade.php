<?php $page="blog";?>
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
									<li class="breadcrumb-item active" aria-current="page">Blog</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Blog</h2>
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
										<li><a href="dashboard"><i class="fas fa-home"></i>Dashboard <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="bookings"><i class="fas fa-clock"></i>Bookings <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="schedule-timings"><i class="fas fa-hourglass-start"></i>Schedule Timings <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="chat"><i class="fas fa-comments"></i>Messages <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="invoices"><i class="fas fa-file-invoice"></i>Invoices <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="reviews"><i class="fas fa-eye"></i>Reviews <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="blog" class="active"><i class="fab fa-blogger-b"></i>Blog <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="profile"><i class="fas fa-user-cog"></i>Profile <span><i class="fas fa-chevron-right"></i></span></a></li>
										<li><a href="login"><i class="fas fa-sign-out-alt"></i>Logout <span><i class="fas fa-chevron-right"></i></span></a></li>
									</ul>
								</div>
							</div>
							<!-- /Sidebar -->

						</div>
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							
							<div class="row">
								
							<div class="col-12">

								<!-- Tab Menu -->
								<nav class="user-tabs">
									<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
										<li>
											<a class="nav-link active" href="#activeservice" data-bs-toggle="tab">Active Blog</a>
										</li>
										<li>
											<a class="nav-link" href="#inactiveservice" data-bs-toggle="tab">Inactive Blog</a>
										</li>
									</ul>
								</nav>
								<!-- /Tab Menu -->

								<!-- Tab Content -->
								<div class="tab-content">

									<!-- Active Content -->
									<div role="tabpanel" id="activeservice" class="tab-pane fade show active">

										<div class="row">
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part I</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success"><i class="far fa-edit"></i> Edit</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-danger">
																	<i class="far fa-trash-alt"></i> Inactive
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part II</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success"><i class="far fa-edit"></i> Edit</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-danger">
																	<i class="far fa-trash-alt"></i> Inactive
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success"><i class="far fa-edit"></i> Edit</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-danger">
																	<i class="far fa-trash-alt"></i> Inactive
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-04.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part I</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success"><i class="far fa-edit"></i> Edit</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-danger">
																	<i class="far fa-trash-alt"></i> Inactive
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-05.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part II</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success"><i class="far fa-edit"></i> Edit</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-danger">
																	<i class="far fa-trash-alt"></i> Inactive
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-06.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success"><i class="far fa-edit"></i> Edit</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-danger">
																	<i class="far fa-trash-alt"></i> Inactive
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
									<!-- /Active Content -->
									
									<!-- Inactive Content -->
									<div role="tabpanel" id="inactiveservice" class="tab-pane fade">
									
										<div class="row">
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-04.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success">
																	<i class="far fa-edit"></i> Edit
																</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-success">
																	<i class="fas fa-toggle-on"></i> Active
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-05.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success">
																	<i class="far fa-edit"></i> Edit
																</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-success">
																	<i class="fas fa-toggle-on"></i> Active
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-06.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success">
																	<i class="far fa-edit"></i> Edit
																</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-success">
																	<i class="fas fa-toggle-on"></i> Active
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-07.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success">
																	<i class="far fa-edit"></i> Edit
																</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-success">
																	<i class="fas fa-toggle-on"></i> Active
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-08.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success">
																	<i class="far fa-edit"></i> Edit
																</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-success">
																	<i class="fas fa-toggle-on"></i> Active
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-xl-4">
												<div class="course-box blog grid-blog">
													<div class="blog-image mb-0">
														<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-09.jpg" alt="Post Image"></a>
													</div>
													<div class="course-content">
														<span class="date">April 09 2020</span>
														<span class="course-title">Abacus Study for beginner - Part III</span>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
														<div class="row">
															<div class="col">
																<a href="edit-blog" class="text-success">
																	<i class="far fa-edit"></i> Edit
																</a>
															</div>
															<div class="col text-end">
																<a href="javascript:void(0);" class="text-success">
																	<i class="fas fa-toggle-on"></i> Active
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
									<!-- /Inactive Content -->

								</div>
								<!-- /Tab Content -->


							</div>


							</div>

						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->	
@endsection