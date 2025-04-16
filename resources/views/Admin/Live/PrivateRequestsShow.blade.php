
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
    @section('title','Private Sessions')
    @include('success')

    <!-- Link to the file hosted on your server, -->
    <link rel="stylesheet" href="path-to-the-file/splide.min.css">


    <!-- or link to the CDN -->
    <link rel="stylesheet" href="url-to-cdn/splide.min.css">
    {{-- splide libaray --}}
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
        integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
        integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
    {{-- splide libaray --}}



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <style>
        :root {
            --main-color: #dc3545;
        }

        .lessons {
            background-color: rgb(68, 109, 180);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 5px;
        }

        .lessons-wrapper {
            /* background-color: yellowgreen; */
            width: 100%;
            display: flex;
            /* flex-wrap: wrap; */
            gap: 15px;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 10px 20px;
        }

        .lesson {
            width: 60%;
            height: 200px;
            font-family: "Heebo-Regular", sans-serif;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* background: orangered; */
            border-radius: 18px;
            overflow: hidden;
            padding: 5px;
            column-gap: 30px;
        }

        .lesson_left {
            width: 171px;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0px 0px 9px -3px rgba(202, 31, 48, 0.651);
        }

        .lesson_left>span {
            color: var(--main-color);
            width: 100%;
            text-align: center;
            font-size: 32px;
        }

        .lesson_left>span:nth-child(3) {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .lesson_left>span:nth-child(1) {
            background: var(--main-color);
            font-size: 28px;
            padding: 8px 0;
            color: #fff;
        }

        .lesson_right {
            width: 429px;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-between;
            background-color: #fff;
            border-radius: 18px;
            padding: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 9px -3px rgba(202, 31, 48, 0.651);
        }

        .lesson_time_num {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .lesson_time,
        .lesson_num,
        .lesson_teacher_name,
        .lesson_course_name,
        .lesson_chapter_name,
        .chapter_icon {
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 7px;
        }

        .lesson_reservation {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .lesson_reservation button {
            position: absolute;
            color: #fff;
            background: var(--main-color);
            bottom: 8px;
            border: none;
            border-radius: 13px;
            font-size: 1.4rem;
            padding: 3px 9px;
            text-transform: capitalize;
            transition: all 0.3s ease-in-out;
        }

        .lesson_reservation button a {
            color: #fff !important;
            border: none !important;
            outline: none !important;
        }

        .lesson_reservation button:hover {
            color: var(--main-color);
            background: #fff;
            outline: 2px solid var(--main-color);

        }

        .lesson_reservation button:hover a {
            color: var(--main-color) !important;

        }

        .lesson_reservation button a:hover {
            border: 0 !important;
            outline: 0 !important;
        }



        .splide__pagination {
            bottom: -0.5em !important;
        }

        .splide__pagination__page.is-active {
            background: var(--main-color) !important;
        }

        .splide__arrow--next {
            right: 2em;
            align-items: center;
            background: var(--main-color);
            border: 0;
            border-radius: 10px;
            cursor: pointer;
            display: -ms-flexbox;
            display: flex;
            height: 2em;
            -ms-flex-pack: center;
            justify-content: center;
            opacity: 1;
            padding: 0;
            position: absolute;
            top: 103%;
            transform: translateY(-50%);
            width: 2em;
            z-index: 1;
        }

        .splide__arrow--prev {
            left: 90% !important;
            align-items: center;
            background: var(--main-color);
            border: 0;
            border-radius: 10px;
            cursor: pointer;
            display: -ms-flexbox;
            display: flex;
            height: 2em;
            -ms-flex-pack: center;
            justify-content: center;
            opacity: 1;
            padding: 0;
            position: absolute;
            top: 103%;
            transform: translateY(-50%);
            width: 2em;
            z-index: 1;
        }

        .splide__arrow svg {
            fill: #fff;
        }
    </style>
    <h3 style="margin: 12px 0 !important">Choose <span style="color: var(--main-color)">your class</span> time</h3>
    <section class="splide" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <div class="splide__list">
                {{-- <li class="lessons-wrapper splide__slide">Slide 1
                </li>
                <li class="lessons-wrapper splide__slide">Slide 2
                </li>
                <li class="lessons-wrapper splide__slide">Slide 3
                </li> --}}

            </div>
        </div>
    </section>
    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModalCenter22" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle22">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    lknlknkl
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">send</button>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // new Splide('.splide').mount();
            var splide = new Splide('.splide', {
                perPage: 1,
                rewind: true,
            });

            $.getJSON("{{route('private_req_api')}}", function(data) {
                console.log(data)
                $(data.sessions).each((val, ele) => {
                    console.log(val)
                    // console.log(ele)
                    var month = ["January", "February", "March", "April", "May", "June", "July",
                        "August", "September", "October", "November", "December"
                    ];
                    // var DataLesson = new Date();
                    // let nameMonth = month[DataLesson.getMonth()];

                    var lesson = `<div class="lesson">
                        <input type="hidden" value=${ele.id} id="lessonID">
                                        <div class="lesson_left">
                                            <span class="lesson_manth">${month[parseInt((ele.date).slice(5,7) - 1)]}</span>
                                            <span class="lesson_numDay mb-5">${(ele.date).slice(-2)}</span>
                                        </div>
                                        <div class="lesson_right">
                                            <div class="lesson_time_num">
                                                <div class="lesson_time">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_8_1047)">
                                                            <path
                                                                d="M17.5001 17.5L17.0958 16.934C15.7102 14.9941 13.9836 13.3223 12.0001 12L12.055 11.5065C12.3507 8.84473 12.3323 6.15744 12.0001 3.5M22.4978 12C22.4978 6.20229 17.7978 1.50232 12.0001 1.50232C6.20241 1.50232 1.50244 6.20229 1.50244 12C1.50244 17.7977 6.20241 22.4977 12.0001 22.4977C17.7978 22.4977 22.4978 17.7977 22.4978 12Z"
                                                                stroke="#DC3545" stroke-width="2"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_8_1047">
                                                                <rect width="24" height="24" fill="white"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <div class="time_fromTO">${(ele.from).slice(0,5)+" / "+(ele.to).slice(0,5)}</div>
                                                </div>

                                                <div class="lesson_num">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.83998 23.52H23.52V7.19998V6.23998V0.47998H3.83998C1.98766 0.47998 0.47998 1.98718 0.47998 3.83998V20.16C0.47998 22.0128 1.98766 23.52 3.83998 23.52ZM3.83998 1.43998H22.56V6.23998H12V3.35998H5.27998V6.23998H3.83998C2.51662 6.23998 1.43998 5.16334 1.43998 3.83998C1.43998 2.51662 2.51662 1.43998 3.83998 1.43998ZM11.04 7.19998V12.8952L8.63998 10.895L6.23998 12.8952V7.19998V6.23998V4.31998H11.04V6.23998V7.19998ZM1.43998 6.18958C1.4443 6.19438 1.44958 6.19822 1.4539 6.20254C1.49134 6.24046 1.53166 6.27502 1.57102 6.31102C1.61134 6.34846 1.6507 6.38686 1.69342 6.4219C1.73518 6.45646 1.77982 6.48814 1.82302 6.52078C1.86622 6.55342 1.90798 6.58702 1.95262 6.61774C1.9987 6.64942 2.04766 6.67678 2.09566 6.70606C2.14078 6.73342 2.18446 6.7627 2.23102 6.78814C2.28094 6.8155 2.33374 6.83902 2.38558 6.86398C2.43262 6.88654 2.47822 6.9115 2.52622 6.93166C2.58046 6.9547 2.6371 6.97342 2.69278 6.99358C2.74078 7.01086 2.78734 7.03102 2.8363 7.04638C2.89774 7.06558 2.9611 7.0795 3.0235 7.09534C3.0691 7.10686 3.11326 7.12078 3.15934 7.13038C3.23278 7.14574 3.30862 7.15486 3.38398 7.16542C3.42094 7.1707 3.45742 7.17838 3.49486 7.18222C3.60814 7.19374 3.72334 7.19998 3.83998 7.19998H5.27998V14.9448L8.63998 12.1449L12 14.9448V7.19998H22.56V22.56H3.83998C2.51662 22.56 1.43998 21.4833 1.43998 20.16V6.18958Z"
                                                            fill="#DC3545" stroke="#DC3545" stroke-width="0.5"></path>
                                                    </svg>
                                                    <span>lesson:${ele.lesson.lesson_name}</span>
                                                </div>
                                            </div>
                                            <div class="lesson_teacher_name">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8 24C9.21011 21.6419 11.8623 20.0279 16 20.0279C20.1377 20.0279 22.7899 21.6419 24 24M19.2868 11.84C19.2868 13.9608 17.8153 15.68 16 15.68C14.1847 15.68 12.7132 13.9608 12.7132 11.84C12.7132 9.71923 14.1847 8 16 8C17.8153 8 19.2868 9.71923 19.2868 11.84Z"
                                                        stroke="#DC3545" stroke-width="2" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="teacherName">${"Mr/s. " + ele.teacher.name}</span>
                                            </div>
                                            <div class="lesson_course_name">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 12.6615L1.67705 7.5L12 2.33853L22.3229 7.5L22.1646 7.57918L12 12.6615Z"
                                                        stroke="#DC3545" stroke-width="1.5"></path>
                                                    <path
                                                        d="M11.6646 15.0093L12 15.177L12.3354 15.0093L18.75 11.802V16.7865L12 20.1615L5.25 16.7865V11.802L11.6646 15.0093Z"
                                                        stroke="#DC3545" stroke-width="1.5"></path>
                                                </svg>
                                                <span>${"course: "+ ele.lesson.course.course.course_name}</span>
                                            </div>
                                            <div class="lesson_chapter_name">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.83998 23.52H23.52V7.19998V6.23998V0.47998H3.83998C1.98766 0.47998 0.47998 1.98718 0.47998 3.83998V20.16C0.47998 22.0128 1.98766 23.52 3.83998 23.52ZM3.83998 1.43998H22.56V6.23998H12V3.35998H5.27998V6.23998H3.83998C2.51662 6.23998 1.43998 5.16334 1.43998 3.83998C1.43998 2.51662 2.51662 1.43998 3.83998 1.43998ZM11.04 7.19998V12.8952L8.63998 10.895L6.23998 12.8952V7.19998V6.23998V4.31998H11.04V6.23998V7.19998ZM1.43998 6.18958C1.4443 6.19438 1.44958 6.19822 1.4539 6.20254C1.49134 6.24046 1.53166 6.27502 1.57102 6.31102C1.61134 6.34846 1.6507 6.38686 1.69342 6.4219C1.73518 6.45646 1.77982 6.48814 1.82302 6.52078C1.86622 6.55342 1.90798 6.58702 1.95262 6.61774C1.9987 6.64942 2.04766 6.67678 2.09566 6.70606C2.14078 6.73342 2.18446 6.7627 2.23102 6.78814C2.28094 6.8155 2.33374 6.83902 2.38558 6.86398C2.43262 6.88654 2.47822 6.9115 2.52622 6.93166C2.58046 6.9547 2.6371 6.97342 2.69278 6.99358C2.74078 7.01086 2.78734 7.03102 2.8363 7.04638C2.89774 7.06558 2.9611 7.0795 3.0235 7.09534C3.0691 7.10686 3.11326 7.12078 3.15934 7.13038C3.23278 7.14574 3.30862 7.15486 3.38398 7.16542C3.42094 7.1707 3.45742 7.17838 3.49486 7.18222C3.60814 7.19374 3.72334 7.19998 3.83998 7.19998H5.27998V14.9448L8.63998 12.1449L12 14.9448V7.19998H22.56V22.56H3.83998C2.51662 22.56 1.43998 21.4833 1.43998 20.16V6.18958Z"
                                                        fill="#DC3545" stroke="#DC3545" stroke-width="0.5"></path>
                                                </svg>
                                                <span>${"Chapter: " + ele.lesson.course.chapter_name}</span>
                                            </div>
                                        </div>
                                </div>`;
                    // var coo = `<li class="lessons-wrapper splide__slide">Slide ${val}
                // </li>`
                    var lessonWrapper = `<div class="lessons-wrapper splide__slide">
                    ${lesson}
                        </div>`;

                    // $(".splide__list").append(lessonWrapper);
                    $(".splide__list").append(lessonWrapper);

                })
                splide.mount();
            })

        })
    </script>

</x-default-layout>