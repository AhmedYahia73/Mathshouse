<style>
	.footer_middle_area, .footer_one {
    background-color: #fef5f3 !important;
}
.footer_contact_widget h4 ,.footer_company_widget h4, .footer_program_widget h4, .footer_support_widget h4, .footer_apps_widget h4 {
	color:#727272
}
.social-icons {
	left:-30px;
	top: 2px;
	background-color:#CF202F;
	color:white;
	
}
.brdr_left_right:before {
	background: none!important;
}
.footer_apps_widget .app_grid .apple_btn, .footer_apps_widget .app_grid .play_store_btn {
	background-color: #FFF;
    border: none;
    border-radius: 4px;
    height: 75px;
    margin-bottom: 15px;
    margin-right: 0;
    width: 100%;
}
.apple_btn:hover .title {
	color:#fff !important;
	
	/* background:red; */
}
/* .footer_apps_widget .app_grid:hover .apple_btn, .footer_apps_widget .app_grid:hover .play_store_btn {
	background-color:#CF202F;
	color:white
} */
.footer_apps_widget .app_grid{}

.footer_company_widget li:hover a {
    color: #c30a0a !important;
}
.footer_support_widget li:hover a {
    color: #c30a0a !important;
}
.footer_program_widget li:hover a {
	color: #c30a0a !important;
}
.footer_apps_widget .app_grid .apple_btn:hover, .footer_apps_widget .app_grid .play_store_btn:hover {
	background-color:#c30a0a !important;
}
.footer_apps_widget .app_grid .apple_btn:hover span, .footer_apps_widget .app_grid .apple_btn:hover span.subtitle, .footer_apps_widget .app_grid .play_store_btn:hover span, .footer_apps_widget .app_grid .play_store_btn:hover span.subtitle {
	color:#ffff !important;
}
</style>
	<!-- Our Footer -->
	<section class="footer_one">
		<div class="container">
			<div class="row">
			<div class="col-md-2">
					<div class="logo-widget home1">
						<img class="w-50"src="{{asset('assets/media/logos/mathshouse_white_logo.png')}}" alt="header-logo.png">
						
					</div>
				</div>
				<div class="col-md-2">
					<div class="footer_contact_widget">
						<h4>CONTACT</h4>
						<div class="position-relative">
						<i class="fa-solid fa-phone position-absolute social-icons rounded border p-1"></i>
						<p class="p-0 m-0">phone number: 123 456 7890</p>
						</div>
						<div class="position-relative">
						<i class="fa-brands fa-whatsapp position-absolute social-icons rounded border p-1"></i>
						<p class="p-0 m-0">Whatsapp: 123 456 7890</p>
						</div>
						<div class="position-relative">
						<i class="fa-regular fa-envelope position-absolute social-icons rounded border p-1"></i>
						<p class="p-0 m-0">Email: support@edumy.com</p>
						</div>
						<div class="position-relative">
						<i class="fa-solid fa-location-dot position-absolute social-icons rounded border p-1"></i>
						<p class="p-0 m-0">Address: 329 Queensberry Street, North Melbourne VIC 3051, Australia.</p>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="footer_company_widget">
						<h4>COMPANY</h4>
						<ul class="list-unstyled">
							<li><a href="#">About Us</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="https://mathshouse.net/index.php/contact/">Contact</a></li>
							<li><a href="#">Become a Teacher</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="footer_program_widget">
						<h4>PROGRAMS</h4>
						<ul class="list-unstyled">
							<li><a href="#">Nanodegree Plus</a></li>
							<li><a href="#">Veterans</a></li>
							<li><a href="#">Georgia</a></li>
							<li><a href="#">Self-Driving Car</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="footer_support_widget">
						<h4>SUPPORT</h4>
						<ul class="list-unstyled">
							<li><a href="#">Documentation</a></li>
							<li><a href="#">Forums</a></li>
							<li><a href="#">Language Packs</a></li>
							<li><a href="#">Release Status</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="footer_apps_widget">
						<h4>MOBILE</h4>
						<div class="app_grid">
							<button class="apple_btn rounded border shadow">
								<div class="icon">
									<span class="flaticon-apple text-danger"></span>
								</div>
								<span class="title text-danger">App Store</span>
								<span class="subtitle text-danger">Available now on the</span>
							</button>
							<button class="play_store_btn btn-dark">
								<div class="icon">
									<span class="flaticon-google-play text-danger"></span>
								</div>
								<span class="title text-danger">Google Play</span>
								<span class="subtitle text-danger">Get in on</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Footer Middle Area -->
	<section class="footer_middle_area p0">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="footer_menu_widget">
						<ul>
							<li class="list-inline-item"><a href="#">Home</a></li>
							<li class="list-inline-item"><a href="#">Privacy</a></li>
							<li class="list-inline-item"><a href="#">Terms</a></li>
							<li class="list-inline-item"><a href="#">Sitemap</a></li>
							<li class="list-inline-item"><a href="#">Purchase</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_social_widget mt15">
					<p>© {{date('Y')}}. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Footer Bottom Area -->
<!-- Wrapper End -->
<script type="text/javascript" src="{{asset('js/jquery-3.3.1.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-migrate-3.0.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.mmenu.all.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ace-responsive-menu.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/isotop.js')}}"></script>
<script type="text/javascript" src="{{asset('js/snackbar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/simplebar.js')}}"></script>
<script type="text/javascript" src="{{asset('js/parallax.js')}}"></script>
<script type="text/javascript" src="{{asset('js/scrollto.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-scrolltofixed-min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.counterup.js')}}"></script>
<script type="text/javascript" src="{{asset('js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/progressbar.js')}}"></script>
<script type="text/javascript" src="{{asset('js/slider.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timepicker.js')}}"></script>
<!-- Custom script for all pages --> 
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</body>
</html>