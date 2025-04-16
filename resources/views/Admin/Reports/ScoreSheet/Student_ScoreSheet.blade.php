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
                name="Course_Course" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>
            <select class="selChapter mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="Course_Chapter" id="selChapter">
                <option value="">Select Chapter</option>
            </select>
            <select class="selLesson mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="Course_Lesson" id="selLesson">
                <option value="">Select Lesson</option>
            </select>
            <input type="hidden" value="{{ $courses }}" class="course_data" />
            <input type="hidden" value="{{ $chapters }}" class="chapter_data" />
            <input type="hidden" value="{{ $lessons }}" class="lesson_data" />
        </div>
        <div class="col-12">
            {{-- <div class="action-buttons mb-5">
                <button id="selectAll">Select All</button>
                <button id="deselectAll">Deselect All</button>
            </div> --}}
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12  mt-2">
                    <thead>
                        <tr>
                            <th class="col-1" style="border-top: none !important; color: #CF202F; font-size: 1.1rem;"
                                scope="col">
                                Select
                            </th>
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
                    </tbody>
                </table>
            </div>
            <!-- Add the button here -->
            <form action="{{ route('generatePdf') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="selected_ids[]" id="selectedIdsInput">

                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" id="generatePdf"
                        style="display: none; background-color: #e43e4c; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s;">
                        Generate Mistakes PDF
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
            $("#selCourse").change(function() {
                var lessonID = $(this).val()
                $.ajax({
                    url: "{{ route('ad_lesson_score_sheet') }}",
                    type: "GET",
                    data: {
                        user_id: {{ $user_id }},
                        lesson_id: lessonID
                    },
                    success: function(data) {
                        console.log(data)
                        console.log(data.data)

                        $(data.data).each((index, ele) => {
                            console.log("ele", ele)
                            var newRow = `<tr>
                                <td style="padding-top: 15px !important">
                                    <input type="checkbox" class="row-checkbox" data-quizze-id="${ele["quizze_id"]}">
                                </td>
                                <td style="padding-top: 15px !important">${ele.quizze.title}</td>
                                <td style="padding-top: 15px !important">${ele.score + "/" + ele.quizze.score}</td>
                                <td style="padding-top: 15px !important">${ele.time}</td>
                                <td style="padding-top: 15px !important">${ele.date}</td>
                                <td><a class="conBtn" href="Mistakes/${ele.id}">View Mistakes</a></td>
                                <td><a class="conBtn" href="Quiz/Report/${ele.id}">Report</a></td>
                            </tr>`;
                            $("#myTable").append(newRow)
                            console.log(ele)
                        })

                    }
                })
            })

            $("#selLesson").change(function() {

                var lessonID = $(this).val()
                $.ajax({
                    url: "{{ route('ad_lesson_score_sheet') }}",
                    type: "GET",
                    data: {
                        user_id: {{ $user_id }},
                        lesson_id: lessonID
                    },
                    success: function(data) {
                        console.log(data)
                        console.log(data.data)

                        $(data.data).each((index, ele) => {
                            console.log("ele", ele)
                            var newRow = `<tr>
                                <td style="padding-top: 15px !important">
                                    <input type="checkbox" class="row-checkbox" data-quizze-id="${ele["quizze_id"]}">
                                </td>
                                <td style="padding-top: 15px !important">${ele.quizze.title}</td>
                                <td style="padding-top: 15px !important">${ele.score + "/" + ele.quizze.score}</td>
                                <td style="padding-top: 15px !important">${ele.time}</td>
                                <td style="padding-top: 15px !important">${ele.date}</td>
                                <td><a class="conBtn" href="Mistakes/${ele.id}">View Mistakes</a></td>
                                <td><a class="conBtn" href="Quiz/Report/${ele.id}">Report</a></td>
                            </tr>`;
                            $("#myTable").append(newRow)
                            console.log(ele)
                        })

                    }
                })
            })

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


$(document).on('change', '.row-checkbox', function () {
    let selectedQuizzeIds = [];
    $('.row-checkbox:checked').each(function () {
        selectedQuizzeIds.push($(this).data('quizze-id'));
    });

    console.log("Selected Quizze IDs:", selectedQuizzeIds);

    // Remove previous hidden inputs
    $('.selected-quizze-id').remove();

    // Append hidden inputs for each selected quizze_id
    selectedQuizzeIds.forEach(quizzeId => {
        $('form').append(`<input type="hidden" name="selected_ids[]" value="${quizzeId}" class="selected-quizze-id">`);
    });

    // Show the button if at least one checkbox is selected
    $('#generatePdf').toggle(selectedQuizzeIds.length > 0);
});




            // Handle the click event of the "Generate Mistakes PDF" button
            // $('#generatePdf').click(function () {
            //     let selectedIds = [];
            //     $('.row-checkbox:checked').each(function () {
            //         selectedIds.push($(this).data('id'));
            //     });
            //     console.log("Selected IDs:", selectedIds);

            // // Send selected IDs via POST request
            // // $.ajax({
            // //     url: "{{ route('generatePdf') }}", // Replace with your API route
            // //     type: "POST",
            // //     headers: {
            // //             "X-CSRF-TOKEN": "{{ csrf_token() }}" // Include CSRF token if needed
            // //         },
            // //     data: {
            // //         user_id: {{ $user_id }},
            // //         selected_ids: selectedIds
            // //     },
            // //     success: function(response) {
            // //         // Create a temporary link element to download the PDF
            // //         let link = document.createElement('a');
            // //         link.href = response.pdf_url; // Assuming the response contains the URL to the generated PDF
            // //         link.download = 'questions_pdf.pdf';
            // //         document.body.appendChild(link);
            // //         link.click();
            // //         document.body.removeChild(link);
            // //         console.log("PDF generated successfully:", response);
            // //     },
            // //     error: function(xhr, status, error) {
            // //         console.error("Error generating PDF:", error);
            // //     }
            // // });

            // });


        })
    </script>


</x-default-layout>
{{-- route('lesson_score_sheet')
data : {lesson_id : 1}
MyCourses/Mistakes/1
Quiz/Report/1

--}}
