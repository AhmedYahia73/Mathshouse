@php
if ( !empty(session('data')) ) {
$data = session('data');
}
@endphp

@extends('layout.loginMaster')
<!--begin::Theme mode setup on page load-->
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
@section('styleCssSection')
<style>
	.py-20 {
		padding-top: 21rem !important;
		padding-bottom: 26rem !important;
	}

	span {
		color: red;
	}
</style>
@endsection
@section('contentScript')
<script>
	var defaultThemeMode = "light"; 
			var themeMode; 
			if ( document.documentElement ) { 
				if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { 
					themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
				 } else { if ( localStorage.getItem("data-bs-theme") !== null ) {
					themeMode = localStorage.getItem("data-bs-theme"); 
				} else {
					 themeMode = defaultThemeMode; 
					} } 
					if (themeMode === "system") { 
						themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; 
					} document.documentElement.setAttribute("data-bs-theme", themeMode);
				 }
		
		
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
</script>

@endsection
@if(auth()->check())
already loged in
Your Name Is : {{ auth()->user()->email }}
<br>
and Your Name Is : {{ auth()->user()->nick_name }} <a href="{{ route('logout') }}">Logout</a>
@else
@section('content')
@if(session()->has('success'))
{{ session()->get('success') }}
@endif
@include('success')


<div class="d-flex flex-column flex-root" id="kt_app_root">
	<!--begin::Page bg image-->
	<style>
		body {
			background-image: url('assets/media/auth/bg4.jpg');
		}

		[data-bs-theme="dark"] body {
			background-image: url('assets/media/auth/bg4-dark.jpg');
		}
	</style>
	<!--end::Page bg image-->
	<!--begin::Authentication - Sign-up -->
	<div class="d-flex flex-column flex-column-fluid flex-lg-row">
		<!--begin::Aside-->
		<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
			<!--begin::Aside-->
			<div class="d-flex flex-center flex-lg-start flex-column">
				<!--begin::Logo-->
				<a href="{{ route('login.index') }}" class="mb-7">
					<img alt="Logo" src="{{asset('assets/media/logos/Maths-house.png')}}" />
				</a>

				<!--end::Logo-->
				<!--begin::Title-->
				<!--end::Title-->
			</div>
			<!--begin::Aside-->
		</div>
		<!--begin::Aside-->
		<!--begin::Body-->
		<div
			class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
			<!--begin::Card-->
			<div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
				<!--begin::Wrapper-->
				<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
					<!--begin::Form-->
					<form class="form w-100" action="{{ route('sign_up_add') }}" method="POST" novalidate="novalidate"
						id="kt_sign_in_form">
						@csrf
						<!--begin::Body-->
						<div class="card-body">
							<!--begin::Heading-->
							<div class="text-start mb-10">
								<!--begin::Title-->
								<h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="sign-in-title">Sign Up</h1>
								<!--end::Title-->
								<!--begin::Text-->
								<div class="text-gray-500 fw-semibold fs-6" data-kt-translate="general-desc">Get
									unlimited access & earn money</div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group=-->
							@error('f_name')
							<span style="color: red">{{ $message }}</span>
							@enderror
							@error('l_name')
							<span style="color: red">{{ $message }}</span>
							@enderror
							<div class="fv-row mb-8 d-flex">
								<!--begin::Email-->
								<input type="text" value="{{ old('f_name') ?? @$data['f_name'] }}"
									placeholder="First Name" name="f_name" class="form-control form-control-solid ml-2"
									required="required" />

								<input type="text" value="{{ old('l_name')  ?? @$data['l_name'] }}"
									placeholder="Last Name" name="l_name" class="form-control form-control-solid ml-2"
									required="required" />

								<!--end::Email-->
							</div>
							<!--end::Input group=-->
							@error('nick_name')
							<span style="color"> {{ $message }} </span>
							@enderror
							@error('email')
							<span style="color"> {{ $message }} </span>
							@enderror
							<div class="fv-row mb-7 d-flex">
								<!--begin::Password-->
								<input placeholder="Nick Name" value="{{ old('nick_name') ?? @$data['nick_name'] }}"
									name="nick_name" autocomplete="off" data-kt-translate="sign-in-input-email"
									class="form-control form-control-solid mr-2" required="required" />
								<!--begin::Password-->
								<input type="email" placeholder="Email" value="{{ old('email') ?? @$data['email'] }}"
									name="email" autocomplete="off" data-kt-translate="sign-in-input-email"
									class="form-control form-control-solid mr-2" required="required" />

								<!--end::Password-->
							</div>

							<!--end::Input group=-->
							@error('phone')
							<span style="color: red">{{ $message }}</span>
							@enderror
							<div class="fv-row mb-7 d-flex">
								<input placeholder="Phone" value="{{ old('phone') ?? @$data['phone']  }}" name="phone"
									autocomplete="off" data-kt-translate="sign-in-input-email"
									class="form-control form-control-solid mr-2" required="required" />
								@error('password')
								<span> {{ $message }} </span>
								@enderror
								<!--end::Password-->
							</div>
							<!--end::Input group=-->

							<div class="my-3">
							</div>
							<!--end::Input group=-->
							<div class="fv-row mb-7 d-flex">
								<!--begin::Password-->
								<div class="input-group">
									<span class="input-group-text"><i class="fa fa-lock"></i></span>
									<input class="form-control mr-2 password_field" type="password" name="password"
										placeholder="Password" autocomplete="off"
										data-kt-translate="sign-in-input-password" required="required" />
									<span class="input-group-text">
										<i class="fa fa-eye togglePassword" style="cursor: pointer"></i>
									</span>
								</div>

								<div class="input-group">
									<span class="input-group-text"><i class="fa fa-lock"></i></span>
									<input class="form-control ml-2 password_field" type="password" name="conf_password"
										placeholder="Confirm Password" autocomplete="off"
										data-kt-translate="sign-in-input-password" required="required" />
									<span class="input-group-text">
										<i class="fa fa-eye togglePassword" style="cursor: pointer"></i>
									</span>
								</div>

								@error('password')
								<span> {{ $message }} </span>
								@enderror
								<!--end::Password-->
							</div>
							<!--end::Input group=-->
							<!--end::Input group=-->
							<div class="fv-row mb-7 d-flex">
								<!--begin::Password-->
								<select class="form-control sel_country form-control-solid mr-2" name="country">
									<option disabled selected>
										Select Country
									</option>
									@foreach( $countries as $country )
									<option value="{{$country->id}}">
										{{$country->name}}
									</option>
									@endforeach
								</select>
								<!--end::Password-->
								<input type="hidden" class="countries" value="{{$countries}}" />
								<input type="hidden" class="cities" value="{{$cities}}" />
								<!--begin::Password-->
								<select class="form-control sel_city form-control-solid ml-2" name="city_id">
									<option disabled selected>
										Select City
									</option>
								</select>
								<!--end::Password-->
							</div>
							<!--end::Input group=-->
							<div class="fv-row mb-8 d-flex">
								<select class="form-control form-control-solid ml-2" name="grade">
									<option disabled selected>
										Select Grade
									</option>
									@for( $i = 1; $i < 14; $i++ ) <option value="{{$i}}">
										{{$i}}
										</option>
										@endfor
								</select>
							</div>
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">
								<div></div>
							</div>
							<!--end::Wrapper-->
							<!--begin::Actions-->
							<div class="d-flex flex-stack">
								<!--begin::Submit-->
								<input type="submit" class="btn btn-primary me-2 flex-shrink-0">
							</div>
							<!--end::Actions-->
						</div>
						<!--begin::Body-->
						<!--end::Form-->
						<!--begin::Sign up-->
						<div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
							<a href="{{route('login.index')}}" class="link-primary fw-semibold">Sign in</a>
						</div>
						<!--end::Sign up-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Footer-->
				<div class="d-flex flex-stack px-lg-10">
					<!--begin::Links-->
					<div class="d-flex fw-semibold text-primary fs-base gap-5">
						<a href="pages/team.html" target="_blank">Terms</a>
						<a href="pages/pricing/column.html" target="_blank">Plans</a>
						<a href="pages/contact.html" target="_blank">Contact Us</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Body-->
	</div>
	<!--end::Authentication - Sign-up-->
</div>


@endsection

@section('script')
<script>
	let sel_country = document.querySelector('.sel_country');
		let sel_city = document.querySelector('.sel_city');
		let countries = document.querySelector('.countries');
		let cities = document.querySelector('.cities');
		cities = cities.value;
		cities = JSON.parse(cities);
		sel_country.addEventListener('change', () => {
			sel_city.innerHTML =`<option disabled selected>Select City ...</option>`;
			cities.forEach(element => {
				if ( sel_country.value == element.country_id ) {
					sel_city.innerHTML +=`
					<option value="${element.id}">${element.city}</option>`;
				}
			});
		});

		const togglePassword = document.querySelectorAll(".togglePassword");
		const password_field = document.querySelectorAll(".password_field");
		
		for (let i = 0, end = togglePassword.length; i < end; i++) {
			togglePassword[i].addEventListener("click", function ( e ) {
				for (let j = 0; j < end; j++) {
					if ( e.target == togglePassword[j] ) {
						// toggle the type attribute
						const type = password_field[j].getAttribute("type") === "password" ? "text" : "password";
						password_field[j].setAttribute("type", type);
						// toggle the eye icon
						this.classList.toggle('fa-eye');
						this.classList.toggle('fa-eye-slash');
					}
				}
			});
		}
</script>
<!--end::Root-->
<!--begin::Javascript-->
<script>
	var hostUrl = "assets/";
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/authentication/sign-in/general.js"></script>
<script src="assets/js/custom/authentication/sign-in/i18n.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
@endsection
@endif