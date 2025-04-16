<style>
    .headerarea__btn{
        color: #fff !important;
    }
    .headerarea__button:hover a{
        color:#5F2DED !important; 
    }
    .cart_icon{
        font-size: 25px;
        margin: 0 15px;
    }
    .logout_btn{
        color: #dc3545 !important;
        border: 1px solid #dc3545;
        border-radius: 2px;
        padding: 7px 20px;
    }
    .logout_btn:hover{
        color: white !important;
        background-color: #dc3545;
    }
</style>


<div class="headerarea headerarea__3 header__area">
    <div class="container desktop__menu__wrapper">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-6" style="margin-left: -50px">
                <div class="headerarea__left">
                    <div class="headerarea__left__logo">

                        <a href="{{ route('home') }}">
                            <img loading="lazy" style="height: 70px;"
                                src="{{ asset('assets/media/logos/mathshouse_white_logo.png') }}" alt="logo"></a>
                    </div>

                </div>
            </div>
            <div class="col-xl-7 col-lg-7 main_menu_wrap">
                <div class="headerarea__main__menu">
                    <nav>
                        <ul>


                            <li class="mega__menu position-static">
                                <a class="headerarea__has__dropdown" href="{{ route('categories') }}">Courses</a>
                            </li>

                            <li class="mega__menu position-static">
                                <a class="headerarea__has__dropdown" href="{{ route('v_dia_cate') }}">Diagnostic
                                    Exam</a>
                            </li>

                            <li class="mega__menu position-static">
                                <a class="headerarea__has__dropdown" href="{{ route('v_exams') }}">Exams</a>
                            </li>

                            <li class="mega__menu position-static">
                                <a class="headerarea__has__dropdown" href="{{ route('v_question') }}">Question</a>
                            </li>

                            <li class="mega__menu position-static">
                                <a class="headerarea__has__dropdown" href="{{ route('v_live') }}">Live</a>
                            </li>




                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="headerarea__right">

                    <div class="cart_icon">
                        <a href="{{ route('buy_course') }}"> <i class="icofont-cart-alt"></i></a>
                    </div>

                    <div class="headerarea__login">
                        <a href="{{ route('stu_profile') }}"><i class="icofont-user-alt-5"></i></a>
                    </div>
                    <div class="" >
                        <a href="{{route('logout')}}" class=" logout_btn">Logout</a>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <div class="container-fluid mob_menu_wrapper">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="mobile-logo">
                    <a class="logo__dark" href="#">
                        <img loading="lazy" style="height: 70px;"
                        src="{{ asset('assets/media/logos/mathshouse_white_logo.png') }}" alt="logo">
                    </a>
              
                </div>
            </div>
            <div class="col-6">
                <div class="header-right-wrap">


                    <div class="mobile-off-canvas">
                        <a class="mobile-aside-button" href="#"><i class="icofont-navigation-menu"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
