@include('Visitor.inc.header')
@include('Visitor.inc.menu')

<style>
    .share-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .share-options {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .share-options a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .share-options a:hover {
        background-color: #ddd;
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
                    <li class="list-inline-item list_s"><a href="#" class="btn flaticon-user" data-toggle="modal"
                            data-target="#exampleModalCenter"> <span class="dn-lg">Login/Register</span></a></li>
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
                            <a id="search-button-listener" class="mk-search-trigger mk-fullscreen-trigger" href="#">
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
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="login_form p30">
                            <form action="#">
                                <div class="heading">
                                    <h3 class="text-center">Login to your account</h3>
                                    <p class="text-center">Don't have an account? <a class="text-thm" href="#">Sign
                                            Up!</a></p>
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
    </div> --}}
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
    {{-- <section class="inner_page_breadcrumb csv1">
        <div class="container">
            <div class="row" style="width: 100%;">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Courses</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Graphic Design </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adobe Illustrator</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Our Team Members -->
    <section class="our-team pb40">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="courses_single_container">
                                <div class="cs_row_one">
                                    <div class="cs_ins_container">
                                        <div class="cs_instructor">
                                            <ul class="cs_instrct_list float-left mb0">
                                                <li class="list-inline-item"><img class="thumb"
                                                        src="{{asset('images/inc/amir.png')}}" alt="4.png"></li>
                                                <li class="list-inline-item"><a href="#">Amir Hemaida</a></li>
                                                </li>
                                            </ul>
                                            <ul class="cs_watch_list float-right mb0">
                                                <li class="list-inline-item"><a href="#"><span
                                                            class="flaticon-like"></span></a></li>
                                                <li class="list-inline-item"><a href="#">Add to Wishlist</a></li>
                                                <li class="list-inline-item">
                                                    <button class="share-button"
                                                        onclick="toggleShareOptions()">Share</button>
                                                    <div id="share-options" class="share-options">
                                                        <a href="#" onclick="shareFacebook()">Facebook</a>
                                                        <a href="#" onclick="shareWhatsApp()">WhatsApp</a>
                                                        <a href="#" onclick="shareMessenger()">Messenger</a>
                                                        <a href="#" onclick="shareInstagram()">Instagram</a>
                                                        <a href="#" onclick="shareGmail()">Gmail</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="cs_title">Designing a Responsive Mobile Website with Muse</h3>
                                        <ul class="cs_review_seller">
                                            <li class="list-inline-item"><a href="#"><span>Best Seller</span></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#">4.5 (11,382 Ratings)</a></li>
                                        </ul>
                                        <ul class="cs_review_enroll">
                                            <li class="list-inline-item"><a href="#"><span
                                                        class="flaticon-profile"></span> 57,869 students enrolled</a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><span
                                                        class="flaticon-comment"></span> 25 Review</a></li>
                                        </ul>
                                        <div class="courses_big_thumb">
                                            <div class="thumb">
                                                <iframe scrolling="no" allowfullscreen class="iframe_video"
                                                    src="//www.youtube.com/embed/57LQI8DKwec" frameborder="0"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cs_row_two">
                                    <div class="cs_overview">
                                        <h4 class="title">Overview</h4>
                                        <h4 class="subtitle">Course Description</h4>
                                        <p class="mb30">
                                            {{$course->course_des}}
                                        </p>
                                        <h4 class="subtitle">What you'll learn</h4>
                                        <ul class="cs_course_syslebus">
                                            <li><i class="fa fa-check"></i>
                                                <p>Become a UX designer.</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>You will be able to add UX designer to your CV</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>Become a UI designer.</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>Build & test a full website design.</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>Build & test a full mobile app.</p>
                                            </li>
                                        </ul>
                                        <ul class="cs_course_syslebus2">
                                            <li><i class="fa fa-check"></i>
                                                <p>Learn to design websites & mobile phone apps.</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>You'll learn how to choose colors.</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>Prototype your designs with interactions.</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>Export production ready assets.</p>
                                            </li>
                                            <li><i class="fa fa-check"></i>
                                                <p>All the techniques used by UX professionals</p>
                                            </li>
                                        </ul>
                                        <h4 class="subtitle">Requirements</h4>
                                        <ul class="list_requiremetn">
                                            <li><i class="fa fa-circle"></i>
                                                <p>You will need a copy of Adobe XD 2019 or above. A free trial can be
                                                    downloaded from Adobe.</p>
                                            </li>
                                            <li><i class="fa fa-circle"></i>
                                                <p>No previous design experience is needed.</p>
                                            </li>
                                            <li><i class="fa fa-circle"></i>
                                                <p>No previous Adobe XD skills are needed.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cs_row_three">
                                    <div class="course_content">
                                        <div class="cc_headers">
                                            <h4 class="title">Course Content</h4>
                                            <ul class="course_schdule float-right">
                                                <li class="list-inline-item"><a href="#">92 Lectures</a></li>
                                                <li class="list-inline-item"><a href="#">10:56:11</a></li>
                                            </ul>
                                        </div>
                                        <br>
                                        {{-- @foreach ($chapters as $chapter)
                                        <div class="details d-flex align-items-center">
                                            <input type="checkbox" class="chapter_item_check" id="{{ $chapter->id }}"
                                                checked />

                                            <input type="hidden" class="chapter_id" value="{{ $chapter->id }}" />

                                            @php
                                            $min = $chapter->price[0]->price;
                                            $discount = $chapter->price[0]->discount;
                                            @endphp

                                            @foreach ($chapter->price as $ch_price)
                                            @if ($min > $ch_price->price)
                                            @php
                                            $min = $ch_price->price;
                                            $discount = $ch_price->discount;
                                            @endphp
                                            @endif
                                            @endforeach

                                            <input type="hidden" class="chapter_price" value="{{ $min }}" />
                                            <input type="hidden" class="chapter_discount" value="{{ $discount }}" />
                                            <input type="hidden" class="chapter_data" value="{{ $chapter }}" />
                                            <div id="accordion" class="panel-group w-100 ml-3 cc_tab">
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a href="#panelBodyCourseStart"
                                                                class="accordion-toggle link" data-toggle="collapse"
                                                                data-parent="#accordion">{{ $chapter->chapter_name
                                                                }}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="panelBodyCourseStart" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <ul class="cs_list mb0">
                                                                @foreach ($chapter->lessons as $lesson)
                                                                <li><span class="flaticon-play-button-1 icon"></span>
                                                                    {{ $lesson->lesson_name }}
                                                                    <span class="cs_preiew">Preview</span>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach --}}
                                        @foreach ($chapters as $chapter)
                                        <div class="details d-flex align-items-center">
                                            <input type="checkbox" class="chapter_item_check" id="{{ $chapter->id }}"
                                                checked />
                                            <input type="hidden" class="chapter_id" value="{{ $chapter->id }}" />

                                            @php
                                            $min = $chapter->price[0]->price;
                                            $discount = $chapter->price[0]->discount;
                                            @endphp

                                            @foreach ($chapter->price as $ch_price)
                                            @if ($min > $ch_price->price)
                                            @php
                                            $min = $ch_price->price;
                                            $discount = $ch_price->discount;
                                            @endphp
                                            @endif
                                            @endforeach

                                            <input type="hidden" class="chapter_price" value="{{ $min }}" />
                                            <input type="hidden" class="chapter_discount" value="{{ $discount }}" />
                                            <input type="hidden" class="chapter_data" value="{{ $chapter }}" />
                                            <div id="accordion" class="panel-group w-100 ml-3 cc_tab">
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a href="#panelBodyCourseStart"
                                                                class="accordion-toggle link" data-toggle="collapse"
                                                                data-parent="#accordion">{{ $chapter->chapter_name
                                                                }}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="panelBodyCourseStart" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <ul class="cs_list mb0">
                                                                @foreach ($chapter->lessons as $lesson)
                                                                <li><span class="flaticon-play-button-1 icon"></span>{{
                                                                    $lesson->lesson_name }} <span
                                                                        class="cs_preiew">Preview</span></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="cs_row_four">
                                    <div class="about_ins_container">
                                        <h4 class="aii_title">About the instructor</h4>
                                        <div class="about_ins_info">
                                            <div class="thumb"><img style="height: 60px; width: 70px;"
                                                    src="{{asset('images/inc/amir.png')}}" alt="6.png"></div>
                                        </div>
                                        <div class="details">
                                            <ul class="review_list">
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item">4.5 Instructor Rating</li>
                                            </ul>
                                            <ul class="about_info_list">
                                                <li class="list-inline-item"><span class="flaticon-comment"></span>
                                                    12,197 Reviews </li>
                                                <li class="list-inline-item"><span class="flaticon-profile"></span>
                                                    141,745 Students </li>
                                                <li class="list-inline-item"><span
                                                        class="flaticon-play-button-1"></span> 5Courses </li>
                                            </ul>
                                            <h4>Amir Hemaida</h4>

                                            <h4>Mathematics Enthusiast | Experienced International Curriculum Educator
                                            </h4>
                                            <p>
                                                For over 23 years, I have been passionate about igniting a love for
                                                mathematics in
                                                students of all backgrounds. As a highly experienced international
                                                curriculum educator
                                                , I have honed my skills in delivering effective instruction across
                                                diverse
                                                learning styles and educational frameworks.
                                            </p>
                                            <h4>My Experience:</h4>
                                            •<b>Co-founder of Math House Institution:</b> Leading a dedicated team to
                                            provide exceptional math
                                            •education to students.
                                            •<b>20+Years in International Schools:</b> Bringing my expertise to a global
                                            learning environment, fostering
                                            •critical thinking and problem-solving skills in students.
                                            •<b>Proven Track Record:</b> Proven ability to help students achieve
                                            academic success and
                                            •improve their math proficiency through engaging and effective teaching
                                            methods.
                                            <div><b>My Approach:</b></div>
                                            I believe in creating a positive and supportive learning environment where
                                            every student feels
                                            empowered to explore and master mathematical concepts.
                                        </div>
                                    </div>
                                </div>
                                <div class="cs_row_five">
                                    <div class="student_feedback_container">
                                        <h4 class="aii_title">Student feedback</h4>
                                        <div class="s_feeback_content">
                                            <ul class="skills">
                                                <li class="list-inline-item">Stars 5</li>
                                                <li class="list-inline-item progressbar1" data-width="84"
                                                    data-target="100">%84</li>
                                            </ul>
                                            <ul class="skills">
                                                <li class="list-inline-item">Stars 4</li>
                                                <li class="list-inline-item progressbar2" data-width="9"
                                                    data-target="100">%9</li>
                                            </ul>
                                            <ul class="skills">
                                                <li class="list-inline-item">Stars 3</li>
                                                <li class="list-inline-item progressbar3" data-width="3"
                                                    data-target="100">%3</li>
                                            </ul>
                                            <ul class="skills">
                                                <li class="list-inline-item">Stars 2</li>
                                                <li class="list-inline-item progressbar4" data-width="1"
                                                    data-target="100">%1</li>
                                            </ul>
                                            <ul class="skills">
                                                <li class="list-inline-item">Stars 1</li>
                                                <li class="list-inline-item progressbar5" data-width="2"
                                                    data-target="100">%2</li>
                                            </ul>
                                        </div>
                                        <div class="aii_average_review text-center">
                                            <div class="av_content">
                                                <h2>4.5</h2>
                                                <ul class="aii_rive_list mb0">
                                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                </ul>
                                                <p>Course Rating</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cs_row_six">
                                    <div class="sfeedbacks">
                                        <h4 class="aii_title">Reviews</h4>
                                        <div class="mbp_pagination_comments">
                                            <div class="mbp_first media csv1">
                                                <img src="images/resource/review1.png" class="mr-3" alt="review1.png">
                                                <div class="media-body">
                                                    <h4 class="sub_title mt-0">Warren Bethell
                                                        <span class="sspd_review float-right">
                                                            <ul>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"></li>
                                                            </ul>
                                                        </span>
                                                    </h4>
                                                    <a class="sspd_postdate fz14" href="#">6 months ago</a>
                                                    <p class="fz15 mt20">This is the second Photoshop course I have
                                                        completed with Cristian. Worth every penny and recommend it
                                                        highly. To get the most out of this course, its best to to take
                                                        the Beginner to Advanced course first.</p>
                                                    <p class="fz15 mt25 mb25">The sound and video quality is of a good
                                                        standard. Thank you Cristian.</p>
                                                    <div class="ssp_reply float-right"><span
                                                            class="flaticon-consulting-message"></span><span
                                                            class="pl10">Reply</span></div>
                                                    <div class="sspd_review_liked"><a href="#"><i
                                                                class="flaticon-like-1"></i> <span
                                                                class="text-thm6 pl5 pr5 fz15">15</span> Thank
                                                            Waren</a></div>
                                                    <div class="custom_hr style2"></div>
                                                    <div class="mbp_sub media csv1">
                                                        <a href="#"><img src="images/resource/review1.png" class="mr-3"
                                                                alt="review1.png"></a>
                                                        <div class="media-body">
                                                            <h4 class="sub_title mt-0">Anton Hilton
                                                                <span class="sspd_review float-right">
                                                                    <ul>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-star"></i></a></li>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-star"></i></a></li>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-star"></i></a></li>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-star"></i></a></li>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-star"></i></a></li>
                                                                        <li class="list-inline-item"></li>
                                                                    </ul>
                                                                </span>
                                                            </h4>
                                                            <a class="sspd_postdate fz14" href="#">6 months
                                                                ago</a>
                                                            <p class="fz15 mt20 mb50">This is the second Photoshop
                                                                course I have completed with Cristian. Worth every penny
                                                                and recommend it highly. To get the most out of this
                                                                course, its best to to take the</p>
                                                            <div class="ssp_reply float-right"><span
                                                                    class="flaticon-consulting-message"></span><span
                                                                    class="pl10">Reply</span></div>
                                                            <div class="sspd_review_liked">
                                                                <a href="#"><i class="flaticon-like-1"></i><span
                                                                        class="text-thm6 pl5 pr5 fz15">15</span> Thank
                                                                    Waren</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom_hr"></div>
                                            <div class="mbp_second media csv1">
                                                <img src="images/resource/review1.png" class="align-self-start mr-3"
                                                    alt="review1.png">
                                                <div class="media-body">
                                                    <h4 class="sub_title mt-0">Warren Bethell
                                                        <span class="sspd_review float-right">
                                                            <ul>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"><a href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li class="list-inline-item"></li>
                                                            </ul>
                                                        </span>
                                                    </h4>
                                                    <a class="sspd_postdate fz14" href="#">6 months ago</a>
                                                    <p class="fz15 mt20">This is the second Photoshop course I have
                                                        completed with Cristian. Worth every penny and recommend it
                                                        highly. To get the most out of this course, its best to to take
                                                        the Beginner to Advanced course first.</p>
                                                    <p class="fz15 mt25 mb25">The sound and video quality is of a good
                                                        standard. Thank you Cristian.</p>
                                                    <div class="ssp_reply float-right"><span
                                                            class="flaticon-consulting-message"></span><span
                                                            class="pl10">Reply</span></div>
                                                    <div class="sspd_review_liked"><a href="#"><i
                                                                class="flaticon-like-1"></i> <span
                                                                class="text-thm6 pl5 pr5 fz15">15</span> Thank
                                                            Waren</a></div>
                                                </div>
                                            </div>
                                            <div class="text-center mt50">
                                                <div class="custom_hr"></div>
                                                <button type="button" class="more-review-btn btn">See more
                                                    reviews</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cs_row_seven">
                                    <div class="sfeedbacks">
                                        <div class="mbp_comment_form style2 pb0">
                                            <h4>Add Reviews & Rate</h4>
                                            <ul>
                                                <li class="list-inline-item pr15">
                                                    <p>What is it like to Course?</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="sspd_review">
                                                        <ul>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star fz18"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star fz18"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star fz18"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star fz18"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star fz18"></i></a></li>
                                                            <li class="list-inline-item"></li>
                                                        </ul>
                                                    </span>
                                                </li>
                                            </ul>
                                            <form class="comments_form">
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Review Title</label>
                                                    <input type="text" class="form-control" id="exampleInputName1"
                                                        aria-describedby="textHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Review Content</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                                        rows="6"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-thm">Submit Review <span
                                                        class="flaticon-right-arrow-1"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="r_course_title">Related Courses</h3>
                        </div>
                        @foreach ( $related_course as $item)
                        <div class="col-lg-6 col-xl-4">
                            <div class="top_courses">
                                <div class="thumb">
                                    <img class="img-whp" src="{{asset('images/courses/' . $item->course_url)}}"
                                        alt="t1.jpg">
                                    <div class="overlay">
                                        <div class="tag">Best Seller</div>
                                        <div class="icon"><span class="flaticon-like"></span></div>
                                        <a class="tc_preview_course"
                                            href="{{route('v_course', ['id' => $item->id])}}">Preview Course</a>
                                    </div>
                                </div>
                                <a href="{{route('v_course', ['id' => $item->id])}}" class="details">
                                    <div class="tc_content">
                                        <h5>{{$item->course_name}}</h5>
                                    </div>
                                    <div class="tc_footer">
                                        <div class="tc_price float-right">${{$item->prices->min('price')}}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="instructor_pricing_widget">
                        <div class="d-flex alogn-items-center justify-content-center m-2">
                            {{-- <input type="hidden" class="{{$currency}}" /> --}}
                            {{-- <select class="form-control w-150px">
                                <option selected disabled>Select Currency ...</option>
                                @foreach ($currency as $item)
                                <option id="curr-id" value="{{$item->id}}">{{$item->currency}}</option>
                                @endforeach
                            </select> --}}
                            <input type="hidden" class="currency-hidden" value="1" />
                            <select class="form-control w-150px currency-selector">
                                <option selected disabled>Select Currency ...</option>
                                @foreach ($currency as $item)
                                <option value="{{ $item->id }}" data-amount="{{ $item->amount }}">
                                    {{ $item->currency}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="price">Price
                            <label><s class="t_price price text-danger">${{ $price }}</s></label>
                            <label class="t_discount_price text-success">${{ $total_price }}</label>
                        </div>
                        <input class="course_price" type="hidden" value="{{ $price }}" />
                        <form method="POST" action="{{ route('buy_course') }}">
                            @csrf
                            <input type="hidden" class="course_data" name="course_data" value="{{ $course }}" />
                            <input type="hidden" class="chapters_data" name="chapters_data" value="{{ $chapters }}" />
                            <input type="hidden" class="chapters_price" name="chapters_price" value="{{ $price }}" />
                            <button class="cart_btnss_white">Buy Now</button>
                        </form>
                        <h5 class="subtitle text-left">Includes</h5>
                        <ul class="price_quere_list text-left">
                            <li>
                                <a href="#"><span class="flaticon-play-button-1"></span>
                                    <span id="courseVideos">{{ count($videos_count) }}</span>
                                    <span>Video</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-book-open mr-2"></i>
                                    <span id="courseChapters">{{ count($chapters_count) }}</span>
                                    <span>Chapter</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-person-chalkboard mr-2"></i>
                                    <span id="courseLessons">{{ count($lessons_count) }}</span>
                                    <span>Lesson</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-circle-question mr-2"></i>
                                    <span id="courseQuestions">{{ $questions }}</span>
                                    <span> Question</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-feather mr-2"></i>
                                    <span id="courseQuizs">{{ $quizs }}</span>
                                    <span>Quiz</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-file-pdf mr-2"></i>
                                    <span id="coursePdfs">{{ count($videos_count) }}</span>
                                    <span>PDF</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="feature_course_widget">
                        <ul class="list-group">
                            <h4 class="title">Course Features</h4>
                            <li class="d-flex justify-content-between align-items-center">
                                Lectures <span class="float-right">6</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                Quizzes <span class="float-right">1</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                Duration <span class="float-right">3 hours</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                Skill level <span class="float-right">All level</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                Language <span class="float-right">English</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                Assessments <span class="float-right">Yes</span>
                            </li>
                        </ul>
                    </div>
                    <div class="blog_tag_widget">
                        <h4 class="title">Tags</h4>
                        <ul class="tag_list">
                            <li class="list-inline-item"><a href="#">Photoshop</a></li>
                            <li class="list-inline-item"><a href="#">Sketch</a></li>
                            <li class="list-inline-item"><a href="#">Beginner</a></li>
                            <li class="list-inline-item"><a href="#">UX/UI</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>




<script>
    // let chapter_item_check = document.querySelectorAll('.chapter_item_check');
    // let chapter_discount = document.querySelectorAll('.chapter_discount');
    // let chapter_price = document.querySelectorAll('.chapter_price');
    // let chapter_id = document.querySelectorAll('.chapter_id');
    // let chapter_data = document.querySelectorAll('.chapter_data');
    // let t_price = document.querySelector('.t_price');
    // let chapters_data = document.querySelector('.chapters_data');
    // let chapters_price = document.querySelector('.chapters_price');
    // let course_price = document.querySelector('.course_price');
    // let t_discount_price = document.querySelector('.t_discount_price');
    // let price = 0;
    // let discount = 0;
    // let total_price = 0;
    // let arr;
    // let arr_data;
    // let chapter;
    // let checked = true;
    // course_price = course_price.value;
    // course_price = parseFloat(course_price);
    // console.log(course_price);
    // for (let i = 0, end = chapter_item_check.length; i < end; i++) {
    //     chapter_item_check[i].addEventListener('change', (e) => {
    //         arr = [];
    //         arr_data = [];
    //         for (let j = 0; j < end; j++) {
    //             if (e.target == chapter_item_check[j] || e.target.parentElement == chapter_item_check[j] ||
    //                 e.target.parentElement.parentElement == chapter_item_check[j]) {
    //                 for (let k = 0; k < end; k++) {
    //                     if (chapter_item_check[k].checked) {
    //                         chapter = chapter_data[k].value;
    //                         chapter = JSON.parse(chapter);
    //                         arr_data = [...arr_data, chapter];
    //                         let price_item = parseFloat(chapter_price[k].value);
    //                         discount = parseFloat(chapter_discount[k].value);
    //                         total_price += price_item - price_item * discount / 100;
    //                         price += parseFloat(chapter_price[k].value);
    //                         arr = [...arr, parseInt(chapter_id[k].value)];
    //                     } else {
    //                         checked = false;
    //                     }
    //                 }
    //                 if (checked) {
    //                     price = course_price;
    //                     total_price = {{ $total_price }}
    //                 }
    //                 chapters_data.value = JSON.stringify(arr_data);
    //                 chapters_price.value = price;
    //                 t_price.innerHTML = price;
    //                 t_discount_price.innerHTML = total_price;
    //                 price = 0;
    //                 total_price = 0;
    //                 checked = true;
    //             }
    //         }
    //     })
    // }

    function toggleShareOptions() {
    var shareOptions = document.getElementById('share-options');
    if (shareOptions.style.display === 'block') {
        shareOptions.style.display = 'none';
    } else {
        shareOptions.style.display = 'block';
    }
}

function shareFacebook() {
    var url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href);
    window.open(url, '_blank');
}

function shareWhatsApp() {
    var url = 'https://wa.me/?text=' + encodeURIComponent(window.location.href);
    window.open(url, '_blank');
}

function shareMessenger() {
    var url = 'fb-messenger://share/?link=' + encodeURIComponent(window.location.href);
    window.open(url, '_blank');
}

function shareInstagram() {
    var url = 'https://www.instagram.com/?url=' + encodeURIComponent(window.location.href);
    window.open(url, '_blank');
}

function shareGmail() {
    var url = 'mailto:?subject=Check%20this%20out&body=' + encodeURIComponent(window.location.href);
    window.open(url, '_self');
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.share-button')) {
        var shareOptions = document.getElementById('share-options');
        if (shareOptions.style.display === 'block') {
            shareOptions.style.display = 'none';
        }
    }
}

</script>
<script>
    $(document).ready(function() {
        var allID = [];
        $(".chapter_item_check").click(function() {
            allID = [];

            $(".chapter_item_check").each((val, ele) => {
                console.log(ele)
                if ($(ele).is(':checked')) {
                    var EleCheck = $(ele).attr("id");
                    allID.push(EleCheck)
                }
                // console.log("EleCheck", EleCheck)
            })

            if (!$(".chapter_item_check").is(':checked')) {
                allID = ["faild"]
            }
            console.log("All ID", allID)

            $.ajax({
                url: "{{ route('api_courses_data') }}",
                type: "GET",
                data: {
                    chapters: allID
                },
                success: function(data) {
                    console.log(data)
                    $("#courseVideos").text(data.videos)
                    $("#courseChapters").text(data.chapters)
                    $("#courseLessons").text(data.lessons)
                    $("#courseQuestions").text(data.questions)
                    $("#courseQuizs").text(data.quizs)
                    $("#coursePdfs").text(data.pdf)
                },
            })
        })

//         $(".form-control.w-150px").change(function () {
//     // Get the selected option element
//     const selectedOption = $(this).find(":selected");

//     // Retrieve the currency text and price data from the selected option
//     const selectedCurrency = selectedOption.text(); // Currency text (e.g., USD, EUR)
//     const selectedPrice = selectedOption.data("price"); // Data attribute for price

//     // Print the values to the console
//     console.log(`Selected Currency: ${selectedCurrency}`);
//     console.log(`Price: ${selectedPrice}`);
// });

    })
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currencySelector = document.querySelector('.currency-selector');
        const hiddenCurrency = document.querySelector('.currency-hidden');
        const priceElement = document.querySelector('.t_price');
        const totalPriceElement = document.querySelector('.t_discount_price');

        const chapterItemCheck = document.querySelectorAll('.chapter_item_check');
        const chapterDiscount = document.querySelectorAll('.chapter_discount');
        const chapterPrice = document.querySelectorAll('.chapter_price');
        const chapterId = document.querySelectorAll('.chapter_id');
        const chaptersData = document.querySelector('.chapters_data');
        const chaptersPrice = document.querySelector('.chapters_price');

        const originalPrice = parseFloat({{ $price }});
        const originalTotalPrice = parseFloat({{ $total_price }});

        let conversionRate = 1;
        let price = originalPrice;
        let totalPrice = originalTotalPrice;
        let selectedChapters = new Set();

        // Function to check if all chapters are selected
        function areAllChaptersSelected() {
            return [...chapterItemCheck].every(checkbox => checkbox.checked);
        }

        // Function to calculate totals
        function calculateTotals() {
            let tempSelectedChapters = new Set();
            let tempPrice = 0;
            let tempTotalPrice = 0;

            chapterItemCheck.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const chapterIdValue = chapterId[index].value;
                    tempSelectedChapters.add(chapterIdValue);

                    const priceItem = parseFloat(chapterPrice[index].value);
                    const discountItem = parseFloat(chapterDiscount[index].value);

                    tempTotalPrice += priceItem - (priceItem * discountItem / 100);
                    tempPrice += priceItem;
                }
            });

            if (areAllChaptersSelected()) {
                // If all chapters are selected, use the original price in the selected currency
                price = originalPrice * conversionRate;
                totalPrice = originalTotalPrice * conversionRate;
            } else if (tempSelectedChapters.size === 0) {
                // Set totals to 0 if no chapters are selected
                price = 0;
                totalPrice = 0;
            } else {
                // Calculate prices based on selected chapters
                price = tempPrice * conversionRate;
                totalPrice = tempTotalPrice * conversionRate;
            }

            selectedChapters = tempSelectedChapters;
            chaptersData.value = JSON.stringify([...selectedChapters]); // Error When Send Chapters
            chaptersPrice.value = price.toFixed(2);
        }

        // Function to update displayed prices
        function updateDisplayedPrices() {
            // const currencyText = currencySelector.options[currencySelector.selectedIndex]?.textContent || '';
            priceElement.textContent = `${price.toFixed(2)}`;
            totalPriceElement.textContent = `${totalPrice.toFixed(2)}`;
        }

        // Event listener for checkbox changes
        chapterItemCheck.forEach((checkbox) => {
            checkbox.addEventListener('change', function () {
                calculateTotals();
                updateDisplayedPrices();
            });
        });

        // Event listener for currency selection changes
        currencySelector.addEventListener('change', function () {
            const selectedOption = currencySelector.options[currencySelector.selectedIndex];
            conversionRate = parseFloat(selectedOption.getAttribute('data-amount')) || 1;

            hiddenCurrency.value = selectedOption.value;
            calculateTotals();
            updateDisplayedPrices();
        });

        // Initialize with original prices
        calculateTotals();
        updateDisplayedPrices();
    });
</script>



<a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>
@include('Visitor.inc.footer')