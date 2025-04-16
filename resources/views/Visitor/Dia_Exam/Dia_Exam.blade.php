@include('Visitor.inc.header')
@include('Visitor.inc.menu')

<style>
    .heroSec {
        width: 100%;
        /* height: 87vh; */
        padding: 0 !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        background: #fff;
        overflow: hidden;
    }

    .mainContent {
        width: 90%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        column-gap: 20px;
    }

    .mainContent .leftContent {
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        row-gap: 20px;
    }

    .mainContent .leftContent>h3 {
        font-size: 4rem !important;
        font-weight: 700 !important;
        margin-bottom: 0 !important;
        color: #CF202F;
    }

    .mainContent .leftContent>.quesP {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        margin-bottom: 0 !important;
        color: #CF202F;
    }

    .mainContent .leftContent>p {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        margin-bottom: 0 !important;
        color: #727272;
    }

    .mainContent .leftContent>p>span {
        color: #CF202F;
        font-weight: bold;
    }

    .mainContent .rightContent {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .mainContent .rightContent img {
        max-width: 70% !important;
    }

    .footerSec {
        width: 90%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .footerSec>img {
        border-radius: 5px !important;
        object-fit: cover !important;
        object-position: center !important;
    }

    @media (max-width: 1220px) {
        .stylehome1,
        .rightContent {
            display: none !important;
        }

        .mainContent .leftContent {
            width: 100% !important;
        }

        .footerSec {
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-around;
            margin-top: 15px;
        }

    }
</style>
<div class="wrapper">
    <div class="preloader"></div>

    <!-- Modal -->
    <div class="sign_up_modal modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <ul class="sign_up_tab nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="login_form">
                            <form action="#">
                                <div class="heading">
                                    <h3 class="text-center">Login to your account</h3>
                                    <p class="text-center">Don't have an account? <a class="text-thm"
                                            href="#">Sign Up!</a></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
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
                                        <button type="submit" class="btn btn-block color-white bgc-fb"><i
                                                class="fa fa-facebook float-left mt5"></i> Facebook</button>
                                    </div>
                                    <div class="col-lg">
                                        <button type="submit" class="btn btn-block color-white bgc-gogle"><i
                                                class="fa fa-google float-left mt5"></i> Google</button>
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
                                    <input type="text" class="form-control" id="exampleInputName1"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="exampleInputEmail2"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="exampleInputPassword2"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="exampleInputPassword3"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="form-group custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="exampleCheck2">
                                    <label class="custom-control-label" for="exampleCheck2">Want to become an
                                        instructor?</label>
                                </div>
                                <button type="submit" class="btn btn-log btn-block btn-thm2">Register</button>
                                <hr>
                                <div class="row mt40">
                                    <div class="col-lg">
                                        <button type="submit" class="btn btn-block color-white bgc-fb"><i
                                                class="fa fa-facebook float-left mt5"></i> Facebook</button>
                                    </div>
                                    <div class="col-lg">
                                        <button type="submit" class="btn btn-block color-white bgc-gogle"><i
                                                class="fa fa-google float-left mt5"></i> Google</button>
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
            <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button"><i
                    class="fa fa-times"></i></a>
            <div id="mk-fullscreen-search-wrapper">
                <form method="get" id="mk-fullscreen-searchform">
                    <input type="text" value="" placeholder="Search courses..."
                        id="mk-fullscreen-search-input">
                    <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value=""
                            type="submit"></i>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Header Nav For Mobile -->
    <div id="page" class="stylehome1 h0">
        <div class="mobile-menu">
            <div class="header stylehome1">
                <div class="main_logo_home2">
                    <img class="nav_logo_img img-fluid float-left mt20" src="images/header-logo.png"
                        alt="header-logo.png">
                    <span>edumy</span>
                </div>
                <ul class="menu_bar_home2">
                    <li class="list-inline-item">
                        <div class="search_overlay">
                            <a id="search-button-listener2" class="mk-search-trigger mk-fullscreen-trigger"
                                href="#">
                                <div id="search-button2"><i class="flaticon-magnifying-glass"></i></div>
                            </a>
                            <div class="mk-fullscreen-search-overlay" id="mk-search-overlay2">
                                <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button2"><i
                                        class="fa fa-times"></i></a>
                                <div id="mk-fullscreen-search-wrapper2">
                                    <form method="get" id="mk-fullscreen-searchform2">
                                        <input type="text" value="" placeholder="Search courses..."
                                            id="mk-fullscreen-search-input2">
                                        <i class="flaticon-magnifying-glass fullscreen-search-icon"><input
                                                value="" type="submit"></i>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item"><a href="#menu"><span></span></a></li>
                </ul>
            </div>
        </div><!-- /.mobile-menu -->
        <nav id="menu" class="stylehome1">
            <ul>
                <li><span>Home</span>
                    <ul>
                        <li><a href="index.html">Home 1</a></li>
                        <li><a href="index2.html">Home 2</a></li>
                        <li><a href="index3.html">Home 3</a></li>
                        <li><a href="index4.html">Home 4</a></li>
                        <li><a href="index5.html">Home 5</a></li>
                        <li><a href="index6.html">Home - University</a></li>
                        <li><a href="index7.html">Home College</a></li>
                        <li><a href="index8.html">Home Kindergarten</a></li>

                        <li><span>Update New Homepages</span>
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
                <li><span>Courses</span>
                    <ul>
                        <li><span>Courses List</span>
                            <ul>
                                <li><a href="page-course-v1.html">Courses v1</a></li>
                                <li><a href="page-course-v2.html">Courses v2</a></li>
                                <li><a href="page-course-v3.html">Courses v3</a></li>
                            </ul>
                        </li>
                        <li><span>Courses Single</span>
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
                <li><span>Events</span>
                    <ul>
                        <li><a href="page-event.html">Event List</a></li>
                        <li><a href="page-event-single.html">Event Single</a></li>
                    </ul>
                </li>
                <li><span>Pages</span>
                    <ul>
                        <li><span>Shop Pages</span>
                            <ul>
                                <li><a href="page-shop.html">Shop</a></li>
                                <li><a href="page-shop-single.html">Shop Single</a></li>
                                <li><a href="page-shop-cart.html">Cart</a></li>
                                <li><a href="page-shop-checkout.html">Checkout</a></li>
                                <li><a href="page-shop-order.html">Order</a></li>
                            </ul>
                        </li>
                        <li><span>User Admin</span>
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
                <li><span>Blog</span>
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
                <li><a href="page-contact.html">Contact</a></li>
                <li><a href="page-login.html"><span class="flaticon-user"></span> Login</a></li>
                <li><a href="page-register.html"><span class="flaticon-edit"></span> Register</a></li>
            </ul>
        </nav>
    </div>
    <!-- Hero Dia Page -->
    <section class="heroSec">
        <div class="mainContent">
            <div class="leftContent">
                <h3>Free Diagnostic Exams</h3>
                <p class="quesP">Do you want to identify your strengths and
                    weaknesses?
                </p>
                <p>Struggling to pinpoint your current math level within
                    the international education system? Don't worry, we've
                    got you covered! Our free, personalized math level
                    assessment is designed to help you confidently identify
                    your strengths and weaknesses across various math
                    topics.
                </p>
            </div>
            <div class="rightContent">
                <img src="{{ asset('images/HeroBackground/Dia Hero.png') }}" alt="Courses">
            </div>
        </div>
        <div class="footerSec">
            <img src="{{ asset('images/HeroBackground/sat.png') }}" alt="photo">
            <img src="{{ asset('images/HeroBackground/collegeBoard.png') }}" alt="photo">
            <img src="{{ asset('images/HeroBackground/act.png') }}" alt="photo">
            <img src="{{ asset('images/HeroBackground/est.png') }}" alt="photo">
        </div>
    </section>

    <!-- Our Courses List -->
    <section class="features-course pb20">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h3 class="mb0 mt0" style="color: #CF202F">Featured Courses</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('v_dia_exam') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex">
                            <select class="form-control sel_category mx-2">
                                <option disabled selected>
                                    Select Category ...
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->cate_name }}</option>
                                @endforeach
                            </select>

                            <select class="form-control sel_course mx-2" name="course_id">
                                <option disabled selected>
                                    Select Course ...
                                </option>
                            </select>
                            <input type="hidden" class="category" value="{{ $categories }}" />
                            <input type="hidden" class="course" value="{{ $courses }}" />

                            <button type="button" class="wallet_btn btn btn-primary mx-2"
                                style="background: #CF202F !important;border: none !important">
                                Search
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal show_wallet fade show d-none" id="modalCenter" tabindex="-1"
                    style="display: block;" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Exam</h5>
                                <button type="button" class="btn_exam_close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Start Exam ??

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary close_wallet_btn"
                                    data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button class="btn btn-success">
                                    Start
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>


@foreach ($popup as $item)
    <div class="modal show_popup fade show " id="modalCenter" tabindex="-1" style="display: block;"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img style="width: 100%; height: 200px;"
                        src="{{ asset('images/MarketingPopup/' . $item->image) }}" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary close_popup_btn" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@include('Visitor.inc.mobile_menu')
<script>
    let show_popup = document.querySelectorAll('.show_popup');
    let btn_close = document.querySelectorAll('.btn-close');
    let close_popup_btn = document.querySelectorAll('.close_popup_btn');

    for (let i = 0, end = btn_close.length; i < end; i++) {

        btn_close[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == show_popup[j]) {
                    show_popup[j].classList.add('d-none');
                }
            }
        })
        close_popup_btn[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == close_popup_btn[j]) {
                    show_popup[j].classList.add('d-none');
                }
            }
        })
    }

    let sel_category = document.querySelector('.sel_category');
    let sel_course = document.querySelector('.sel_course');
    let category = document.querySelector('.category');
    let course = document.querySelector('.course');
    course = course.value;
    course = JSON.parse(course);

    sel_category.addEventListener('change', () => {
        sel_course.innerHTML = `
				<option disabled selected>Select Course ...</option>`;

        course.forEach(item => {
            if (item.category_id == sel_category.value) {
                sel_course.innerHTML += `
				<option value="${item.id}">${item.course_name}</option>
				`;
            }
        });
    })

    let wallet_btn = document.querySelectorAll('.wallet_btn');
    let show_wallet = document.querySelectorAll('.show_wallet');
    let btn_exam_close = document.querySelectorAll('.btn_exam_close');
    let close_wallet_btn = document.querySelectorAll('.close_wallet_btn');

    for (let i = 0, end = wallet_btn.length; i < end; i++) {
        wallet_btn[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == wallet_btn[j] || e.target.parentElement == wallet_btn[j] ||
                    e.target.parentElement.parentElement == wallet_btn[j] ||
                    e.target.parentElement.parentElement.parentElement == wallet_btn[j] ||
                    e.target.parentElement.parentElement.parentElement.parentElement == wallet_btn[j] ||
                    e.target.parentElement.parentElement.parentElement.parentElement.parentElement ==
                    wallet_btn[j]) {
                    show_wallet[j].classList.remove('d-none');
                }
            }
        })
        btn_exam_close[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == show_wallet[j]) {
                    show_wallet[j].classList.add('d-none');
                }
            }
        })
        close_wallet_btn[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == close_wallet_btn[j]) {
                    show_wallet[j].classList.add('d-none');
                }
            }
        })
    }
</script>
@include('Visitor.inc.footer')
