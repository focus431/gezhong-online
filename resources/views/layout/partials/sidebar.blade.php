<!-- resources/views/partials/sidebar.blade.php -->


@if (Auth::user()->role == 'admin')
<!-- Admin 的側邊欄項目 -->
@elseif (Auth::user()->role == 'mentor')
<!-- Mentor 的側邊欄項目 -->

<div class="user-widget">
	<div class="pro-avatar" style="width: 150px; height: 150px; overflow: hidden;">
		<img src="{{ asset('storage/' . ($user->avatar_path ?? 'default-avatar.jpg')) }}" alt="User Image" style="width: 100%; height: 100%; object-fit: cover;">
	</div>
	<div class="rating">
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star"></i>
	</div>
	<div class="user-info-cont">
		<h4 class="usr-name">{{ $user->last_name }} {{ $user->first_name }}</h4>
		<p class="mentee-type">{{ ucfirst($user->role) }}</p>
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
		<li><a href="dashboard_mentor" class="{{ Request::is('dashboard_mentor') ? 'active' : '' }}"><i class="fas fa-home"></i>{{ __('dashboard') }} <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="bookings_mentor" class="{{ Request::is('bookings_mentor') ? 'active' : '' }}"><i class="fas fa-clock"></i>Bookings <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="schedule-timings" class="{{ Request::is('schedule-timings') ? 'active' : '' }}"><i class="fas fa-hourglass-start"></i>Schedule Timings <span><i class="fas fa-chevron-right"></i></span></a></li>
		<!-- <li><a href="chat" class="{{ Request::is('chat') ? 'active' : '' }}"><i class="fas fa-comments"></i>Messages <span><i class="fas fa-chevron-right"></i></span></a></li> -->
		<li><a href="invoices" class="{{ Request::is('invoices') ? 'active' : '' }}"><i class="fas fa-file-invoice"></i>Invoices <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="reviews" class="{{ Request::is('reviews') ? 'active' : '' }}"><i class="fas fa-eye"></i>Reviews <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="blog" class="{{ Request::is('blog') ? 'active' : '' }}"><i class="fab fa-blogger-b"></i>Blog <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="profile-settings-mentor" class="{{ Request::is('profile-settings-mentor') ? 'active' : '' }}"><i class="fas fa-user-cog"></i>Profile <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="logout" class="{{ Request::is('logout') ? 'active' : '' }}"><i class="fas fa-sign-out-alt"></i>Logout <span><i class="fas fa-chevron-right"></i></span></a></li>
	</ul>
</div>
@else
<!-- Mentee 的側邊欄項目 -->

<div class="user-widget">
	<div class="pro-avatar" style="width: 150px; height: 150px; overflow: hidden;">
		<img src="{{ asset('storage/' . ($user->avatar_path ?? 'default-avatar.jpg')) }}" alt="User Image" style="width: 100%; height: 100%; object-fit: cover;">
	</div>
	<div class="rating">
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star filled"></i>
		<i class="fas fa-star"></i>
	</div>
	<div class="user-info-cont">
		<h4 class="usr-name">{{ $user->last_name }} {{ $user->first_name }}</h4>
		<p class="mentee-type">{{ ucfirst($user->role) }}</p>
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
		<!-- 引入側邊欄 -->
		<li><a href="dashboard_mentee" class="{{ Request::is('dashboard_mentee') ? 'active' : '' }}"><i class="fas fa-home"></i>{{ __('dashboard') }} <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="bookings_mentee" class="{{ Request::is('bookings_mentee') ? 'active' : '' }}"><i class="fas fa-clock"></i>My Classes <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="search" class="{{ Request::is('search') ? 'active' : '' }}"><i class="fas fa-hourglass-start"></i>Booking <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="paymentplan" class="{{ Request::is('paymentplan') ? 'active' : '' }}"><i class="fas fa-user-cog"></i>plans <span><i class="fas fa-chevron-right"></i></span></a></li>

		<!-- <li><a href="chat" class="{{ Request::is('chat') ? 'active' : '' }}"><i class="fas fa-comments"></i>Messages <span><i class="fas fa-chevron-right"></i></span></a></li> -->
		<!-- <li><a href="favourites" class="{{ Request::is('favourites') ? 'active' : '' }}"><i class="fas fa-star"></i>Favourites <span><i class="fas fa-chevron-right"></i></span></a></li> -->
		<li><a href="profile-settings-mentee" class="{{ Request::is('profile-settings-mentee') ? 'active' : '' }}"><i class="fas fa-user-cog"></i>Profile <span><i class="fas fa-chevron-right"></i></span></a></li>
		<li><a href="logout" class="{{ Request::is('logout') ? 'active' : '' }}"><i class="fas fa-sign-out-alt"></i>Logout <span><i class="fas fa-chevron-right"></i></span></a></li>






	</ul>
</div>
@endif