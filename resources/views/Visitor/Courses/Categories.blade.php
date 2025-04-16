@include('Visitor.inc.header')
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
                                                {{-- <div class="tag">Best Seller</div> --}}
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

@include('Visitor.inc.footer')
