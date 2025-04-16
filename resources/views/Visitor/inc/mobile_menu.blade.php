
<div id="page" class="stylehome1 h0">
    <div class="mobile-menu">
        <div class="header stylehome1">
            <div class="main_logo_home2">
                <img class="nav_logo_img img-fluid float-left mt20" src="images/header-logo.png" alt="header-logo.png">
                <span>edumy</span>
            </div>
            <ul class="menu_bar_home2">
                <li class="list-inline-item">
                    <div class="search_overlay">
                      <a id="search-button-listener2" class="mk-search-trigger mk-fullscreen-trigger" href="#">
                        <div id="search-button2"><i class="flaticon-magnifying-glass"></i></div>
                      </a>
                        <div class="mk-fullscreen-search-overlay" id="mk-search-overlay2">
                            <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button2"><i class="fa fa-times"></i></a>
                            <div id="mk-fullscreen-search-wrapper2">
                              <form method="get" id="mk-fullscreen-searchform2">
                                <input type="text" value="" placeholder="Search courses..." id="mk-fullscreen-search-input2">
                                <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
                              </form>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-inline-item"><a href="#menu"><span></span></a></li>
            </ul>
        </div>
    </div><!-- /.mobile-menu -->
    <nav id="menu" class="stylehome1">
        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
            <li>
                <a href="{{route('categories')}}"><span class="title">Courses</span></a>
            </li>
            <li>
                <a href="{{route('v_dia_cate')}}"><span class="title">Diagnostic Exam</span></a>
            </li>
            <li>
                <a href="{{route('v_exams')}}"><span class="title">Exams</span></a>
            </li>
            <li>
                <a href="{{route('v_question')}}"><span class="title">Question</span></a>
            </li>
            <li>
                <a href="#"><span class="title">Live</span></a>
            </li>
            <li class="last">
                <a href="https://mathshouse.net/index.php/the-firm/"><span class="title">About</span></a>
            </li>
            <li class="last">
                <a href="https://mathshouse.net/index.php/contact"><span class="title">Contact</span></a>
            </li>
            <li class="list-inline-item list_s">
                @if ( empty(auth()->user()) )	
                <a href="{{route('login.index')}}" class="btn flaticon-user"> <span class="title">Login</span></a>
                @elseif( auth()->user()->position == 'admin' || auth()->user()->position == 'user_admin' )
                <a href="{{route('dashboard')}}" class="btn flaticon-user"> <span class="title">Dashboard</span></a>
                @elseif( auth()->user()->position == 'teacher' )
                <a href="{{route('t_dashboard')}}" class="btn flaticon-user"> <span class="title">Dashboard</span></a>
                @else
                <a href="{{route('login.index')}}" class="btn flaticon-user"> <span class="title">Dashboard</span></a>
                @endif
            </li>
              
        </ul>
    </nav>
</div>


@section('script')
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
@endsection