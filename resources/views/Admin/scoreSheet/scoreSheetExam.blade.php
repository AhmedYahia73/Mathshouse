@php
function fun_admin()
{
return 'admin';
}
$chapter_name = null;
$ch_id = [];
@endphp
<x-default-layout>
    @section('title', 'Report ScoreSheet Exam')
    {{-- <div class="col-12 mt-3 d-flex flex-column align-items-center gap-4">

        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12  mt-2">
                    <thead>
                        <tr>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">QUIZZES </th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Score</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Time</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Date</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Mistakes</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Reports</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                            <td style="padding-top: 15px !important">QUIZ 1</td>
                            <td style="padding-top: 15px !important">20/16</td>
                            <td style="padding-top: 15px !important">20M</td>
                            <td style="padding-top: 15px !important">16/6/2024</td>
                            <td><a class="conBtn" href="student_quizzes/id">View Mistakes</a></td>
                            <td><a class="conBtn" href="">Report</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <style>

.conBtn {
            width: 100% !important;
            background: #FEF5F3 !important;
            color: #CF202F !important;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 5px 20px;
            border: none;
            outline: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .conBtn:hover {
            background: #CF202F !important;
            color: #FEF5F3 !important;
        }
        .title {
            background-color: #FEF5F3;
            /* padding: 10px 20px; */
            /* border-radius: 10px; */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row
        }
        @media (max-width: 640px) { /* Tailwind's sm breakpoint is 640px */
            .title {
                flex-direction: column;
                align-items: flex-start;
                justify-content: flex-start;
            }
        }
    </style>

    <div class="col-12 mt-3 d-flex flex-column align-items-center gap-10">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem;font-weight: 600;color: #CF202F">Score Sheet Exam</span>
        </div>
        <div class="title col-12 d-flex justify-content-start gap-2 py-6 px-4 rounded"
            style="background-color: #FEF5F3">
            <span class="col-3" style="color: #CF202F;font-size: 1.4rem;font-weight: 600">Student: {{$user->nick_name}}
                {{-- {{ $student->f_name . ' ' . $student->l_name . '(' . $student->nick_name . ')' }} --}}
            </span>
            <span class="col-4" style="color: #CF202F;font-size: 1.4rem;font-weight: 600">Course: {{$stu_course->course_name}}
                {{-- {{ $student->f_name . ' ' . $student->l_name . '(' . $student->nick_name . ')' }} --}}
            </span>
            <span class="col-4" style="color: #CF202F;font-size: 1.4rem;font-weight: 600">Date of join: {{$user->created_at->format('d-m-Y')}}
                {{-- {{ $student->f_name . ' ' . $student->l_name . '(' . $student->nick_name . ')' }} --}}
            </span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">

            <select class="selCourse mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="Course_Course" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>
            {{-- <input type="hidden" value="{{ $courses }}" class="course_data" />
            <input type="hidden" value="{{ $chapters }}" class="chapter_data" />
            <input type="hidden" value="{{ $lessons }}" class="lesson_data" /> --}}
        </div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12  mt-2">
                    <thead>
                        <tr class="p-4 border border-t-2 border-b-2 " style="border:#CF202F;">
                            <th class="col-1"
                                style="border-top: none !important; color: #CF202F; font-size: 1.4rem;font-weight: 600;"
                                scope="col">
                            </th>
                            <th class="col-3"
                                style="border-top: none !important; color: #CF202F;font-size: 1.14rem;font-weight: 600; "
                                scope="col">Test Name </th>
                            <th class="col-3"
                                style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                                scope="col">Score</th>
                            <th class="col-3"
                                style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                                scope="col">Time</th>
                            {{-- <th class="col-2"
                                style="border-top: none !important; color: #CF202F;font-size: 1.1rem; " scope="col">Date
                            </th> --}}
                            <th class="col-3"
                                style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                                scope="col">Mistakes</th>
                            {{-- <th class="col-3"
                                style="border-top: none !important; color: #CF202F;font-size: 1.1rem; " scope="col">
                                Reports</th> --}}
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($exam_history as $item)
                        <tr class="p-4 border border-t-2 border-b-2 " style="border:#CF202F;">
                            <th class="col-1"
                            style="border-top: none !important; color: #CF202F; font-size: 1.4rem;font-weight: 600;"
                            scope="col">
                                {{$loop->iteration}}
                            </th>
                            <th class="col-3"
                            style="border-top: none !important; color: #CF202F;font-size: 1.14rem;font-weight: 600; "
                            scope="col">
                                {{$item->exams->title}} 
                            </th>
                            <th class="col-3"
                            style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                            scope="col"> 
                                {{$item->score}} 
                            </th>
                            <th class="col-3"
                            style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                            scope="col">
                                {{$item->time}} 
                            </th>
                            {{-- <th class="col-2"
                                style="border-top: none !important; color: #CF202F;font-size: 1.1rem; " scope="col">Date
                            </th> --}}
                            {{-- Admin/Report/ScoreSheet/Show/Mistakes/3973 --}}
                            
                            <td>
                                <a class="conBtn" href="{{route('ad_score_exam_mistake', $item->id)}}">View Mistakes</a>
                            </td>
                            {{-- <th class="col-3"
                                style="border-top: none !important; color: #CF202F;font-size: 1.1rem; " scope="col">
                                Reports</th> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Add the button here -->
            <div class="d-flex align-items-center justify-content-center mt-3">
                <button id="generatePdf"
                    style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                    Generate Mistakes PDF
                </button>
            </div>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // let course_data = document.querySelector('.course_data');
        // let chapter_data = document.querySelector('.chapter_data');
        // let lesson_data = document.querySelector('.lesson_data');
        // let course_name = document.querySelector('.course_name');

        // let selCourse = document.querySelector('#selCourse');
        // let selChapter = document.querySelector('#selChapter');
        // let selLesson = document.querySelector('#selLesson');

        // course_data = JSON.parse(course_data.value);
        // chapter_data = JSON.parse(chapter_data.value);
        // lesson_data = JSON.parse(lesson_data.value);

        // selCourse.addEventListener('change', () => {
        //     selChapter.innerHTML = `<option selected disabled>
        //     Select Chapter</option>`;

        //     chapter_data.forEach(element => {
        //         if (element.course_id == selCourse.value) {
        //             selChapter.innerHTML += `
        //         <option value="${element.id}">${element.chapter_name}</option>`;
        //         }
        //     });

        //     let selectedIndex = selCourse.selectedIndex;
        //     let selectedText = selCourse.options[selectedIndex].text;
        //     course_name.innerText = selectedText;
        // });

        // selChapter.addEventListener('change', () => {
        //     selLesson.innerHTML = `<option selected disabled>
        //     Select Lesson</option>`;

        //     lesson_data.forEach(element => {
        //         if (element.chapter_id == selChapter.value) {
        //             selLesson.innerHTML += `
        //         <option value="${element.id}">${element.lesson_name}</option>`;
        //         }
        //     });
        // });

        $(document).ready(function() {

            // $("#selLesson").change(function() {
                let user_id = {{ $user->id }}
                // var lessonID = $(this).val()
                $.ajax({

                    url: "{{ route('course_exam',['user'=>$user->id]) }}",
                    type: "GET",
                    data: {
                        user_id: user_id,
                        // lesson_id: lessonID
                    },
                    success: function(data) {
                        console.log(data)
                        console.log(data.data)

                        // $(data.data).each((index, ele) => {
                        //     console.log("ele", ele)
                        //     var newRow = `<tr>
                        //         <td style="padding-top: 15px !important">
                        //             <input type="checkbox" class="row-checkbox" data-id="${ele.id}">
                        //         </td>
                        //         <td style="padding-top: 15px !important">${ele.quizze.title}</td>
                        //         <td style="padding-top: 15px !important">${ele.score + "/" + ele.quizze.score}</td>
                        //         <td style="padding-top: 15px !important">${ele.time}</td>
                        //         <td style="padding-top: 15px !important">${ele.date}</td>
                        //         <td><a class="conBtn" href="Mistakes/${ele.id}">View Mistakes</a></td>
                        //         <td><a class="conBtn" href="Quiz/Report/${ele.id}">Report</a></td>
                        //     </tr>`;
                        //     $("#myTable").append(newRow)
                        //     console.log(ele)
                        // })

                    }
                })
            // })

            // Select All functionality
            // $("#selectAll").click(function () {
            //     $(".row-checkbox").prop("checked", true); // Select all checkboxes
            //     if ($(".row-checkbox:checked").length > 0) {
            //         $("#generatePdf").show(); // Show the button
            //     }
            // });

            // Deselect All functionality
            // $("#deselectAll").click(function () {
            //     $(".row-checkbox").prop("checked", false); // Deselect all checkboxes
            //     $("#generatePdf").hide(); // Hide the button
            // });

             // Show/Hide the "Generate Mistakes PDF" button based on checkbox selection
            // $(document).on('change', '.row-checkbox', function () {
            //     if ($('.row-checkbox:checked').length > 0) {
            //         $('#generatePdf').show(); // Show the button if at least one checkbox is selected
            //     } else {
            //         $('#generatePdf').hide(); // Hide the button if no checkboxes are selected
            //     }
            // });

            // Handle the click event of the "Generate Mistakes PDF" button
            /*('#generatePdf').click(function () {
                let selectedIds = [];
                $('.row-checkbox:checked').each(function () {
                    selectedIds.push($(this).data('id'));
                });
                console.log("Selected IDs:", selectedIds);
            });*/


        })
    </script>

</x-default-layout>
{{-- route('lesson_score_sheet')
data : {lesson_id : 1}
MyCourses/Mistakes/1
Quiz/Report/1

--}}
