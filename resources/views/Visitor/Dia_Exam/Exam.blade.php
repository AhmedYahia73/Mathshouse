@php
    $page_name = 'Diagnostic Exam';
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
    }

    .quizzes-page .type-quizzes {
        position: relative;
        width: calc(100% / 3);
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
    }

    .btn-dropdown {
        position: relative;
        font-size: 1.6rem;
        padding: 10px;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        cursor: pointer;
        background: none;
        border: none;
    }

    .options-list {
        position: absolute;
        top: 60%;
        width: 100%;
        margin: 0;
        padding: 1px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        list-style-type: none;
        background: #dedede;
        border: 1px solid #ccc;
        border-right: 0;
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
        font-size: 0.7rem;
    }

    .options-list .options-tx li:hover {
        background-color: #f5f5f5;
        border-radius: 1.1rem;
    }

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

    @media (max-width: 768px) {
        main .main-wrapper .question {
            flex-direction: column;
            row-gap: 10px;
        }
    }

    main .main-wrapper .question .question-side {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    main .main-wrapper .question .question-side::-webkit-scrollbar {
        width: 8px;
        border-radius: 10px;
    }

    main .main-wrapper .question .question-side::-webkit-scrollbar-track {
        background: grey;
        border-radius: 10px;
    }

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

    main .main-wrapper .question .answer-side {
        width: 7%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 768px) {
        main .main-wrapper .question .answer-side {
            width: 100%;
        }
    }

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
        row-gap: 10px;
        align-items: center;
        padding: 5px;
    }

    main .main-wrapper .question .answer-side .answer-chosen .chosen {
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        background: #fefefe;
        border: 2px solid #ddd;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        border-right: 0;
        column-gap: 20px;
        padding: 3px 8px;
        cursor: pointer;
        transition: border 0.3s ease-in;
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
        font-size: 1rem;
    }

    main .main-wrapper .question .answer-side .answer-chosen .chosen input {
        border: none;
        font-size: 1.3rem;
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 0;
        background: none;
        cursor: pointer;
    }

    main .main-wrapper .question .answer-side .answer-setValue {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        row-gap: 10px;
        margin-top: 40px;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-setValue {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        row-gap: 10px;
        padding: 5px;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-setValue span {
        width: 100%;
        font-size: 0.8rem;
        font-weight: 500;
    }

    main .main-wrapper .question .answer-side .answer-setValue .input_val {
        width: 100%;
        padding: 1px;
        border-radius: 20px;
    }

    main .main-wrapper .question .answer-side .answer-setValue .input_val>input {
        width: 100%;
        border: none;
        font-size: 0.5rem;
        text-align: center;
        background: transparent;
        border-bottom: 2px dashed #c2c2c2;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-value {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        column-gap: 10px;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-value span {
        font-size: 0.8rem;
        font-weight: 500;
    }

    main .main-wrapper .question .answer-side .answer-setValue .section-value input {
        width: 100%;
        border: none;
        background: none;
        font-size: 1rem;
        text-align: center;
        border-radius: 20px;
    }

    /* Pagination Container */
    .pagination-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 2rem 0;
        width: 100%;
        padding: 0 10px;
        box-sizing: border-box;
    }

    /* Pagination List */
    .pagination {
        display: flex;
        flex-wrap: nowrap;
        list-style: none;
        padding: 5px 10px;
        margin: 0;
        align-items: center;
        background: #fff;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        overflow-x: auto;
        white-space: nowrap;
        justify-content: center;
    }

    /* Page Items */
    .page-item {
        margin: 0 0.3rem;
        text-align: center;
    }

    /* Page Links */
    .page-link {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: clamp(36px, 8vw, 40px);
        height: clamp(36px, 8vw, 40px);
        border-radius: 50%;
        color: #4a5568;
        text-decoration: none;
        font-weight: 500;
        font-size: clamp(0.9rem, 2.5vw, 1rem);
        transition: all 0.3s ease;
        border: 1px solid transparent;
        padding: 0 !important;
    }

    /* Active Page */
    .page-item.activee .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    }

    /* Hover Effect */
    .page-item:not(.activee):not(.disabled) .page-link:hover {
        background: #f7fafc;
        border-color: #e2e8f0;
    }

    /* Disabled Page */
    .page-item.disabled .page-link {
        color: #cbd5e0;
        pointer-events: none;
    }

    /* Previous and Next Buttons */
    .previous-page .page-link,
    .next-page .page-link {
        width: clamp(60px, 15vw, 80px);
        border-radius: 45px;
        background: #0ab1ce;
        transition: transform 0.3s ease;
    }

    .previous-page .page-link:hover {
        transform: translateX(-5px);
    }

    .next-page .page-link:hover {
        transform: translateX(5px);
    }

    /* Submit Button */
    .btn-submit-quiz {
        background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        color: white;
        border: none;
        padding: clamp(10px, 2.5vw, 12px) clamp(20px, 5vw, 24px);
        border-radius: 50px;
        font-weight: 600;
        font-size: clamp(0.9rem, 2.5vw, 1.1rem);
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(245, 101, 101, 0.3);
        margin-top: 1rem;
        min-width: clamp(140px, 40vw, 180px);
        text-align: center;
    }

    .btn-submit-quiz:hover {
        background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(245, 101, 101, 0.4);
    }

    .btn-submit-quiz.d-none {
        display: none;
    }

    /* Media Queries for Responsive Design */
    @media (max-width: 768px) {
        .pagination {
            max-width: 90vw;
            justify-content: flex-start;
        }

        .page-link {
            width: clamp(32px, 10vw, 36px);
            height: clamp(32px, 10vw, 36px);
            font-size: clamp(0.8rem, 2.8vw, 0.9rem);
        }

        .previous-page .page-link,
        .next-page .page-link {
            width: clamp(50px, 12vw, 60px);
        }

        .btn-submit-quiz {
            min-width: clamp(140px, 40vw, 180px);
            font-size: clamp(0.9rem, 2.5vw, 1rem);
        }
    }

    @media (max-width: 480px) {
        .pagination {
            max-width: 85vw;
        }

        .page-link {
            width: clamp(28px, 9vw, 32px);
            height: clamp(28px, 9vw, 32px);
            font-size: clamp(0.7rem, 2.5vw, 0.8rem);
        }

        .previous-page .page-link,
        .next-page .page-link {
            width: clamp(45px, 11vw, 50px);
        }

        .btn-submit-quiz {
            min-width: clamp(120px, 35vw, 140px);
            font-size: clamp(0.8rem, 2.3vw, 0.9rem);
            padding: clamp(8px, 2vw, 10px) clamp(15px, 4vw, 20px);
        }
    }

    .enterBtn {
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

    /* Remove conflicting styles */
    main .paginationn {
        display: none;
    }
</style>
@include('Student.inc.header')

<div class="quizzes-page">
    <header>
        <div class="type-quizzes">
            <span>Math</span>
            <span>Directions<i class="fa-solid fa-angle-up angle-show-disc rotateEle"></i></span>
            <p class="disc-ruels-quizzes d-none">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos hic necessitatibus consectetur sit
                nisi, similique distinctio non fugiat magni nam, sequi, qui libero earum praesentium rem! Atque, minus
                nesciunt.
            </p>
        </div>
        <div class="timer-quizzes">
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
            <div class="hide-timer d-none">
                <div class="icon-timer"><i class="fa-regular fa-clock" style="padding-bottom: 5px;margin-top: 5px;"></i></div>
                <button class="show-btn">Show</button>
            </div>
        </div>
    </header>
    <main>
        <form action="{{ route('dia_exam_ans', ['id' => $exam->id]) }}" method="POST" style="width: 100%;" id="quizForm">
            @csrf
            <input type="hidden" name="start_time" id="start_time" value="{{ now()->timestamp }}">
            <input type="hidden" name="time" id="time_diff">
            <div class="main-wrapper">
                @foreach ($exam->question as $question)
                    <div class="question">
                        <input type="hidden" value="{{ $question->id }}" class="questionID" id="questionID{{ $question->id }}">
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
                            <input type="hidden" name="quizze" value="{{ $exam }}">
                            @php
                                $arr = ['A', 'B', 'C', 'D', 'E'];
                                $iter = $loop->iteration;
                            @endphp
                            @if ($question->ans_type == 'MCQ')
                                <div class="answer-chosen">
                                    <input name="q_answers[]" type="hidden" class="q_answers" value="{{ json_encode(['q_id' => $question->id]) }}" />
                                    @foreach ($question->mcq as $mcq)
                                        <div class="chosen chose_mcq chosen{{ $iter }}" id="chosen{{ $iter }}{{ $loop->iteration }}">
                                            <input type="hidden" class="mcq_id" value="{{ $mcq->id }}">
                                            <button type="button" class="ans_btn">{{ $mcq->mcq_num }}</button>
                                            <input type="text" value="{{ $mcq->mcq_ans }}" readonly>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <input name="q_grid_answers[]" type="hidden" class="q_grid_answers" value="{{ json_encode(['q_id' => $question->id]) }}" />
                                <div class="answer-setValue">
                                    <div class="section-setValue">
                                        <span>Answer:</span>
                                        <div class="input_val">
                                            <input type="text" step="0.001" value="0" class="gridVal" id="input_val" name="q_grid_ans[]">
                                        </div>
                                        <button style="font-size:20px;border-radius:100%;color:#fff" type="button" class="addSl">/</button>
                                        <button type="button" class="enterBtn">Enter</button>
                                    </div>
                                    <div class="section-value">
                                        <span>Preview:</span>
                                        <input type="number" id="preview_value" readonly>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-container">
                <ul class="pagination"></ul>
                <button class="btn-submit-quiz d-none" type="submit" aria-label="Submit Quiz">Submit Quiz</button>
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

    $(document).ready(function() {
        if (typeof $ === 'undefined') {
            console.error('jQuery is not loaded!');
        }

        $('#quizForm').on('submit', function(e) {
            console.log('Form submit triggered');
            const startTimeVal = $('#start_time').val();
            console.log('Start time:', startTimeVal);
            if (!startTimeVal) {
                console.error('Start time is missing or empty!');
                return;
            }
            const startTime = parseInt(startTimeVal) * 1000;
            const endTime = Date.now();
            const timeDiffSeconds = Math.floor((endTime - startTime) / 1000);
            const hours = Math.floor(timeDiffSeconds / 3600);
            const minutes = Math.floor((timeDiffSeconds % 3600) / 60);
            const seconds = timeDiffSeconds % 60;
            const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
            console.log('Formatted time:', formattedTime);
            $('#time_diff').val(formattedTime);
            console.log('Time diff set:', $('#time_diff').val());
        });

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
        });

        $(".angle-show-disc").click(function() {
            $('.disc-ruels-quizzes').toggleClass("d-none");
            $('.angle-show-disc').toggleClass("rotateEle");
        });

        $(".hide-btn").click(function() {
            $(".show-timer").addClass("d-none");
            $(".hide-timer").removeClass("d-none");
        });

        $(".show-btn").click(function() {
            $(".hide-timer").addClass("d-none");
            $(".show-timer").removeClass("d-none");
        });

        $(".btn-dropdown").click(function() {
            $('.options-list').toggleClass("d-none");
        });

        $(".options-list li").click(function() {
            $(".options-list").toggleClass("d-none");
        });

        $(document).on('click', '.addSl', function() {
            let container = $(this).closest('.answer-setValue');
            let input = container.find('.gridVal');
            let currentVal = input.val();
            if (currentVal && !currentVal.includes('/')) {
                input.val(currentVal + '/');
            }
        });

        $(document).on('click', '.enterBtn', calculateFraction);
        $(document).on('keypress', '.gridVal', function(e) {
            if (e.which === 13) calculateFraction();
        });

        function calculateFraction() {
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
            const rounded = Math.round(value * 100) / 100;
            if (rounded % 1 === 0) {
                return rounded.toString();
            }
            return rounded.toFixed(2);
        }

        $(".chosen").each((elePar, valPar) => {
            var staPar = elePar + 1;
            var elementPar = `.${$(valPar).attr("class").slice(0, 6) + staPar}`;
            $(elementPar).each((ele, val) => {
                var element = `#${$(val).attr("id")}`;
                $(element).click(() => {
                    $(elementPar).removeClass("selectedd");
                    $(element).addClass("selectedd");
                })
            })
        });

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
            var paginationSize = window.innerWidth <= 768 ? 3 : Math.ceil(numberOfItems / 3);
            var currentPage;

            function showPage(whichPage) {
                if (whichPage < 1 || whichPage > totalPages) return false;
                $(".question.active").removeClass("active");
                if (whichPage == totalPages) {
                    $(".btn-submit-quiz").removeClass("d-none");
                } else {
                    $(".btn-submit-quiz").addClass("d-none");
                }
                currentPage = whichPage;
                $(".question").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).addClass("active").show();
                $(".pagination li").remove();
                $(".pagination").append(
                    $("<li>").addClass("page-item").addClass("previous-page").append(
                        $("<a>").addClass("page-link").attr({
                            href: "javascript:void(0)",
                            "aria-label": "Previous"
                        }).html(
                            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>'
                        )
                    )
                );
                getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                    $("<li>").addClass("page-item").addClass("current-page")
                        .toggleClass("activee", item === currentPage).append($("<a>")
                            .addClass("page-link").attr({
                                href: "javascript:void(0)",
                                "aria-label": item ? `Page ${item}` : "More pages"
                            }).text(item || "...")).appendTo(".pagination");
                });
                $(".pagination").append(
                    $("<li>").addClass("page-item").addClass("next-page").append(
                        $("<a>").addClass("page-link").attr({
                            href: "javascript:void(0)",
                            "aria-label": "Next"
                        }).html(
                            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                        )
                    )
                );
                $(".previous-page").toggleClass("disabled", currentPage === 1);
                $(".next-page").toggleClass("disabled", currentPage === totalPages);
                return true;
            }

            $(".main-wrapper").show();
            showPage(1);

            $(document).on("click", ".pagination li.current-page:not(.activee)", function() {
                const pageText = $(this).text();
                if (pageText === '...') {
                    const pages = getPageList(totalPages, currentPage, paginationSize);
                    const dotsIndex = pages.indexOf('...');
                    if (dotsIndex === 1) {
                        return showPage(Math.floor(currentPage / 2));
                    } else {
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

            $(window).on('resize', function() {
                paginationSize = window.innerWidth <= 768 ? 3 : Math.ceil(numberOfItems / 3);
                showPage(currentPage || 1);
            });
        });
    });
</script>
