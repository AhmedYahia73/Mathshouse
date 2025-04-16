@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp

<x-default-layout>
    @section('title', 'Add Package to Student')
    @include('success')
    <style>
        .allUser {
            position: absolute;
            width: 100%;
            top: 40px;
            left: 0;
            background: #7b7575;
            max-height: 150px;
            overflow-y: scroll;
            border-radius: 0 0 10px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .user {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
            text-transform: uppercase;
            border-bottom: 3px solid #aaa;
            padding: 7px 0;
            transition: all 0.2s ease-out;
        }

        .user:hover {
            cursor: pointer;
            background: #646161;
        }

        .user:last-child {
            border-bottom: none;

        }

        .notGetUser {
            font-size: 1.3rem;
            font-weight: 500;
            padding: 10px 0;
            color: #fff;
            text-transform: uppercase;

        }
    </style>
    @include('success')
    <form action="{{route('add_small_package')}}" method="POST">
        @csrf
        <div style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px; padding: 30px;">
            <div class="position-relative">

                <input type="hidden" class="user_id" name="user_id" />
                <input type="text" required class="form-control my-2 secUser" name="user" placeholder="Select Student ..." />
                <div class="allUser">
                    {{-- <div class="user">
                        <span class="userNickName">mohamed</span>
                        <span class="userPhone">012345678910</span>
                    </div> --}}
                    <span class="notGetUser d-none">not found user</span>
                </div>
            </div>

            <input type="hidden" class="courses" value="{{$courses}}" />
            <select name="category_id" class="form-control sel_category my-2">
                <option selected disabled>Select Category ...</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->cate_name}}</option>
                @endforeach
            </select>

            <select name="course_id" class="form-control sel_course my-2">
                <option selected disabled>Select Course ...</option>
                @foreach ($courses as $course)
                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                @endforeach
            </select>

            <select name="module" class="form-control secpackage my-2">
                <option selected disabled>Select Package ...</option>
                <option value="Exam">Exam</option>
                <option value="Question">Question</option>
                <option value="Live">Live</option>
            </select>

            <input type="number" name="number" class="form-control my-2 numPackage"
                placeholder="The Number of Package" required />

            <div class="d-flex my-2">
                <button class="btn btn-primary mr-2 sub_btn">Submit</button>
                <button type="reset" class="btn btn-danger mx-2">Clear</button>
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        let sel_category = document.querySelector('.sel_category');
        let sel_course = document.querySelector('.sel_course');
        let courses = document.querySelector('.courses');
        courses = courses.value;
        courses = JSON.parse(courses);
 
        sel_category.addEventListener('change', (e) => {
            
            sel_course.innerHTML = `<option selected disabled>Select Course ...</option>`;
            courses.forEach(item => {
                if (item.category_id == e.target.value) {
                    sel_course.innerHTML += `
                    <option value="${item.id}">${item.course_name}</option>
                    `;
                }
            });
        });

        $(document).ready(function() {
            $(".secUser").keyup(function() {
                var name = $(this).val();
                console.log("name", name)

                $.ajax({
                    url: '{{ route('package_stu_search') }}',
                    type: "GET",
                    data: {
                        name: name
                    },
                    success: function(data) {
                        // console.log("data NAME", data)
                        // console.log("data faild", data.faild)

                        if (data.faild == undefined) {
                            $(".allUser").empty()
                            $(data.users).each((val, ele) => {
                                var resStudent = `<div class="user">
                            <input type="hidden" class="usersID" value=${ele.id} />
                            <span class="userNickName">${ele.nick_name}</span>
                            <span class="userPhone">${ele.phone}</span>
                            </div>`;
                                $(".allUser").append(resStudent);
                                $(".user").click(function() {
                                    $(".user_id").val("");

                                    $(".secUser").val($(this).find(
                                        ".userNickName").text())

                                    $(".user_id").val($(this).find(
                                        ".usersID").val())

                                    $(".allUser").empty()
                                })
                            })
                        } else {
                            $(".allUser").empty()
                            var textFaild = `<span class="notGetUser">${data.faild}</span>`;
                            $(".allUser").append(textFaild);
                        }

                    },
                    error: function(status, error) {
                        console.log(status)
                        console.log(error)
                    }

                })



            });
            /* ###### */
            $(".sub_btn").click(function() {
                var newStudent = {
                    userid: $(".user_id").val(),
                    user: $(".secUser").val(),
                    module: $(".secpackage").val(),
                    number: $(".numPackage").val(),

                }
            })
        });
    </script>
</x-default-layout>
