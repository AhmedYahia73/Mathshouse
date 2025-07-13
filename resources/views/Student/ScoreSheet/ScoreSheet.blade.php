{{-- @php
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

    <div class="col-12 mt-3 d-flex flex-column align-items-center gap-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem; font-weight: 600; color: #CF202F;">Score Sheet</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-2">
            <span class="col-5" style="color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                Student: <span
                    style="color: #787878;">{{ auth()->user()->f_name . ' ' . auth()->user()->l_name . '(' . auth()->user()->nick_name . ')' }}</span>
            </span>
            <span class="col-6" style="color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                Course: <span class="course_name" style="color:#787878;"></span>
            </span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">
            <select class="selCourse mx-2"
                style="width: 20%; font-size: 1.4rem; font-weight: 600; border: none; border-radius: 0;"
                name="Course_Course" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>

            <input type="hidden" value="{{ $courses }}" class="course_data" />
            <input type="hidden" value="{{ $chapters }}" class="chapter_data" /> --}}
{{-- <input type="hidden" value="{{ $lessons }}" class="lesson_data" />
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

    </div>

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
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

                                if (chapter.lessons && chapter.lessons.length > 0) {
                                    chapter.lessons.forEach(function(lesson) {

                                        // Dynamically generate quiz columns for the first 4 quizzes in lesson.quizs
                                        const quizColumns = lesson.quizs.slice(
                                                0, 4)
                                            .map(quiz => {
                                                // Find the first student quiz with a score above the passing score
                                                const validStudentQuiz =
                                                    quiz.student_quizs.find(
                                                        studentQuiz =>
                                                        studentQuiz
                                                        ?.score >= quiz
                                                        ?.pass_score
                                                    );

                                                // Generate the <td> for the found student quiz or a placeholder
                                                return `
                    <td>
                        ${validStudentQuiz ? `${validStudentQuiz.score}/${quiz.score}` : "-"}
                    </td>
                `;
                                            }).join(
                                                ''
                                                ); // Join all quiz columns for this lesson

                                        // Fallback if there are fewer than 4 quizzes
                                        const emptyColumns = lesson.quizs
                                            .length < 4 ?
                                            `<td>-</td>`.repeat(4 - lesson.quizs
                                                .length) :
                                            '';

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
                                } else {
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

@include('Student.inc.footer') --}}
{{-- route('lesson_score_sheet')
    data : {lesson_id : 1}
    MyCourses/Mistakes/1
    Quiz/Report/1

--}}

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

        .filter-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .filter-label {
            font-weight: 600;
            color: #CF202F;
        }

        .filter-select {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #CF202F;
        }

        .chapter-row {
            background-color: #FEF5F3 !important;
            color: #CF202F !important;
            font-weight: bold !important;
        }

        .chapter-name {
            color: #CF202F !important;
            font-size: 1.1rem;
        }
    </style>

    <div class="col-12 mt-3 d-flex flex-column align-items-center gap-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem; font-weight: 600; color: #CF202F;">Score Sheet</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-2">
            <span class="col-5" style="color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                Student: <span
                    style="color: #787878;">{{ auth()->user()->f_name . ' ' . auth()->user()->l_name . '(' . auth()->user()->nick_name . ')' }}</span>
            </span>
            <span class="col-6" style="color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                Course: <span class="course_name" style="color:#787878;"></span>
            </span>
        </div>
      <div class="col-12 d-flex align-items-center justify-content-start gap-3 flex-wrap py-2">
    <select class="selCourse"
        style="width: 22%; min-width: 200px; font-size: 1.2rem; font-weight: 600; border: 2px solid #CF202F; border-radius: 8px; padding: 8px 12px;"
        name="Course_Course" id="selCourse">
        <option selected disabled>Select Course</option>
        @foreach ($courses as $item)
            <option value="{{ $item->id }}">{{ $item->course_name }}</option>
        @endforeach
    </select>

    <div class="filter-container d-flex align-items-center gap-2" style="min-width: 280px;">
        <span class="filter-label" style="font-size: 1.1rem; font-weight: 600; color: #555;">Filter by:</span>
        <select class="filter-select" id="attendanceFilter"
            style="border: 2px solid #CF202F; border-radius: 8px; padding: 8px 12px; font-size: 1rem; font-weight: 500; width: 180px;">
            <option value="all">All Sessions</option>
            <option value="attended">Attended Only</option>
            <option value="not_attended">Not Attended Only</option>
        </select>
    </div>

    <button id="downloadExcel"
        style="background: #CF202F; color: white; border: none; border-radius: 8px; padding: 8px 20px;
               font-size: 1rem; font-weight: 600; white-space: nowrap; min-width: 160px; margin-left: auto;">
        <i class="fas fa-download me-2"></i>Export Excel
    </button>

    <input type="hidden" value="{{ $courses }}" class="course_data" />
    <input type="hidden" value="{{ $chapters }}" class="chapter_data" />
</div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12 mt-2" id="scoreTable">
                    <thead>
                        <tr>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">Chapters</th>
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
    </div>

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SheetJS for Excel export -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#selCourse').on('change', function() {
                var selectedCourseName = $("#selCourse option:selected").text();
                var selectedCourseId = $("#selCourse").val();

                $('.course_name').text(selectedCourseName);

                $.ajax({
                    url: "{{ route('course_score_sheet') }}",
                    type: 'POST',
                    data: {
                        course_id: selectedCourseId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('API response:', response);
                        if (response.data && response.data.length > 0) {
                            $('#myTable').empty();

                            response.data.forEach(function(chapter) {
                                // Add chapter row
                                var chapterRow = `<tr class="chapter-row">
                                    <td colspan="6" class="chapter-name">${chapter.chapter_name}</td>
                                </tr>`;
                                $('#myTable').append(chapterRow);

                                if (chapter.lessons && chapter.lessons.length > 0) {
                                    chapter.lessons.forEach(function(lesson) {
                                        const quizColumns = lesson.quizs.slice(
                                                0, 4)
                                            .map(quiz => {
                                                const validStudentQuiz =
                                                    quiz.student_quizs.find(
                                                        studentQuiz =>
                                                        studentQuiz
                                                        ?.score >= quiz
                                                        ?.pass_score
                                                    );
                                                return `<td>${validStudentQuiz ? `${validStudentQuiz.score}/${quiz.score}` : "-"}</td>`;
                                            }).join('');

                                        const emptyColumns = lesson.quizs
                                            .length < 4 ?
                                            `<td>-</td>`.repeat(4 - lesson.quizs
                                                .length) : '';

                                        // Replace "Absent" with "Not Attended"
                                        const attendanceStatus = lesson
                                            .live_attend === 'Absent' ?
                                            'Not Attended' : 'Attended';
                                        const attendanceBgColor = lesson
                                            .live_attend === 'Absent' ?
                                            '#FFEBEE' :
                                            '#E8F5E9'; // Light red/green backgrounds
                                        const attendanceTextColor = lesson
                                            .live_attend === 'Absent' ?
                                            '#C62828' :
                                            '#2E7D32'; // Darker red/green text

                                        var lessonRow = `<tr>
                                            <td>${lesson.lesson_name}</td>
                                            ${quizColumns}${emptyColumns}
                                            <td style="background-color:${attendanceBgColor}; color: ${attendanceTextColor} !important;display:flex; justify-content:center" data-attendance="${attendanceStatus.toLowerCase().replace(' ', '_')}">
                                                ${attendanceStatus}
                                            </td>
                                        </tr>`;

                                        $('#myTable').append(lessonRow);
                                    });
                                }
                            });
                        } else {
                            $('#myTable').empty();
                            $('#myTable').append(`<tr>
                                <td colspan="6" style="color: #888; text-align: center;">No data available.</td>
                            </tr>`);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('API error:', error);
                    }
                });
            });

            // Attendance filter functionality
            $('#attendanceFilter').on('change', function() {
                const filterValue = $(this).val();
                $('#myTable tr').each(function() {
                    if ($(this).hasClass('chapter-row')) {
                        // Show chapter rows by default
                        $(this).show();
                        return;
                    }

                    const attendanceCell = $(this).find('td:last-child');
                    if (attendanceCell.length) {
                        const attendanceStatus = attendanceCell.data('attendance');
                        if (filterValue === 'all' ||
                            (filterValue === 'attended' && attendanceStatus === 'attended') ||
                            (filterValue === 'not_attended' && attendanceStatus === 'not_attended')
                        ) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    }
                });
            });

            // Excel download functionality
            $('#downloadExcel').on('click', function() {
                // Get the table
                const table = document.getElementById('scoreTable');

                // Clone the table to modify it for export
                const cloneTable = table.cloneNode(true);

                // Remove any hidden rows from the clone (except chapter rows)
                $(cloneTable).find('tr').each(function() {
                    if ($(this).css('display') === 'none' && !$(this).hasClass('chapter-row')) {
                        $(this).remove();
                    }
                });

                // Convert to worksheet
                const worksheet = XLSX.utils.table_to_sheet(cloneTable);

                // Create workbook
                const workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, "ScoreSheet");

                // Generate file name
                const courseName = $('.course_name').text() || 'Scores';
                const fileName = `${courseName}_ScoreSheet.xlsx`;

                // Export the workbook
                XLSX.writeFile(workbook, fileName);
            });
        });
    </script>

@endsection

@include('Student.inc.footer')
