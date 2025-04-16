@include('Visitor.inc.header')
@include('Visitor.inc.menu')
@include('success')
<style>
    .table td {
        padding: .50rem;
        font-weight: 600;
        color: #787878 !important;
    }

    .form-control:focus {
        color: #B8B8B8 !important;
        background-color: #fff;
        border-color: none !important;
        outline: 0;
        box-shadow: none !important;
    }

    .footerCardd {
        display: flex;
        flex-direction: column;
        row-gap: 20px;
    }

    .secApplayCoupone {
        background: #fff;
        width: 100%;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        column-gap: 5px;
        border-radius: 10px;
        border: 2px solid #CF202F;
        overflow: hidden;
    }

    .secApplayCoupone img {
        width: 10% !important;
    }

    .secApplayCoupone input {
        width: 50% !important;
        height: 100%;
        border: none;
        padding: 20px;
        outline: none;
    }

    .secApplayCoupone button {
        width: 35% !important;
        height: 100%;
        font-size: 1.2rem;
        font-weight: 600;
        border: none;
        outline: none;
        background: #FDF4F5;
        padding: 10px;
        color: #CF202F;
        cursor: pointer;
    }

    .UpdateCard {
        background: #fff;
        color: #CF202F;
        font-size: 1.5rem;
        font-weight: 600;
        width: 100%;
        height: 55px;
        border: none;
        outline: none;
        border-radius: 10px;
        border: 3px solid #CF202F;
        cursor: pointer;
    }

    .sideTotal {
        padding: 15px;
        background: #FDF4F5;
        text-align: center;
        border-radius: 15px;
    }

    .btnCheckout {
        background: #CF202F;
        color: #fff;
        font-size: 1.5rem;
        font-weight: 600;
        padding: 12px 0;
        border-radius: 10px;
        width: 100%;
        border: none;
        outline: none;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .btnCheckout:hover {
        background: #fff;
        color: #CF202F;
        border: 3px solid #CF202F;

    }
</style>
<div class="wrapper">
    <div class="preloader"></div>

    <!-- Main Header Nav -->
    {{-- <header class="header-nav menu_style_home_one navbar-scrolltofixed stricky main-menu">
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
                    <li class="list-inline-item list_s"><a href="#" class="btn flaticon-user"
                            data-toggle="modal" data-target="#exampleModalCenter"> <span
                                class="dn-lg">Login/Register</span></a></li>
                    <li class="list-inline-item list_s">
                        <div class="cart_btn">
                            <ul class="cart">
                                <li>
                                    <a href="#" class="btn cart_btn flaticon-shopping-bag"><span>5</span></a>
                                    <ul class="dropdown_content">
                                        <li class="list_content">
                                            <a href="#">
                                                <img class="float-left" src="http://via.placeholder.com/50x50"
                                                    alt="50x50">
                                                <p>Dolar Sit Amet</p>
                                                <small>1 × $7.90</small>
                                                <span class="close_icon float-right"><i class="fa fa-plus"></i></span>
                                            </a>
                                        </li>
                                        <li class="list_content">
                                            <a href="#">
                                                <img class="float-left" src="http://via.placeholder.com/50x50"
                                                    alt="50x50">
                                                <p>Lorem Ipsum</p>
                                                <small>1 × $7.90</small>
                                                <span class="close_icon float-right"><i class="fa fa-plus"></i></span>
                                            </a>
                                        </li>
                                        <li class="list_content">
                                            <a href="#">
                                                <img class="float-left" src="http://via.placeholder.com/50x50"
                                                    alt="50x50">
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
                            <a id="search-button-listener" class="mk-search-trigger mk-fullscreen-trigger"
                                href="#">
                                <span id="search-button"><i class="flaticon-magnifying-glass"></i></span>
                            </a>
                        </div>
                    </li>
                </ul><!-- Button trigger modal -->
            </nav>
        </div>
    </header> --}}
    <!-- Modal -->
    {{-- <div class="sign_up_modal modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                        aria-labelledby="home-tab">
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
                                <p class="text-center">Have an account? <a class="text-thm" href="#">Login</a>
                                </p>
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
    </div> --}}
    <!-- Modal Search Button Bacground Overlay -->
    {{-- <div class="search_overlay dn-992">
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
    </div> --}}

    <!-- Main Header Nav For Mobile -->
    @include('Visitor.inc.mobile_menu')

    <!-- Inner Page Breadcrumb -->
    {{-- <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row" style="width: 100%;">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Cart</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <!-- Shop Checkouts Content -->
    <section class="shop-checkouts">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div>
                        <form action="#">
                            <table class="table col-12  mt-2">
                                <thead>
                                    <tr>
                                        <th class="col-4"
                                            style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                            scope="col">Courses</th>
                                        <th class="col-4"
                                            style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                            scope="col">Duration</th>
                                        <th class="col-4"
                                            style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                            scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <img width="132px" height="96px" style="border-radius: 10px"
                                                    src="{{ asset('images/Chapters/' . $course->course_url) }}" />
                                                <span class="ml-3">{{ $course->course_name }}</span>
                                            </div>
                                        </td>
                                        <td>

                                            <select name="course_duration" class="form-control chapter_duration mx-2"
                                                style="width: 80%; margin-top: 20px; font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;">
                                                @foreach ($course->prices as $item)
                                                @if ( $min_price_data->id == $item->id )
                                                    <option selected value="{{ $item->id }}">
                                                        {{ $item->duration }} Days
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->duration }} Days
                                                    </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <input type="hidden" class="chapters_price"
                                            value="{{ json_encode($course->prices) }}" />
                                        <input type="hidden" class="ch_price" value="{{ $min_price_data->price }}" />
                                        <td class="tbl_chapter_price">
                                            <div class="d-flex align-items-center" style="margin-top: 35px !important;">
                                                ${{ $min_price_data->price }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </form>
                    </div>
                    <div style="margin-top: 3rem;">
                        <div>
                            <h3 style="margin-bottom: 2rem !important; color: #6D6D6D">Do you have a discount code?</h3>
                            <form method="POST" action="{{ route('course_use_promocode') }}" class="form-inline">
                                @csrf
                                {{-- <input name="promo_code" class="form-control" type="search" placeholder="Coupon Code"
                                    aria-label="Search">
                                <button class="btn btn2">Apply Coupon</button>
                                <button type="button" class="btn btn3">Update Cart</button> --}}

                                <div class="footerCardd">
                                    <div class="secApplayCoupone">
                                        <img src="{{ asset('images/iconPayment/DiscountIcon.svg') }}" alt="">
                                        <input type="search" class="ponIn" name="promo_code"
                                            placeholder="Discount Code" aria-label="Search">
                                        <button class="applyBtn">Apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="sideTotal mb30">
                        <h3 style="color: #CF202F">Cart Totals</h3>
                        <ul>
                            <li>
                                <p
                                    style="display: flex;align-items: center;justify-content: space-between;font-size: 1.5rem;font-weight: 600;">
                                    Total <span class="float-right totals color-orose total_price">
                                        @if ($min_price_data->discount != null && $min_price_data->discount != 0)
                                            <del style="margin-right: 10px;color: #787878 !important">
                                                ${{ $min_price_data->price }}</del>
                                            <span class="dicount_price" style="color: #CF202F">
                                                ${{ $min_price_data->price - ($min_price_data->discount * $min_price_data->price) / 100 }}
                                            </span>
                                        @else
                                            <span style="color: #CF202F">
                                                ${{ $min_price_data->price }}
                                            </span>
                                        @endif
                                    </span></p>
                            </li>
                        </ul>
                    </div>
                    <form method="GET" action="{{ route('check_out_course') }}">
                        @csrf
                        <input type="hidden" class="course_price" name="price"
                            value="{{ $min_price_data->price - ($min_price_data->discount * $min_price_data->price) / 100 }}" />
                        <input type="hidden" name="course" value="{{ $course }}" />
                        <div class="ui_kit_button payment_widget_btn">
                            <button class="btnCheckout">Proceed To Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>


<script>

    let chapter_duration = document.querySelectorAll('.chapter_duration');
    let chapters_price = document.querySelectorAll('.chapters_price');
    let tbl_chapter_price = document.querySelectorAll('.tbl_chapter_price');
    let ch_price = document.querySelectorAll('.ch_price');
    let total_price = document.querySelector('.total_price');
    let course_price = document.querySelector('.course_price');
    let course_name = "{{ $course->course_name }}";

    // Function to save data to local storage
    function saveToLocalStorage(data) {
        localStorage.setItem('courseDetails', JSON.stringify(data));
    }

    // Function to load data from local storage
    function loadFromLocalStorage() {
        let storedData = localStorage.getItem('courseDetails');
        return storedData ? JSON.parse(storedData) : [];
    }

    // Array to store course details
    let courseDetails = loadFromLocalStorage();

    // Function to initialize and save the initial price
    function initializePrice() {
        for (let i = 0, end = chapter_duration.length; i < end; i++) {
            let money = JSON.parse(chapters_price[i].value);
            let discount = money.find(element => element.id == chapter_duration[i].value).discount;
            let price = parseFloat(ch_price[i].value);
            let finalPrice;

            if (discount != 0 && discount != null) {
                finalPrice = price - (price * discount / 100);
            } else {
                finalPrice = price;
            }

            // Store the initial data in the courseDetails array
            courseDetails[i] = {
                courseName: course_name,
                courseDuration: chapter_duration[i].options[chapter_duration[i].selectedIndex].text,
                // chapterPrice: finalPrice,
                courseDiscount: price,
                totalPrice: finalPrice
            };

            // Save the updated courseDetails to local storage
            saveToLocalStorage(courseDetails);
        }
    }

    // Call the function to initialize and store the initial price
    initializePrice();

    for (let i = 0, end = chapter_duration.length; i < end; i++) {
        chapter_duration[i].addEventListener('change', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == chapter_duration[j]) {
                    let money = chapters_price[j].value;
                    money = JSON.parse(money);
                    let discount = 0;
                    let selectedDuration = chapter_duration[j].options[chapter_duration[j].selectedIndex].text;

                    money.forEach(element => {
                        if (element.id == chapter_duration[j].value) {
                            discount = element.discount;
                            money = element.price;
                        }
                    });

                    let finalPrice;
                    if (discount != 0 && discount != null) {
                        let total = money - (money * discount / 100);
                        tbl_chapter_price[j].innerHTML = `
                            <del>${money}$</del>
                            <span class="text-success">
                                ${total}$
                            </span>
                        `;
                        finalPrice = total;
                    } else {
                        tbl_chapter_price[j].innerHTML = `${money}$`;
                        finalPrice = money;
                    }

                    // Update course_price and total_price fields
                    course_price.value = finalPrice;
                    total_price.innerHTML = `
                        <del>${money}$</del>
                        <span>${finalPrice}$</span>
                    `;

                    // Store the data in the courseDetails array
                    courseDetails[j] = {
                        courseName: course_name,
                        courseDuration: selectedDuration,
                        coursePrice: finalPrice,
                        courseDiscount: money,
                        totalPrice: finalPrice
                    };

                    // Save the updated courseDetails to local storage
                    saveToLocalStorage(courseDetails);

                    console.log(courseDetails); // For debugging purposes
                }
            }
        });
    }



</script>
@include('Visitor.inc.footer')
