@php
function fun_admin()
{
    return 'admin';
}
$chapter_name = null;
$ch_id = [];
@endphp
<x-default-layout>
    @section('title', 'ScoreSheet Report')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .action-buttons button {
            padding: 10px 20px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            background-color: #CF202F;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #a11b24;
        }
    </style>
    <div class="col-12 mt-3 d-flex flex-column align-items-center gap-10">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem;font-weight: 600;color: #CF202F">Score Sheet</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-2">
            <span class="col-5" style="color: #787878;font-size: 1.4rem;font-weight: 600">Student:
                {{ $student->f_name . ' ' . $student->l_name . '(' . $student->nick_name . ')' }}</span>
            <span class="col-6" style="color: #787878;font-size: 1.4rem;font-weight: 600">Course: <span
                    class="course_name"></span></span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">
            <select class="selCourse mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="course_id" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>
            <select class="selChapter mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="chapter_id" id="selChapter">
                <option value="">Select Chapter</option>
            </select>
            <select class="selLesson mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="lesson_id" id="selLesson">
                <option value="">Select Lesson</option>
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
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">
                                Select
                            </th>
                            <th class="col-5" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">QUIZZES </th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Score</th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Time</th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Date</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Mistakes</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Reports</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                    </tbody>
                </table>
            </div>
            <!-- Add the button here -->
            <form action="{{ route('generatePdf') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="selected_ids[]" id="selectedIdsInput">
                <input type="hidden" name="course_id" id="selectedCourseId">
                <input type="hidden" name="chapter_id" id="selectedChapterId">
                <input type="hidden" name="lesson_id" id="selectedLessonId">

                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" id="generatePdf"
                        style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                        Generate Mistakes PDF
                    </button>
                </div>
            </form>
            <form action="{{ route('generateAnsPdf') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="selected_ids[]" id="selectedIdsInputAns">
                <input type="hidden" name="course_id" id="selectedCourseIdAns">
                <input type="hidden" name="chapter_id" id="selectedChapterIdAns">
                <input type="hidden" name="lesson_id" id="selectedLessonIdAns">

                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" id="generateAnsPdf"
                        style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                        Generate Mistakes Answers PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
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

        function loadScoreSheet() {
            var courseId = $("#selCourse").val();
            var chapterId = $("#selChapter").val();
            var lessonId = $("#selLesson").val();

            // Set the selected values in the PDF forms
            $("#selectedCourseId").val(courseId);
            $("#selectedChapterId").val(chapterId);
            $("#selectedLessonId").val(lessonId);
            $("#selectedCourseIdAns").val(courseId);
            $("#selectedChapterIdAns").val(chapterId);
            $("#selectedLessonIdAns").val(lessonId);

            if (!courseId) return; // Don't load if no course selected

            $.ajax({
                url: "{{ route('ad_lesson_score_sheet') }}",
                type: "GET",
                data: {
                    user_id: {{ $user_id }},
                    course_id: courseId,
                    chapter_id: chapterId,
                    lesson_id: lessonId
                },
                success: function(data) {
                    $("#myTable").empty(); // Clear previous results

                    if(data.data && data.data.length > 0) {
                        $(data.data).each((index, ele) => {
                            var newRow = `<tr>
                                <td style="padding-top: 15px !important">
                                    <input type="checkbox" class="row-checkbox" data-quizze-id="${ele["id"]}">
                                </td>
                                <td style="padding-top: 15px !important">${ele.quizze.title}</td>
                                <td style="padding-top: 15px !important">${ele.score + "/" + ele.quizze.score}</td>
                                <td style="padding-top: 15px !important">${ele.time}</td>
                                <td style="padding-top: 15px !important">${ele.date}</td>
                                <td><a class="conBtn" href="Mistakes/${ele.id}">View Mistakes</a></td>
                                <td><a class="conBtn" href="Quiz/Report/${ele.id}">Report</a></td>
                            </tr>`;
                            $("#myTable").append(newRow);
                        });
                    } else {
                        $("#myTable").append(`<tr><td colspan="7" class="text-center">No data found for the selected filters</td></tr>`);
                    }
                }
            });
        }

        selCourse.addEventListener('change', () => {
            selChapter.innerHTML = `<option selected disabled>Select Chapter</option>`;
            selLesson.innerHTML = `<option selected disabled>Select Lesson</option>`;

            chapter_data.forEach(element => {
                if (element.course_id == selCourse.value) {
                    selChapter.innerHTML += `
                <option value="${element.id}">${element.chapter_name}</option>`;
                }
            });

            let selectedIndex = selCourse.selectedIndex;
            let selectedText = selCourse.options[selectedIndex].text;
            course_name.innerText = selectedText;

            loadScoreSheet();
        });

        selChapter.addEventListener('change', () => {
            selLesson.innerHTML = `<option selected disabled>Select Lesson</option>`;

            lesson_data.forEach(element => {
                if (element.chapter_id == selChapter.value) {
                    selLesson.innerHTML += `
                <option value="${element.id}">${element.lesson_name}</option>`;
                }
            });

            loadScoreSheet();
        });

        selLesson.addEventListener('change', () => {
            loadScoreSheet();
        });

        $(document).ready(function() {
            $(document).on('change', '.row-checkbox', function() {
                let selectedQuizzeIds = [];
                $('.row-checkbox:checked').each(function() {
                    selectedQuizzeIds.push($(this).data('quizze-id'));
                });

                // Update both forms with selected IDs
                $('#selectedIdsInput').val(selectedQuizzeIds.join(','));
                $('#selectedIdsInputAns').val(selectedQuizzeIds.join(','));

                // Show/hide buttons based on selection
                $('#generatePdf').toggle(selectedQuizzeIds.length > 0);
                $('#generateAnsPdf').toggle(selectedQuizzeIds.length > 0);
            });
        });
    </script>
</x-default-layout>
