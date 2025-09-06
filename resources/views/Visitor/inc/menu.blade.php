{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
    integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        console.log("sssssssssssssssssssss")
    })
</script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<style>
    :root {
        --inline-gap: 0.9375rem;
        --animation: 400ms;
        --primaryColor: #1E1E1E;
    }

    /* .activee {
        padding: 10px 15px !important;
        background: red !important;
        color: #fff !important;
        border-radius: 10px !important;
    } */

    li>a>span {
        transition: all 0.3s ease-in-out;
    }


    .navbar {
        border-bottom: outset;
    }

    .navbar-toggler {
        cursor: pointer;
        font-size: 2rem !important;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        outline: none !important;
        border: none !important;
        padding: 0 !important;
    }

    .navbar-toggler>svg {
        color: #cf202f !important;
        font-size: 2.6rem;
        margin-right: 20px;

    }

    .navbar-toggler:focus {

        outline: none;
    }

    /* Start Nav bar section */
    .navbar .navbar-nav .nav-link,
    .navbar-brand {
        /* color: white; */
        text-transform: uppercase;
    }

    .navbar-brand {
        font-size: 28px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .bg-color {
        background-color: black;
    }

    .nav-item a {
        position: relative;
    }

    .nav-item a::before {
        content: "";
        position: absolute;
        bottom: 7px;
        left: var(--inline-gap);
        width: 0px;
        height: 2px;
        background-color: #CF202F;
        transition: width var(--animation);
    }

    .nav-item a:not(.btn):hover {
        color: #CF202F !important;
    }

    .nav-item a:hover::before,
    a.active::before {
        width: calc(90% - (var(--inline-gap) * 2));
    }

    .dropdown .dropdown-menu {
        display: none;
    }

    .dropdown:hover>.dropdown-menu,
    .dropend:hover>.dropdown-menu {
        display: block;
        margin-top: 0.125em;
        margin-left: .125em;
    }

    @media screen and (min-width:769px) {
        .dropend:hover>.dropdown-menu {
            position: absolute;
            top: 0;
            left: 85%;
        }

        nav {
            width: 100%;
        }
    }
</style>
<!-- Main Header Nav -->


<!-- Ace Responsive Menu -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white p-1">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" class="navbar_brand float-left dn-smd"><img
                src="{{ asset('assets/media/logos/mathshouse_white_logo.png') }}" style="width:150px" alt=""></a>
        <button class="navbar-toggler p-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars w-200 d-flex align-items-center"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 mt-2 mt-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('home') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('home') }}" class="navbar_brand float-left dn-smd">home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('categories') ? 'active' : '' }}"
                        href="{{ route('categories') }}">courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('v_dia_cate') ? 'active' : '' }}"
                        href="{{ route('v_dia_cate') }}">diagnostic exams </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('v_exams') ? 'active' : '' }}"
                        href="{{ route('v_exams') }}">exams </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('v_question') ? 'active' : '' }}"
                        href="{{ route('v_question') }}">questions</a>
                </li>
                <li class="nav-item">
                    @if (empty(auth()->user()))
                        <a class="nav-link p-lg-3 text-capitalize" href="{{ route('login.index') }}">live</a>
                    @else
                        <a class="nav-link p-lg-3 text-capitalize" href="{{ route('v_live') }}">live</a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3 text-capitalize"
                        href="{{ route('v_about') }}">about</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link p-lg-3" href="{{ route('v_contact') }}">contact us</a>
                </li>
                <li class="nav-item">
                    @if (empty(auth()->user()))
                <li class="nav-item px-2">
                    <a href="{{ route('login.index') }}" class="btn btn-outline-danger"> <span
                            class="">Login</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sign_up') }}" class="btn btn-danger nav_btn"> <span class="">Sign
                            Up</span></a>
                </li>
            @elseif(auth()->user()->position == 'admin' || auth()->user()->position == 'user_admin')
                <a href="{{ route('dashboard') }}" class="btn btn-danger nav_btn"> <span
                        class="">Dashboard</span></a>
            @elseif(auth()->user()->position == 'teacher')
                <a href="{{ route('t_dashboard') }}" class="btn btn-danger nav_btn"> <span
                        class="">Dashboard</span></a>
            @elseif(auth()->user()->position == 'student')
                <a href="{{ route('stu_dashboard') }}" class="btn btn-danger nav_btn"> <span
                        class="">Dashboard</span></a>
            @elseif(auth()->user()->position == 'affilate')
                <a href="{{ route('stu_affilate') }}" class="btn btn-danger nav_btn"> <span
                        class="">Dashboard</span></a>
            @else
                <a href="{{ route('login.index') }}" class="btn btn-danger nav_btn"> <span
                        class="">Dashboard</span></a>
                @endif

            </ul>
            <!-- <ul class="sign_up_btn pull-right dn-smd mt10">
                <li class="list-inline-item list_s">
                </li>

            </ul> -->

        </div>
    </div>
</nav> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --inline-gap: 0.9375rem;
            --animation: 400ms;
            --primaryColor: #1E1E1E;
        }

        li>a>span {
            transition: all 0.3s ease-in-out;
        }

        .navbar {
            border-bottom: outset;
        }

        .navbar-toggler {
            cursor: pointer;
            font-size: 2rem !important;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none !important;
            border: none !important;
            padding: 8px 12px !important;
            background: transparent !important;
        }

        .navbar-toggler>i {
            color: #cf202f !important;
            font-size: 2.6rem;
            margin-right: 0;
        }

        .navbar-toggler:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .navbar .navbar-nav .nav-link,
        .navbar-brand {
            text-transform: uppercase;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .nav-item a {
            position: relative;
        }

        .nav-item a::before {
            content: "";
            position: absolute;
            bottom: 7px;
            left: var(--inline-gap);
            width: 0px;
            height: 2px;
            background-color: #CF202F;
            transition: width var(--animation);
        }

        .nav-item a:not(.btn):hover {
            color: #CF202F !important;
        }

        .nav-item a:hover::before,
        a.active::before {
            width: calc(90% - (var(--inline-gap) * 2));
        }

        @media screen and (min-width:769px) {
            nav {
                width: 100%;
            }
        }

        /* Make buttons inline on mobile */
        .btn-group-mobile {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
        }

        @media (max-width: 991.98px) {
            .btn-group-mobile {
                justify-content: center;
                margin-top: 10px;
                padding: 0 15px;
            }

            .btn-group-mobile .nav-item {
                flex: 0 0 auto;
                padding: 0 !important;
                margin: 0 5px;
            }

            .btn-group-mobile .btn {
                white-space: nowrap;
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <!-- Debug Panel -->

    <!-- Clean, minimal navbar structure -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white p-1" id="mainNavbar">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('home') }}" class="navbar_brand float-left dn-smd"><img
                    src="{{ asset('assets/media/logos/mathshouse_white_logo.png') }}" style="width:150px"
                    alt=""></a>


            <!-- Mobile menu toggle button -->
            <button class="navbar-toggler" type="button" id="navbarToggleBtn" aria-label="Toggle navigation menu"
                aria-expanded="false">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>

            <!-- Navigation menu -->
            <div class="navbar-collapse collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 mt-2 mt-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('home') ? 'active' : '' }}"
                            aria-current="page" href="{{ route('home') }}"
                            class="navbar_brand float-left dn-smd">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('categories') ? 'active' : '' }}"
                            href="{{ route('categories') }}">courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('v_dia_cate') ? 'active' : '' }}"
                            href="{{ route('v_dia_cate') }}">diagnostic exams </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('v_exams') ? 'active' : '' }}"
                            href="{{ route('v_exams') }}">exams </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-lg-3 text-capitalize {{ request()->routeIs('v_question') ? 'active' : '' }}"
                            href="{{ route('v_question') }}">questions</a>
                    </li>
                    <li class="nav-item">
                        @if (empty(auth()->user()))
                            <a class="nav-link p-lg-3 text-capitalize" href="{{ route('login.index') }}">live</a>
                        @else
                            <a class="nav-link p-lg-3 text-capitalize" href="{{ route('v_live') }}">live</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-lg-3 text-capitalize" href="{{ route('v_about') }}">about</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-lg-3" href="{{ route('v_contact') }}">contact us</a>
                    </li>
                    @if (empty(auth()->user()))
                        <!-- Button group for mobile inline display -->
                        <div class="btn-group-mobile">
                            <li class="nav-item px-2">
                                <a href="{{ route('login.index') }}" class="btn btn-outline-danger"> <span
                                        class="">Login</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sign_up') }}" class="btn btn-danger nav_btn"> <span
                                        class="">Sign
                                        Up</span></a>
                            </li>
                        </div>
                    @elseif(auth()->user()->position == 'admin' || auth()->user()->position == 'user_admin')
                        <a href="{{ route('dashboard') }}" class="btn btn-danger nav_btn"> <span
                                class="">Dashboard</span></a>
                    @elseif(auth()->user()->position == 'teacher')
                        <a href="{{ route('t_dashboard') }}" class="btn btn-danger nav_btn"> <span
                                class="">Dashboard</span></a>
                    @elseif(auth()->user()->position == 'student')
                        <a href="{{ route('stu_dashboard') }}" class="btn btn-danger nav_btn"> <span
                                class="">Dashboard</span></a>
                    @elseif(auth()->user()->position == 'affilate')
                        <a href="{{ route('stu_affilate') }}" class="btn btn-danger nav_btn"> <span
                                class="">Dashboard</span></a>
                    @else
                        <a href="{{ route('login.index') }}" class="btn btn-danger nav_btn"> <span
                                class="">Dashboard</span></a>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Comprehensive error-safe navbar implementation
        (function() {
            'use strict';

            // Wait for everything to be loaded
            function initializeNavbar() {
                try {
                    // Get elements
                    const toggleBtn = document.getElementById('navbarToggleBtn');
                    const navbarMenu = document.getElementById('navbarMenu');
                    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

                    // Manual toggle functionality (no Bootstrap collapse component)
                    let isMenuOpen = false;

                    function toggleMenu() {
                        isMenuOpen = !isMenuOpen;

                        if (isMenuOpen) {
                            navbarMenu.classList.add('show');
                            toggleBtn.setAttribute('aria-expanded', 'true');
                        } else {
                            navbarMenu.classList.remove('show');
                            toggleBtn.setAttribute('aria-expanded', 'false');
                        }
                    }

                    function closeMenu() {
                        if (isMenuOpen) {
                            isMenuOpen = false;
                            navbarMenu.classList.remove('show');
                            toggleBtn.setAttribute('aria-expanded', 'false');
                        }
                    }

                    // Add click handler to toggle button
                    toggleBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        toggleMenu();
                    });

                    // Close menu when clicking nav links (on mobile)
                    navLinks.forEach(function(link) {
                        link.addEventListener('click', function() {
                            if (window.innerWidth <= 991.98 && isMenuOpen) {
                                setTimeout(closeMenu, 100); // Small delay for better UX
                            }
                        });
                    });

                    // Close menu when clicking outside
                    document.addEventListener('click', function(e) {
                        if (isMenuOpen && !e.target.closest('#mainNavbar')) {
                            closeMenu();
                        }
                    });

                    // Handle window resize
                    window.addEventListener('resize', function() {
                        if (window.innerWidth > 991.98 && isMenuOpen) {
                            closeMenu();
                        }
                    });

                } catch (error) {
                    console.error('Navbar initialization error:', error);
                }
            }

            // Multiple initialization attempts to ensure it works
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeNavbar);
            } else {
                initializeNavbar();
            }

            // Backup initialization
            window.addEventListener('load', function() {
                setTimeout(initializeNavbar, 100);
            });

        })();
    </script>
</body>

</html>
