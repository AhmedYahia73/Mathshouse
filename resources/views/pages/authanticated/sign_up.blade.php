@php
    if (!empty(session('data'))) {
        $data = session('data');
    }
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@extends('layout.loginMaster')
@section('styleCssSection')
    <style>
        .parContainer {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            row-gap: 35px;
        }

        .parContainer>header {
            width: 95%;
            display: flex;
            align-items: flex-start;
        }

        .parContainer>header>img {
            padding-top: 20px;
        }

        .parContainer>.contentRe {
            width: 95%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            row-gap: 15px;
            margin-bottom: 30px;
        }

        .contentRe .headerTitle {
            width: 50%;
            font-size: 2.0rem;
            line-height: 40px;
            color: #727272;
            font-weight: bold;
            word-spacing: 5px;

        }

        .contentRe .headerTitle span:nth-child(2) {
            color: #CF202F;
        }

        .contentRe .leftRe {
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            margin: 0 !important;
        }

        .contentRe .centerRe {
            width: 0.3%;
            height: 100%;
            border-radius: 20px;
            background: #727272;

        }

        .contentRe .rightRe {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contentRe .leftRe .inputs {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            row-gap: 13px;
            margin-bottom: 30px;
        }

        .firstInp,
        .lastInp {
            position: relative;
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            row-gap: 5px;

        }

        .nickInp,
        .emailInp,
        .phoneInp,
        .passInp,
        .passConfInp {
            position: relative;
            width: 90%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            row-gap: 5px;
        }

        .fulName {
            width: 90%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            column-gap: 50px;
        }

        .firstInp>input,
        .lastInp>input,
        .nickInp>input,
        .emailInp>input,
        .phoneInp>input,
        .passInp>input,
        .passConfInp>input {
            width: 100%;
            outline: none;
            border: none;
            border-bottom: solid red;
            padding: 10px 0;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .firstInp>span,
        .lastInp>span,
        .nickInp>span,
        .emailInp>span,
        .phoneInp>span,
        .passInp>span,
        .passConfInp>span {
            font-size: 1.2rem;
            font-weight: bold;
            color: red;
        }

        .leftRe>button {
            width: 50%;
            border: none;
            background: #CF202F;
            padding: 10px;
            border-radius: 20px;
            color: #fff;
            font-size: 1.3rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .leftRe>button:hover {
            background: red;
        }

        .showPass,
        .hidePass,
        .showPassConf,
        .hidePassConf {
            position: absolute;
            right: 3%;
            top: 30%;
            font-size: 1.4rem !important;
            cursor: pointer;
        }


        footer {
            color: #727272;
            font-size: 1.3rem;
            font-weight: 500;
        }

        footer>a {
            font-weight: 800 !important;
            color: #CF202F;
            transition: all 0.3s ease-in-out;
        }

        footer>a:hover {
            color: red;
        }

        @media (max-width: 1220px) {

            .contentRe .centerRe,
            .contentRe .rightRe {
                display: none !important;
            }

            .contentRe .leftRe {
                width: 100%;
            }
            .headerTitle{
                width: 100% !important;
                margin-bottom: 10px;    
                display: flex;
                align-items: center;
                justify-content :center;
                gap: 10px;
            }
        }
    </style>
@endsection

{{-- Content page --}}

<div class="parContainer">
    <header>
        <img alt="Logo" src="{{ asset('assets/media/logos/mathshouse_whiteLogo.png') }}" />
    </header>

    <div class="contentRe">
        <form action="{{ route('sign_up_add') }}" method="POST" novalidate="novalidate" class="leftRe">
            @csrf
            <div class="headerTitle">
                <span>Sign up to</span>
                <span>Maths House</span>
                <div>Welcome</div>
            </div>

            <div class="inputs">

                <div class="fulName">
                    <div class="firstInp">
                        <input type="text" value="{{ old('f_name') ?? @$data['f_name'] }}" id="firstInput"
                            name="f_name" placeholder="First Name">
                        @error('f_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        <span class="d-none">Please Set Your First Name</span>
                    </div>

                    <div class="lastInp">
                        <input type="text" id="lastInput" value="{{ old('l_name') ?? @$data['l_name'] }}"
                            name="l_name" placeholder="Last Name">
                        @error('l_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        <span class="d-none">Please Set Your Last Name</span>
                    </div>
                </div>

                <div class="nickInp">
                    <input type="text" id="nickInput" name="nick_name"
                        value="{{ old('nick_name') ?? @$data['nick_name'] }}" placeholder="Nick Name">
                    @error('nick_name')
                        <span style="color: red;"> {{ $message }} </span>
                    @enderror
                    <span class="d-none">Please Set Your Nick Name</span>
                </div>
                <div class="emailInp">
                    <input type="email" id="emailInput" name="email" placeholder="Email"
                        value="{{ old('email') ?? @$data['email'] }}">
                    <span class="d-none">Please Set Your Email</span>
                    <span class="d-none">Please Set '@' After Your Email Name</span>
                    @error('email')
                        <span style="color: red;"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="phoneInp">
                    <input type="number" id="phoneInput" value="{{ old('phone') ?? @$data['phone'] }}" name="phone"
                        placeholder="Phone">
                    <span class="d-none">Please Set Your Phone Number</span>
                    @error('phone')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="passInp">
                    <input type="password" id="passInput" name="password" placeholder="Password">
                    <span class="d-none">Please Set Your Password</span>
                    @error('password')
                        <span style="color: red;"> {{ $message }} </span>
                    @enderror
                    <i class="fa-solid fa-eye showPass d-none"></i>
                    <i class="fa-solid fa-eye-slash hidePass"></i>
                </div>
                <div class="passConfInp">
                    <input type="password" id="passConfInput" name="conf_password" placeholder="Confirm Password">
                    <span class="d-none">Please Set Your Confirm Password</span>
                    <span class="d-none">Confirm Password is not matching</span>
                    <i class="fa-solid fa-eye showPassConf d-none"></i>
                    <i class="fa-solid fa-eye-slash hidePassConf"></i>
                </div>
            </div>
            <button type="submit" id="subSign">Sign Up</button>
        </form>

        <div class="centerRe"></div>
        <div class="rightRe">
            <img alt="Logo" src="{{ asset('assets/media/logos/mathshouse_white_logoHeader.png') }}" />
        </div>
    </div>

    <footer>
        You have an account? <a href="{{ route('login.index') }}">Login</a>
    </footer>
</div>



{{-- ////Content page --}}

@section('script')
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <script>
        $(document).ready(function() {

            $(".hidePass").click(function() {
                $(this).addClass("d-none")
                $(".showPass").removeClass("d-none")
                $("#passInput").attr("type", "text");
            })
            $(".showPass").click(function() {
                $(this).addClass("d-none")
                $(".hidePass").removeClass("d-none")
                $("#passInput").attr("type", "password");
            })

            $(".hidePassConf").click(function() {
                $(this).addClass("d-none")
                $(".showPassConf").removeClass("d-none")
                $("#passConfInput").attr("type", "text");
            })
            $(".showPassConf").click(function() {
                $(this).addClass("d-none")
                $(".hidePassConf").removeClass("d-none")
                $("#passConfInput").attr("type", "password");
            })



            function checkFaild(ele) {
                if ($(ele).val() == "") {
                    $(ele).next().removeClass("d-none")
                } else {
                    $(ele).next().addClass("d-none")
                }
            }

            function checkFaildEmail(ele) {
                if ($(ele).val().includes("@")) {
                    $(ele).next().next().addClass("d-none")
                } else {
                    $(ele).next().next().removeClass("d-none")
                }
            }

            function checkconfirmPass(pass, confPass) {
                if ($(pass).val() == $(confPass).val()) {
                    $(pass).next().next().addClass("d-none")
                } else {
                    $(pass).next().next().removeClass("d-none")
                }
            }


            $("#firstInput").keyup(function() {
                checkFaild($(this));
            })
            $("#lastInput").keyup(function() {
                checkFaild($(this));
            })
            $("#nickInput").keyup(function() {
                checkFaild($(this));
            })
            $("#emailInput").keyup(function() {
                checkFaild($(this));
                // checkFaildEmail($(this));
            })
            $("#phoneInput").keyup(function() {
                checkFaild($(this));
            })
            $("#passInput").keyup(function() {
                checkFaild($(this));
            })
            $("#passConfInput").keyup(function() {
                checkFaild($(this));
                checkconfirmPass($(this), $("#passInput"));
            })


            $("#subSign").click(function(e) {
                var firstName = $("#firstInput").val();
                var lastName = $("#lastInput").val();
                var nickName = $("#nickInput").val();
                var userEmail = $("#emailInput").val();
                var userPhone = $("#phoneInput").val();
                var userPass = $("#passInput").val();
                var userPassConf = $("#passConfInput").val();

                if (firstName == "") {
                    $("#firstInput").next().removeClass("d-none");
                    e.preventDefault();
                } else {
                    $("#firstInput").next().addClass("d-none");
                }
                if (lastName == "") {
                    $("#lastInput").next().removeClass("d-none");
                    e.preventDefault();
                } else {
                    $("#lastInput").next().addClass("d-none");
                }
                if (nickName == "") {
                    $("#nickInput").next().removeClass("d-none");
                    e.preventDefault();
                } else {
                    $("#nickInput").next().addClass("d-none");
                }

                if (userEmail == "") {
                    $("#emailInput").next().removeClass("d-none");
                    e.preventDefault();
                } else {
                    $("#emailInput").next().addClass("d-none");
                }
                if ($("#emailInput").val().includes("@")) {
                    $("#emailInput").next().next().addClass("d-none");
                    // e.preventDefault();
                } else {
                    $("#emailInput").next().next().removeClass("d-none");
                }

                if (userPhone == "") {
                    $("#phoneInput").next().removeClass("d-none");
                    e.preventDefault();
                } else {
                    $("#phoneInput").next().addClass("d-none");
                }


                if (userPass == "") {
                    $("#passInput").next().removeClass("d-none");
                    e.preventDefault();
                } else {
                    $("#passInput").next().addClass("d-none");
                }

                if (userPassConf == "") {
                    $("#passConfInput").next().removeClass("d-none");
                    e.preventDefault();
                } else {
                    $("#passConfInput").next().addClass("d-none");
                    if (userPassConf == $("#passInput").val()) {
                        $("#passConfInput").next().next().addClass("d-none");
                        // e.preventDefault();
                    } else {
                        $("#passConfInput").next().next().removeClass("d-none");
                    }
                }
            })
        })
    </script>
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/custom/authentication/sign-in/general.js"></script>
    <script src="assets/js/custom/authentication/sign-in/i18n.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
@endsection
