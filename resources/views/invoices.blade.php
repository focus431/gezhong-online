<?php $page="invoices";?>
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
									<li class="breadcrumb-item active" aria-current="page">Invoices</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Invoices</h2>
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
							<div class="card card-table">
								<div class="card-body">
								
									<!-- Invoice Table -->
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>Invoice No</th>
													<th>Mentee</th>
													<th>Amount</th>
													<th>Paid On</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<a href="invoice-view">#INV-0010</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user2.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Tyrone Roberts <span>16</span></a>
														</h2>
													</td>
													<td>$450</td>
													<td>14 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0009</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user1.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Julie Pennington <span>01</span></a>
														</h2>
													</td>
													<td>$200</td>
													<td>13 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0008</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Tyrone Roberts <span>02</span></a>
														</h2>
													</td>
													<td>$100</td>
													<td>12 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0007</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user3.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Allen Davis <span>03</span></a>
														</h2>
													</td>
													<td>$350</td>
													<td>11 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0006</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user4.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Patricia Manzi <span>04</span></a>
														</h2>
													</td>
													<td>$275</td>
													<td>10 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0005</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user5.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Olive Lawrence <span>05</span></a>
														</h2>
													</td>
													<td>$600</td>
													<td>9 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0004</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user6.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Frances Foster <span>06</span></a>
														</h2>
													</td>
													<td>$50</td>
													<td>8 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0003</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user7.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Deloris Briscoe <span>07</span></a>
														</h2>
													</td>
													<td>$400</td>
													<td>7 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0002</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user8.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Daniel Griffing <span>08</span></a>
														</h2>
													</td>
													<td>$550</td>
													<td>6 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<a href="invoice-view">#INV-0002</a>
													</td>
													<td>
														<h2 class="table-avatar">
															<a href="profile-mentee" class="avatar avatar-sm me-2">
																<img class="avatar-img rounded-circle" src="assets/img/user/user8.jpg" alt="User Image">
															</a>
															<a href="profile-mentee">Daniel Griffing <span>08</span></a>
														</h2>
													</td>
													<td>$550</td>
													<td>6 Nov 2019</td>
													<td class="text-end">
														<div class="table-action">
															<a href="invoice-view" class="btn btn-sm bg-info-light">
																<i class="far fa-eye"></i> View
															</a>
															<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																<i class="fas fa-print"></i> Print
															</a>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- /Invoice Table -->
									
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->	
@endsection