<?php $page = "checkout"; ?>
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
						<li class="breadcrumb-item active" aria-current="page">Checkout</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">Checkout</h2>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7 col-lg-8">
				<div class="card">
					<div class="card-body">
						<!-- Checkout Form -->
						<form action="booking-success">
							<!-- Personal Information -->
							<div class="info-widget">
								<h4 class="card-title">Personal Information</h4>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group card-label">
											<label>First Name</label>
											<input class="form-control" type="text" value="{{$user->first_name}}">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group card-label">
											<label>Last Name</label>
											<input class="form-control" type="text" value="{{$user->last_name}}">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group card-label">
											<label>Email</label>
											<input class="form-control" type="email" value="{{$user->email}}">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group card-label">
											<label>Phone</label>
											<input class="form-control" type="text">
										</div>
									</div>
								</div>
								<div class="exist-customer">Existing Customer? <a href="#">Click here to login</a></div>
							</div>
							<!-- /Personal Information -->

							<div class="payment-widget">
								<h4 class="card-title">Payment Method</h4>
								<!-- Credit Card Payment -->
								<div class="payment-list">
									<label class="payment-radio credit-card-option">
										<input type="radio" name="radio" checked>
										<span class="checkmark"></span>
										Credit card
									</label>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group card-label">
												<label for="card_name">Name on Card</label>
												<input class="form-control" id="card_name" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group card-label">
												<label for="card_number">Card Number</label>
												<input class="form-control" id="card_number" placeholder="1234  5678  9876  5432" type="text">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group card-label">
												<label for="expiry_month">Expiry Month</label>
												<input class="form-control" id="expiry_month" placeholder="MM" type="text">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group card-label">
												<label for="expiry_year">Expiry Year</label>
												<input class="form-control" id="expiry_year" placeholder="YY" type="text">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group card-label">
												<label for="cvv">CVV</label>
												<input class="form-control" id="cvv" type="text">
											</div>
										</div>
									</div>
								</div>
								<!-- /Credit Card Payment -->

								<!-- Paypal Payment -->
								<div class="payment-list">
									<label class="payment-radio paypal-option">
										<input type="radio" name="radio">
										<span class="checkmark"></span>
										Paypal
									</label>
								</div>
								<!-- /Paypal Payment -->

								<!-- Terms Accept -->
								<div class="terms-accept">
									<div class="custom-checkbox">
										<input type="checkbox" id="terms_accept">
										<label for="terms_accept">I have read and accepted <a href="#">Terms &amp; Conditions</a></label>
									</div>
								</div>
								<!-- /Terms Accept -->

								<!-- Submit Section -->
								<div class="submit-section mt-4">
									<button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
								</div>
								<!-- /Submit Section -->
							</div>
						</form>
						<!-- /Checkout Form -->

					</div>
				</div>

			</div>

			<div class="col-md-5 col-lg-4 theiaStickySidebar">

				<!-- Booking Summary -->
				<div class="card booking-card">
					<div class="card-header">
						<h4 class="card-title">Booking Summary</h4>
					</div>
					<div class="card-body">

						<!-- Booking Mentee Info -->
						<div class="booking-user-info">
							<a href="payment-mentee" class="booking-user-img">
								<img src="{{ asset('storage/' . ($user->avatar_path ?? 'default-avatar.jpg')) }}" alt="User Image">
							</a>
							<div class="booking-info">
								<h4><a href="payment-mentee">{{$user->last_name}} {{$user->first_name}}</a></h4>
								<div class="rating">
									<i class="fas fa-star filled"></i>
									<i class="fas fa-star filled"></i>
									<i class="fas fa-star filled"></i>
									<i class="fas fa-star filled"></i>
									<i class="fas fa-star"></i>
									<span class="d-inline-block average-rating">35</span>
								</div>
								<div class="mentor-details">
									<p class="user-location"><i class="fas fa-map-marker-alt"></i> {{$user->city}}, {{$user->country}}</p>
								</div>
							</div>
						</div>
						<!-- Booking Mentee Info -->

						<div class="booking-summary">
							<div class="booking-item-wrap">

								<ul class="booking-date">
									<li>Booking Date <span>{{ date('Y M d') }}</span></li>
									<li>Time <span>{{ date('h:i A') }}</span></li>
								</ul>



								<ul class="booking-fee">
									<li>Lessons <span>{{$plan->lessons}} </span></li>
								</ul>
								<div class="booking-total">
									<ul class="booking-total-list">
										<li>
											<span>Total</span>
											<span class="total-cost">{{$plan->price}}</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Booking Summary -->

			</div>
		</div>

	</div>

</div>
<!-- /Page Content -->
@endsection