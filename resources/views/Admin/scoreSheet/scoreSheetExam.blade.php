{{-- @php
    function fun_admin()
    {
        return 'admin';
    }
    $chapter_name = null;
    $ch_id = [];
@endphp
<x-default-layout>
    @section('title', 'Report ScoreSheet Exam')
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

            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row
        }

        @media (max-width: 640px) {
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
        <div class="title col-12 d-flex justify-content-start gap-2 py-6 px-4 rounded" style="background-color: #FEF5F3">
            <span class="col-3" style="color: #CF202F;font-size: 1.4rem;font-weight: 600">Student: {{ $user->nick_name }}
            </span>
            <span class="col-4" style="color: #CF202F;font-size: 1.4rem;font-weight: 600" id="courseName">Course:
                {{ $stu_course->course_name }}</span>
            <span class="col-4" style="color: #CF202F;font-size: 1.4rem;font-weight: 600">Date of join:
                {{ $user->created_at->format('d-m-Y') }}
            </span>
        </div>
        <div class="title col-12 d-flex justify-content-start gap-2 py-6 px-4 rounded"
            style="background-color: #FE你就    <div class="col-12 d-flex align-items-center justify-content-start gap-5">
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="course_id"
                id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="year"
                id="selYear">
                <option selected disabled>Select Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="month"
                id="selMonth">
                <option selected disabled>Select Month</option>
                @foreach ($months as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="exam_code_id"
                id="selExamCode">
                <option selected disabled>Select Code</option>
                @foreach ($exam_codes as $code)
                    <option value="{{ $code->id }}">{{ $code->exam_code }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12  mt-2">
                    <thead>
                        <tr class="p-4 border border-t-2 border-b-2 " style="border:#CF202F;">

                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">
                                Select
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
                            <th class="col-3"
                                style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                                scope="col">Mistakes</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($exam_history as $item)
                            <tr class="p-4 border border-t-2 border-b-2 " style="border:#CF202F;">
                                <th class="col-1"
                                    style="border-top: none !important; color: #CF202F; font-size: 1.4rem;font-weight: 600;"
                                    scope="col">
                                    {{ $loop->iteration }}
                                </th>
                                <th class="col-3"
                                    style="border-top: none !important; color: #CF202F;font-size: 1.14rem;font-weight: 600; "
                                    scope="col">
                                    {{ $item->exams->title }}
                                </th>
                                <th class="col-3"
                                    style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                                    scope="col">
                                    {{ $item->score }}
                                </th>
                                <th class="col-3"
                                    style="border-top: none !important; color: #CF202F;font-size: 1.4rem; font-weight: 600;"
                                    scope="col">
                                    {{ $item->time }}
                                </th>
                                <td>
                                    <a class="conBtn" href="{{ route('ad_score_exam_mistake', $item->id) }}">View
                                        Mistakes</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ route('generateExamPdf') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="exam_history_id []" id="selectedIdsInput">

                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" id="generateExamPdf"
                        style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                        Generate Mistakes PDF
                    </button>
                </div>
            </form>
            <form action="{{ route('generateExamAnsPdf') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="exam_history_id[]" id="selectedIdsInputAns">

                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" id="generateExamAnsPdf"
                        style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                        Generate Mistakes Answers PDF
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            let user_id = {{ $user->id }}
            $.ajax({

                url: "{{ route('course_exam', ['user' => $user->id]) }}",
                type: "GET",
                data: {
                    user_id: user_id,
                },
                success: function(data) {
                    console.log(data)
                    console.log(data.data)

                }
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            let user_id = {{ $user->id }};
            // Define base route URL for ad_score_exam_mistake
            const mistakeRouteBase = "{{ route('ad_score_exam_mistake', '') }}/";

            function filterExams() {
                let course_id = $('#selCourse').val();
                let year = $('#selYear').val();
                let month = $('#selMonth').val();
                let exam_code_id = $('#selExamCode').val();

                // Construct query string, only including non-empty parameters
                let paramsObj = {};
                if (user_id) paramsObj.user_id = user_id;
                if (course_id) paramsObj.course_id = course_id;
                if (year) paramsObj.year = year;
                if (month) paramsObj.month = month;
                if (exam_code_id) paramsObj.exam_code_id = exam_code_id;

                let params = new URLSearchParams(paramsObj).toString();

                $.ajax({
                    url: params ? "{{ url('api/filter_exams') }}?" + params :
                        "{{ url('api/filter_exams') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        updateTable(data.exam_history);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#myTable').html('<tr><td colspan="5">Error loading data</td></tr>');
                    }
                });
            }

            function updateTable(exams) {
                let tbody = $('#myTable');
                tbody.empty();

                if (exams.length === 0) {
                    tbody.append('<tr><td colspan="5">No exams found</td></tr>');
                    return;
                }

                exams.forEach((item, index) => {
                    let row = `
                        <tr class="p-4 border border-t-2 border-b-2" style="border:#CF202F;">
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                                ${index + 1}
                            </th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.14rem; font-weight: 600;">
                                ${item.exams.title}
                            </th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                                ${item.score}
                            </th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                                ${item.time}
                            </th>
                                              <td>
                                <a class="conBtn" href="${mistakeRouteBase}${item.id}">View Mistakes</a>
                            </td>

                        </tr>`;
                    tbody.append(row);
                });
            }

            // Update course name when course is selected
            $('#selCourse').change(function() {
                let selectedCourse = $(this).find('option:selected').text();
                if (selectedCourse && selectedCourse !== 'Select Course') {
                    $('#courseName').text('Course: ' + selectedCourse);
                } else {
                    $('#courseName').text('Course: {{ $stu_course->course_name }}');
                }
                filterExams();
            });

            // Event listeners for select changes
            $('#selCourse, #selYear, #selMonth, #selExamCode').change(function() {
                filterExams();
            });

            // Initial load
            filterExams();

              $(document).ready(function() {
            $(document).on('change', '.row-checkbox', function() {
                let selectedQuizzeIds = [];
                $('.row-checkbox:checked').each(function() {
                    selectedQuizzeIds.push($(this).data('quizze-id'));
                });

                // Set the value as JSON string
                $('#selectedIdsInput').val(JSON.stringify(selectedQuizzeIds));
                $('#selectedIdsInputAns').val(JSON.stringify(selectedQuizzeIds));

                // Show/hide buttons based on selection
                $('#generateExamPdf').toggle(selectedQuizzeIds.length > 0);
                $('#generateExamAnsPdf').toggle(selectedQuizzeIds.length > 0);
            });
        });
        });
    </script>
</x-default-layout> --}}
{{-- route('lesson_score_sheet')
data : {lesson_id : 1}
MyCourses/Mistakes/1
Quiz/Report/1

--}}

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
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row
        }

        @media (max-width: 640px) {
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
        <div class="title col-12 d-flex justify-content-start gap-2 py-6 px-4 rounded" style="background-color: #FEF5F3">
            <span class="col-3" style="color: #CF202F;font-size: 1.4rem;font-weight: 600">Student: {{ $user->nick_name }}</span>
            <span class="col-4" style="color: #CF202F;font-size: 1.4rem;font-weight: 600" id="courseName">Course: {{ $stu_course->course_name }}</span>
            <span class="col-4" style="color: #CF202F;font-size: 1.4rem;font-weight: 600">Date of join: {{ $user->created_at->format('d-m-Y') }}</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="course_id" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="year" id="selYear">
                <option selected disabled>Select Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="month" id="selMonth">
                <option selected disabled>Select Month</option>
                @foreach ($months as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
            <select class="selCourse mx-2" style="width: 20%;font-size: 1.4rem;font-weight: 600;" name="exam_code_id" id="selExamCode">
                <option selected disabled>Select Code</option>
                @foreach ($exam_codes as $code)
                    <option value="{{ $code->id }}">{{ $code->exam_code }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12 mt-2">
                    <thead>
                        <tr class="p-4 border border-t-2 border-b-2" style="border-color:#CF202F;">
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">Select</th>
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;" scope="col">#</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.14rem; font-weight: 600;" scope="col">Test Name</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;" scope="col">Score</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;" scope="col">Time</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;" scope="col">Mistakes</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($exam_history as $item)
                            <tr class="p-4 border border-t-2 border-b-2" style="border-color:#CF202F;">
                                <td class="col-1" style="border-top: none !important;">
                                    <input type="checkbox" class="row-checkbox" data-quizze-id="{{ $item->id }}">
                                </td>
                                <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;" scope="row">{{ $item->id }}</th>
                                <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.14rem; font-weight: 600;">{{ $item->exams->title }}</th>
                                <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">{{ $item->score }}</th>
                                <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">{{ $item->time }}</th>
                                <td>
                                    <a class="conBtn" href="{{ route('ad_score_exam_mistake', $item->id) }}">View Mistakes</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ route('generateExamPdf') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="exam_history_id[]" id="selectedIdsInput">
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" id="generateExamPdf" style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                        Generate Mistakes PDF
                    </button>
                </div>
            </form>
            <form action="{{ route('generateExamAnsPdf') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="exam_history_id[]" id="selectedIdsInputAns">
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" id="generateExamAnsPdf" style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                        Generate Mistakes Answers PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let user_id = {{ $user->id }};
            const mistakeRouteBase = "{{ route('ad_score_exam_mistake', '') }}/";

            function filterExams() {
                let course_id = $('#selCourse').val();
                let year = $('#selYear').val();
                let month = $('#selMonth').val();
                let exam_code_id = $('#selExamCode').val();

                let paramsObj = { user_id };
                if (course_id) paramsObj.course_id = course_id;
                if (year) paramsObj.year = year;
                if (month) paramsObj.month = month;
                if (exam_code_id) paramsObj.exam_code_id = exam_code_id;

                $.ajax({
                    url: "{{ url('api/filter_exams') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: paramsObj,
                    success: function(data) {
                        updateTable(data.exam_history);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#myTable').html('<tr><td colspan="6">Error loading data</td></tr>');
                    }
                });
            }

            function updateTable(exams) {
                let tbody = $('#myTable');
                tbody.empty();

                if (exams.length === 0) {
                    tbody.append('<tr><td colspan="6">No exams found</td></tr>');
                    return;
                }

                exams.forEach((item, index) => {
                    let row = `
                        <tr class="p-4 border border-t-2 border-b-2" style="border-color:#CF202F;">
                            <td class="col-1" style="border-top: none !important;">
                                <input type="checkbox" class="row-checkbox" data-quizze-id="${item.id}">
                            </td>
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                                ${item.id}
                            </th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.14rem; font-weight: 600;">
                                ${item.exams.title}
                            </th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                                ${item.score}
                            </th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F; font-size: 1.4rem; font-weight: 600;">
                                ${item.time}
                            </th>
                            <td>
                                <a class="conBtn" href="${mistakeRouteBase}${item.id}">View Mistakes</a>
                            </td>
                        </tr>`;
                    tbody.append(row);
                });
            }

            $('#selCourse').change(function() {
                let selectedCourse = $(this).find('option:selected').text();
                if (selectedCourse && selectedCourse !== 'Select Course') {
                    $('#courseName').text('Course: ' + selectedCourse);
                } else {
                    $('#courseName').text('Course: {{ $stu_course->course_name }}');
                }
                filterExams();
            });

            $('#selCourse, #selYear, #selMonth, #selExamCode').change(function() {
                filterExams();
            });

            $(document).on('change', '.row-checkbox', function() {
                let selectedQuizzeIds = [];
                $('.row-checkbox:checked').each(function() {
                    selectedQuizzeIds.push($(this).data('quizze-id'));
                });

                // Send as JSON string to match backend expectation
                $('#selectedIdsInput').val(JSON.stringify(selectedQuizzeIds));
                $('#selectedIdsInputAns').val(JSON.stringify(selectedQuizzeIds));

                // Show/hide buttons based on selection
                $('#generateExamPdf').toggle(selectedQuizzeIds.length > 0);
                $('#generateExamAnsPdf').toggle(selectedQuizzeIds.length > 0);
            });

            filterExams();
        });
    </script>
</x-default-layout>
