@extends('layout.mainlayout')
@section('content')		
		<!-- Home Banner -->
		<section class="section section-search">
				<div class="container">
					<div class="banner-wrapper m-auto text-center">
						<div class="banner-header">
							<h1>Search Teacher in <span>Mentoring Appointment</span></h1>
							<p>Discover the best Mentors & institutions the city nearest to you.</p>
						</div>
                         
						<!-- Search -->
						<div class="search-box">
							<form action="search">
								<div class="form-group search-location">
									<input type="text" class="form-control" placeholder="Search Location">
								</div>
								<div class="form-group search-info">
									<input type="text" class="form-control" placeholder="Search School, Online educational centers, etc">
								</div>
								<button type="submit" class="btn btn-primary search-btn"><i><img src="assets/img/search-submit.png" alt=""></i> <span>Search</span></button>
							</form>
						</div>
						<!-- /Search -->
						
					</div>
				</div>
			</section>
			<!-- /Home Banner -->

			<section class="section how-it-works">
				<div class="container">
					<div class="section-header text-center">
						<span>Mentoring Flow</span>
						<h2>How does it works ?</h2>
						<p class="sub-title">Are you looking to join online institutions? Now it's very simple, Sign up with mentoring</p>
					</div>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-4">
							<div class="feature-box text-center">					
								<div class="feature-header">
									<div class="feature-icon">
										<span class="circle"></span>
										<i><img src="assets/img/icon-1.png" alt=""></i>
									</div>		
									<div class="feature-cont">	
										<div class="feature-text">Sign up</div>
									</div>
								</div>
								<p class="mb-0">Are you looking to join online Learning? Now it's very simple, Now Sign up</p>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4">
							<div class="feature-box text-center">					
								<div class="feature-header">
									<div class="feature-icon">
										<span class="circle"></span>
										<i><img src="assets/img/icon-2.png" alt=""></i>
									</div>	
									<div class="feature-cont">
										<div class="feature-text">Collaborate</div>
									</div>
								</div>
								<p class="mb-0">Collaborate on your own timing, by scheduling with mentor booking</p>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4">
							<div class="feature-box text-center">					
								<div class="feature-header">
									<div class="feature-icon">
										<span class="circle"></span>
										<i><img src="assets/img/icon-3.png" alt=""></i>
									</div>	
									<div class="feature-cont">
										<div class="feature-text">Improve & Get Back</div>
									</div>
								</div>
								<p class="mb-0">you can gather different skill set, and you can become mentor too</p>
							</div>
						</div>
						
					</div>
				</div>
			</section>

			<section class="section popular-courses">
				<div class="container">
					<div class="section-header text-center">
						<span>Mentoring Goals</span>
						<h2>Popular Mentors</h2>
						<p class="sub-title">Do you want to move on next step? Choose your most popular leaning mentors, it will help you to achieve your professional goals.</p>
					</div>
					<div class="owl-carousel owl-theme">
				
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user1.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Donna Yancey</a></h3>
									<div class="author-info">
										<div class="author-name">
											Digital Marketer
										</div>
									</div>
									<div class="rating">							
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user2.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">James Amen</a></h3>
									<div class="author-info">
										<div class="author-name">
											UNIX, Calculus, Trigonometry
										</div>
									</div>
									<div class="rating">						
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user3.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title">Marvin Downey</h3>
									<div class="author-info">
										<div class="author-name">
											ASP.NET,Computer Gaming
										</div>
									</div>
									<div class="rating">						
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user4.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Betty Hairston</a></h3>
									<div class="author-info">
										<div class="author-name">
											Computer Programming
										</div>
									</div>
									<div class="rating">						
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Jose Anderson</a></h3>
									<div class="author-info">
										<div class="author-name">
											Digital Marketer
										</div>
									</div>
									<div class="rating">							
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star "></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user6.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Aaron Pietrzak</a></h3>
									<div class="author-info">
										<div class="author-name">
											UNIX,Calculus,Trigonometry
										</div>
									</div>
									<div class="rating">						
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user7.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Brian Martinez</a></h3>
									<div class="author-info">
										<div class="author-name">
											ASP.NET,Computer Gaming
										</div>
									</div>
									<div class="rating">						
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user15.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Misty Lundy</a></h3>
									<div class="author-info">
										<div class="author-name">
											Computer Programming
										</div>
									</div>
									<div class="rating">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user9.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Vern Campbell</a></h3>
									<div class="author-info">
										<div class="author-name">
											Digital Marketer
										</div>
									</div>
									<div class="rating">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user13.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Jessica Fogarty</a></h3>
									<div class="author-info">
										<div class="author-name">
											UNIX,Calculus,Trigonometry
										</div>
									</div>
									<div class="rating">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user11.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Evelyn Stafford</a></h3>
									<div class="author-info">
										<div class="author-name">
											ASP.NET,Computer Gaming
										</div>
									</div>
									<div class="rating">
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star "></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
					
						<div class="course-box">
							<div class="product">
								<div class="product-img">
									<a href="profile">
										<img class="img-fluid" alt="" src="assets/img/user/user12.jpg" width="600" height="300">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="profile">Christopher Carroll</a></h3>
									<div class="author-info">
										<div class="author-name">
											Computer Programming
										</div>
									</div>
									<div class="rating">
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star"></i>
										<span class="d-inline-block average-rating">4.4</span>
									</div>
									<div class="author-country">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> Paris, France</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- Path section start -->
			<section class="section path-section">
				<div class="section-header text-center">
					<div class="container">
						<span>Choose the</span>
						<h2>Different All Learning Paths</h2>
						<p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
					</div>
				</div>
				<div class="learning-path-col">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img1.jpg" alt="">
											<div class="text-col">
												<h5>Digital Marketer</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img2.jpg" alt="">
											<div class="text-col">
												<h5>Ui designer</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img3.jpg" alt="">
											<div class="text-col">
												<h5>IT Security</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img4.jpg" alt="">
											<div class="text-col">
												<h5>Front-End Developer</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img5.jpg" alt="">
											<div class="text-col">
												<h5>Web Developer</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img6.jpg" alt="">
											<div class="text-col">
												<h5>Administrator</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img7.jpg" alt="">
											<div class="text-col">
												<h5>Project Manager</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-12 col-md-4 col-lg-3">
								<div class="large-col">
									<a href="search" class="large-col-image">
										<div class="image-col-merge">
											<img src="assets/img/path-img8.jpg" alt="">
											<div class="text-col">
												<h5>PHP Developer</h5>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="view-all text-center"><a href="#" class="btn btn-primary">View All</a></div>						
					</div>
				</div>
			</section>
			<!-- Path section end -->
			
			<!-- Blog Section -->
		   <section class="section section-blogs">
				<div class="container">
				
					<!-- Section Header -->
					<div class="section-header text-center">
						<span>Lorem ipsum dolor</span>
						<h2>The Blogs & News</h2>
						<p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
					<!-- /Section Header -->
					
					<div class="row blog-grid-row">
						<div class="col-md-6 col-lg-3 col-sm-12">
						
							<!-- Blog Post -->
							<div class="blog grid-blog">
								<div class="blog-image">
									<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt="Post Image"></a>
								</div>
								<div class="blog-content">
									<ul class="entry-meta meta-item">
										<li>
											<div class="post-author">
												<a href="blog-details"><span>Tyrone Roberts</span></a>
											</div>
										</li>
										<li><i class="far fa-clock"></i> 4 Dec 2019</li>
									</ul>
									<h3 class="blog-title"><a href="blog-details">What is Lorem Ipsum? Lorem Ipsum is simply</a></h3>
									<p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
								</div>
							</div>
							<!-- /Blog Post -->
							
						</div>
						<div class="col-md-6 col-lg-3 col-sm-12">
						
							<!-- Blog Post -->
							<div class="blog grid-blog">
								<div class="blog-image">
									<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt="Post Image"></a>
								</div>
								<div class="blog-content">
									<ul class="entry-meta meta-item">
										<li>
											<div class="post-author">
												<a href="blog-details"><span>Brittany Garcia</span></a>
											</div>
										</li>
										<li><i class="far fa-clock"></i> 3 Dec 2019</li>
									</ul>
									<h3 class="blog-title"><a href="blog-details">Contrary to popular belief, Lorem Ipsum is</a></h3>
									<p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
								</div>
							</div>
							<!-- /Blog Post -->
							
						</div>
						<div class="col-md-6 col-lg-3 col-sm-12">
						
							<!-- Blog Post -->
							<div class="blog grid-blog">
								<div class="blog-image">
									<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt="Post Image"></a>
								</div>
								<div class="blog-content">
									<ul class="entry-meta meta-item">
										<li>
											<div class="post-author">
												<a href="blog-details"><span>Allen Davis</span></a>
											</div>
										</li>
										<li><i class="far fa-clock"></i> 3 Dec 2019</li>
									</ul>
									<h3 class="blog-title"><a href="blog-details">The standard chunk of Lorem Ipsum used</a></h3>
									<p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
								</div>
							</div>
							<!-- /Blog Post -->
							
						</div>
						<div class="col-md-6 col-lg-3 col-sm-12">
						
							<!-- Blog Post -->
							<div class="blog grid-blog">
								<div class="blog-image">
									<a href="blog-details"><img class="img-fluid" src="assets/img/blog/blog-04.jpg" alt="Post Image"></a>
								</div>
								<div class="blog-content">
									<ul class="entry-meta meta-item">
										<li>
											<div class="post-author">
												<a href="blog-details"><span>William Lawrence</span></a>
											</div>
										</li>
										<li><i class="far fa-clock"></i> 2 Dec 2019</li>
									</ul>
									<h3 class="blog-title"><a href="blog-details">The standard Lorem Ipsum passage, used</a></h3>
									<p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
								</div>
							</div>
							<!-- /Blog Post -->
							
						</div>
					</div>
					<div class="view-all text-center"> 
						<a href="blog-list" class="btn btn-primary">View All</a>
					</div>
				</div>
			</section>
			<!-- /Blog Section -->	

			<!-- Statistics Section -->
			<section class="section statistics-section">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="statistics-list text-center">
								<span>500+</span>
								<h3>Happy Clients</h3>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="statistics-list text-center">
								<span>120+</span>
								<h3>Online Appointments</h3>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="statistics-list text-center">
								<span>100%</span>
								<h3>Job Satisfaction</h3>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- /Statistics Section -->
	   @endsection
	  