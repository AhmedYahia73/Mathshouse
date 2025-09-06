{{-- @include('Visitor.inc.header')
@include('Visitor.inc.menu')


<style>
    /* Global style */

    :root {
        --main-color: #CF202F;
        --secondary-color: #727272;
    }

    /* Start of Header Section */


    #header {
        height: 100vh
    }

    .header-nav {}

    .header-content {
        background-color: aqua;
    }

    /* Start of Nav bar */
    .header-nav {
        position: fixed-top;
    }

    /* End of Nav bar */
    /* End of Header Section */
    main {

        padding-bottom: 20px;
        margin-bottom: 20px;

    }

    .main-container {
        width: var(--main-container);
        margin: auto;
    }

    .main-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding-top: 100px;
    }

    .main-caption {
        /* width: 60%; */
        margin-right: 20px;
    }

    .main-img {
        /* width: 40%; */
        padding: 20px;
    }

    .main-img img {
        width: 90%;
        filter: drop-shadow(4px 4px 9px #000a);
    }

    .main-img img:hover {
        -webkit-animation: vibrate-1 0.3s linear infinite both;
        animation: vibrate-1 0.3s linear infinite both;
    }

    @-webkit-keyframes vibrate-1 {
        0% {
            -webkit-transform: translate(0);
            transform: translate(0);
        }

        20% {
            -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
        }

        40% {
            -webkit-transform: translate(-2px, -2px);
            transform: translate(-2px, -2px);
        }

        60% {
            -webkit-transform: translate(2px, 2px);
            transform: translate(2px, 2px);
        }

        80% {
            -webkit-transform: translate(2px, -2px);
            transform: translate(2px, -2px);
        }

        100% {
            -webkit-transform: translate(0);
            transform: translate(0);
        }
    }

    @keyframes vibrate-1 {
        0% {
            -webkit-transform: translate(0);
            transform: translate(0);
        }

        20% {
            -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
        }

        40% {
            -webkit-transform: translate(-2px, -2px);
            transform: translate(-2px, -2px);
        }

        60% {
            -webkit-transform: translate(2px, 2px);
            transform: translate(2px, 2px);
        }

        80% {
            -webkit-transform: translate(2px, -2px);
            transform: translate(2px, -2px);
        }

        100% {
            -webkit-transform: translate(0);
            transform: translate(0);
        }
    }

    .main-inner .main-caption h2 {
        font-size: 65px;
        color: var(--main-color);
        margin-bottom: 20px;
    }

    .main-caption span {
        color: var(--main-color);
    }

    .main-inner .main-caption p {
        font-size: 16px;
        color: #4f4f5a;
        margin: 20px 0;
        font-family: var(--secondary-font);
    }

    .main-inner .main-caption .buttons {
        display: flex;
        align-items: center;
        gap: 32px;
    }

    .main-inner .main-caption .buttons .btn {
        padding: 10px 25px;
        background-color: var(--primaryColor);
        color: white;
        border-radius: 0px 20px 20px 20px;
        font-size: var(--secondary-font);
        font-family: var(--secondary-font);
    }

    .main-inner .main-caption .buttons .btn2 {
        display: flex;
        align-items: center;
        font-weight: 500;
        color: var(--color);
        font-size: 16px;
        font-family: var(--secondary-font);
        gap: 8px;
    }

    .main-inner .main-caption .buttons .btn2 .icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background-color: var(--primaryColor);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        margin-right: 5px;
        position: relative;
    }

    .main-inner .main-caption .buttons .btn2 .icon i {

        position: relative;
    }

    .main-inner .main-caption .buttons .btn:hover {
        background-color: rgba(248, 14, 14, 0.845);
    }

    .main-inner .main-caption .buttons .btn2:hover {
        color: rgba(248, 14, 14, 0.845);
    }

    .main-inner .main-caption .buttons .btn2 .icon::before {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        width: 40px;
        height: 40px;
        border-radius: inherit;
    }

    /*start media query of main at Home section*/
    @media screen and (max-width: 600px) {
        .main-inner {
            display: flex;
            flex-direction: column-reverse;
            width: 100%;

        }

        .main-caption {
            text-align: center;
        }

        .main-img img {
            width: 100%;
        }
    }

    @media screen and (min-width:601px) and (max-width:768px) {
        .main-inner {
            display: flex;
            flex-direction: column-reverse;
            width: 100%;

        }

        .main-caption {
            text-align: center;
        }

        .main-img img {
            width: 100%;
        }
    }

    @media screen and (min-width:769px) and (max-width:992px) {
        .main-inner {
            display: flex;
            flex-direction: column-reverse;
            width: 100%;

        }

        .main-caption {
            text-align: center;
        }

        .main-img img {
            width: 100%;
        }
    }

    /*End media query of main at Home section*/

    /* Start of Second Section */
    .services {}

    #services .services-content {
        text-align: center;
    }

    #services .services-content .icons {
        font-size: 50px;
        color: var(--secondary-color);
    }

    #services .content-row h5::after {
        content: "";
        height: 3px;
        width: 50px;
        background-color: var(--secondary-color);
        position: absolute;
        bottom: -15px;
        left: 50%;
        right: 50%;
        transform: translateX(-50%) translateY(-50%);
        transition: all 0.5s;
    }

    #services .content-row :hover::after {
        width: 100px;
    }

    #services .icons {
        background-color: #FEF5F3;
        display: flex font-size:4px
    }

    .curve-line {
        position: absolute;
        top: 50%;
        left: calc(33.333% + 15px);
        /* Adjust the percentage based on your needs */
        width: 100%;
        height: 2px;
        background: linear-gradient(to right, transparent 50%, #000 50%);
        background-size: 10px 2px;
    }

    .curve-line::before {
        content: '';
        position: absolute;
        top: -5px;
        left: 0;
        width: calc(33.333% - 15px);
        /* Adjust the percentage based on your needs */
        height: 10px;
        border-radius: 50%;
        background-color: var(--main-color);
    }

    /* End of Second Section */
    /* start of counter section */
    .counter-box {
        color: #fff;
        text-align: center;
    }

    @media (min-width: 577px) {
        .counter-box {
            margin-bottom: 1.8rem;
        }
    }

    .counter-ico {
        margin-bottom: 1rem;
    }

    .counter-box .service-ico {
        margin-bottom: 1rem;
        color: #1e1e1e;
    }


    .service-box .s-caption {
        font-size: 1.4rem;
        text-transform: uppercase;
        text-align: center;
        padding: 0.4rem 0;
    }

    .icons-counter {
        font-size: 2rem;
        line-height: 0;
    }

    .image-counter {
        background-color: #FEF5F3;

    }

    .overlay-mf {
        position: absolute;
        top: 0;
        left: 0px;
        padding: 0;
        height: 100%;
        width: 100%;
        opacity: 0.7;
    }

    .ico-color {
        height: 60px;
        width: 60px;
        font-size: 2rem;
        border-radius: 50%;
        line-height: 1.55;
        margin: 0 auto;
        text-align: center;
        box-shadow: 0 0 0 10px #ffffff99;
    }

    /* @property --num {
        syntax: "<integer>";
        initial-value: 0;
        inherits: false;
    } */

    .counter-num h3 {
        counter-reset: num var(--num);
        font: 800 26px system-ui;
        color: var(--main-color)
    }

    .counter-num span {
        color: #727272;
    }

    /* End of counter section */

    /* start of Courses section */
    .Courses-caption {
        background-color: #fef5f3;
        padding: 5%;
        border-radius: 20%;
        margin-top: 20px;

    }

    #Courses .caption h3 {
        color: #727272;
    }

    #Courses .caption span {
        color: var(--main-color);
    }

    #Courses .caption h4 {
        color: #727272;
    }

    #Courses .badge {
        color: var(--main-color)
    }

    .bg-badge {
        background-color: #FEF5F3;
        padding: 10px;
    }

    /* End of Courses section */

    /* Start of Customer section */
    #Customer .caption h2 {
        color: #727272;
    }

    #Customer .caption h2 span {
        color: var(--main-color);
    }

    #Customer .caption h4 {
        color: #727272;
    }

    .main-header {
        background-color: #FEF5F3;
        border-radius: 8px;
        padding: 10px;

    }

    .main-header .rating {
        color: var(--main-color);
    }

    .rating h4 {
        color: var(--main-color);
    }

    .arrows-button a {
        color: var(--main-color);
    }

    /* End of Customer section */

    /* Start of Upcoming section */
    .upcoming-caption h2 span {
        color: var(--main-color);
    }

    .upcoming-timer i {
        color: var(--main-color);
    }

    #Upcoming .caption h2 {
        color: #727272;
    }

    .slider a {
        /* display: inline-block; */
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: var(--main-color);
        margin: 0 10px;
    }

    .slider .slider-button-middle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #FFE3E6;
        margin: 0 10px;
    }

    .slider .third-slider-button {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #FFE3E6;
        margin: 0 10px;
    }

    /* End of Upcoming section */

    /* Start of blog section */
    #blog h2 {
        color: #727272;
    }

    /* End of Upcoming section */

    /* Start of Subscribe section */
    #Subscribe h2 {
        color: #727272;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #CF202F;
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(207, 32, 47, 0.25);
    }

    /* End of Subscribe section */
</style>

<!-- Start of Home Section -->
<main>
    <div class="container">
        <div class="main-inner">
            <div class="main-caption  p-4">
                <h1>Unlock Your Math Potential
                    Expert-Led Courses for Global Students <span class>,</span></h1>
                <h2>Anywhere</h2>
                <p>Connect With The Most Qualified And Passionate <span>Mentors</span></p>
                <a type="button" class="btn btn-danger" style="color: #fff !important" href={{ route('categories') }}>Find
                    Courses</a>
            </div>
            <div class="main-img vibrate-1">
                <img class="v-100" src="{{ asset('images/Home/Learning-cuate 1.png') }}" alt="he">
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <a href="#Courses" class="scroll-arrow"><i class="fa-solid fa-chevron-down fa-2x"
                    style="color:#CF202F"></i></a>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="margin-top: -15px;">
            <a href="#Courses" class="scroll-arrow"><i class="fa-solid fa-chevron-down fa-2x"
                    style="color:#CF202F"></i></a>
        </div>


    </div>
</main>
<!-- End of Home Section -->

<!-- Start of second section -->
<section id="services" class="services py-5">
    <div class="container">
        <div class="services-content">
            <div class="row gy-4">
                <div class="col-md-3">
                    <div class="content-row py-5">
                        <i class="fa-solid fa-user mb-3 icons p-3 rounded rounded-3"></i>
                        <h3 class="mb-0">Achieve your goals</h3>
                        <p class="pt-4 m-0 text-muted">Empower yourself with our online math courses designed
                            for the international education system. Led by
                            experienced and passionate instructors, our interactive
                            Zoom sessions cater to all levels and learning styles.
                            Whether you're aiming for top grades or preparing for
                            exams, we'll guide you to success.</p>
                    </div>

                </div>
                <div class="col-md-2">
                    <div class="content-row py-5">
                        <svg width="190" height="160" xmlns="http://www.w3.org/2000/svg">
                            <path d="M 10 80 Q 52.5 10, 95 80 T 180 80" stroke="#CF202F" fill="transparent" />
                        </svg>
                    </div>

                </div>


                <div class="col-md-4">
                    <div class="content-row py-5">
                        <i class="fa-solid fa-search mb-3 icons p-3 rounded rounded-5"></i>
                        <h3 class="mb-0">Benefits :
                        </h3>
                        •<b>Expert Instructors:</b> Learn from highly qualified math educators.
                        <br />
                        •<b>Personalized Learning:</b> We cater to individual needs and learning styles.
                        <br />
                        •<b>Interactive Sessions:</b> Engage in real-time discussions via Zoom.<br />
                        •<b>Flexible Scheduling:</b> Choose the time that suits you best.<br />
                        •<b>Proven Results:</b> Achieve your academic goals with our effective strategies.

                    </div>

                </div>
                <div class="col-md-2">
                    <div class="content-row py-5">
                        <svg width="190" height="160" xmlns="http://www.w3.org/2000/svg">
                            <path d="M 10 80 Q 52.5 10, 95 80 T 180 80" stroke="#CF202F" fill="transparent" />
                        </svg>
                    </div>

                </div>


            </div>
        </div>
    </div>
</section>
<!-- End of second section -->

<!--Start of Counter section-->
<div class="section-counter image-counter pt-5 pb-5">
    <div class="container position-relative">
        <div class="row">
            <div class="col-sm-3 col-lg-3">
                <div class="counter-box counter-box pt-4 pt-md-0">

                    <div class="counter-num">
                        <h3>55</h3>
                        <span class="counter-text">Creative Events</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-lg-3">
                <div class="counter-box pt-4 pt-md-0">

                    <div class="counter-num">
                        <h3>55</h3>
                        <span class="counter-text">Skilled Tutor</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-lg-3">
                <div class="counter-box pt-4 pt-md-0">

                    <div class="counter-num">
                        <h3>55K</h3>
                        <span class="counter-text">Online Courses</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-lg-3">
                <div class="counter-box pt-4 pt-md-0">
                    <div class="counter-num">
                        <h3>55k</h3>
                        <span class="counter-text">People Wordwide</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Counter section-->

<section id="Courses" class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 py-5">
                <div class="caption text-center">
                    <h3 class="caption-a fw-bolder">Browse Our <span>Top</span> Courses</h3>
                    <h4 class="subtitle-a">
                        Discover expertly crafted courses to elevate your skills
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($courses as $item)
                <div class="col-md-3 course-style">
                    <a href="{{ route('v_course', ['id' => $item->id]) }}">
                        <div class="Courses-caption">
                            <div class="badge d-flex flex-row-reverse">
                                <h2> <span class="badge bg-badge h5">Top Seller</span></h2>
                            </div>
                            <h3 class="h5">{{ $item->course_name }}</h3>
                            <h3 class="h5 p-0 m-0"> Web Design</h3>
                            <h4>${{ $item->prices->min('price') }}</h4>

                        </div>
                    </a>
                </div>
            @endforeach

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('categories') }}" class="btn btn-danger px-4 py-2">
                View All Courses
            </a>
        </div>
    </div>
</section class="py-4">

<section id="Customer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 py-3">
                <div class="caption text-center">
                    <h2 class="caption-a fw-bolder">Trusted by Thousands of </h2>
                    <h2 class="subtitle-a">
                        <span>Happy</span> Customer
                    </h2>
                    <p>Look at their reviews</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-2">
                <div class="main-header">
                    <div class="content d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('assets/img/avatars/Neutral Profile Picture 22.png') }}"
                                alt="" />
                            <h4 class="p-0 m-0 pl-3">Amr Mohammed</h4>
                        </div>
                        <div class="d-flex justify-content-center align-items-center rating">
                            <i class="fa-solid fa-star mx-3"></i>
                            <h4 class="p-0 m-0">4</h4>
                        </div>
                    </div>

                    <p class="p-2 pt-3">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mi diam,
                        egestas sed tellus sed, aliquet cursus arcu”</p>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="main-header">
                    <div class="content d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('assets/img/avatars/Neutral Profile Picture 22.png') }}"
                                alt="" />
                            <h4 class="p-0 m-0 pl-3">Amr Mohammed</h4>
                        </div>
                        <div class="d-flex justify-content-center align-items-center rating">
                            <i class="fa-solid fa-star mx-3"></i>
                            <h4 class="p-0 m-0">4</h4>
                        </div>
                    </div>

                    <p class="p-2 pt-3">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mi diam,
                        egestas sed tellus sed, aliquet cursus arcu”</p>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="main-header">
                    <div class="content d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('assets/img/avatars/Neutral Profile Picture 22.png') }}"
                                alt="" />
                            <h4 class="p-0 m-0 pl-3">Amr Mohammed</h4>
                        </div>
                        <div class="d-flex justify-content-center align-items-center rating">
                            <i class="fa-solid fa-star mx-3"></i>
                            <h4 class="p-0 m-0">4</h4>
                        </div>
                    </div>

                    <p class="p-2 pt-3">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mi diam,
                        egestas sed tellus sed, aliquet cursus arcu”</p>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="main-header">
                    <div class="content d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('assets/img/avatars/Neutral Profile Picture 22.png') }}"
                                alt="" />
                            <h4 class="p-0 m-0 pl-3">Amr Mohammed</h4>
                        </div>
                        <div class="d-flex justify-content-center align-items-center rating">
                            <i class="fa-solid fa-star mx-3"></i>
                            <h4 class="p-0 m-0">4</h4>
                        </div>
                    </div>

                    <p class="p-2 pt-3">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mi diam,
                        egestas sed tellus sed, aliquet cursus arcu”</p>
                </div>
            </div>

            <div class="arrows-button p-4">
                <a href=""><i class="fa-solid fa-arrow-left"></i></a>
                <a href=""><i class="fa-solid fa-arrow-right pl-3"></i></a>

            </div>
        </div>



    </div>
    </div>
    </div>
</section>

<section id="Upcoming">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 py-3">
                <div class="caption text-center">
                    <h2 class="caption-a fw-bolder">Upcoming Event</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 rounded shadow p-3 mb-5 ml-5">
                <div class="upcomingContent">
                    <div class="inner-content d-flex">
                        <div class="comingImage" style="width: 148px; height:161px; background-color:#DDDDDD "></div>
                        <div class="pl-3 upcoming-caption">
                            <h2> <span class="badge bg-badge rounded h5 fw-bold">18 Mar</span></h2>
                            <p>Embarrassing Hidden in The</p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-center align-items-center upcoming-timer">
                                    <i class="fa-regular fa-clock"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center pl-2 upcoming-timer">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 rounded shadow p-3 mb-5 ml-5">
                <div class="upcomingContent">
                    <div class="inner-content d-flex">
                        <div class="comingImage" style="width: 148px; height:161px; background-color:#DDDDDD "></div>
                        <div class="pl-3 upcoming-caption">
                            <h2> <span class="badge bg-badge rounded h5 fw-bold">18 Mar</span></h2>
                            <p>Embarrassing Hidden in The</p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-center align-items-center upcoming-timer">
                                    <i class="fa-regular fa-clock"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center pl-2 upcoming-timer">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 rounded shadow p-3 mb-5 ml-5">
                <div class="upcomingContent">
                    <div class="inner-content d-flex">
                        <div class="comingImage" style="width: 148px; height:161px; background-color:#DDDDDD "></div>
                        <div class="pl-3 upcoming-caption">
                            <h2> <span class="badge bg-badge rounded h5 fw-bold">18 Mar</span></h2>
                            <p>Embarrassing Hidden in The</p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-center align-items-center upcoming-timer">
                                    <i class="fa-regular fa-clock"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center pl-2 upcoming-timer">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 rounded shadow p-3 mb-5 ml-5">
                <div class="upcomingContent">
                    <div class="inner-content d-flex">
                        <div class="comingImage" style="width: 148px; height:161px; background-color:#DDDDDD "></div>
                        <div class="pl-3 upcoming-caption">
                            <h2> <span class="badge bg-badge rounded h5 fw-bold">18 Mar</span></h2>
                            <p>Embarrassing Hidden in The</p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-center align-items-center upcoming-timer">
                                    <i class="fa-regular fa-clock"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center pl-2 upcoming-timer">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 rounded shadow p-3 mb-5 ml-5">
                <div class="upcomingContent">
                    <div class="inner-content d-flex">
                        <div class="comingImage" style="width: 148px; height:161px; background-color:#DDDDDD "></div>
                        <div class="pl-3 upcoming-caption">
                            <h2> <span class="badge bg-badge rounded h5 fw-bold">18 Mar</span></h2>
                            <p>Embarrassing Hidden in The</p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-center align-items-center upcoming-timer">
                                    <i class="fa-regular fa-clock"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center pl-2 upcoming-timer">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 rounded shadow p-3 mb-5 ml-5">
                <div class="upcomingContent">
                    <div class="inner-content d-flex">
                        <div class="comingImage" style="width: 148px; height:161px; background-color:#DDDDDD "></div>
                        <div class="pl-3 upcoming-caption">
                            <h2> <span class="badge bg-badge rounded h5 fw-bold">18 Mar</span></h2>
                            <p>Embarrassing Hidden in The</p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-center align-items-center upcoming-timer">
                                    <i class="fa-regular fa-clock"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center pl-2 upcoming-timer">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p class="p-0 m-0 ml-1">8:00am-10:00am</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="slider d-flex justify-content-center align-items-center">
            <a href="#" class="slider-button"></a>
            <a href="#" class="slider-button-middle"></a>
            <a href="#" class="third-slider-button"></a>
        </div>
    </div>

</section>

<section id="blog">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 py-3">
                <div class="caption text-center">
                    <h2 class="caption-a fw-bolder">Blog</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="blog-content p-3">
                    <img class="w-75" src="{{ asset('assets/img/blog/Frame 1261154503.png') }}" alt="">
                    <p>Tips</p>
                    <h4>Attract More Attention</h4>
                    <h4>Sales And Profits</h4>
                    <p>May 15, 2020</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-content p-3">
                    <img class="w-75" src="{{ asset('assets/img/blog/Frame 1261154504.png') }}" alt="">
                    <p>Marketing</p>
                    <h4>11 Tips to Help You</h4>
                    <h4>Get New Clients</h4>
                    <p>May 15, 2020</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-content p-3">
                    <img class="w-75" src="{{ asset('assets/img/blog/Frame 1261154505.png') }}" alt="">
                    <p>Tips</p>
                    <h4>An Overworked</h4>
                    <h4>Newspaper Editor</h4>
                    <p>May 15, 2020</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="Subscribe">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 py-3">
                <div class="caption text-center">
                    <h2 class="caption-a fw-bolder">Subscribe our newsletter</h2>
                    <p>Your download should start automatically, if not Click here.
                        </br>Should I give up, huh?
                    </p>
                </div>
                <form>
                    <div class="form-group w-25 mx-auto mb-3">
                        <input type="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Email address">

                    </div>
                    <div class="button-form text-center">
                        <button type="submit" class="btn btn-danger">Subscribe</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
</section>

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

    document.querySelectorAll('.scroll-arrow').forEach(arrow => {
        arrow.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = arrow.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
@include('Visitor.inc.footer') --}}



@include('Visitor.inc.header')
@include('Visitor.inc.menu')

<style>
    :root {
        --main-color: #CF202F;
        --secondary-color: #727272;
        --light-bg: #FEF5F3;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
    }

    /* Hero Section */
    .hero-section {
        padding: 20px 0 50px;
        background: linear-gradient(to bottom, #ffffff, #fff5f5);
    }

    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #333;
        margin-bottom: 20px;
    }

    .hero-content h1 span,
    .hero-content h2,
    .hero-content p span {
        color: var(--main-color);
    }

    .hero-content p {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin-bottom: 30px;
    }

    .hero-image {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .scroll-down {
        text-align: center;
        margin-top: 50px;
    }

    .scroll-down a {
        color: var(--main-color);
        font-size: 2rem;
        text-decoration: none;
        display: inline-block;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-20px);
        }

        60% {
            transform: translateY(-10px);
        }
    }

    /* Services Section */
    .services-section {
        padding: 80px 0;
        background-color: white;
    }

    .service-card {
        text-align: center;
        padding: 30px 20px;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 30px;
        background-color: var(--light-bg);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .service-icon {
        font-size: 3rem;
        color: var(--main-color);
        margin-bottom: 20px;
    }

    .curve-svg {
        width: 100%;
        height: 50px;
        margin: 30px 0;
    }

    /* Counter Section */
    .counter-section {
        padding: 60px 0;
        background-color: var(--light-bg);
    }

    .counter-item {
        text-align: center;
        padding: 20px;
    }

    .counter-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--main-color);
        margin-bottom: 10px;
    }

    .counter-text {
        color: var(--secondary-color);
        font-weight: 500;
    }

    /* Courses Section */
    .courses-section {
        padding: 80px 0;
        background-color: white;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--secondary-color);
    }

    .section-title h2 span {
        color: var(--main-color);
    }

    .section-title p {
        color: var(--secondary-color);
        font-size: 1.1rem;
    }

    .course-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        margin-bottom: 30px;
        background-color: var(--light-bg);
    }

    .course-card:hover {
        transform: translateY(-10px);
    }

    .course-badge {
        background-color: var(--light-bg);
        color: var(--main-color);
        padding: 20px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
        padding-bottom: 0;
    }

    .course-content {
        padding: 20px;
    }

    .course-content h3 {
        font-size: 1.4rem;
        margin-bottom: 10px;
        color: #333;
    }

    .course-price {
        font-size: 1.2rem;
        color: var(--main-color);
        font-weight: 700;
    }

    /* Testimonials Section */
    .testimonials-section {
        padding: 80px 0;
        background-color: var(--light-bg);
    }

    .testimonial-card {
        background-color: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin: 15px;
        position: relative;
    }

    .testimonial-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .testimonial-user {
        display: flex;
        align-items: center;
    }

    .testimonial-user img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
    }

    .testimonial-rating {
        color: var(--main-color);
        font-weight: 600;
    }

    .testimonial-text {
        color: var(--secondary-color);
        line-height: 1.6;
        font-style: italic;
    }

    .testimonial-controls {
        text-align: center;
        margin-top: 30px;
    }

    .testimonial-controls button {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--main-color);
        margin: 0 10px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .testimonial-controls button:hover {
        color: #a00;
    }

    /* Upcoming Events Section */
    .events-section {
        padding: 80px 0;
        background-color: white;
    }

    .event-card {
        display: flex;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        background-color: white;
    }

    .event-image {
        width: 150px;
        min-width: 150px;
        background-color: #ddd;
    }

    .event-content {
        padding: 20px;
        flex-grow: 1;
    }

    .event-date {
        background-color: var(--light-bg);
        color: var(--main-color);
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 15px;
    }

    .event-details {
        display: flex;
        margin-top: 15px;
        color: var(--secondary-color);
    }

    .event-details div {
        margin-right: 20px;
        display: flex;
        align-items: center;
    }

    .event-details i {
        margin-right: 5px;
        color: var(--main-color);
    }

    .events-controls {
        text-align: center;
        margin-top: 30px;
    }

    .slider-dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #ddd;
        margin: 0 5px;
        cursor: pointer;
    }

    .slider-dot.active {
        background-color: var(--main-color);
    }

    /* Blog Section */
    .blog-section {
        padding: 80px 0;
        background-color: var(--light-bg);
    }

    .blog-card {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .blog-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .blog-content {
        padding: 20px;
    }

    .blog-category {
        color: var(--main-color);
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }

    .blog-title {
        font-size: 1.3rem;
        margin-bottom: 10px;
        color: #333;
    }

    .blog-date {
        color: var(--secondary-color);
    }

    /* Subscribe Section */
    .subscribe-section {
        padding: 80px 0;
        background-color: white;
        text-align: center;
    }

    .subscribe-form {
        max-width: 500px;
        margin: 0 auto;
    }

    .form-control {
        border: 2px solid #ddd;
        border-radius: 30px;
        padding: 15px 25px;
        margin-bottom: 20px;
    }

    .form-control:focus {
        border-color: var(--main-color);
        box-shadow: 0 0 0 0.2rem rgba(207, 32, 47, 0.25);
    }

    /* Modal */
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }

    .modal-footer {
        border-top: none;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-content h1 {
            font-size: 2.8rem;
        }

        .event-card {
            flex-direction: column;
        }

        .event-image {
            width: 100%;
            height: 200px;
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.2rem;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .testimonial-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .testimonial-rating {
            margin-top: 10px;
        }
    }

    @media (max-width: 576px) {
        .hero-content h1 {
            font-size: 1.8rem;
        }

        .hero-content p {
            font-size: 1rem;
        }

        .service-card {
            padding: 20px 15px;
        }

        .counter-number {
            font-size: 2rem;
        }
    }
</style>

<body>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1>Unlock Your Math Potential Expert-Led Courses for Global Students <span>.</span></h1>
                        <h2>Anywhere</h2>
                        <p>Connect With The Most Qualified And Passionate <span>Mentors</span></p>
                        <a href="#" class="btn btn-danger btn-lg">Find Courses</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-image text-center">
                        <img class="v-100" src="{{ asset('images/Home/Learning-cuate 1.png') }}" alt="he">
                    </div>
                </div>
            </div>
            <div class="scroll-down">
                <a href="#services"><i class="fas fa-chevron-down"></i></a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3>Achieve your goals</h3>
                        <p>Empower yourself with our online math courses designed for the international education
                            system. Led by experienced and passionate instructors, our interactive Zoom sessions cater
                            to all levels and learning styles. Whether you're aiming for top grades or preparing for
                            exams, we'll guide you to success.</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <svg class="curve-svg" viewBox="0 0 500 100">
                            <path d="M 10,80 C 100,10 400,100 490,20" stroke="#CF202F" stroke-width="3"
                                fill="transparent" />
                        </svg>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Benefits</h3>
                        <ul class="text-start">
                            <li><strong>Expert Instructors:</strong> Learn from highly qualified math educators.</li>
                            <li><strong>Personalized Learning:</strong> We cater to individual needs.</li>
                            <li><strong>Interactive Sessions:</strong> Engage in real-time discussions.</li>
                            <li><strong>Flexible Scheduling:</strong> Choose sessions that fit your timetable.</li>
                            <li><strong>Comprehensive Resources:</strong> Access a wealth of study materials.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Counter Section -->
    <section class="counter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="counter-item">
                        <div class="counter-number">55</div>
                        <div class="counter-text">Creative Events</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-item">
                        <div class="counter-number">55</div>
                        <div class="counter-text">Skilled Tutor</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-item">
                        <div class="counter-number">55K</div>
                        <div class="counter-text">Online Courses</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-item">
                        <div class="counter-number">55K</div>
                        <div class="counter-text">People Wordwide</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="courses-section" id="courses">
        <div class="container">
            <div class="section-title">
                <h2>Browse Our <span>Top</span> Courses</h2>
                <p>Discover expertly crafted courses to elevate your skills</p>
            </div>
            <div class="row">
                @foreach ($courses as $item)
                    <div class="col-md-4">
                        <a href="{{ route('v_course', ['id' => $item->id]) }}">
                            <div class="course-card">
                                <div class="course-badge">Top Seller</div>
                                <div class="course-content">
                                    <h3>{{ $item->course_name }}</h3>
                                    <p>${{ $item->prices->min('price') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <div class="text-center mt-4">
                <a href="{{ route('categories') }}" class="btn btn-outline-danger">View All Courses</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Trusted by Thousands of <span>Happy</span> Customer</h2>
                <p>Look at their reviews</p>
            </div>
            <div class="row">
                <div class="col-md-4 testimonial-item">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="testimonial-user">
                                <img src="https://placehold.co/50x50/CF202F/white?text=A" alt="User">
                                <div>
                                    <h5>Amr Mohammed</h5>
                                </div>
                            </div>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i> 4.5
                            </div>
                        </div>
                        <p class="testimonial-text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mi
                            diam, egestas sed tellus sed, aliquet cursus arcu”</p>
                    </div>
                </div>
                <div class="col-md-4 testimonial-item">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="testimonial-user">
                                <img src="https://placehold.co/50x50/CF202F/white?text=S" alt="User">
                                <div>
                                    <h5>Sarah Johnson</h5>
                                </div>
                            </div>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i> 4.8
                            </div>
                        </div>
                        <p class="testimonial-text">“The math courses here completely transformed my understanding of
                            calculus. The instructors are amazing and very supportive!”</p>
                    </div>
                </div>
                <div class="col-md-4 testimonial-item">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="testimonial-user">
                                <img src="https://placehold.co/50x50/CF202F/white?text=J" alt="User">
                                <div>
                                    <h5>John Davis</h5>
                                </div>
                            </div>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i> 4.7
                            </div>
                        </div>
                        <p class="testimonial-text">“I was struggling with algebra for years until I found these
                            courses. Now I'm confident and even enjoying math problems!”</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-controls">
                <button id="prev-testimonial"><i class="fas fa-arrow-left"></i></button>
                <button id="next-testimonial"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="events-section" id="events">
        <div class="container">
            <div class="section-title">
                <h2>Upcoming Events</h2>
            </div>
            <div class="row">
                <div class="col-md-6 event-item">
                    <div class="event-card">
                        <div class="event-image"></div>
                        <div class="event-content">
                            <span class="event-date">18 Mar</span>
                            <h4>Algebra Masterclass</h4>
                            <div class="event-details">
                                <div><i class="far fa-clock"></i> 8:00am-10:00am</div>
                                <div><i class="fas fa-location-dot"></i> Online</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 event-item">
                    <div class="event-card">
                        <div class="event-image"></div>
                        <div class="event-content">
                            <span class="event-date">22 Mar</span>
                            <h4>Calculus Workshop</h4>
                            <div class="event-details">
                                <div><i class="far fa-clock"></i> 2:00pm-4:00pm</div>
                                <div><i class="fas fa-location-dot"></i> Online</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="events-controls">
                <span class="slider-dot active"></span>
                <span class="slider-dot"></span>
                <span class="slider-dot"></span>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section" id="blog">
        <div class="container">
            <div class="section-title">
                <h2>Blog</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card">
                        <img src="https://placehold.co/400x200/CF202F/white?text=Math+Tips" alt="Blog"
                            class="blog-image">
                        <div class="blog-content">
                            <span class="blog-category">Tips</span>
                            <h3 class="blog-title">Attract More Attention Sales And Profits</h3>
                            <span class="blog-date">May 15, 2020</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card">
                        <img src="https://placehold.co/400x200/CF202F/white?text=Marketing" alt="Blog"
                            class="blog-image">
                        <div class="blog-content">
                            <span class="blog-category">Marketing</span>
                            <h3 class="blog-title">11 Tips to Help You Get New Clients</h3>
                            <span class="blog-date">May 15, 2020</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card">
                        <img src="https://placehold.co/400x200/CF202F/white?text=Education" alt="Blog"
                            class="blog-image">
                        <div class="blog-content">
                            <span class="blog-category">Tips</span>
                            <h3 class="blog-title">An Overworked Newspaper Editor</h3>
                            <span class="blog-date">May 15, 2020</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe Section -->
    <section class="subscribe-section" id="subscribe">
        <div class="container">
            <div class="section-title">
                <h2>Subscribe our newsletter</h2>
                <p>Your download should start automatically, if not Click here. Should I give up, huh?</p>
            </div>
            <form class="subscribe-form">
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email address">
                </div>
                <button type="submit" class="btn btn-danger btn-lg">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Special Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="https://placehold.co/500x300/CF202F/white?text=Math+Course+Offer" class="img-fluid"
                        alt="Offer">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Testimonial slider functionality
            const testimonials = document.querySelectorAll('.testimonial-item');
            const prevBtn = document.getElementById('prev-testimonial');
            const nextBtn = document.getElementById('next-testimonial');
            let currentTestimonial = 0;

            // Show specific testimonial
            function showTestimonial(index) {
                testimonials.forEach(testimonial => {
                    testimonial.style.display = 'none';
                });

                testimonials[index].style.display = 'block';
                currentTestimonial = index;
            }

            // Initialize - show first testimonial only on mobile
            function initTestimonials() {
                if (window.innerWidth < 768) {
                    showTestimonial(0);
                } else {
                    testimonials.forEach(testimonial => {
                        testimonial.style.display = 'block';
                    });
                }
            }

            // Call on load and resize
            initTestimonials();
            window.addEventListener('resize', initTestimonials);

            // Navigation handlers
            prevBtn.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    let newIndex = currentTestimonial - 1;
                    if (newIndex < 0) newIndex = testimonials.length - 1;
                    showTestimonial(newIndex);
                }
            });

            nextBtn.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    let newIndex = currentTestimonial + 1;
                    if (newIndex >= testimonials.length) newIndex = 0;
                    showTestimonial(newIndex);
                }
            });

            // Show modal after 2 seconds
            setTimeout(function() {
                const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
                modal.show();
            }, 2000);

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>

    @include('Visitor.inc.footer')
