<style>
    a {
        color: #595959 !important;
    }

    .hidee {
        height: 0px;
    }

    a:hover {
        color: #477598 !important;
    }
</style>
<div class="full__width__padding">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-12">
            <div class="dashboard__inner sticky-top">
                <div class="dashboard__nav__title">
                    <h6>Welcome, {{ auth()->user()->nick_name }} </h6>
                </div>
                <div class="dashboard__nav">
                    <ul>
                        <li>
                            <a class="active" href="{{ route('stu_dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('stu_my_courses') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-book-open">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                                My Courses</a>
                        </li>
                        <li>
                            {{-- Group --}}
                            <span id="showChild" class="p-0 col-md-12 d-flex align-items-center justify-content-between"
                                style="color: #5f6c76; cursor: pointer;">
                                <span>
                                    <i class="fa-solid fa-play" style="width: 16px;margin-right: 10px;"></i>
                                    Live Sessions
                                </span>
                                <i class="fa-solid fa-angle-down"></i></span>
                            <ul id="child" class="hidee" style="overflow: hidden;">

                                <li style="padding-left: 20px;">
                                    <a href="{{ route('stu_mysessions') }}">
                                        <i class="fa-solid fa-video" style="width: 17px;margin-right: 10px;"></i>
                                        Live
                                    </a>
                                </li>
                                <li style="padding-left: 20px;">
                                    <a href="{{ route('stu_myLiveCourse') }}">
                                        <i class="fa-solid fa-person-chalkboard"
                                            style="width: 17px;margin-right: 10px;"></i>
                                        My Live Lesson
                                    </a>
                                </li>
                                <li style="padding-left: 20px;">
                                    <a href="{{ route('stu_private_req') }}">
                                        <i class="fa-solid fa-book" style="width: 17px;margin-right: 10px;"></i>
                                        Private Request
                                    </a>
                                </li>
                            </ul>
                            {{-- //////Group --}}
                        </li>
                        <li>
                            <a href="{{ route('my_packages') }}">
                                <i class="fa-solid fa-cubes" style="width: 17px;margin-right: 10px;"></i>
                                My Packages
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('score_sheet') }}">
                                <i class="fa-solid fa-cubes" style="width: 17px;margin-right: 10px;"></i>
                                Score Sheet
                            </a>
                        </li>
                        <li>
                            {{-- Group --}}
                            <span id="show_Child" class="p-0 col-md-12 d-flex align-items-center justify-content-between"
                                style="color: #5f6c76; cursor: pointer;">
                                <span>
                                    <i class="fa-solid fa-book" style="width: 17px;margin-right: 10px;"></i>
                                    <span>
                                        Education History
                                    </span>
                                </span>
                                <i class="fa-solid fa-angle-down"></i></span>
                            <ul id="child1" class="hidee" style="overflow: hidden;">

                                <li>
                                    <a href="{{ route('quizze_history') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-bookmark">
                                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        Quizes history
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dia_exam_history') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-bookmark">
                                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        Diagnostic Exam History</a>
                                </li>
                                <li>
                                    <a href="{{ route('question_history') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-bookmark">
                                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        Question History</a>
                                </li>
                                <li>
                                    <a href="{{ route('exam_history') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                            </polygon>
                                        </svg>
                                        Exam History
                                    </a>
                                </li>
                            </ul>
                            {{-- //////Group --}}
                        </li>
                        <li>
                            {{-- Group --}}
                            <span id="show_Child2" class="p-0 col-md-12 d-flex align-items-center justify-content-between"
                                style="color: #5f6c76; cursor: pointer;">
                                <span>
                                    <i class="fa-solid fa-dollar-sign" style="width: 17px;margin-right: 10px;"></i>
                                    Payment
                                </span>
                                <i class="fa-solid fa-angle-down"></i></span>
                            <ul id="child2" class="hidee" style="overflow: hidden;">

                                <li>
                                    <a href="{{ route('wallet') }}">
                                        <i class="fa-solid fa-money-bill-wave"
                                            style="width: 17px;margin-right: 10px;"></i>
                                        Wallet
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('stu_payment_history') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-help-circle">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                        Payment History
                                    </a>
                                </li>
                            </ul>
                            {{-- //////Group --}}
                        </li>
                        <li>
                            <a href="{{ route('stu_profile') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                My Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-volume-1">
                                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                                    <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                                </svg>
                                Logout</a>
                        </li>
                        <li>
                            <a href="{{ route('delete_account',['id'=>auth()->user()->id]) }}">
                                <i class="fa-solid fa-user-xmark"></i>
                                &nbsp;
                                Delete Account
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-12">
            <div class="-fluid full__width__padding">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="dashboardarea__wraper">
                            <div class="dashboardarea__img">
                                <div class="dashboardarea__inner bg-danger student__dashboard__inner">
                                    <div class="dashboardarea__left">
                                        <div class="dashboardarea__left__img">
                                            <img loading="lazy" style="height: 120px;width: 120px;"
                                                src="{{ asset('images/users/' . auth()->user()->image) }}" alt="">
                                        </div>
                                        <div class="dashboardarea__left__content">
                                            <h4>
                                                {{ auth()->user()->f_name . ' ' .
                                                auth()->user()->l_name .
                                                ' (' . auth()->user()->nick_name . ')'}}
                                            </h4>
                                            <ul>
                                                <li> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-book-open">
                                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                                    </svg>
                                                    {{ auth()->user()->email }}
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="dashboardarea__right">
                                        <div style="font-weight: bold; color: #fff; font-size: 22px"
                                            class="dashboardarea__right__button">
                                            ${{ app('wallet') }}
                                        </div>
                                    </div>
                                    <div class="dashboardarea__right">
                                        <div class="dashboardarea__right__button">
                                            <a class="default__button bg-dark text-light"
                                                href="{{ route('wallet') }}">My Wallet
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-arrow-right">
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    <polyline points="12 5 19 12 12 19"></polyline>
                                                </svg></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $("#showChild").click(function() {
                        $("#child").toggleClass("hidee")
                    })
                })
                $(document).ready(function() {
                    $("#show_Child").click(function() {
                        $("#child1").toggleClass("hidee")
                    })
                })
                $(document).ready(function() {
                    $("#show_Child2").click(function() {
                        $("#child2").toggleClass("hidee")
                    })
                })
            </script>
            <!-- breadcrumbarea__section__end-->

            @yield('page_content')
        </div>
    </div>
</div>