{{--
@include('Visitor.inc.header')
@include('Visitor.inc.menu')

<div class="wrapper">
	<div class="preloader"></div>

	<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid">
		    <!-- Ace Responsive Menu -->
		    <nav>
		        <!-- Menu Toggle btn-->
		        <div class="menu-toggle">
		            <img class="nav_logo_img img-fluid" src="images/header-logo.png" alt="header-logo.png">
		            <button type="button" id="menu-btn">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <a href="#" class="navbar_brand float-left dn-smd">
		            <img class="logo1 img-fluid" src="images/header-logo.png" alt="header-logo.png">
		            <img class="logo2 img-fluid" src="images/header-logo2.png" alt="header-logo2.png">
		            <span>edumy</span>
		        </a>
		        <!-- Responsive Menu Structure-->
		        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
		        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
		            <li>
		                <a href="#"><span class="title">Home</span></a>
		                <!-- Level Two-->
		                <ul>
		                    <li><a href="index.html">Home 1</a></li>
		                    <li><a href="index2.html">Home 2</a></li>
		                    <li><a href="index3.html">Home 3</a></li>
		                    <li><a href="index4.html">Home 4</a></li>
		                    <li><a href="index5.html">Home 5</a></li>
		                    <li><a href="index6.html">Home - University</a></li>
		                    <li><a href="index7.html">Home College</a></li>
		                    <li><a href="index8.html">Home Kindergarten</a></li>

		                    <li>
					                <a href="#"><span class="title">Update New Homepages</span></a>
					                <!-- Level Two-->
				                	<ul>
														<li><a href="index9.html">New Home 01</a></li>
														<li><a href="index10.html">New Home 02</a></li>
														<li><a href="index11.html">New Home 03</a></li>
														<li><a href="index12.html">New Home 04</a></li>
														<li><a href="index13.html">New Home 05</a></li>
													</ul>
					            </li>

		                </ul>
		            </li>
		            <li>
		                <a href="#"><span class="title">Courses</span></a>
		                <!-- Level Two-->
	                	<ul>
		                    <li>
		                        <a href="#">Courses List</a>
		                        <!-- Level Three-->
		                        <ul>
		                            <li><a href="page-course-v1.html">Courses v1</a></li>
		                            <li><a href="page-course-v2.html">Courses v2</a></li>
		                            <li><a href="page-course-v3.html">Courses v3</a></li>
		                        </ul>
		                    </li>
		                    <li>
		                        <a href="#">Courses Single</a>
		                        <!-- Level Three-->
		                        <ul>
		                            <li><a href="page-course-single-v1.html">Single V1</a></li>
		                            <li><a href="page-course-single-v2.html">Single V2</a></li>
		                            <li><a href="page-course-single-v3.html">Single V3</a></li>
		                            <li><a href="page-course-single-v4.html">New Single V4</a></li>
		                            <li><a href="page-course-single-v5.html">New Single V5</a></li>
		                            <li><a href="page-course-single-v6.html">New Single V6</a></li>
		                            <li><a href="page-course-single-v7.html">New Single V7</a></li>
		                        </ul>
		                    </li>
                            <li><a href="page-instructors.html">Instructors</a></li>
		                    <li><a href="page-instructors-single.html">Instructor Single</a></li>
	                	</ul>
		            </li>
		            <li>
		                <a href="#"><span class="title">Events</span></a>
		                <ul>
		                    <li><a href="page-event.html">Event List</a></li>
		                    <li><a href="page-event-single.html">Event Single</a></li>
		                </ul>
		            </li>
		            <li>
		                <a href="#"><span class="title">Pages</span></a>
		                <ul>
				            <li>
				                <a href="#"><span class="title">Shop Pages</span></a>
				                <ul>
				                    <li><a href="page-shop.html">Shop</a></li>
				                    <li><a href="page-shop-single.html">Shop Single</a></li>
				                    <li><a href="page-shop-cart.html">Cart</a></li>
				                    <li><a href="page-shop-checkout.html">Checkout</a></li>
				                    <li><a href="page-shop-order.html">Order</a></li>
				                </ul>
				            </li>
				            <li>
				                <a href="#"><span class="title">User Admin</span></a>
				                <ul>
				                    <li><a href="page-dashboard.html">Dashboard</a></li>
				                    <li><a href="page-my-courses.html">My Courses</a></li>
				                    <li><a href="page-my-order.html">My Order</a></li>
				                    <li><a href="page-my-message.html">My Message</a></li>
				                    <li><a href="page-my-review.html">My Review</a></li>
				                    <li><a href="page-my-bookmarks.html">My Bookmarks</a></li>
				                    <li><a href="page-my-listing.html">My Listing</a></li>
				                    <li><a href="page-my-setting.html">My Setting</a></li>
		                        </ul>
				            </li>
		                    <li><a href="page-about.html">About Us</a></li>
		                    <li><a href="page-gallery.html">Gallery</a></li>
		                    <li><a href="page-gallery2.html">Video Gallery</a></li>
		                    <li><a href="page-faq.html">Faq</a></li>
		                    <li><a href="page-login.html">LogIn</a></li>
		                    <li><a href="page-login2.html">New LogIn V2</a></li>
		                    <li><a href="page-login3.html">New LogIn V3</a></li>
		                    <li><a href="page-login4.html">New LogIn V4</a></li>
		                    <li><a href="page-register.html">Register</a></li>
		                    <li><a href="page-pricing.html">Membership</a></li>
		                    <li><a href="page-error.html">404 Page</a></li>
		                    <li><a href="page-terms.html">Terms and Conditions</a></li>
		                    <li><a href="page-become-instructor.html">Become an Instructor</a></li>
		                    <li><a href="page-ui-element.html">UI Elements</a></li>
		                </ul>
		            </li>
		            <li>
		                <a href="#"><span class="title">Blog</span></a>
		                <ul>
		                    <li><a href="page-blog-v1.html">Blog List 1</a></li>
		                    <li><a href="page-blog-grid.html">Blog List 2</a></li>
		                    <li><a href="page-blog-list.html">Blog List 3</a></li>
		                    <li><a href="page-blog-list2.html">New Blog List 4</a></li>
		                    <li><a href="page-blog-list3.html">New Blog List 5</a></li>
		                    <li><a href="page-blog-list4.html">New Blog List 6</a></li>
		                    <li><a href="page-blog-single.html">Single Post</a></li>
		                </ul>
		            </li>
		            <li class="last">
		                <a href="page-contact.html"><span class="title">Contact</span></a>
		            </li>
		        </ul>
		        <ul class="sign_up_btn pull-right dn-smd mt20">
	                <li class="list-inline-item list_s"><a href="#" class="btn flaticon-user" data-toggle="modal" data-target="#exampleModalCenter"> <span class="dn-lg">Login/Register</span></a></li>
	                <li class="list-inline-item list_s">
	                	<div class="cart_btn">
							<ul class="cart">
								<li>
									<a href="#" class="btn cart_btn flaticon-shopping-bag"><span>5</span></a>
									<ul class="dropdown_content">
										<li class="list_content">
											<a href="#">
												<img class="float-left" src="http://via.placeholder.com/50x50" alt="50x50">
												<p>Dolar Sit Amet</p>
												<small>1 × $7.90</small>
												<span class="close_icon float-right"><i class="fa fa-plus"></i></span>
											</a>
										</li>
										<li class="list_content">
											<a href="#">
												<img class="float-left" src="http://via.placeholder.com/50x50" alt="50x50">
												<p>Lorem Ipsum</p>
												<small>1 × $7.90</small>
												<span class="close_icon float-right"><i class="fa fa-plus"></i></span>
											</a>
										</li>
										<li class="list_content">
											<a href="#">
												<img class="float-left" src="http://via.placeholder.com/50x50" alt="50x50">
												<p>Is simply</p>
												<small>1 × $7.90</small>
												<span class="close_icon float-right"><i class="fa fa-plus"></i></span>
											</a>
										</li>
										<li class="list_content">
											<h5>Subtotal: $57.70</h5>
											<a href="#" class="btn btn-thm cart_btns">View cart</a>
											<a href="#" class="btn btn-thm3 checkout_btns">Checkout</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
	                </li>
	                <li class="list-inline-item list_s">
	                	<div class="search_overlay">
						 	<a id="search-button-listener" class="mk-search-trigger mk-fullscreen-trigger" href="#">
						    	<span id="search-button"><i class="flaticon-magnifying-glass"></i></span>
						 	</a>
						</div>
	                </li>
	            </ul><!-- Button trigger modal -->
		    </nav>
		</div>
	</header>
	<!-- Modal -->
	<div class="sign_up_modal modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      	</div>
	    		<ul class="sign_up_tab nav nav-tabs" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
				  	</li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="login_form">
							<form action="#">
								<div class="heading">
									<h3 class="text-center">Login to your account</h3>
									<p class="text-center">Don't have an account? <a class="text-thm" href="#">Sign Up!</a></p>
								</div>
								 <div class="form-group">
							    	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address">
								</div>
								<div class="form-group">
							    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
								</div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="exampleCheck1">
									<label class="custom-control-label" for="exampleCheck1">Remember me</label>
									<a class="tdu btn-fpswd float-right" href="#">Forgot Password?</a>
								</div>
								<button type="submit" class="btn btn-log btn-block btn-thm2">Login</button>
								<hr>
								<div class="row mt40">
									<div class="col-lg">
										<button type="submit" class="btn btn-block color-white bgc-fb"><i class="fa fa-facebook float-left mt5"></i> Facebook</button>
									</div>
									<div class="col-lg">
										<button type="submit" class="btn btn-block color-white bgc-gogle"><i class="fa fa-google float-left mt5"></i> Google</button>
									</div>
								</div>
							</form>
						</div>
				  	</div>
				  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="sign_up_form">
							<div class="heading">
								<h3 class="text-center">Create New Account</h3>
								<p class="text-center">Have an account? <a class="text-thm" href="#">Login</a></p>
							</div>
							<form action="#">
								<div class="form-group">
							    	<input type="text" class="form-control" id="exampleInputName1" placeholder="Username">
								</div>
								 <div class="form-group">
							    	<input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email Address">
								</div>
								<div class="form-group">
							    	<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
								</div>
								<div class="form-group">
							    	<input type="password" class="form-control" id="exampleInputPassword3" placeholder="Confirm Password">
								</div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="exampleCheck2">
									<label class="custom-control-label" for="exampleCheck2">Want to become an instructor?</label>
								</div>
								<button type="submit" class="btn btn-log btn-block btn-thm2">Register</button>
								<hr>
								<div class="row mt40">
									<div class="col-lg">
										<button type="submit" class="btn btn-block color-white bgc-fb"><i class="fa fa-facebook float-left mt5"></i> Facebook</button>
									</div>
									<div class="col-lg">
										<button type="submit" class="btn btn-block color-white bgc-gogle"><i class="fa fa-google float-left mt5"></i> Google</button>
									</div>
								</div>
							</form>
						</div>
				  	</div>
				</div>
	    	</div>
	  	</div>
	</div>
	<!-- Modal Search Button Bacground Overlay -->
    <div class="search_overlay dn-992">
		<div class="mk-fullscreen-search-overlay" id="mk-search-overlay">
		    <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button"><i class="fa fa-times"></i></a>
		    <div id="mk-fullscreen-search-wrapper">
		      <form method="get" id="mk-fullscreen-searchform">
		        <input type="text" value="" placeholder="Search courses..." id="mk-fullscreen-search-input">
		        <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
		      </form>
		    </div>
		</div>
	</div>

	<!-- Main Header Nav For Mobile -->
		@include('Visitor.inc.mobile_menu')

	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row" style="width: 100%;">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">About Us</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">About Us</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- About Text Content -->
	<section class="about-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="about_content">
						<h3>Our Values</h3>
						<p class="color-black22 mt20">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis,et quasi architecto beatae vitae dicta sunt explicabo.</p>
						<p class="mt15">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis,et quasi architecto beatae vitae dicta sunt explicabo.</p>
						<p class="mt20">Nemo enim ipsam,voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia,consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.,Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, adipisci velit, sed quia non numquam eius modi tempora</p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about_thumb">
						<img class="img-fluid" src="images/about/8.jpg" alt="8.jpg">
					</div>
				</div>
			</div>
			<div class="row mb60">
				<div class="col-lg-12 text-center mt60">
					<h3 class="fz26">Our Story</h3>
				</div>
				<div class="col-lg-12 text-center mt40">
					<ul class="funfact_two_details">
						<li class="list-inline-item">
							<div class="funfact_two text-left">
								<div class="details">
									<h5>FOREIGN FOLLOWERS</h5>
									<div class="timer">88,000</div>
								</div>
							</div>
						</li>
						<li class="list-inline-item">
							<div class="funfact_two text-left">
								<div class="details">
									<h5>CERTIFIED TEACHERS</h5>
									<div class="timer">96</div>
								</div>
							</div>
						</li>
						<li class="list-inline-item">
							<div class="funfact_two text-left">
								<div class="details">
									<h5>STUDENTS ENROLLED</h5>
									<div class="timer">4,789</div>
								</div>
							</div>
						</li>
						<li class="list-inline-item">
							<div class="funfact_two text-left">
								<div class="details">
									<h5>COMPLETE COURSES</h5>
									<div class="timer">489</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="about_whoweare">
						<h4>Who We Are</h4>
						<p class="mt25">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis,et quasi architecto beatae vitae dicta sunt explicabo.</p>
						<p class="mt25">Nemo enim ipsam,voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia,consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.,Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, adipisci velit, sed quia non numquam eius modi tempora</p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about_whoweare">
						<h4>What We Do</h4>
						<p class="mt25">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis,et quasi architecto beatae vitae dicta sunt explicabo.</p>
						<p class="mt25">Nemo enim ipsam,voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia,consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.,Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, adipisci velit, sed quia non numquam eius modi tempora</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Divider -->
	<section class="divider parallax bg-img2" data-stellar-background-ratio="0.3">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="divider-one">
						<p class="color-white">STARTING ONLINE LEARNING</p>
						<h1 class="color-white text-uppercase">Enhance your skIlls wIth best OnlIne courses</h1>
						<a class="btn btn-transparent divider-btn" href="#">Get Started Now</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Team Members -->
	<section class="our-team pb40">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-title text-center">
						<h3 class="mb0 mt0">Popular Instructors</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="team_slider">
						<div class="item">
							<div class="team_member text-center">
								<div class="instructor_col">
									<div class="thumb">
										<img class="img-fluid img-rounded-circle" src="images/team/6.png" alt="6.png">
									</div>
									<div class="details">
										<h4>Andrew Williams</h4>
										<p>Web Design, Photoshop</p>
										<ul>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#">(6)</a></li>
										</ul>
									</div>
								</div>
								<div class="tm_footer">
									<ul>
										<li class="list-inline-item"><a href="#">56,178 students</a></li>
										<li class="list-inline-item"><a href="#">22 courses</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="team_member text-center">
								<div class="instructor_col">
									<div class="thumb">
										<img class="img-fluid img-rounded-circle" src="images/team/7.png" alt="7.png">
									</div>
									<div class="details">
										<h4>Anna Richard</h4>
										<p>CSS, HTML</p>
										<ul>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#">(6)</a></li>
										</ul>
									</div>
								</div>
								<div class="tm_footer">
									<ul>
										<li class="list-inline-item"><a href="#">56,178 students</a></li>
										<li class="list-inline-item"><a href="#">22 courses</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="team_member text-center">
								<div class="instructor_col">
									<div class="thumb">
										<img class="img-fluid img-rounded-circle" src="images/team/8.png" alt="8.png">
									</div>
									<div class="details">
										<h4>Krisztina Szer</h4>
										<p>User Experience Design</p>
										<ul>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#">(6)</a></li>
										</ul>
									</div>
								</div>
								<div class="tm_footer">
									<ul>
										<li class="list-inline-item"><a href="#">56,178 students</a></li>
										<li class="list-inline-item"><a href="#">22 courses</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="team_member text-center">
								<div class="instructor_col">
									<div class="thumb">
										<img class="img-fluid img-rounded-circle" src="images/team/9.png" alt="9.png">
									</div>
									<div class="details">
										<h4>Kristen Pala</h4>
										<p>Web Design, PSD to HTML</p>
										<ul>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#">(6)</a></li>
										</ul>
									</div>
								</div>
								<div class="tm_footer">
									<ul>
										<li class="list-inline-item"><a href="#">56,178 students</a></li>
										<li class="list-inline-item"><a href="#">22 courses</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="team_member text-center">
								<div class="instructor_col">
									<div class="thumb">
										<img class="img-fluid img-rounded-circle" src="images/team/10.png" alt="10.png">
									</div>
									<div class="details">
										<h4>Jill Poye</h4>
										<p>Watercolor Painting</p>
										<ul>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#">(6)</a></li>
										</ul>
									</div>
								</div>
								<div class="tm_footer">
									<ul>
										<li class="list-inline-item"><a href="#">56,178 students</a></li>
										<li class="list-inline-item"><a href="#">22 courses</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Testimonials -->
	<section id="our-testimonials" class="our-testimonials">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0">What People Say</h3>
						<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="testimonialsec">
						<ul class="tes-nav">
							<li>
								<img class="img-fluid" src="images/testimonial/1.jpg" alt="1.jpg"/>
							</li>
							<li>
								<img class="img-fluid" src="images/testimonial/2.jpg" alt="2.jpg"/>
							</li>
							<li>
								<img class="img-fluid" src="images/testimonial/3.jpg" alt="3.jpg"/>
							</li>
							<li>
								<img class="img-fluid" src="images/testimonial/4.jpg" alt="4.jpg"/>
							</li>
						</ul>
						<ul class="tes-for">
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h5>Ali Tufan</h5>
										<span class="small text-thm">Client</span>
										<p>Customization is very easy with this theme. Clean and quality design and full support for any kind of request! Great theme!</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Partners -->
	<section id="our-partners" class="our-partners">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0">Need To Train Your Team?</h3>
						<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="row">
						<div class="col-sm-6 col-md-4 col-lg">
							<div class="our_partner">
								<img class="img-fluid" src="images/partners/1.png" alt="1.png">
							</div>
						</div>
						<div class="col-sm-6 col-md-4 col-lg">
							<div class="our_partner">
								<img class="img-fluid" src="images/partners/2.png" alt="2.png">
							</div>
						</div>
						<div class="col-sm-6 col-md-4 col-lg">
							<div class="our_partner">
								<img class="img-fluid" src="images/partners/3.png" alt="3.png">
							</div>
						</div>
						<div class="col-sm-6 col-md-4 col-lg">
							<div class="our_partner">
								<img class="img-fluid" src="images/partners/4.png" alt="4.png">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Newslatters -->
	<section id="our-newslatters" class="our-newslatters">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0">Get Newsletter</h3>
						<p>Your download should start automatically, if not Click here. Should I give up, huh?.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="footer_apps_widget_home1">
						<form class="form-inline mailchimp_form">
							<input type="email" class="form-control" placeholder="Email address">
							<button type="submit" class="btn btn-lg btn-thm dbxshad">Get it now <span class="flaticon-right-arrow-1"></span></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

<a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>
@include('Visitor.inc.footer') --}}


@include('Visitor.inc.header')
@include('Visitor.inc.menu')

<style>
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Header Styles */
    .page-header {
        background: linear-gradient(to right, rgba(220, 53, 69, 0.9), rgba(220, 53, 69, 0.8)), url('https://images.unsplash.com/photo-1522881193457-37ae97c905bf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80') center/cover no-repeat;
        color: var(--white);
        padding: 80px 0;
        text-align: center;
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        list-style: none;
        margin-top: 15px;
    }

    .breadcrumb-item {
        margin: 0 10px;
        position: relative;
    }

    .breadcrumb-item:not(:last-child):after {
        content: "/";
        position: absolute;
        right: -15px;
        color: var(--white);
    }

    .breadcrumb-item a {
        color: var(--white);
        text-decoration: none;
        transition: opacity 0.3s;
    }

    .breadcrumb-item a:hover {
        opacity: 0.8;
    }

    /* Section Styles */
    section {
        padding: 80px 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }

    .section-title h2:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: var(--primary);
    }

    .section-title p {
        color: var(--gray);
        max-width: 600px;
        margin: 0 auto;
    }

    /* About Content */
    .about-content {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 60px;
    }

    .about-text {
        flex: 1;
        min-width: 300px;
        padding: 20px;
    }

    .about-image {
        flex: 1;
        min-width: 300px;
        padding: 20px;
    }

    .about-image img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    /* Stats Section */
    .stats {
        background-color: var(--primary-light);
        border-radius: 10px;
        padding: 40px;
        margin: 40px 0;
    }

    .stats-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        text-align: center;
    }

    .stat-item {
        flex: 1;
        min-width: 200px;
        padding: 20px;
    }

    .stat-item h3 {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 10px;
    }

    /* Team Section */
    .team-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .team-member {
        background-color: var(--white);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        max-width: 280px;
    }

    .team-member:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .team-img {
        width: 100%;
        height: 250px;
        object-fit: contain;
    }

    .team-info {
        padding: 20px;
        text-align: center;
    }

    .team-info h4 {
        color: var(--primary);
        margin-bottom: 5px;
    }

    .team-info p {
        color: var(--gray);
        margin-bottom: 15px;
    }

    .team-stats {
        display: flex;
        justify-content: space-around;
        border-top: 1px solid var(--light-gray);
        padding: 15px 0 0;
        margin-top: 15px;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(to right, rgba(220, 53, 69, 0.9), rgba(220, 53, 69, 0.8)), url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80') center/cover no-repeat;
        color: var(--white);
        text-align: center;
        padding: 100px 0;
    }

    .cta-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .cta-content h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .cta-content p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .btn-icon {
        display: inline-block;
        padding: 12px 30px;
        background-color: var(--white);
        color: var(--primary);
        text-decoration: none;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .btn-icon:hover {
        background-color: transparent;
        border-color: var(--white);
        color: var(--white);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .about-content {
            flex-direction: column;
        }

        .stats-container {
            flex-direction: column;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        section {
            padding: 60px 0;
        }
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background-color: var(--primary);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
        z-index: 1000;
    }

    .back-to-top:hover {
        background-color: var(--dark);
        transform: translateY(-5px);
    }
</style>

<body>
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1>About Us</h1>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ul>
        </div>
    </header>

    <!-- About Content Section -->
    <section>
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Our Values</h2>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium laudantium, totam rem
                        aperiam, eaque ipsa quae ab illo inventore veritatis, et quasi architecto beatae vitae dicta
                        sunt explicabo.</p>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                        magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem
                        ipsum quia dolor sit amet.</p>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats">
                <h3 class="section-title">Our Story</h3>
                <div class="stats-container">
                    <div class="stat-item">
                        <h3>88,000</h3>
                        <p>FOREIGN FOLLOWERS</p>
                    </div>
                    <div class="stat-item">
                        <h3>96</h3>
                        <p>CERTIFIED TEACHERS</p>
                    </div>
                    <div class="stat-item">
                        <h3>4,789</h3>
                        <p>STUDENTS ENROLLED</p>
                    </div>
                    <div class="stat-item">
                        <h3>489</h3>
                        <p>COMPLETE COURSES</p>
                    </div>
                </div>
            </div>

            <!-- Who We Are / What We Do -->
            <div class="about-content">
                <div class="about-text">
                    <h2>Who We Are</h2>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium laudantium, totam rem
                        aperiam, eaque ipsa quae ab illo inventore veritatis, et quasi architecto beatae vitae dicta
                        sunt explicabo.</p>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                        magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                </div>
                <div class="about-text">
                    <h2>What We Do</h2>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium laudantium, totam rem
                        aperiam, eaque ipsa quae ab illo inventore veritatis, et quasi architecto beatae vitae dicta
                        sunt explicabo.</p>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                        magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Enhance Your Skills With Best Online Courses</h2>
                <p>Join thousands of students learning with our platform. Start your educational journey today.</p>
                <a href="#" class="btn-icon">Get Started Now</a>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section style="background-color: var(--primary-light);">
        <div class="container">
            <div class="section-title">
                <h2>Popular Instructors</h2>
                <p>Meet our team of dedicated and experienced educators</p>
            </div>

            <div class="team-container">
                <!-- Team Member 1 -->
                <div class="team-member">
                    <img src="/Mathshouse/public/assets/media/logos/mathshouse_white_logo.png"
                        alt="Andrew Williams" class="team-img">
                    <div class="team-info">
                        <h4>Andrew Williams</h4>
                        <p>Web Design, Photoshop</p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(6)</span>
                        </div>
                        <div class="team-stats">
                            <div>56,178 students</div>
                            <div>22 courses</div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-member">
                    <img src="/Mathshouse/public/assets/media/logos/mathshouse_white_logo.png"
                        alt="Anna Richard" class="team-img">
                    <div class="team-info">
                        <h4>Anna Richard</h4>
                        <p>CSS, HTML</p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(6)</span>
                        </div>
                        <div class="team-stats">
                            <div>56,178 students</div>
                            <div>22 courses</div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-member">
                    <img src="/Mathshouse/public/assets/media/logos/mathshouse_white_logo.png"
                        alt="Krisztina Szer" class="team-img">
                    <div class="team-info">
                        <h4>Krisztina Szer</h4>
                        <p>User Experience Design</p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(6)</span>
                        </div>
                        <div class="team-stats">
                            <div>56,178 students</div>
                            <div>22 courses</div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="team-member">
                    <img src="/Mathshouse/public/assets/media/logos/mathshouse_white_logo.png"
                        alt="Kristen Pala" class="team-img">
                    <div class="team-info">
                        <h4>Kristen Pala</h4>
                        <p>Web Design, PSD to HTML</p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(6)</span>
                        </div>
                        <div class="team-stats">
                            <div>56,178 students</div>
                            <div>22 courses</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

</body>

@include('Visitor.inc.footer')
