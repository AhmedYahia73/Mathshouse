{{-- @include('Visitor.inc.header')
@include('Visitor.inc.menu')

<style>
    .img-whp {
        width: 300px !important;
        height: 200px;
        object-fit: cover;
        object-position: center;
    }

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

    .mainContent .leftContent>p {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        margin-bottom: 0 !important;
        color: #727272;
    }

    .mainContent .rightContent {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .mainContent .rightContent img {
        max-width: 75% !important;
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

    .tc_content {
        max-height: 200px;
        overflow-y: scroll;
    }

    .tc_content::-webkit-scrollbar {
        width: 0.3rem;
    }

    .tc_content::-webkit-scrollbar-track {
        background-color: #fff;
    }

    .tc_content::-webkit-scrollbar-thumb {
        background: #CF202F;
        /* outline: 1px solid slategrey; */
        border-radius: 10px;
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

        .thumb,
        .thumb>a,
        .img-whp {
            width: 100% !important;
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
    @include('Visitor.inc.mobile_menu')

    <!-- Hero Courses Page -->
    <section class="heroSec">
        <div class="mainContent">
            <div class="leftContent">
                <h3>Courses</h3>
                <p>Our courses are meticulously categorized within the
                    educational system framework, allowing you to efficiently
                    select the program that aligns with your specific learning
                    objectives
                </p>
            </div>
            <div class="rightContent">
                <img src="{{ asset('images/HeroBackground/Course Hero.png') }}" alt="Courses">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop_product_slider">
                        @foreach ($categories as $category)
                            <div class="item">
                                <a href="{{ route('v_courses', ['id' => $category->id]) }}">
                                    <div class="top_courses">
                                        <div class="thumb">
                                            <img class="img-whp"
                                                src="{{ asset('images/category/' . $category->cate_url) }}"
                                                alt="t1.jpg">
                                            <div class="overlay">
                                                <div class="icon"><span class="flaticon-like"></span></div>
                                                <a class="tc_preview_course"
                                                    href="{{ route('v_courses', ['id' => $category->id]) }}">Preview
                                                    Course</a>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="tc_content">
                                                <h5>
                                                    <a href="{{ route('v_courses', ['id' => $category->id]) }}">
                                                        {{ $category->cate_name }}
                                                    </a>
                                                </h5>
                                                <p class="overViewP">
                                                    {{ $category->cate_des }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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
</script>

@include('Visitor.inc.footer') --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Portal | Featured Courses</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <!-- AOS Library for scroll animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #CF202F;
            --primary-dark: #A41A26;
            --secondary-color: #2D3748;
            --accent-color: #4A90E2;
            --light-bg: #F8F9FA;
            --gray-text: #727272;
            --light-gray: #E2E8F0;
            --white: #FFFFFF;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--secondary-color);
            line-height: 1.6;
            overflow-x: hidden;
            background-color: var(--light-bg);
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            line-height: 1.3;
        }

        .wrapper {
            position: relative;
        }

        /* Hero Section */
        .heroSec {
            width: 100%;
            min-height: 85vh;
            padding: 2rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(248,249,250,1) 100%);
            position: relative;
            overflow: hidden;
        }

        .heroSec::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(207,32,47,0.03) 0%, rgba(74,144,226,0.03) 100%);
            top: -150px;
            right: -150px;
            z-index: 0;
        }

        .heroSec::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(207,32,47,0.03) 0%, rgba(74,144,226,0.03) 100%);
            bottom: -100px;
            left: -100px;
            z-index: 0;
        }

        .mainContent {
            width: 90%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            column-gap: 40px;
            position: relative;
            z-index: 2;
        }

        .mainContent .leftContent {
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            row-gap: 24px;
        }

        .mainContent .leftContent > h3 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 0;
            color: var(--primary-color);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            padding-bottom: 15px;
        }

        .mainContent .leftContent > h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .mainContent .leftContent > p {
            font-size: 1.25rem;
            font-weight: 400;
            margin-bottom: 0;
            color: var(--gray-text);
            max-width: 90%;
        }

        .cta-button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            transition: var(--transition);
            z-index: -1;
        }

        .cta-button:hover::before {
            width: 100%;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(207, 32, 47, 0.2);
        }

        .mainContent .rightContent {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            position: relative;
        }

        .mainContent .rightContent img {
            max-width: 85%;
            filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
            border-radius: 10px;
            transition: var(--transition);
        }

        .mainContent .rightContent:hover img {
            transform: translateY(-5px);
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--white);
            box-shadow: var(--shadow);
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
            background: linear-gradient(135deg, rgba(207,32,47,0.1) 0%, rgba(74,144,226,0.1) 100%);
        }

        .floating-element:nth-child(2) {
            top: 60%;
            left: 5%;
            animation-delay: 2s;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, rgba(207,32,47,0.1) 0%, rgba(74,144,226,0.1) 100%);
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            right: 15%;
            animation-delay: 4s;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(207,32,47,0.1) 0%, rgba(74,144,226,0.1) 100%);
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        .footerSec {
            width: 90%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 60px;
            position: relative;
            z-index: 2;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footerSec img {
            height: 60px;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: var(--transition);
            object-fit: contain;
        }

        .footerSec img:hover {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.05);
        }

        /* Featured Courses Section */
        .features-course {
            padding: 100px 0;
            background: var(--white);
            position: relative;
        }

        .features-course::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 300px;
            background: linear-gradient(to bottom, var(--light-bg) 0%, transparent 100%);
            z-index: 0;
        }

        .main-title {
            position: relative;
            margin-bottom: 60px;
            z-index: 2;
        }

        .main-title h3 {
            font-size: 2.5rem;
            color: var(--primary-color);
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .main-title h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .shop_product_slider {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .top_courses {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--shadow);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .top_courses:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .thumb {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 220px;
        }

        .img-whp {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: var(--transition);
        }

        .top_courses:hover .img-whp {
            transform: scale(1.05);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 20px;
            opacity: 0;
            transition: var(--transition);
        }

        .top_courses:hover .overlay {
            opacity: 1;
        }

        .tag {
            background: var(--primary-color);
            color: var(--white);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .icon {
            color: var(--white);
            background: rgba(255,255,255,0.2);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .icon:hover {
            background: var(--primary-color);
            transform: rotate(360deg);
        }

        .tc_preview_course {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            opacity: 0;
            transform: translateY(10px);
            transition: var(--transition);
        }

        .top_courses:hover .tc_preview_course {
            opacity: 1;
            transform: translateY(0);
        }

        .details {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .tc_content {
            flex-grow: 1;
            max-height: 150px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .tc_content::-webkit-scrollbar {
            width: 0.3rem;
        }

        .tc_content::-webkit-scrollbar-track {
            background-color: var(--light-gray);
        }

        .tc_content::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        .tc_content h5 a {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--secondary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .tc_content h5 a:hover {
            color: var(--primary-color);
        }

        .overViewP {
            color: var(--gray-text);
            font-size: 0.95rem;
            margin-top: 10px;
        }

        /* Modal Styles */
        .show_popup {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            border-radius: 16px;
            overflow: hidden;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid var(--light-gray);
            padding: 20px 25px;
        }

        .modal-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .btn-close {
            padding: 10px;
            background-size: 0.8em;
        }

        .modal-body {
            padding: 0;
        }

        .modal-body img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .modal-footer {
            border-top: 1px solid var(--light-gray);
            padding: 15px 25px;
        }

        .btn-label-secondary {
            background: var(--light-gray);
            color: var(--secondary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-label-secondary:hover {
            background: #d1d9e6;
        }

        /* Responsive Styles */
        @media (max-width: 1220px) {
            .mainContent {
                flex-direction: column;
                text-align: center;
            }

            .mainContent .leftContent {
                width: 100%;
                align-items: center;
                margin-bottom: 40px;
            }

            .mainContent .leftContent > h3::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .mainContent .leftContent > p {
                max-width: 100%;
            }

            .mainContent .rightContent {
                width: 100%;
                justify-content: center;
            }

            .footerSec {
                justify-content: center;
            }

            .footerSec img {
                margin: 0 15px 15px;
            }
        }

        @media (max-width: 768px) {
            .mainContent .leftContent > h3 {
                font-size: 2.5rem;
            }

            .mainContent .leftContent > p {
                font-size: 1.1rem;
            }

            .shop_product_slider {
                grid-template-columns: 1fr;
            }

            .main-title h3 {
                font-size: 2rem;
            }
        }

        /* Animation utilities */
        [data-aos] {
            pointer-events: none;
        }

        [data-aos].aos-animate {
            pointer-events: auto;
        }
    </style>
</head>
<body>
    @include('Visitor.inc.header')
    @include('Visitor.inc.menu')

    <div class="wrapper">
        <div class="preloader"></div>

        <!-- Hero Courses Page -->
        <section class="heroSec">
            <div class="mainContent">
                <div class="leftContent" data-aos="fade-right" data-aos-duration="1000">
                    <h3>Expand Your Knowledge</h3>
                    <p>Our courses are meticulously categorized within the educational system framework, allowing you to efficiently select the program that aligns with your specific learning objectives</p>
                    <a href="#courses" class="cta-button">Explore Courses</a>
                </div>
                <div class="rightContent" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="{{ asset('images/HeroBackground/Course Hero.png') }}" alt="Online Learning">
                    <div class="floating-elements">
                        <div class="floating-element"><i class="fas fa-book-open"></i></div>
                        <div class="floating-element"><i class="fas fa-graduation-cap"></i></div>
                        <div class="floating-element"><i class="fas fa-certificate"></i></div>
                    </div>
                </div>
            </div>
            <div class="footerSec" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <img src="{{ asset('images/HeroBackground/sat.png') }}" alt="SAT">
                <img src="{{ asset('images/HeroBackground/collegeBoard.png') }}" alt="College Board">
                <img src="{{ asset('images/HeroBackground/act.png') }}" alt="ACT">
                <img src="{{ asset('images/HeroBackground/est.png') }}" alt="EST">
            </div>
        </section>

        <!-- Our Courses List -->
        <section class="features-course pb20" id="courses">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="main-title text-center">
                            <h3 class="mb0 mt0">Featured Courses</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop_product_slider">
                            @foreach ($categories as $category)
                                <div class="item" data-aos="fade-up" data-aos-duration="800">
                                    <a href="{{ route('v_courses', ['id' => $category->id]) }}">
                                        <div class="top_courses">
                                            <div class="thumb">
                                                <img class="img-whp"
                                                    src="{{ asset('images/category/' . $category->cate_url) }}"
                                                    alt="{{ $category->cate_name }}">
                                                <div class="overlay">
                                                    <div class="icon"><span class="flaticon-like"></span></div>
                                                    <a class="tc_preview_course"
                                                        href="{{ route('v_courses', ['id' => $category->id]) }}">View Course</a>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <div class="tc_content">
                                                    <h5>
                                                        <a href="{{ route('v_courses', ['id' => $category->id]) }}">
                                                            {{ $category->cate_name }}
                                                        </a>
                                                    </h5>
                                                    <p class="overViewP">
                                                        {{ $category->cate_des }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
    </div>

    @foreach ($popup as $item)
        <div class="modal show_popup fade show" id="modalCenter" tabindex="-1" style="display: block;"
            aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Special Offer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('images/MarketingPopup/' . $item->image) }}" alt="Promotion" />
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

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });

            let show_popup = document.querySelectorAll('.show_popup');
            let btn_close = document.querySelectorAll('.btn-close');
            let close_popup_btn = document.querySelectorAll('.close_popup_btn');

            for (let i = 0, end = btn_close.length; i < end; i++) {
                btn_close[i].addEventListener('click', (e) => {
                    for (let j = 0; j < end; j++) {
                        show_popup[j].classList.add('d-none');
                    }
                })
                close_popup_btn[i].addEventListener('click', (e) => {
                    for (let j = 0; j < end; j++) {
                        show_popup[j].classList.add('d-none');
                    }
                })
            }
        });
    </script>

    @include('Visitor.inc.footer')
</body>
</html>
