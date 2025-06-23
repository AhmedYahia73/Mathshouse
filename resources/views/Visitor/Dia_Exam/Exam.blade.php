@php
    $page_name = 'Diagnostic Exam';
    // $quizze->question;
    // "Mcq" => $item->mcq
    // "Grid" => $item->g_ans
    // api_quizze
@endphp
@section('title', 'Quizze')
@include('success')
<style>
    body {
        background: #fff !important;
    }

    .quizzes-page {
        width: 100%;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .quizzes-page>header {
        width: 100%;
        padding: 0 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 3px solid #c9c9c9;
        padding-bottom: 10px;
        /* background: #000; */
    }

    .quizzes-page .type-quizzes {
        position: relative;
        width: calc(100% / 3);
        /* background: orange; */
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        font-size: 1.5rem;
    }

    .quizzes-page .type-quizzes>span:nth-child(1) {
        font-weight: 500;
    }

    .quizzes-page .type-quizzes span>.angle-show-disc {
        margin-left: 5px;
        font-size: 1.2rem;
        cursor: pointer;
    }

    .rotateEle {
        transform: rotate(180deg);
    }

    .quizzes-page .type-quizzes .disc-ruels-quizzes {
        position: absolute;
        top: 100%;
        left: 25%;
        max-width: 150%;
        background: #dedede;
        font-size: 1.1rem;
        padding: 10px;
        border-radius: 10px;
        z-index: 100;
    }

    .quizzes-page .timer-quizzes {
        width: calc(100% / 3);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quizzes-page .timer-quizzes>div {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* row-gap: 10px */
    }

    .quizzes-page .timer-quizzes div:nth-child(1) {
        font-size: 1.5rem;
        font-weight: 600;
        text-align: center;
    }

    .quizzes-page .timer-quizzes button {
        font-size: 1.2rem;
        font-weight: 500;
        border: 1px solid #000;
        border-radius: 8px;
        padding: 3px 34px;
        transition: all 0.3s ease-in-out;
        background: #fff;
        color: #000;
    }

    .quizzes-page .timer-quizzes button:hover {
        background: #000;
        color: #fff;
    }


    .quizzes-page .options {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        /* margin-right: 100px; */
    }

    /* style drop down */

    .btn-dropdown {
        position: relative;
        font-size: 1.6rem;
        padding: 10px;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        cursor: pointer;
        background: none;
        border: none;
        margin-right: 100px;
    }

    .options-list {
        position: absolute;
        top: 60%;
        left: 22%;
        width: 60%;
        margin: 0;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        list-style-type: none;
        background: #dedede;
        border: 1px solid #ccc;
        z-index: 100;
    }

    .options-list .options-tx {
        width: 100%;
        display: flex;
        flex-direction: column;
        row-gap: 10px;
    }

    .options-list .options-tx li {
        padding: 5px;
        text-align: center;
        cursor: pointer;
        font-size: 1.1rem;
    }

    .options-list .options-tx li:hover {
        background-color: #f5f5f5;
        border-radius: 1.1rem;
    }

    /* Main */
    main {
        width: 100%;
        min-height: 80vh;
        margin-top: 10px;
        padding-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }

    main>form {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
    }

    main .main-wrapper {
        width: 100%;
        padding: 0 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        row-gap: 10px;
        border-bottom: 3px dashed #e2e2e2;
    }

    main .main-wrapper .question {
        position: relative;
        width: 100%;
        background: #fff;
        display: flex;
        column-gap: 10px;
        padding: 10px;
    }

    /* Media query for small screens (e.g., max-width: 768px) */
    @media (max-width: 768px) {
        main .main-wrapper .question {
            flex-direction: column;
            row-gap: 10px;
            /* Optional: Add spacing between stacked items */
        }
    }

    /* Question Side */
    main .main-wrapper .question .question-side {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* width */
    main .main-wrapper .question .question-side::-webkit-scrollbar {
        width: 8px;
        border-radius: 10px;
    }

    /* Track */
    main .main-wrapper .question .question-side::-webkit-scrollbar-track {
        background: grey;
        border-radius: 10px;
    }

    /* Handle */
    main .main-wrapper .question .question-side::-webkit-scrollbar-thumb {
        background: rgb(226, 226, 226);
        border-radius: 10px;
    }

    main .main-wrapper .question .question-side .text-question {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        column-gap: 10px;
    }

    main .main-wrapper .question .question-side .text-question p {
        font-size: 1.2rem;
        font-weight: 500;
        width: 100%;
        text-align: start;
    }

    main .main-wrapper .question .question-side .img-question {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        row-gap: 10px;
        margin-bottom: 20px;
    }

    main .main-wrapper .question .question-side .img-question span {
        border-bottom: 2px solid #000;
        font-size: 1.2rem;
        font-weight: 600;
    }

    main .main-wrapper .question .question-side .img-question img {
        min-width: 100%;
        max-width: 100%;
        height: auto;
        object-fit: cover;
        object-position: center;
        border: 2px solid #000;
        border-radius: 10px;
    }

    /* Answer Side */
    main .main-wrapper .question .answer-side {
        width: 35%;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* background: #20e690; */
        /* overflow-y: scroll */
    }

    @media (max-width: 768px) {
        main .main-wrapper .question .answer-side {
            width: 100%;
        }
    }

    /* width */
    /* main .main-wrapper .question .question-side::-webkit-scrollbar {
        width: 8px;
        border-radius: 10px;
    } */

    /* Track */
    /* main .main-wrapper .question .question-side::-webkit-scrollbar-track {
        background: grey;
        border-radius: 10px;
    } */

    /* Handle */
    /* main .main-wrapper .question .question-side::-webkit-scrollbar-thumb {
        background: rgb(226, 226, 226);
        border-radius: 10px;
    } */

    main .main-wrapper .question .answer-side .sup-question {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        column-gap: 10px;
    }

    .question-num {
        font-size: 1.3rem;
        font-weight: 600;
        background: #000;
        padding: 0 5px;
        border-radius: 50%;
        text-align: center;
        color: #fff;
        width: 40px;
    }

    main .main-wrapper .question .answer-side .sup-question p {
        width: 100%;
        color: #000;
        font-size: 1.2rem;
        font-weight: 500;
        text-align: start;
    }


    main .main-wrapper .question .answer-side .answer-chosen {
        width: 100%;
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        row-gap: 30px;
        align-items: center;
        padding: 5px;
    }


    main .main-wrapper .question .answer-side .answer-chosen .chosen {
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        background: #fefefe;
        border-radius: 20px;
        column-gap: 20px;
        padding: 5px 12px;
        cursor: pointer;
        transition: border 0.3s ease-in;
        box-shadow: 0px 0px 8px 3px rgb(4 4 4 / 18%);
    }

    main .main-wrapper .question .answer-side .answer-chosen .chosen:hover {
        outline: 3px solid #000;
    }

    .selectedd {
        outline: 3px solid #000;
    }

    main .main-wrapper .question .answer-side .answer-chosen .chosen button {
        background: none;
        border-radius: 50%;
        padding: 0px 10px;
        text-align: center;
        font-weight: 500;
        font-size: 1.3rem;
    }

    main .main-wrapper .question .answer-side .answer-chosen .chosen input {
        border: none;
        font-size: 1.3rem;
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 500px;
        background: none;
        cursor: pointer;
    }


    main .main-wrapper .question .answer-side .answer-setValue {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        row-gap: 80px;
        margin-top: 60px;
        /* background: red; */

    }

    main .main-wrapper .question .answer-side .answer-setValue .section-setValue {
        display: flex;
        align-items: center;
        column-gap: 10px;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-setValue span {
        font-size: 1.2rem;
        font-weight: 500;
    }

    main .main-wrapper .question .answer-side .answer-setValue .input_val {
        width: 35%;
        padding: 10px;
        border-radius: 10px;
        border: 2px solid #cdcdcd;
        border-radius: 20px;
        padding-bottom: 15px;
    }

    main .main-wrapper .question .answer-side .answer-setValue .input_val>input {
        width: 100%;
        border: none;
        font-size: 1.2rem;
        text-align: center;
        background: transparent;
        border-bottom: 2px dashed #c2c2c2;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-value {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: flex-start;
        column-gap: 10px;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-value span {
        font-size: 1.2rem;
        font-weight: 500;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-value input {
        width: 50%;
        border: none;
        padding: 10px;
        background: none;
        font-size: 1.2rem;
        text-align: center;
        border-radius: 20px;
        border: 2px solid #cdcdcd;
    }

    /* Section Pagination  */
    main .paginationn {
        position: relative;
        display: flex;
        text-align: center;
        margin-top: 15px;
        user-select: none;
    }

    main .paginationn>li {
        display: inline-block;
        margin: 5px;
        box-shadow: 0 5px 25px rgb(1 1 1 / 10%)
    }

    main .paginationn>li a {
        color: #fff;
        text-decoration: none;
        font-size: 1.2em;
        line-height: 45px;
    }

    main .paginationn>.currentt-page:hover {
        background: #0ab1ce;
    }

    main .paginationn>li:hover a {
        color: #fff !important;
    }

    .previouss-page,
    .nextt-page {
        background: #0ab1ce;
        width: 80px;
        border-radius: 45px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    main .previouss-page:hover {
        transform: translateX(-5px);
    }

    .nextt-page:hover {
        transform: translateX(5px);
    }

    .currentt-page,
    .dotss {
        background: #ccc;
        width: 45px;
        border-radius: 50%;
        cursor: pointer;
    }

    /* .activee {
        background: #0ab1ce;
    } */

    .disablee {
        background: #ccc;
    }

    .btn-submit-quiz {
        position: absolute;
        right: -45%;
        top: 9%;
        border: none;
        cursor: pointer;
        font-weight: 500;
        padding: 5px 30px;
        font-size: 1.2rem;
        border-radius: 45px;
        transition: 0.3s ease;
        background: #0ab1ce;
        color: #fff !important;
        transition: all 0.3s ease;
    }

    .btn-submit-quiz:hover {
        background: cadetblue;
    }

    /* .addSl {
        font-size: 2rem;
        border: none;
        background: transparent;
        margin-left: 100px;
        font-weight: 500;
        border: 2px solid #2222;
        padding: 1px 20px;
        border-radius: 15px;
    } */

    /* ///Section Pagination  */

    .answer-setValue {
        margin: 20px 0;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .section-setValue,
    .section-value {
        margin-bottom: 10px;
    }

    input[type="text"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        padding: 8px 12px;
        margin-left: 5px;
        background: #0ab1ce;
        /* color: white;
    border: none; */
        border-radius: 4px;
        cursor: pointer;
    }

    #preview_value {
        background: #f5f5f5;
        font-weight: bold;
    }

    /* ///Section Pagination  */

    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 2rem 0;
        position: relative;
        width: 100%;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0 auto;
        align-items: center;
        background: #fff;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 5px;
    }

    .page-item {
        margin: 0 3px;
        text-align: center;
    }

    .page-link {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: #4a5568;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        padding: 0 !important;
    }

    .page-item.activee .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    }

    .page-item:not(.activee):not(.disabled) .page-link:hover {
        background: #f7fafc;
        border-color: #e2e8f0;
    }

    .page-item.disabled .page-link {
        color: #cbd5e0;
        pointer-events: none;
    }

    .btn-submit-quiz {
        position: absolute;
        right: 20px;
        background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(245, 101, 101, 0.3);
    }

    .btn-submit-quiz:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(245, 101, 101, 0.4);
    }

    .btn-submit-quiz.d-none {
        display: none;
    }

    /* Animation for page transitions */
    .question {
        transition: opacity 0.3s ease;
    }

    .question:not(.active) {
        opacity: 0;
        height: 0;
        overflow: hidden;
        position: absolute;
    }

    .question.active {
        opacity: 1;
        height: auto;
        position: relative;
    }
</style>
@include('Student.inc.header')


<div class="quizzes-page">
    <header>
        {{-- Type section --}}
        <div class="type-quizzes">
            <span>Math</span>
            <span>Directions<i class="fa-solid fa-angle-up angle-show-disc rotateEle"></i></span>
            <p class="disc-ruels-quizzes d-none">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos hic necessitatibus consectetur sit
                nisi, similique distinctio non fugiat magni nam, sequi, qui libero earum praesentium rem! Atque, minus
                nesciunt.
            </p>
        </div>
        {{-- Timer section --}}
        <div class="timer-quizzes">
            {{-- show section --}}
            <div class="show-timer">
                <div class="timer">
                    <span class="hr" id="hour">00</span>
                    <span>:</span>
                    <span class="min" id="minutes">00</span>
                    <span>:</span>
                    <span class="sec" id="seconds">00</span>
                </div>
                <button class="hide-btn">Hide</button>
            </div>
            {{-- hide section --}}
            <div class="hide-timer d-none">
                <div class="icon-timer"><i class="fa-regular fa-clock" style="padding-bottom: 5px;margin-top: 5px;"></i>
                </div>
                <button class="show-btn">Show</button>
            </div>
        </div>
        {{-- Options section --}}
        {{-- <div class="options">
            <i class="fa-solid fa-ellipsis-vertical btn-dropdown"></i>
            <div class="options-list d-none">
                <ul class="options-tx">
                    @foreach ($reports as $report)
                    <li>
                        <div type="button" data-bs-toggle="modal" data-bs-target="#modalCenter{{ $report->id }}">
                            {{ $report->list }}
                        </div>
                        <!-- Modal -->
                        <form method="POST" action="{{ route('Ad_report_list_edit', ['id' => $report->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal fade" id="modalCenter{{ $report->id }}" tabindex="-1" aria-hidden="true"
                                style="display: none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalCenterTitle">Make Report</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>


                                        <div class="my-2 px-3">
                                            <label>
                                                Report
                                            </label>
                                            <input class='form-control' value="{{ $report->list }}" name="list"
                                                placeholder="Report" />
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div> --}}
    </header>
    <main>
        <form action="{{ route('dia_exam_ans', ['id' => $exam->id]) }}" method="POST" style="width: 100%;"
            id="quizForm">
            @csrf
            <!-- Hidden input for start time (Unix timestamp) -->
            <input type="hidden" name="start_time" id="start_time" value="{{ now()->timestamp }}">
            <!-- Hidden input for time difference in HH:MM:SS -->
            <input type="hidden" name="time" id="time_diff">
            <div class="main-wrapper">
                @foreach ($exam->question as $question)
                    <div class="question">
                        <input type="hidden" value="{{ $question->id }}" class="questionID"
                            id="questionID{{ $question->id }}">
                        <div class="question-side">
                            <div class="text-question">
                                <span class="question-num">{{ $loop->iteration }}</span>
                                <p>{!! $question->question !!}</p>
                            </div>
                            <div class="img-question">
                                <span>Examples</span>
                                @if (!empty($question->q_url))
                                    <img src="{{ asset('images/questions/' . $question->q_url) }}" alt="question">
                                @endif
                            </div>
                        </div>
                        <div class="answer-side">
                            <!-- Existing answer-side content -->
                            <div class="options">
                                <i class="fa-solid fa-ellipsis-vertical btn-dropdown"></i>
                                <div class="options-list d-none">
                                    <ul class="options-tx">
                                        @foreach ($reports as $report)
                                            <li class="report_item">
                                                {{ $report->list }}
                                                <input type="hidden" class="reportID" value="{{ $report->id }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            {{-- Supp Question --}}

                            {{-- Input to set and send value about answer question to array --}}
                            {{-- <input type="hidden" id="timer_val" name="timer_val" /> --}}
                            <input type="hidden" name="quizze" value="{{ $exam }}">

                            {{-- Answer chosen --}}

                            @php
                                $arr = ['A', 'B', 'C', 'D', 'E'];
                                $iter = $loop->iteration;
                            @endphp
                            @if ($question->ans_type == 'MCQ')
                                <div class="answer-chosen">
                                    <input name="q_answers[]" type="hidden" class="q_answers"
                                        value="{{ json_encode(['q_id' => $question->id]) }}" />
                                    @foreach ($question->mcq as $mcq)
                                        <div class="chosen chose_mcq chosen{{ $iter }}"
                                            id="chosen{{ $iter }}{{ $loop->iteration }}">
                                            <input type="hidden" class="mcq_id" value="{{ $mcq->id }}">
                                            <button type="button" class="ans_btn">{{ $mcq->mcq_num }}</button>
                                            <input type="text" value="{{ $mcq->mcq_ans }}" readonly>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <input name="q_grid_answers[]" type="hidden" class="q_grid_answers"
                                    value="{{ json_encode(['q_id' => $question->id]) }}" />
                                     {{-- Answer Set Value --}}
                                {{-- <div class="answer-setValue">
                            <div class="section-setValue">
                                <span>Answer:</span>
                                <div class="input_val">
                                    <input type="text" name="q_grid_ans[]" step="0.001" value="0" class="gridVal">
                                </div>
                                <input type="button" value="/" class="addSl">
                            </div>
                            <div class="section-value">
                                <span>Answer Preview:</span>
                                <input type="number" value="00000" readonly>
                            </div>
                        </div> --}}
                                <div class="answer-setValue">
                                    <div class="section-setValue">
                                        <span>Answer:</span>
                                        <div class="input_val">
                                            <input type="text" step="0.001" value="0" name="q_grid_ans[]"
                                                class="gridVal" id="input_val">
                                        </div>
                                        <input type="button" value="/" class="addSl">
                                        <input type="button" value="Enter" class="enterBtn">
                                    </div>
                                    <div class="section-value">
                                        <span>Answer Preview:</span>
                                        <input type="number" id="preview_value" readonly>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
            {{-- end Section Question --}}
            <div class="pagination-container">
                <ul class="pagination">
                    <button class="btn-submit-quiz d-none" type="submit">Submit Quiz</button>
                </ul>
            </div>
        </form>
    </main>
</div>



@include('Student.inc.footer')

<script>
    let q_answers = document.querySelectorAll('.q_answers');
    let mcq_id = document.querySelectorAll('.mcq_id');
    let chose_mcq = document.querySelectorAll('.chose_mcq');
    let ans_btn = document.querySelectorAll('.ans_btn');

    for (let i = 0, end = chose_mcq.length; i < end; i++) {
        chose_mcq[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (chose_mcq[j] == e.target || chose_mcq[j] == e.target.parentElement) {
                    let question_ans = chose_mcq[j].parentElement.children[0];
                    let question_id = question_ans.value;
                    question_id = JSON.parse(question_id);
                    question_id = question_id.q_id;
                    let mcq_id = chose_mcq[j].children[0].value
                    let answer = ans_btn[j].innerText;
                    question_ans.value = JSON.stringify({
                        'q_id': question_id,
                        'mcq_id': mcq_id,
                        'answer': answer
                    });
                }
            }
        })
    }
</script>
<script>
    $(document).ready(function() {
        /* Timer question */
        // var hoursLabel = $("#hour");
        // var minutesLabel = $("#minutes");
        // var secondsLabel = $("#seconds");
        // var totalHours = 0;
        // var totalMinutes = 0;
        // var totalSeconds = 0;

        // setInterval(setTime, 1000);

        // function setTime() {
        //     var Hours_quizz = $("#hour").text();
        //     var Min_quizz = $("#minutes").text();
        //     var Sec_quizz = $("#seconds").text();
        //     var alltime = `${Hours_quizz}:${Min_quizz}:${Sec_quizz}`;
        //     var objTim = alltime;

        //     $("#timer_val").val(JSON.stringify(objTim));

        //     console.log("Hours_quizz", Hours_quizz)
        //     console.log("Min_quizz", Min_quizz)
        //     console.log("Sec_quizz", Sec_quizz)
        //     console.log("objTim", objTim)
        //     console.log("timer_val ", $("#timer_val").val())
        //         ++totalSeconds;
        //     secondsLabel.html(pad(totalSeconds % 60));
        //     secondsLabel.html(pad(parseInt(totalSeconds)));

        //     if (totalSeconds <= 59) {
        //         console.log("sec < 59")
        //         // var Hours_quizz = $("#hr").text();
        //         // var Min_quizz = $("#minutes").text();
        //         // var Sec_quizz = $("#seconds").text();
        //         // var Timer_quizz = Hours_quizz + Min_quizz + Sec_quizz;

        //         // console.log("Hours_quizz", Hours_quizz)
        //         // console.log("Min_quizz", Min_quizz)
        //         // console.log("Sec_quizz", Sec_quizz)
        //         // console.log("Timer_quizz", Timer_quizz)
        //     } else {
        //         secondsLabel.html(pad(parseInt(0)));
        //         totalSeconds = 0;
        //         totalMinutes++;
        //         minutesLabel.html(pad(parseInt(totalMinutes)));
        //         console.log("5555")

        //         if (totalMinutes <= 59) {
        //             console.log("min < 59")
        //         } else {
        //             minutesLabel.html(pad(parseInt(0)));
        //             totalMinutes = 0;
        //             totalHours++;
        //             hoursLabel.html(pad(parseInt(totalHours)));
        //             console.log("6666")
        //         }
        //     }


        // }

        // function pad(val) {
        //     var valString = val + "";
        //     if (valString.length < 2) {
        //         return "0" + valString;
        //     } else {
        //         return valString;
        //     }
        // }

        //edit here for time
        // Handle form submission
        // Ensure jQuery is loaded
        if (typeof $ === 'undefined') {
            console.error('jQuery is not loaded!');
        }

        // Handle form submission
        $('#quizForm').on('submit', function(e) {
            console.log('Form submit triggered');

            // Get start time
            const startTimeVal = $('#start_time').val();
            console.log('Start time:', startTimeVal);

            if (!startTimeVal) {
                console.error('Start time is missing or empty!');
                return; // Prevent submission if start_time is missing
            }

            const startTime = parseInt(startTimeVal) * 1000; // Convert to milliseconds
            const endTime = Date.now();
            const timeDiffSeconds = Math.floor((endTime - startTime) / 1000);

            // Convert to HH:MM:SS
            const hours = Math.floor(timeDiffSeconds / 3600);
            const minutes = Math.floor((timeDiffSeconds % 3600) / 60);
            const seconds = timeDiffSeconds % 60;
            const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;

            // Set time difference
            console.log('Formatted time:', formattedTime);
            $('#time_diff').val(formattedTime);
            console.log('Time diff set:', $('#time_diff').val());

            // Allow form submission to proceed
        });

        // Timer for display (unchanged)
        var hoursLabel = $("#hour");
        var minutesLabel = $("#minutes");
        var secondsLabel = $("#seconds");
        var totalHours = 0;
        var totalMinutes = 0;
        var totalSeconds = 0;

        setInterval(setTime, 1000);

        function setTime() {
            ++totalSeconds;
            secondsLabel.html(pad(totalSeconds % 60));

            if (totalSeconds >= 60) {
                secondsLabel.html(pad(0));
                totalSeconds = 0;
                totalMinutes++;
                minutesLabel.html(pad(totalMinutes));

                if (totalMinutes >= 60) {
                    minutesLabel.html(pad(0));
                    totalMinutes = 0;
                    totalHours++;
                    hoursLabel.html(pad(totalHours));
                }
            }
        }

        function pad(val) {
            var valString = val + "";
            return valString.length < 2 ? "0" + valString : valString;
        }

        /* Send Timer */
        // $(".btn-submit-quiz").click(function() {

        //     var Hours_quizz = $("#hour").text();
        //     var Min_quizz = $("#minutes").text();
        //     var Sec_quizz = $("#seconds").text();
        //     var alltime = `${Hours_quizz}:${Min_quizz}:${Sec_quizz}`;
        //     var objTim = alltime;

        //     var timer_val = $("#timer_val").val(JSON.stringify(objTim));
        //     var timer = timer_val.val();
        //     console.log()
        //     $.ajax({
        //         url: "{{ route('api_timer') }}",
        //         type: "GET",
        //         data: {
        //             timer,
        //         },
        //         success: function(data) {
        //             console.log("data", data)
        //         }
        //     })
        // })

        /* Send Report about the question */
        $(".report_item").on("click", function() {
            console.log("Report id", $(this).find(".reportID").val())
            console.log("ques id", $(this).closest(".question").find(".questionID").val())
            $.ajax({
                url: "{{ route('api_report_question') }}",
                type: "GET",
                data: {
                    question_id: $(this).closest(".question").find(".questionID").val(),
                    list_id: $(this).find(".reportID").val(),
                },
                success: function(data) {
                    console.log(data)
                }
            })
        })
        /* Show Discraption */
        $(".angle-show-disc").click(function() {
            $('.disc-ruels-quizzes').toggleClass("d-none");
            $('.angle-show-disc').toggleClass("rotateEle");
        });
        /* Hide Timer */
        $(".hide-btn").click(function() {
            $(".show-timer").addClass("d-none");
            $(".hide-timer").removeClass("d-none");
        });
        /* Show Timer */
        $(".show-btn").click(function() {
            $(".hide-timer").addClass("d-none");
            $(".show-timer").removeClass("d-none");
        });
        /* Show dropDown */
        $(".btn-dropdown").click(function() {
            $('.options-list').toggleClass("d-none");
        });
        /* Hide dropDown */
        $(".options-list li").click(function() {
            $(".options-list").toggleClass("d-none");
        });

        /* /////////////// */
        /* Handel Data question */
        /* /////////////// */

        // Add slash button - using event delegation in case elements are dynamic
        $(document).ready(function() {
            // Event handlers for fraction input
            $(document).on('click', '.addSl', function() {
                // Find the closest answer-setValue container first
                let container = $(this).closest('.answer-setValue');
                // Then find the gridVal input within that container
                let input = container.find('.gridVal');
                let currentVal = input.val();

                // Only add slash if not already present and input isn't empty
                if (currentVal && !currentVal.includes('/')) {
                    input.val(currentVal + '/');
                }
            });

            $(document).on('click', '.enterBtn', calculateFraction);
            $(document).on('keypress', '.gridVal', function(e) {
                if (e.which === 13) calculateFraction();
            });

            function calculateFraction() {
                // Get the container based on which button was clicked
                const container = $(this).closest('.answer-setValue');
                const input = container.find('.gridVal').val().trim();
                const preview = container.find('#preview_value');

                if (!input) {
                    preview.val("0");
                    return;
                }

                if (input.includes('/')) {
                    const parts = input.split('/');
                    if (parts.length === 2) {
                        const numerator = parseFloat(parts[0]);
                        const denominator = parseFloat(parts[1]);

                        if (!isNaN(numerator) && !isNaN(denominator) && denominator !== 0) {
                            const result = numerator / denominator;
                            preview.val(formatResult(result));
                            return;
                        }
                    }
                    preview.val("Invalid fraction");
                    return;
                }

                const num = parseFloat(input);
                preview.val(!isNaN(num) ? formatResult(num) : "Invalid input");
            }


            function formatResult(value) {
                // Round to 2 decimal places first
                const rounded = Math.round(value * 100) / 100;

                // Check if it's a whole number after rounding
                if (rounded % 1 === 0) {
                    return rounded.toString(); // Return as integer string
                }
                return rounded.toFixed(2); // Return with 2 decimal places
            }
        });

        $(".chosen").each((elePar, valPar) => {

            var staPar = elePar + 1;
            console.log("elePar", elePar)
            console.log("staPar", staPar)
            console.log("valPar", valPar)
            var elementPar = `.${$(valPar).attr("class").slice(0, 6) + staPar}`;

            console.log(elementPar)

            $(elementPar).each((ele, val) => {
                console.log("ele", ele)
                console.log("val", val)
                var element = `#${$(val).attr("id")}`;
                console.log(element)
                $(element).click(() => {
                    $(elementPar).removeClass("selectedd");
                    $(element).addClass("selectedd");
                })
            })
        })

        /* Handel pagination question */
        function getPageList(totalPages, currentPage, paginationSize) {
            if (totalPages < 1) return [];
            if (currentPage < 1) currentPage = 1;
            if (currentPage > totalPages) currentPage = totalPages;
            if (paginationSize < 3) paginationSize = 3;

            let pages = [];
            let startPage, endPage;

            if (totalPages <= paginationSize) {
                for (let i = 1; i <= totalPages; i++) {
                    pages.push(i);
                }
                return pages;
            }

            const half = Math.floor(paginationSize / 2);
            startPage = Math.max(1, currentPage - half);
            endPage = Math.min(totalPages, startPage + paginationSize - 1);

            if (endPage - startPage + 1 < paginationSize) {
                startPage = Math.max(1, endPage - paginationSize + 1);
            }

            if (startPage > 1) {
                pages.push(1);
                if (startPage > 2) {
                    pages.push('...');
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                pages.push(i);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    pages.push('...');
                }
                pages.push(totalPages);
            }

            return pages;
        }

        $(function() {
            var numberOfItems = $(".question").length;
            var limitPerPage = 1;
            var totalPages = Math.ceil(numberOfItems / limitPerPage);
            var paginationSize = Math.ceil(numberOfItems / 3);
            var currentPage;

            function showPage(whichPage) {
                if (whichPage < 1 || whichPage > totalPages) return false;

                // Hide current question with animation
                $(".question.active").removeClass("active");

                if (whichPage == totalPages) {
                    $(".btn-submit-quiz").removeClass("d-none");
                } else {
                    $(".btn-submit-quiz").addClass("d-none");
                }

                currentPage = whichPage;

                // Show new question with animation
                $(".question").hide().slice((currentPage - 1) * limitPerPage,
                    currentPage * limitPerPage).addClass("active").show();

                $(".pagination li").slice(1, -1).remove();

                getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                    $("<li>").addClass("page-item").addClass("current-page")
                        .toggleClass("activee", item === currentPage).append($("<a>")
                            .addClass("page-link").attr({
                                href: "javascript:void(0)",
                                "aria-label": item ? `Page ${item}` : "More pages"
                            }).text(item || "...")).insertBefore(".next-page");
                });

                $(".previous-page").toggleClass("disabled", currentPage === 1);
                $(".next-page").toggleClass("disabled", currentPage === totalPages);
                return true;
            }

            // Initialize pagination
            $(".pagination").append(
                $("<li>").addClass("page-item").addClass("previous-page").append(
                    $("<a>").addClass("page-link").attr({
                        href: "javascript:void(0)",
                        "aria-label": "Previous"
                    }).html(
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>'
                    )
                ),
                $("<li>").addClass("page-item").addClass("next-page").append(
                    $("<a>").addClass("page-link").attr({
                        href: "javascript:void(0)",
                        "aria-label": "Next"
                    }).html(
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    )
                )
            );

            $(".main-wrapper").show();
            showPage(1);

            // Event handlers
            $(document).on("click", ".pagination li.current-page:not(.activee)", function() {
                const pageText = $(this).text();
                if (pageText === '...') {
                    // Get the current page list
                    const pages = getPageList(totalPages, currentPage, paginationSize);
                    // Find the index of the clicked dots
                    const dotsIndex = pages.indexOf('...');

                    // Determine if it's the left or right dots
                    if (dotsIndex === 1) { // Left dots (before first page)
                        // Show pages around the first page
                        return showPage(Math.floor(currentPage / 2));
                    } else { // Right dots (before last page)
                        // Show pages around the last page
                        return showPage(Math.floor((currentPage + totalPages) / 2));
                    }
                } else {
                    return showPage(+pageText);
                }
            });

            $(".next-page").on("click", function() {
                return showPage(currentPage + 1);
            });

            $(".previous-page").on("click", function() {
                return showPage(currentPage - 1);
            });

            // $(".addSl").on("click", function() {
            //     var inpVal = $(this).closest(".section-setValue").find(".gridVal");
            //     var currentVal = inpVal.val().toString();
            //     inpVal.val(currentVal + "/");
        });
    });
</script>
