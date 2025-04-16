@php
    $page_name = 'Question History';
    $chapter_name = null;
    $ch_id = [];
@endphp
@section('title', 'Chapters')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- other head elements -->
    </head>


    <style>
        .table {
            background: #fff !important;
        }

        .table td {
            font-weight: 600;
            color: #787878 !important;
        }

        .selCourse,
        .selChapter,
        .selLesson {
            background-color: transparent !important;
            color: #CF202F !important;
            cursor: pointer;
        }

        .selCourse:focus,
        .selChapter:focus,
        .selLesson:focus {
            color: #CF202F !important;
            background-color: transparent !important;
            border-color: none !important;
            outline: 0;
            box-shadow: none !important;
        }

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
    </style>

    {{-- <div class="col-12 mt-3 d-flex flex-column align-items-center gap-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem;font-weight: 600;color: #CF202F">Score Sheet</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-2">
            <span class="col-5" style="color: #787878;font-size: 1.4rem;font-weight: 600">Student:
                {{ auth()->user()->f_name . ' ' . auth()->user()->l_name . '(' . auth()->user()->nick_name . ')' }}</span>
            <span class="col-6" style="color: #787878;font-size: 1.4rem;font-weight: 600">Course: <span class="course_name"></span></span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">

            <select class="selCourse mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;" name="Course_Course"
                id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>
            <select class="selChapter mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;" name="Course_Chapter"
                id="selChapter">
                <option value="">Select Chapter</option>
                @foreach ($chapters as $item)
                <option value="{{ $item->id }}">{{ $item->chapter_name }}</option>
                 @endforeach
            </select>
            <select class="selLesson mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;" name="Course_Lesson"
                id="selLesson">
                <option value="">Select Lesson</option>
                @foreach ($lessons as $item)
                <option value="{{ $item->id }}">{{ $item->lesson_name }}</option>
                 @endforeach
            </select>
            <input type="hidden" value="{{ $courses }}" class="course_data" />
            <input type="hidden" value="{{ $chapters }}" class="chapter_data" />
            <input type="hidden" value="{{ $lessons }}" class="lesson_data" />
        </div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12  mt-2">
                    <thead>
                        <tr>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Chapter </th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Lesson</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Quizze 1</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Quizze 2</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Quizze 3</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Quizze 4</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Live Session</th>
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

    {{-- <script>
        let course_data = document.querySelector('.course_data');
        let chapter_data = document.querySelector('.chapter_data');
        let lesson_data = document.querySelector('.lesson_data');
        let course_name = document.querySelector('.course_name');

        let selCourse = document.querySelector('#selCourse');
        let selChapter = document.querySelector('#selChapter');
        let selLesson = document.querySelector('#selLesson');

        course_data = JSON.parse(course_data.value);
        chapter_data = JSON.parse(chapter_data.value);
        lesson_data = JSON.parse(lesson_data.value);

        selCourse.addEventListener('change', () => {
            selChapter.innerHTML = `<option selected disabled>
            Select Chapter</option>`;

            chapter_data.forEach(element => {
                if (element.course_id == selCourse.value) {
                    selChapter.innerHTML += `
                <option value="${element.id}">${element.chapter_name}</option>`;
                }
            });

            let selectedIndex = selCourse.selectedIndex;
            let selectedText = selCourse.options[selectedIndex].text;
            course_name.innerText = selectedText;
        });

        selChapter.addEventListener('change', () => {
            selLesson.innerHTML = `<option selected disabled>
            Select Lesson</option>`;

            lesson_data.forEach(element => {
                if (element.chapter_id == selChapter.value) {
                    selLesson.innerHTML += `
                <option value="${element.id}">${element.lesson_name}</option>`;
                }
            });
        });
        $(document).ready(function() {
            $("#selLesson").change(function() {

                var lessonID = $(this).val()
                $.ajax({
                    url: "{{ route('lesson_score_sheet') }}",
                    type: "GET",
                    data: {
                        lesson_id: lessonID
                    },
                    success: function(data) {
                        console.log(data)
                        console.log(data.data)

                        $(data.data).each((index, ele) => {
                            console.log("ele", ele)
                            var newRow = `<tr>
                                <td style="padding-top: 15px !important">${ele.quizze.title}</td>
                                <td style="padding-top: 15px !important">${ele.score + "/" + ele.quizze.score }</td>
                                <td style="padding-top: 15px !important">${ele.time}</td>
                                <td style="padding-top: 15px !important">${ele.date}</td>
                                <td><a class="conBtn" href="MyCourses/Mistakes/${ele.id}">View Mistakes</a></td>
                                <td><a class="conBtn" href="Quiz/Report/${ele.id}">Report</a></td>
                            </tr>`;

                            $("#myTable").append(newRow)
                        })

                    }
                })
            })
        })
    </script> --}}


    {{-- <div class="col-12 mt-3 d-flex flex-column align-items-center gap-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem; font-weight: 600; color: #CF202F;">Score Sheet</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-2">
            <span class="col-5" style="color: #787878; font-size: 1.4rem; font-weight: 600;">
                Student: {{ auth()->user()->f_name . ' ' . auth()->user()->l_name . '(' . auth()->user()->nick_name . ')' }}
            </span>
            <span class="col-6" style="color: #787878; font-size: 1.4rem; font-weight: 600;">
                Course: <span class="course_name"></span>
            </span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">
            <!-- Course Dropdown -->
            <select class="selCourse mx-2" style="width: 20%; font-size: 1.4rem; font-weight: 600; border: none; border-radius: 0;" name="Course_Course" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>

            <!-- Chapter Dropdown -->
            <select class="selChapter mx-2" style="width: 20%; font-size: 1.4rem; font-weight: 600; border: none; border-radius: 0;" name="Course_Chapter" id="selChapter">
                <option value="">Select Chapter</option>
                @foreach ($chapters as $item)
                    <option value="{{ $item->id }}">{{ $item->chapter_name }}</option>
                @endforeach
            </select>

            <!-- Lesson Dropdown -->
            <select class="selLesson mx-2" style="width: 20%; font-size: 1.4rem; font-weight: 600; border: none; border-radius: 0;" name="Course_Lesson" id="selLesson">
                <option value="">Select Lesson</option>
                @foreach ($lessons as $item)
                    <option value="{{ $item->id }}">{{ $item->lesson_name }}</option>
                @endforeach
            </select>

            <input type="hidden" value="{{ $courses }}" class="course_data" />
            <input type="hidden" value="{{ $chapters }}" class="chapter_data" />
            <input type="hidden" value="{{ $lessons }}" class="lesson_data" />
        </div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12 mt-2">
                    <thead>
                        <tr>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Chapter</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Lesson</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Quizze 1</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Quizze 2</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Quizze 3</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Quizze 4</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Live Session</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Trigger when course selection changes
        $('#selCourse').on('change', function() {
            // Get the selected course name and id
            var selectedCourseName = $("#selCourse option:selected").text();
            var selectedCourseId = $("#selCourse").val();

            // Update the "Course:" span with the selected course name
            $('.course_name').text(selectedCourseName);

            // Send the selected course_id via AJAX
            $.ajax({
                url:  "{{ route('course_score_sheet') }}", // Ensure this matches your route
                type: 'POST', // POST request
                data: {
                    course_id: selectedCourseId, // Send the course_id
                    _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                },
                success: function(response) {
                    console.log('API response:', response);
                    populateTable(response.data); // Call function to populate the table
                },
                error: function(xhr, status, error) {
                    console.error('API error:', error);
                    // Handle errors
                }
            });
        });
    });

    // Function to populate the table with the data received
    function populateTable(data) {
        var tableBody = $('#myTable'); // Make sure this matches your table's ID
        tableBody.empty(); // Clear previous data

        data.forEach(item => {
            item.lessons.forEach(lesson => {
                tableBody.append(`
                    <tr>
                        <td>${item.chapter_name}</td>
                        <td>${lesson.lesson_name}</td>
                        <td>${lesson.quizs[0]?.score || 'N/A'}</td>
                        <td>${lesson.quizs[1]?.score || 'N/A'}</td>
                        <td>${lesson.quizs[2]?.score || 'N/A'}</td>
                        <td>${lesson.quizs[3]?.score || 'N/A'}</td>
                        <td>${lesson.live_attend}</td>
                    </tr>
                `);
            });
        });
    }
</script> --}}


    <div class="col-12 mt-3 d-flex flex-column align-items-center gap-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem; font-weight: 600; color: #CF202F;">Score Sheet</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-2">
            <span class="col-5" style="color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                Student: <span style="color: #787878;">{{ auth()->user()->f_name . ' ' . auth()->user()->l_name . '(' . auth()->user()->nick_name . ')' }}</span>
            </span>
            <span class="col-6" style="color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                Course: <span class="course_name" style="color:#787878;"></span>
            </span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">
            <!-- Course Dropdown -->
            <select class="selCourse mx-2"
                style="width: 20%; font-size: 1.4rem; font-weight: 600; border: none; border-radius: 0;"
                name="Course_Course" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>

            <!-- Chapter Dropdown -->
            {{-- <select class="selChapter mx-2"
                style="width: 20%; font-size: 1.4rem; font-weight: 600; border: none; border-radius: 0;"
                name="Course_Chapter" id="selChapter">
                <option value="">Select Chapter</option>
                @foreach ($chapters as $item)
                    <option value="{{ $item->id }}">{{ $item->chapter_name }}</option>
                @endforeach
            </select> --}}

            <!-- Lesson Dropdown -->
            {{-- <select class="selLesson mx-2"
                style="width: 20%; font-size: 1.4rem; font-weight: 600; border: none; border-radius: 0;"
                name="Course_Lesson" id="selLesson">
                <option value="">Select Lesson</option>
                @foreach ($lessons as $item)
                    <option value="{{ $item->id }}">{{ $item->lesson_name }}</option>
                @endforeach
            </select> --}}

            <input type="hidden" value="{{ $courses }}" class="course_data" />
            {{-- <input type="hidden" value="{{ $chapters }}" class="chapter_data" /> --}}
            {{-- <input type="hidden" value="{{ $lessons }}" class="lesson_data" /> --}}
        </div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12 mt-2">
                    <thead>
                        <tr>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Chapter</th>
                            <th class="col-4" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Lesson</th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Q1</th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Q2</th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Q3</th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Q4</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Live Session</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    </tbody>
                </table>
            </div>
        </div>

        {{-- /*
        Trigger when chapter selection changes
        $('#selChapter').on('change', function() {
            var selectedChapterId = $("#selChapter").val();
            var selectedCourseId = $("#selCourse").val();

            // Clear previous lesson options
            $('#selLesson').html('<option value="">Select Lesson</option>');

            // Send the selected chapter_id via AJAX to fetch lessons
            $.ajax({
                url: "{{ route('fetch_chapters') }}", // Ensure this matches your route for fetching lessons
                type: 'POST',
                data: {
                    chapter_id: selectedChapterId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('API response:', response);

                    // Populate the lessons dropdown for the selected chapter
                    $('#selLesson').html(
                        '<option value="">Select Lesson</option>'
                        ); // Clear previous options
                    response.chapter.lessons.forEach(function(lesson) {
                        $('#selLesson').append(
                            `<option value="${lesson.id}">${lesson.lesson_name}</option>`
                        );
                    });

                    // Clear the table body before populating new data
                    $('#myTable').empty();

                    // Iterate through each chapter in the response data
                    // Create a row for the chapter
                    var chapterRow = `
            <tr>
                <td colspan="7" style="font-weight: bold;">${response.chapter.chapter_name}</td>
            </tr>`;
                    $('#myTable').append(chapterRow);

                    // Check if the chapter has lessons and iterate through them
                    if (response.chapter.lessons && response.chapter.lessons.length > 0) {
                        response.chapter.lessons.forEach(function(lesson) {
                            var lessonRow = `
                <tr>
                    <td></td> <!-- Empty cell for chapter row -->
                    <td>${lesson.lesson_name}</td>
                    <td>${lesson.quizs[0]?.student_quizs?.score && lesson.quizs[0].student_quizs.score >= lesson.quizs[0]?.pass_score ? (lesson.quizs[0].student_quizs.score / lesson.quizs[0].score) : "-"}</td>
                    <td>${lesson.quizs[1]?.student_quizs?.score && lesson.quizs[1].student_quizs.score >= lesson.quizs[1]?.pass_score ? (lesson.quizs[1].student_quizs.score / lesson.quizs[1].score) : "-"}</td>
                    <td>${lesson.quizs[2]?.student_quizs?.score && lesson.quizs[2].student_quizs.score >= lesson.quizs[2]?.pass_score ? (lesson.quizs[2].student_quizs.score / lesson.quizs[2].score) : "-"}</td>
                    <td>${lesson.quizs[3]?.student_quizs?.score && lesson.quizs[3].student_quizs.score >= lesson.quizs[3]?.pass_score ? (lesson.quizs[3].student_quizs.score / lesson.quizs[3].score) : "-"}</td>
                    <td style="${lesson.live_attend === 'Absent' ? 'background-color:#CF202F; color: white !important;' : 'background-color: green; color:white !important;'}">
                                            ${lesson.live_attend}
                    </td>
               </tr>`;
                            $('#myTable').append(lessonRow);
                        });
                    } else {
                        // In case there are no lessons for a chapter
                        $('#myTable').append(`
            <tr>
                <td></td> <!-- Empty cell for chapter row -->
                <td colspan="6" style="color: #888;">No lessons available for this chapter.</td>
            </tr>`);
                    }
                },

                error: function(xhr, status, error) {
                    console.error('API error:', error);
                }
            });
        })

        $('#selLesson').on('change', function() {
            var selectedLessonId = $("#selLesson").val();
            var selectedChapterId = $("#selChapter").val();

            // Send AJAX request with all necessary parameters
            $.ajax({
                url: "{{ route('fetch_lessons') }}",
                type: 'POST',
                data: {
                    chapter_id: selectedChapterId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('API response:', response);

                    // Clear the previous lesson data in the table
                    $('#myTable').empty();
                    console.log(selectedLessonId)

                    // Loop through the lessons in the response and find the selected lesson
                    var selectedLesson = null; // Initialize variable to store selected lesson
                    response.lessons.forEach(function(lesson) {
                        if (lesson.id == selectedLessonId) { // Check if lesson ID matches selectedLessonId
                            selectedLesson = lesson; // Store the matching lesson
                        }
                    });
                    console.log(selectedLesson)

                    if (selectedLesson) {
                        // Create a new row with the selected lesson details
                        var lessonRow = `
                            <tr>
                                <td>${selectedLesson.chapter_name}</td> <!-- Add chapter name here -->
                                <td>${selectedLesson.lesson_name}</td>
                                <td>${selectedLesson.quizs[0]?.student_quizs?.score && selectedLesson.quizs[0].student_quizs.score >= selectedLesson.quizs[0]?.pass_score ? (selectedLesson.quizs[0].student_quizs.score / selectedLesson.quizs[0].score) : "-"}</td>
                                <td>${selectedLesson.quizs[1]?.student_quizs?.score && selectedLesson.quizs[1].student_quizs.score >= selectedLesson.quizs[1]?.pass_score ? (selectedLesson.quizs[1].student_quizs.score / selectedLesson.quizs[1].score) : "-"}</td>
                                <td>${selectedLesson.quizs[2]?.student_quizs?.score && selectedLesson.quizs[2].student_quizs.score >= selectedLesson.quizs[2]?.pass_score ? (selectedLesson.quizs[2].student_quizs.score / selectedLesson.quizs[2].score) : "-"}</td>
                                <td>${selectedLesson.quizs[3]?.student_quizs?.score && selectedLesson.quizs[3].student_quizs.score >= selectedLesson.quizs[3]?.pass_score ? (selectedLesson.quizs[3].student_quizs.score / selectedLesson.quizs[3].score) : "-"}</td>
                                <td style="${lesson.live_attend === 'Absent' ? 'background-color:#CF202F; color: white !important;' : 'background-color: green; color:white !important;'}">
                                            ${lesson.live_attend}
                                </td>
                            </tr>
                        `;

                        // Append the new row to the table
                        $('#myTable').append(lessonRow);
                    } else {
                        // Handle case where lesson is not found
                        $('#myTable').append(`
                            <tr>
                                <td colspan="7" style="color: #888;">No lesson details available.</td>
                            </tr>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('API error:', xhr.responseText); // Display the server response error for debugging
                }
            });
        });

        */ --}}

    </div>

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Trigger when course selection changes
            // $('#selCourse').on('change', function() {
            //     var selectedCourseName = $("#selCourse option:selected").text();
            //     var selectedCourseId = $("#selCourse").val();

            //     // Update the "Course:" span with the selected course name
            //     $('.course_name').text(selectedCourseName);

            //     // Clear previous chapter and lesson options
            //     $('#selChapter').html('<option value="">Select Chapter</option>');
            //     $('#selLesson').html('<option value="">Select Lesson</option>');

            //     // Send the selected course_id via AJAX
            //     $.ajax({
            //         url: "{{ route('course_score_sheet') }}", // Ensure this matches your route
            //         type: 'POST', // POST request
            //         data: {
            //             course_id: selectedCourseId, // Send the course_id
            //             _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
            //         },
            //         success: function(response) {
            //             console.log('API response:', response);
            //             response.data.forEach(function(chapter) {
            //                 $('#selChapter').append(
            //                     `<option value="${chapter.id}">${chapter.chapter_name}</option>`
            //                 );
            //             });
            //             // After chapters are populated, fetch lessons for each chapter
            //             response.data.forEach(function(chapter) {
            //                 if (chapter.lessons && chapter.lessons.length > 0) {
            //                     chapter.lessons.forEach(function(lesson) {
            //                         $('#selLesson').append(
            //                             `<option value="${lesson.id}">${lesson.lesson_name}</option>`
            //                         );
            //                     });
            //                 }
            //             });
            //             // populateTable(response.data); // Call function to populate the table

            //             // Clear the table body before populating
            //             $('#myTable').empty();
            //             // Iterate through each chapter in the response data
            //             response.data.forEach(function(chapter) {
            //                 // Create a row for the chapter
            //                 var chapterRow = `<tr>
            //                 <td colspan="7" style="font-weight: bold;">${chapter.chapter_name}</td>
            //                 </tr>`;
            //                     $('#myTable').append(chapterRow);

            //                     // Check if the chapter has lessons and iterate through them
            //                     if (chapter.lessons && chapter.lessons.length > 0) {
            //                         chapter.lessons.forEach(function(lesson) {
            //                             var lessonRow = `<tr>
            //                         <td></td> <!-- Empty cell for chapter row -->
            //                         <td>${lesson.lesson_name}</td>
            //                         <td>Quiz 1</td> <!-- Placeholder for Quiz 1 -->
            //                         <td>Quiz 2</td> <!-- Placeholder for Quiz 2 -->
            //                         <td>Quiz 3</td> <!-- Placeholder for Quiz 3 -->
            //                         <td>Quiz 4</td> <!-- Placeholder for Quiz 4 -->
            //                         <td>Live Session</td> <!-- Placeholder for Live Session -->
            //                     </tr>`;
            //                             $('#myTable').append(lessonRow);
            //                         });
            //                     } else {
            //                         // In case there are no lessons for a chapter
            //                         $('#myTable').append(`<tr>
            //                         <td></td> <!-- Empty cell for chapter row -->
            //                         <td colspan="6" style="color: #888;">No lessons available for this chapter.</td>
            //                     </tr>`);
            //                     }
            //                 });
            //         },
            //         error: function(xhr, status, error) {
            //             console.error('API error:', error);
            //             // Handle errors
            //         }
            //     });

            // });
            $('#selCourse').on('change', function() {
                var selectedCourseName = $("#selCourse option:selected").text();
                var selectedCourseId = $("#selCourse").val();

                // Update the "Course:" span with the selected course name
                $('.course_name').text(selectedCourseName);

                // Clear previous chapter and lesson options
                $('#selChapter').html('<option value="">Select Chapter</option>');
                $('#selLesson').html('<option value="">Select Lesson</option>');

                // Send the selected course_id via AJAX
                $.ajax({
                    url: "{{ route('course_score_sheet') }}", // Ensure this matches your route
                    type: 'POST', // POST request
                    data: {
                        course_id: selectedCourseId, // Send the course_id
                        _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        console.log('API response:', response);
                        if (response.data && response.data.length > 0) {
                            // Populate chapters
                            response.data.forEach(function(chapter) {
                                $('#selChapter').append(
                                    `<option value="${chapter.id}">${chapter.chapter_name}</option>`
                                );
                            });

                            // After chapters are populated, fetch lessons for each chapter
                            response.data.forEach(function(chapter) {
                                if (chapter.lessons && chapter.lessons.length > 0) {
                                    chapter.lessons.forEach(function(lesson) {
                                        $('#selLesson').append(
                                            `<option value="${lesson.id}">${lesson.lesson_name}</option>`
                                        );
                                    });
                                }
                            });

                            // Clear the table body before populating
                            $('#myTable').empty();
                            // Iterate through each chapter in the response data
                            response.data.forEach(function(chapter) {
                                // Create a row for the chapter
                                var chapterRow = `<tr>
                                    <td colspan="7" style="font-weight: bold;color:blue !important;">${chapter.chapter_name}</td>
                                </tr>`;
                                $('#myTable').append(chapterRow);

                                // Check if the chapter has lessons and iterate through them
                                // if (chapter.lessons && chapter.lessons.length > 0) {
                                //     chapter.lessons.forEach(function(lesson) {
                                //         const pass_score = 50; // Example pass score, replace with actual value
                                //         var lessonRow = `<tr>
                                //             <td></td> <!-- Empty cell for chapter row -->
                                //             <td>${lesson.lesson_name}</td>
                                //             <td>${lesson.quizs[0]?.student_quizs?.score && lesson.quizs[0].student_quizs.score >= lesson.quizs[0]?.pass_score ? (lesson.quizs[0].student_quizs.score / lesson.quizs[0].score) : "-"}</td>
                                //             <td>${lesson.quizs[1]?.student_quizs?.score && lesson.quizs[1].student_quizs.score >= lesson.quizs[1]?.pass_score ? (lesson.quizs[1].student_quizs.score / lesson.quizs[1].score) : "-"}</td>
                                //             <td>${lesson.quizs[2]?.student_quizs?.score && lesson.quizs[2].student_quizs.score >= lesson.quizs[2]?.pass_score ? (lesson.quizs[2].student_quizs.score / lesson.quizs[2].score) : "-"}</td>
                                //             <td>${lesson.quizs[3]?.student_quizs?.score && lesson.quizs[3].student_quizs.score >= lesson.quizs[3]?.pass_score ? (lesson.quizs[3].student_quizs.score / lesson.quizs[3].score) : "-"}</td>
                                //             <td style="${lesson.live_attend === 'Absent' ? 'background-color:#CF202F; color: white !important;' : 'background-color: green; color:white !important;'}">
                                //                 ${lesson.live_attend}
                                //             </td>

                                //             </tr>`;
                                //         $('#myTable').append(lessonRow);
                                //     });
                                // }

if (chapter.lessons && chapter.lessons.length > 0) {
    chapter.lessons.forEach(function(lesson) {

        // Dynamically generate quiz columns for the first 4 quizzes in lesson.quizs
        const quizColumns = lesson.quizs.slice(0, 4)
            .map(quiz => {
                // Find the first student quiz with a score above the passing score
                const validStudentQuiz = quiz.student_quizs.find(studentQuiz =>
                    studentQuiz?.score >= quiz?.pass_score
                );

                // Generate the <td> for the found student quiz or a placeholder
                return `
                    <td>
                        ${validStudentQuiz ? `${validStudentQuiz.score}/${quiz.score}` : "-"}
                    </td>
                `;
            }).join(''); // Join all quiz columns for this lesson

        // Fallback if there are fewer than 4 quizzes
        const emptyColumns = lesson.quizs.length < 4
            ? `<td>-</td>`.repeat(4 - lesson.quizs.length)
            : '';

        // Create the lesson row with the quiz columns
        var lessonRow = `<tr>
            <td></td> <!-- Empty cell for chapter row -->
            <td>${lesson.lesson_name}</td>
            ${quizColumns}${emptyColumns} <!-- Include both quiz columns and any empty columns -->
            <td style="${lesson.live_attend === 'Absent' ? 'background-color:#CF202F; color: white !important;display:flex; justify-content:center' : 'background-color: green; color:white !important;display:flex; justify-content:center'}">
                ${lesson.live_attend}
            </td>
        </tr>`;

        // Append the generated row to the table
        $('#myTable').append(lessonRow);
    });
}

// if (chapter.lessons && chapter.lessons.length > 0) {
//     chapter.lessons.forEach(function(lesson) {
//         // Access the quiz at index 7
//         const quiz = lesson.quizs[7]; // Attempt to access quiz at index 7
//         let quizColumn = "<td>-</td>"; // Default value if no valid quiz is found

//         // Check if the quiz exists and has student quizzes
//         if (quiz && quiz.student_quizs && quiz.student_quizs.length > 0) {
//             // Find the first student quiz with a score above the passing score
//             const validStudentQuiz = quiz.student_quizs.find(studentQuiz =>
//                 studentQuiz?.score >= quiz?.pass_score
//             );

//             // Generate the <td> for the found student quiz or a placeholder
//             quizColumn = `
//                 <td>
//                     ${validStudentQuiz ? `${validStudentQuiz.score}/${quiz.score}` : "-"}
//                 </td>
//             `;
//         }

//         // Create the lesson row with the quiz column
//         var lessonRow = `<tr>
//             <td></td> <!-- Empty cell for chapter row -->
//             <td>${lesson.lesson_name}</td>
//             ${quizColumn} <!-- Include the quiz column for index 7 -->
//             <td style="${lesson.live_attend === 'Absent' ? 'background-color:#CF202F; color: white !important;' : 'background-color: green; color:white !important;'}">
//                 ${lesson.live_attend}
//             </td>
//         </tr>`;

//         // Append the generated row to the table
//         $('#myTable').append(lessonRow);
//     });
// }


                                 else {
                                    // In case there are no lessons for a chapter
                                    $('#myTable').append(`<tr>
                                        <td></td> <!-- Empty cell for chapter row -->
                                        <td colspan="6" style="color: #888;">No lessons available for this chapter.</td>
                                    </tr>`);
                                }
                            });
                        } else {
                            // If there are no chapters available, display a message in the table
                            $('#myTable').empty(); // Clear any existing data
                            $('#myTable').append(`<tr>
                                <td colspan="7" style="color: #888; text-align: center;">No chapters available.</td>
                            </tr>`);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('API error:', error);
                        // Handle errors
                    }
                });
            });
        });
    </script>


@endsection

@include('Student.inc.footer')
{{-- route('lesson_score_sheet')
    data : {lesson_id : 1}
    MyCourses/Mistakes/1
    Quiz/Report/1

--}}
