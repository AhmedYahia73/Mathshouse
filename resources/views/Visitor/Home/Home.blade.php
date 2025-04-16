@include('Visitor.inc.header')
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

    @property --num {
        syntax: "<integer>";
        initial-value: 0;
        inherits: false;
    }

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
            <a href=""><i class="fa-solid fa-chevron-down fa-2x" style="color:#CF202F"></i></a>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="margin-top: -15px;">
            <a href=""><i class="fa-solid fa-chevron-down fa-2x" style="color:#CF202F"></i></a>
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
                        Cum doctus civibus efficiantur in imperdiet deterruisset
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach( $courses as $item )
                <div class="col-md-3">
                    <a href="{{route('v_course', ['id' => $item->id])}}">
                    <div class="Courses-caption">
                        <div class="badge d-flex flex-row-reverse">
                            <h2> <span class="badge bg-badge h5">Top Seller</span></h2>
                        </div>
                        <h3 class="h5">{{$item->course_name}}</h3>
                        <h3 class="h5 p-0 m-0"> Web Design</h3>
                        <h4>${{$item->prices->min('price')}}</h4>

                    </div>
                </a>
                </div>
            @endforeach

            <div class="d-flex align-items-center flex-row-reverse">
                <a href="{{route('categories')}}" class="btn btn-danger mt-3">view all courses</a>
            </div>

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
</script>
@include('Visitor.inc.footer')
