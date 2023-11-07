<!-- Sidebar -->
<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span><i class="fe fe-home"></i> {{ __('main') }}</span>
							</li>
							<li class="{{ Request::is('admin/index_admin') ? 'active' : '' }}"> 
								<a href="/admin/index_admin"><span>{{ __('dashboard') }}</span></a>
							</li>
							<li class="{{ Request::is('admin/mentor') ? 'active' : '' }}"> 
								<a href="/admin/mentor"><span>{{ __('mentor') }}</span></a>
							</li>
							<li class="{{ Request::is('admin/mentee') ? 'active' : '' }}"> 
								<a href="/admin/mentee"><span>{{ __('mentee') }}</span></a>
							</li>
							<li class="{{ Request::is('admin/booking-list') ? 'active' : '' }}"> 
								<a href="/admin/booking-list"><span>{{ __('booking list') }}</span></a>
							</li>
							<li class="{{ Request::is('admin/categories') ? 'active' : '' }}"> 
								<a href="/admin/categories"><span>Categories</span></a>
							</li>
							<li class="{{ Request::is('admin/transactions-list') ? 'active' : '' }}"> 
								<a href="/admin/transactions-list"><span>{{ __('Transactions') }}</span></a>
							</li>
							<li class="{{ Request::is('admin/settings') ? 'active' : '' }}"> 
								<a href="/admin/settings"><span>{{ __('Settings') }}</span></a>
							</li>
							<li class="submenu">
								<a href="#"><span> Reports</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('admin/invoice-report','admin/invoice') ? 'active' : '' }}" href="{{ url('admin/invoice-report') }}">Invoice Reports</a></li>
								</ul>
							</li>
							<li class="menu-title"> 
								<span><i class="fe fe-document"></i> Pages</span>
							</li>
							<li class="{{ Request::is('admin/profile') ? 'active' : '' }}"> 
								<a href="/admin/profile{id}"><span>My Profile</span></a>
							</li>
							<li class="submenu"> 
								<a href="#"><span>{{ __('Blog') }}</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('admin/blog') ? 'active' : '' }}" href="{{ url('admin/blog') }}"> {{ __('Blog') }}</a></li>
									<li><a class="{{ Request::is('admin/blog-details') ? 'active' : '' }}" href="{{ url('admin/blog-details') }}"> {{ __('Blog Details') }} </a></li>
									<li><a class="{{ Request::is('admin/add-blog') ? 'active' : '' }}" href="{{ url('admin/blog/create') }}"> {{ __('Add Blog') }} </a></li>
									<li><a class="{{ Request::is('admin/edit-blog') ? 'active' : '' }}" href="{{ url('admin/edit-blog') }}"> Edit Blog </a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><span> Authentication </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('admin/login') ? 'active' : '' }}" href="{{ url('admin/login') }}"> Login </a></li>
									<li class="{{ Request::is('admin/register') ? 'active' : '' }}"><a href="register"> Register </a></li>
									<li class="{{ Request::is('admin/forgot-password') ? 'active' : '' }}"><a href="forgot-password"> Forgot Password </a></li>
									<li class="{{ Request::is('admin/lock-screen') ? 'active' : '' }}"><a href="lock-screen"> Lock Screen </a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><span> Error Pages </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="{{ Request::is('admin/error-404') ? 'active' : '' }}"><a href="error-404">404 Error </a></li>
									<li class="{{ Request::is('admin/error-500') ? 'active' : '' }}"><a href="error-500">500 Error </a></li>
								</ul>
							</li>
							<li class="{{ Request::is('admin/blank-page') ? 'active' : '' }}"> 
								<a href="/admin/blank-page"><span>Blank Page</span></a>
							</li>
							<li class="menu-title"> 
								<span><i class="fe fe-star-o"></i> UI Interface</span>
							</li>
							<li class="{{ Request::is('admin/components') ? 'active' : '' }}"> 
								<a href="/admin/components"><span>Components</span></a>
							</li>
							<li class="submenu">
								<a href="#"><span> Forms </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('admin/form-basic-inputs') ? 'active' : '' }}" href="{{ url('admin/form-basic-inputs') }}">Basic Inputs </a></li>
									<li><a class="{{ Request::is('admin/form-input-groups') ? 'active' : '' }}" href="{{ url('admin/form-input-groups') }}">Input Groups </a></li>
									<li><a class="{{ Request::is('admin/form-horizontal') ? 'active' : '' }}" href="{{ url('admin/form-horizontal') }}">Horizontal Form </a></li>
									<li><a class="{{ Request::is('admin/form-vertical') ? 'active' : '' }}" href="{{ url('admin/form-vertical') }}"> Vertical Form </a></li>
									<li><a class="{{ Request::is('admin/form-mask') ? 'active' : '' }}" href="{{ url('admin/form-mask') }}"> Form Mask </a></li>
									<li><a class="{{ Request::is('admin/form-validation') ? 'active' : '' }}" href="{{ url('admin/form-validation') }}"> Form Validation </a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><span> Tables </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('admin/tables-basic') ? 'active' : '' }}" href="{{ url('admin/tables-basic') }}">Basic Tables </a></li>
									<li><a class="{{ Request::is('admin/data-tables') ? 'active' : '' }}" href="{{ url('admin/data-tables') }}">Data Table </a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);"><span>Multi Level</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="submenu">
										<a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
										<ul style="display: none;">
											<li><a href="javascript:void(0);"><span>Level 2</span></a></li>
											<li class="submenu">
												<a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
												<ul style="display: none;">
													<li><a href="javascript:void(0);">Level 3</a></li>
													<li><a href="javascript:void(0);">Level 3</a></li>
												</ul>
											</li>
											<li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
										</ul>
									</li>
									<li>
										<a href="javascript:void(0);"> <span>Level 1</span></a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->