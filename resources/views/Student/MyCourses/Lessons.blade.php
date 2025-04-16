@php
    $page_name = 'Lesson';
    $arr2 = [];
@endphp
@section('title', 'Lessons')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')
    <style>
        /* .list_cont {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .list_cont>i {
            font-size: 30px;
            cursor: pointer;
        }

        .list_item {
            position: absolute;
            top: 0;
            right: 35px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #efefef;
            z-index: 10000;
            overflow: hidden;
        }

        .list_item>span {
            width: 100%;
            text-align: center;
            font-size: 1.3rem;
            padding: 10px 20px;
            color: #000;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .list_item>span:hover {
            background: #cacaca;
            color: #fff;

        } */

.list-container {
    width: 100%;
    background-color: #fefefe;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.05);
    position: relative; /* To position the dropdown within the container */
    overflow: visible; /* Allow content to overflow */
}

.list-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dropdown-menu {
    max-height: 500px;  /* Adjust this value depending on how much content you have */
    overflow-y: auto;   /* Enable vertical scrolling if content exceeds max-height */
    border-radius: 5px;
    border: 1px solid #ddd;
    position: absolute; /* Ensure dropdown is placed inside the container */
    top: 100%; /* Place the dropdown below the button */
    left: 0;
    right: 0;
    width: 100%;
    background-color: white;
    z-index: 1000; /* Ensures it appears above other elements */
}

.dropdown-item {
    padding: 10px 15px;
    transition: background-color 0.2s ease;
    font-size: 1rem;
    font-weight: 500;
    color: #333;
    cursor: pointer;
}

.dropdown-item:hover {
    background-color: #f9f9f9;
}

.dropdown-toggle {
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.2s ease;
}

.dropdown-toggle:hover {
    background-color: #a31922;
}


/* Wrapper to Maintain Aspect Ratio */
.responsive-video {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Aspect Ratio */
    overflow: hidden;
    border-radius: 10px;
}

/* Make Video Fill Container */
.responsive-video video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures full coverage without scroll */
    border: none;
}

/* General Button Styles */
/* .btn-action {
    background-color: #FEF5F3;
    color: #CF202F;
    border: 2px solid #CF202F;
    font-weight: 500;
    font-size: 1rem;
    padding: 10px 20px;
    text-transform: uppercase;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: auto;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
} */

/* Ensure the button and text remain responsive */
.btn-action {
    max-width: 100%;
    min-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

/* Make the lesson name truncation work properly */
.lesson-name {
    max-width: 50%; /* Adjust based on screen size */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-action {
        font-size: 0.9rem;
        padding: 8px;
    }
    .lesson-name {
        max-width: 40%;
    }
}

@media (max-width: 480px) {
    .btn-action {
        font-size: 0.85rem;
        padding: 6px;
    }
    .lesson-name {
        max-width: 35%;
    }
}


.btn-action:hover {
    background-color: #CF202F;  /* Red background on hover */
    color: #FEF5F3;  /* Light cream color text on hover */
    border-color: #FEF5F3;  /* Light cream color border on hover */
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15);
}

/* Dropdown menu */
.dropdown-menu {
    border-radius: 10px;
    padding: 0;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    padding: 10px 20px;
    font-size: 1rem;
    color: #333;
    text-transform: capitalize;
}

.dropdown-item:hover {
    background-color: #FEF5F3;  /* Light cream color hover */
    color: #CF202F;  /* Red text on hover */
}

/* .btn-action {
    max-width: 600px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
} */

/* Icon Styling */
.btn-action i {
    margin-right: 8px;
}

/* Adjust the margins */
.m-2 {
    margin: 0.5rem !important;
}

    </style>
    @include('success')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script>
        $(document).ready(function() {
            console.log("sdfs")

        })
    </script>



    <main class="main_wrapper overflow-hidden">




        <!-- headar section start -->
        <header>
            <div class="headerarea headerarea__3 header__sticky header__area">


                <div class="mob_menu_wrapper">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="mobile-logo">
                                <a class="logo__dark" href="#"><img loading="lazy" src="img/logo/logo_1.png"
                                        alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="header-right-wrap">

                                <div class="headerarea__right">

                                    <div class="header__cart">
                                        <a href="#"> <i class="icofont-cart-alt"></i></a>
                                        <div class="header__right__dropdown__wrapper">
                                            <div class="header__right__dropdown__inner">
                                                <div class="single__header__right__dropdown">

                                                    <div class="header__right__dropdown__img">
                                                        <a href="#">
                                                            <img loading="lazy" src="img/grid/cart1.jpg" alt="photo">
                                                        </a>
                                                    </div>
                                                    <div class="header__right__dropdown__content">

                                                        <a href="shop-product.html">Web Directory</a>
                                                        <p>1 x <span class="price">$ 80.00</span></p>

                                                    </div>
                                                    <div class="header__right__dropdown__close">
                                                        <a href="#"><i class="icofont-close-line"></i></a>
                                                    </div>
                                                </div>

                                                <div class="single__header__right__dropdown">

                                                    <div class="header__right__dropdown__img">
                                                        <a href="#">
                                                            <img loading="lazy" src="img/grid/cart2.jpg" alt="photo">
                                                        </a>
                                                    </div>
                                                    <div class="header__right__dropdown__content">

                                                        <a href="shop-product.html">Design Minois</a>
                                                        <p>1 x <span class="price">$ 60.00</span></p>

                                                    </div>
                                                    <div class="header__right__dropdown__close">
                                                        <a href="#"><i class="icofont-close-line"></i></a>
                                                    </div>
                                                </div>

                                                <div class="single__header__right__dropdown">

                                                    <div class="header__right__dropdown__img">
                                                        <a href="#">
                                                            <img loading="lazy" src="img/grid/cart3.jpg" alt="photo">
                                                        </a>
                                                    </div>
                                                    <div class="header__right__dropdown__content">

                                                        <a href="shop-product.html">Crash Course</a>
                                                        <p>1 x <span class="price">$ 70.00</span></p>

                                                    </div>
                                                    <div class="header__right__dropdown__close">
                                                        <a href="#"><i class="icofont-close-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="dropdown__price">Total: <span>$1,100.00</span>
                                            </p>
                                            <div class="header__right__dropdown__button">
                                                <a href="#" class="white__color">VIEW
                                                    CART</a>
                                                <a href="#" class="blue__color">CHECKOUT</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mobile-off-canvas">
                                    <a class="mobile-aside-button" href="#"><i
                                            class="icofont-navigation-menu"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header section end -->

        <!-- Mobile Menu Start Here -->
        <div class="mobile-off-canvas-active">
            <a class="mobile-aside-close"><i class="icofont  icofont-close-line"></i></a>
            <div class="header-mobile-aside-wrap">
                <div class="mobile-search">
                    <form class="search-form" action="#">
                        <input type="text" placeholder="Search entire store…">
                        <button class="button-search"><i class="icofont icofont-search-2"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap headerarea">

                    <div class="mobile-navigation">

                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="index.html">Home</a>
                                    <ul class="dropdown">
                                        <li class="menu-item-has-children"><a href="index.html">Homes Light</a>
                                            <ul class="dropdown">
                                                <li><a href="index.html">Home (Default)</a></li>
                                                <li><a href="home-2.html">Elegant</a></li>
                                                <li><a href="home-3.html">Classic</a></li>
                                                <li><a href="home-4.html">Classic LMS</a></li>
                                                <li><a href="home-5.html">Online Course </a></li>
                                                <li><a href="home-6.html">Marketplace </a></li>
                                                <li><a href="home-7.html">University</a></li>
                                                <li><a href="home-8.html">eCommerce</a></li>
                                                <li><a href="home-9.html">Kindergarten</a></li>
                                                <li><a href="home-10.html">Machine Learning</a></li>
                                                <li><a href="home-11.html">Single Course</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="index.html">Homes Dark</a>
                                            <ul class="dropdown">
                                                <li><a href="index-dark.html">Home Default (Dark)</a></li>
                                                <li><a href="home-2-dark.html">Elegant (Dark)</a></li>
                                                <li><a href="home-3-dark.html">Classic (Dark)</a></li>
                                                <li><a href="home-4-dark.html">Classic LMS (Dark)</a></li>
                                                <li><a href="home-5-dark.html">Online Course (Dark)</a></li>
                                                <li><a href="home-6-dark.html">Marketplace (Dark)</a></li>
                                                <li><a href="home-7-dark.html">University (Dark)</a></li>
                                                <li><a href="home-8-dark.html">eCommerce (Dark)</a></li>
                                                <li><a href="home-9-dark.html">Kindergarten (Dark)</a></li>
                                                <li><a href="home-10-dark.html">Kindergarten (Dark)</a></li>
                                                <li><a href="home-11-dark.html">Single Course (Dark)</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </li>


                                <li class="menu-item-has-children "><a href="#">Pages</a>

                                    <ul class="dropdown">
                                        <li class="menu-item-has-children">
                                            <a href="#">Get Started 1</a>

                                            <ul class="dropdown">
                                                <li><a href="about.html">About</a></li>
                                                <li><a href="about-dark.html">About (Dark)<span
                                                            class="mega__menu__label new">New</span></a></li>
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog-dark.html">Blog (Dark)</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                                <li><a href="blog-details-dark.html">Blog Details (Dark)</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#">Get Started 2</a>
                                            <ul class="dropdown">
                                                <li><a href="error.html">Error 404</a></li>
                                                <li><a href="error-dark.html">Error (Dark)</a></li>
                                                <li><a href="event-details.html">Event Details</a></li>
                                                <li><a href="zoom/zoom-meetings.html">Zoom<span
                                                            class="mega__menu__label">Online Call</span></a></li>
                                                <li><a href="zoom/zoom-meetings-dark.html">Zoom Meeting (Dark)</a>
                                                </li>
                                                <li><a href="zoom/zoom-meeting-details.html">Zoom Meeting
                                                        Details</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#">Get Started 3</a>
                                            <ul class="dropdown">
                                                <li><a href="zoom/zoom-meeting-details-dark.html">Meeting Details
                                                        (Dark)</a>
                                                </li>
                                                <li><a href="login.html">Login</a></li>
                                                <li><a href="login-dark.html">Login (Dark)</a></li>
                                                <li><a href="maintenance.html">Maintenance</a></li>
                                                <li><a href="maintenance-dark.html">Maintenance Dark</a></li>
                                                <li><a href="#">Terms & Condition</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#">Get Started 4</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Terms & Condition (Dark)</a></li>
                                                <li><a href="#">Privacy Policy</a></li>
                                                <li><a href="#">Privacy Policy (Dark)</a></li>
                                                <li><a href="#">Success Stories</a></li>
                                                <li><a href="#">Success Stories (Dark)</a></li>
                                                <li><a href="#">Work Policy</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <div class="mega__menu__img">
                                                <a href="#"><img loading="lazy" src="img/mega/mega_menu_2.png"
                                                        alt="Mega Menu"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>



                                <li class="menu-item-has-children "><a href="course.html">Courses</a>

                                    <ul class="dropdown">
                                        <li class="menu-item-has-children">
                                            <a href="#">Get Started 1</a>

                                            <ul class="dropdown">
                                                <li><a href="course.html">Grid <span class="mega__menu__label">All
                                                            Courses</span></a></li>
                                                <li><a href="course-dark.html">Course Grid (Dark)</a></li>
                                                <li><a href="course-grid.html">Course Grid</a></li>
                                                <li><a href="course-grid-dark.html">Course Grid (Dark)</a></li>
                                                <li><a href="course-list.html">Course List</a></li>
                                                <li><a href="course-list-dark.html">Course List (Dark)</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#">Get Started 2</a>
                                            <ul class="dropdown">
                                                <li><a href="course-details.html">Course Details</a></li>
                                                <li><a href="course-details-dark.html">Course Details (Dark)</a>
                                                </li>
                                                <li><a href="course-details-2.html">Course Details 2</a></li>
                                                <li><a href="course-details-2-dark.html">Details 2 (Dark)</a></li>
                                                <li><a href="course-details-3.html">Course Details 3</a></li>
                                                <li><a href="course-details-3.html">Details 3 (Dark)</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#">Get Started 3</a>
                                            <ul class="dropdown">
                                                <li><a href="dashboard/become-an-instructor.html">Become An
                                                        Instructor</a>
                                                <li><a href="dashboard/create-course.html">Create Course <span
                                                            class="mega__menu__label">Career</span></a></li>
                                                <li><a href="instructor.html">Instructor</a></li>
                                                <li><a href="instructor-dark.html">Instructor (Dark)</a></li>
                                                <li><a href="instructor-details.html">Instructor Details</a></li>
                                                <li><a href="lesson.html">Course Lesson<span
                                                            class="mega__menu__label new">New</span></a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <div class="mega__menu__img">
                                                <a href="#"><img loading="lazy" src="img/mega/mega_menu_1.png"
                                                        alt="Mega Menu"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>


                                <li class="menu-item-has-children "><a href="dashboard/admin-dashboard.html">Dashboard</a>

                                    <ul class="dropdown">
                                        <li class="menu-item-has-children">
                                            <a href="#">Admin</a>

                                            <ul class="dropdown">
                                                <li><a href="dashboard/admin-dashboard.html">Admin Dashboard</a>
                                                </li>
                                                <li><a href="dashboard/admin-profile.html">Admin Profile</a></li>
                                                <li><a href="dashboard/admin-message.html">Message</a></li>
                                                <li><a href="dashboard/admin-course.html">Courses</a></li>
                                                <li><a href="dashboard/admin-reviews.html">Review</a></li>
                                                <li><a href="dashboard/admin-quiz-attempts.html">Admin Quiz</a>
                                                </li>

                                                <li><a href="dashboard/admin-settings.html">Settings</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#">Instructor</a>
                                            <ul class="dropdown">
                                                <li><a href="dashboard/instructor-dashboard.html">Inst.
                                                        Dashboard</a></li>
                                                <li><a href="dashboard/instructor-profile.html">Inst. Profile</a>
                                                </li>
                                                <li><a href="dashboard/instructor-message.html">Message</a></li>
                                                <li><a href="dashboard/instructor-wishlist.html">Wishlist</a></li>
                                                <li><a href="dashboard/instructor-reviews.html">Review</a></li>
                                                <li><a href="dashboard/instructor-my-quiz-attempts.html">My
                                                        Quiz</a></li>
                                                <li><a href="dashboard/instructor-order-history.html">Order
                                                        History</a></li>
                                                <li><a href="dashboard/instructor-course.html">My Courses</a></li>
                                                <li><a href="dashboard/instructor-announcments.html">Announcements</a>
                                                </li>
                                                <li><a href="dashboard/instructor-quiz-attempts.html">Quiz
                                                        Attempts</a></li>
                                                <li><a href="dashboard/instructor-assignments.html">Assignment</a>
                                                </li>
                                                <li><a href="dashboard/instructor-settings.html">Settings</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#">Student</a>
                                            <ul class="dropdown">
                                                <li><a href="dashboard/student-dashboard.html">Dashboard</a></li>
                                                <li><a href="dashboard/student-profile.html">Profile</a></li>
                                                <li><a href="dashboard/student-message.html">Message</a></li>
                                                <li><a href="dashboard/student-enrolled-courses.html">Enrolled
                                                        Courses</a></li>
                                                <li><a href="dashboard/student-wishlist.html">Wishlist</a></li>
                                                <li><a href="dashboard/student-reviews.html">Review</a></li>
                                                <li><a href="dashboard/student-my-quiz-attempts.html">My Quiz</a>
                                                </li>
                                                <li><a href="dashboard/student-assignments.html">Assignment</a>
                                                </li>
                                                <li><a href="dashboard/student-settings.html">Settings</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item-has-children"><a href="ecommerce/shop.html">eCommerce</a>
                                    <ul class="dropdown">
                                        <li><a href="ecommerce/shop.html">Shop<span class="mega__menu__label">Online
                                                    Store</span></a></li>
                                        <li><a href="ecommerce/product-details.html">Product Details</a></li>
                                        <li><a href="ecommerce/cart.html">Cart</a></li>
                                        <li><a href="ecommerce/checkout.html">Checkout</a></li>
                                        <li><a href="ecommerce/wishlist.html">Wishlist</a></li>

                                    </ul>
                                </li>

                            </ul>
                        </nav>

                    </div>

                </div>
                <div class="mobile-curr-lang-wrap">
                    <div class="single-mobile-curr-lang">
                        <a class="mobile-language-active" href="#">Language <i class="icofont-thin-down"></i></a>
                        <div class="lang-curr-dropdown lang-dropdown-active">
                            <ul>
                                <li><a href="#">English (US)</a></li>
                                <li><a href="#">English (UK)</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- <div class="single-mobile-curr-lang">
                        <a class="mobile-currency-active" href="#">Currency <i class="icofont-thin-down"></i></a>
                        <div class="lang-curr-dropdown curr-dropdown-active">
                            <ul>
                                <li><a href="#">USD</a></li>
                                <li><a href="#">EUR</a></li>
                                <li><a href="#">Real</a></li>
                                <li><a href="#">BDT</a></li>
                            </ul>
                        </div>
                    </div> -->

                    <div class="single-mobile-curr-lang">
                        <a class="mobile-account-active" href="#">My Account <i class="icofont-thin-down"></i></a>
                        <div class="lang-curr-dropdown account-dropdown-active">
                            <ul>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="login.html">/ Create Account</a></li>
                                <li><a href="login.html">My Account</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mobile-social-wrap">
                    <a class="facebook" href="#"><i class="icofont icofont-facebook"></i></a>
                    <a class="twitter" href="#"><i class="icofont icofont-twitter"></i></a>
                    <a class="pinterest" href="#"><i class="icofont icofont-pinterest"></i></a>
                    <a class="instagram" href="#"><i class="icofont icofont-instagram"></i></a>
                    <a class="google" href="#"><i class="icofont icofont-youtube-play"></i></a>
                </div>
            </div>
        </div>
        <!-- Mobile Menu end Here -->

        <!-- theme fixed shadow -->
        <div>
            <div class="theme__shadow__circle"></div>
            <div class="theme__shadow__circle shadow__right"></div>
        </div>
        <!-- theme fixed shadow -->


        <!-- tution__section__start -->
        <div class="tution sp_bottom_100 sp_top_50">
            <div class="container-fluid full__width__padding">
                <div class="row">
                    {{-- <div class="list_cont">
                        <h4 class="pr-3 text-success">
                            If you have an issues must clicked here
                            <i class="fa fa-arrow-right"></i>
                        </h4>
                        <i class="fa-solid fa-ellipsis-vertical" id="iconList"></i>
                        <div class="list_item d-none">
                            @foreach ( $reports as $report )
                                <span class="report_item">
                                    <input type="hidden" class="report_val" value="{{$report}}" />
                                    {{$report->list}}
                                </span>
                            @endforeach
                        </div>
                    </div> --}}

                    {{-- <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up">

                        <div class="accordion content__cirriculum__wrap" id="accordionExample">

                            @foreach ($payment_request as $order)
                                @foreach ($order->order as $chapter)
                                    @if ($chapter_id == $chapter->id)
                                        @foreach ($chapter->lessons as $lesson)
                                            @if( !isset($arr[$lesson->id]) )
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFour">
                                                    <button class="accordion-button" id="accodion{{ $lesson->id }}"
                                                        type="button">
                                                        {{ $lesson->lesson_name }}
                                                    </button>
                                                </h2>
                                                <div id="collapseFour{{ $lesson->id }}"
                                                    class="accordion-collapse collapse" aria-labelledby="headingFour"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">

                                                        @foreach ($lesson->ideas as $idea)
                                                        @php
                                                            $arr2[$idea->id] = $idea;
                                                        @endphp
                                                            <a href="{{ route('stu_lessons', ['id' => $chapter_id, 'L_id' => $idea->lesson->id, 'idea' => $idea->id]) }}"
                                                                class="scc__wrap">
                                                                <div class="scc__info">
                                                                    <i class="icofont-video-alt"></i>
                                                                    <h5> <span>
                                                                            {{ $idea->idea }}
                                                                        </span> </h5>
                                                                </div>
                                                            </a>
                                                        @endforeach

                                                        <hr />

                                                        @foreach ($lesson->quizze as $quizze)
                                                            <a href="{{ route('stu_quizze', ['id' => $quizze->id]) }}"
                                                                class="scc__wrap">
                                                                <div class="scc__info">
                                                                    <i class="fa-solid fa-question  text-danger"></i>
                                                                    <h5>
                                                                        <span class="text-primary ml-3">
                                                                            Q{{$loop->iteration}}
                                                                        </span>
                                                                        <span>
                                                                            {{ $quizze->title }}
                                                                        </span> </h5>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @php
                                                $arr[$lesson->id] = $lesson;
                                            @endphp
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach


                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                        @foreach ($payment_request as $order)
                            @foreach ($order->order as $chapter)
                                @if ($chapter_id == $chapter->id)
                                    @foreach ($chapter->lessons as $lesson)
                                        @if ($lesson->id == $L_id)
                                            @foreach ($lesson->ideas as $ideas)
                                                @if ($ideas->id == $idea_num)
                                                    <div class="lesson__content__main d-none" style="margin-bottom: 80px;">
                                                        <div class="lesson__content__wrap">
                                                            <h3>{{ $ideas->idea }}</h3>
                                                        </div>

                                                        <div class="plyr__video-embed rbtplayer">
                                                            <iframe  scrolling="no" allowfullscreen style="width: 100%; margin-top: 45px;"
                                                                src="{{ $ideas->v_link }}" title="YouTube video player"
                                                                frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </div> --}}


                    <div class="container-fluid">
                        <div class="row">
                            <!-- Sidebar for Lessons -->
                            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                                <div class="accordion content__curriculum__wrap shadow-sm p-3 bg-white rounded" id="accordionExample">
                                    @foreach ($payment_request as $order)
                                        @foreach ($order->order as $chapter)
                                            @if ($chapter_id == $chapter->id)
                                                @foreach ($chapter->lessons as $lesson)
                                                    @if (!isset($arr[$lesson->id]))
                                                    <div class="accordion-item mb-3">
                                                        <!-- Lesson Header -->
                                                        <h2 class="accordion-header" id="headingLesson{{ $lesson->id }}">
                                                            <button
                                                                class="accordion-button fw-bold collapsed text-white bg-danger"
                                                                id="accordion{{ $lesson->id }}"
                                                                type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseLesson{{ $lesson->id }}"
                                                                aria-expanded="false"
                                                                aria-controls="collapseLesson{{ $lesson->id }}">
                                                                <i class="fa-solid fa-book me-2"></i>
                                                                {{ $lesson->lesson_name }}
                                                            </button>
                                                        </h2>
                                                        <!-- Ideas and Quizzes -->
                                                        <div
                                                            id="collapseLesson{{ $lesson->id }}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="headingLesson{{ $lesson->id }}"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body bg-white">
                                                                <!-- List of Ideas -->
                                                                <h6 class="fw-bold text-danger">Ideas</h6>
                                                                @foreach ($lesson->ideas as $idea)
                                                                @php
                                                                    $arr2[$idea->id] = $idea;
                                                                @endphp
                                                                <a
                                                                    href="{{ route('stu_lessons', ['id' => $chapter_id, 'L_id' => $idea->lesson->id, 'idea' => $idea->id]) }}"
                                                                    class="d-flex align-items-center p-2 mb-2 rounded border text-decoration-none text-dark">
                                                                    <i class="icofont-video-alt text-danger me-2"></i>
                                                                    <h5 class="m-0">{{ $idea->idea }}</h5>
                                                                </a>
                                                                @endforeach

                                                                <!-- Divider -->
                                                                <hr />

                                                                <!-- List of Quizzes -->
                                                                <h6 class="fw-bold text-danger">Quizzes</h6>
                                                                @foreach ($lesson->quizze as $quizze)
                                                                <a
                                                                    href="{{ route('stu_quizze', ['id' => $quizze->id]) }}"
                                                                    class="d-flex align-items-center p-2 mb-2 rounded border text-decoration-none text-dark">
                                                                    <i class="fa-solid fa-question text-danger me-2"></i>
                                                                    <h5 class="m-0">
                                                                        <span class="text-danger fw-bold">Q{{$loop->iteration}}:</span> {{ $quizze->title }}
                                                                    </h5>
                                                                </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @php
                                                        $arr[$lesson->id] = $lesson;
                                                    @endphp
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>

                            <!-- Main Video Content -->
                            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                                @php
                                    $renderedIdeas = [];
                                @endphp

                                @foreach ($payment_request as $order)
                                    @foreach ($order->order as $chapter)
                                        @if ($chapter_id == $chapter->id)
                                            @foreach ($chapter->lessons as $lesson)
                                                @if ($lesson->id == $L_id)
                                                    @foreach ($lesson->ideas as $ideas)
                                                        @if ($ideas->id == $idea_num && !in_array($ideas->id, $renderedIdeas))
                                                            @php
                                                                $renderedIdeas[] = $ideas->id;
                                                            @endphp
                                                    <div class="lesson__content__main d-none" style="margin-bottom: 80px;">
                                                        <div class="mb-4 text-center">
                                                            <h3 class="fw-bold" style="color: #CF202F; font-size: 1.8rem; letter-spacing: 1px;">
                                                                {{ $ideas->idea }}
                                                            </h3>
                                                        </div>

                                                        <div class="plyr__video-embed">
                                                            <iframe  scrolling="no" allowfullscreen style="width: 100%; margin-top: 45px;"
                                                                src="{{ $ideas->v_link }}"
                                                                title="YouTube video player"
                                                                frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                allowfullscreen></iframe>
                                                        </div>
                                                    </div>

                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach

                                <div class="list-container p-4 rounded shadow-sm" style="background-color: #fefefe; border: 1px solid #ddd;">
                                    <!-- Dropdown Trigger -->
                                    <div class="list-header d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 text-danger fw-bold" style="font-size: 1.2rem; color: #CF202F;">
                                            Select an Issue:
                                        </h4>
                                        <div class="dropdown" style="width: 70%">
                                            <button
                                                class="btn dropdown-toggle text-white px-4 py-2"
                                                type="button"
                                                id="dropdownMenuButton"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                style="background-color: #CF202F; border: none; border-radius: 5px;">
                                                Report Issue
                                            </button>
                                            <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton" style="width: 100%; border: 1px solid #ddd;">
                                                @foreach ($reports as $report)
                                                <li class="dropdown-item report-item" style="cursor: pointer;">
                                                    <input type="hidden" class="report-val" value="{{$report}}" />
                                                    <span>{{$report->list}}</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                @foreach ($arr2 as $idea)
                                    @if (!empty($idea->pdf))
                                        <!-- Button with Dropdown for PDF actions -->
                                         {{-- <div class="btn-group m-2">
                                            <button class="btn btn-action dropdown-toggle rounded shadow-sm d-flex align-items-center"
                                                    type="button"
                                                    id="dropdownMenu{{$idea->id}}"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fas fa-file-pdf me-2"></i>
                                                <span class="text-truncate" style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block;">
                                                    {{$idea->lesson->lesson_name}}
                                                </span>
                                                {{$idea->idea}}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{$idea->id}}">
                                                <li>
                                                    <a class="dropdown-item" href="{{ asset('files\\lessons_pdf\\' . $idea->pdf) }}" download="{{ asset('files\\lessons_pdf' . $idea->pdf) }}">
                                                        <i class="fas fa-download"></i> Download PDF
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="{{ route('stu_live_pdf', ['file_name' => $idea->pdf]) }}">
                                                        <i class="fas fa-eye"></i> View PDF
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> --}}

                                        <div class="btn-group m-2 w-100">
                                            <button class="btn btn-action dropdown-toggle rounded shadow-sm d-flex align-items-center w-100 text-start"
                                                    type="button"
                                                    id="dropdownMenu{{$idea->id}}"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fas fa-file-pdf me-2"></i>
                                                <span class="lesson-name flex-grow-1 text-truncate">
                                                    {{$idea->lesson->lesson_name}}
                                                </span>
                                                <span class="ms-2">{{$idea->idea}}</span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{$idea->id}}">
                                                <li>
                                                    <a class="dropdown-item" href="{{ asset('files\\lessons_pdf\\' . $idea->pdf) }}"
                                                       download="{{ asset('files\\lessons_pdf' . $idea->pdf) }}">
                                                        <i class="fas fa-download"></i> Download PDF
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" target="_blank" href="{{ route('stu_live_pdf', ['file_name' => $idea->pdf]) }}">
                                                        <i class="fas fa-eye"></i> View PDF
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <br />
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        {{-- @foreach ($arr2 as $idea)
        @if ( !empty($idea->pdf) )
            <a class="btn btn-success text-center m-2" href="{{asset('files\\lessons_pdf\\' . $idea->pdf)}}" download="{{asset('files\\lessons_pdf' . $idea->pdf)}}">
                PDF {{$idea->lesson->lesson_name}} {{$idea->idea}}
            </a>
            <a class="btn btn-info text-center m-2" target="_blank" href="{{route('stu_live_pdf', ['file_name' => $idea->pdf])}}" />
                Show {{$idea->lesson->lesson_name}} {{$idea->idea}}
            </a>
            <br />
        @endif
        @endforeach --}}

    {{-- @foreach ($arr2 as $idea)
        @if (!empty($idea->pdf))
            <!-- Button with Dropdown for PDF actions -->
            <div class="btn-group m-2">
                <button class="btn btn-action dropdown-toggle rounded shadow-sm" type="button" id="dropdownMenu{{$idea->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-pdf"></i> {{$idea->lesson->lesson_name}} {{$idea->idea}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{$idea->id}}">
                    <li>
                        <a class="dropdown-item" href="{{ asset('files\\lessons_pdf\\' . $idea->pdf) }}" download="{{ asset('files\\lessons_pdf' . $idea->pdf) }}">
                            <i class="fas fa-download"></i> Download PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" target="_blank" href="{{ route('stu_live_pdf', ['file_name' => $idea->pdf]) }}">
                            <i class="fas fa-eye"></i> View PDF
                        </a>
                    </li>
                </ul>
            </div>
            <br />
        @endif
    @endforeach
     --}}

        </div>


        <!-- tution__section__end -->
    </main>
    <script>
        $(document).ready(function() {
            console.log("first")
            // $(".accordion-button").click(function() {
            //     console.log("ssss", $(this).closest(".accordion-item").find(".accordion-collapse")
            //         .toggleClass("collapse"))
            // })
            $("#iconList").click(function() {
                console.log("ssss")
                $(".list_item").toggleClass("d-none")
            })


            // Close all dropdowns
            $(".accordion-button").click(function() {
                const collapseSection = $(this).closest(".accordion-item").find(".accordion-collapse");

                // Toggle the clicked dropdown
                if (collapseSection.hasClass("show")) {
                    collapseSection.collapse("hide");
                } else {
                    collapseSection.collapse("show");
                }
            });

            // Close all dropdowns with a button
            $("#closeAll").click(function() {
                $(".accordion-collapse").collapse("hide"); // Close all dropdowns
            });


        })

        let lesson__content__main = document.querySelector('.lesson__content__main');
        lesson__content__main.classList.remove('d-none');

        //___________________________________________________________________________________________
        // let report_item = document.querySelectorAll('.report_item');
        // let report_val = document.querySelectorAll('.report_val');

        // for (let i = 0, end = report_item.length; i < end; i++) {
        //     report_item[i].addEventListener('click', ( e ) => {
        //         for (let j = 0; j < end; j++) {
        //             if ( report_item[j] == e.target ) {
        //                 let  obj = report_val[j].value;
        //                 obj = JSON.parse(obj);
        //                 obj = {
        //                     'list_id' : obj.id,
        //                     'lesson_video_id' : {{$idea_num}},
        //                 }
        //                 $(".list_item").toggleClass("d-none")

        //                 $.ajax("{{ route('report_video_api') }}", {
        //                     type: 'GET', // http method
        //                     data: {
        //                         obj: obj
        //                     }, // data to submit
        //                     success: function(data) {
        //                         console.log(data);
        //                     },
        //                 });
        //             }
        //         }
        //     })
        // }

        document.addEventListener('DOMContentLoaded', () => {
        const reportItems = document.querySelectorAll('.report-item');
        const reportVals = document.querySelectorAll('.report-val');

        // Handle click on each dropdown item
        reportItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                const reportData = JSON.parse(reportVals[index].value);
                const requestData = {
                    list_id: reportData.id,
                    lesson_video_id: {{$idea_num}},
                };

                // Make the AJAX request
                $.ajax("{{ route('report_video_api') }}", {
                    type: 'GET',
                    data: { obj: requestData },
                    success: function (data) {
                        console.log(data);
                    },
                });
            });
        });
});

    </script>
@endsection


@include('Student.inc.footer')
