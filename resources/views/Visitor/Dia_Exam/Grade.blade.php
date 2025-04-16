@php
$page_name = 'Grade';
@endphp
@section('title', 'Lessons')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')
<style>
    .table {
        background: #fff !important;
    }

    .table td {
        font-weight: 600;
        color: #787878 !important;
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

<div class="app-email card my-3">
    <div class="border-0">
        <div class="row g-0">


            <!-- Emails List -->
            <div class="col app-emails-list">
                <div class="card shadow-none border-0">
                    <div class="card-body emails-list-header p-3 py-lg-3 py-2">
                        <!-- Email List: Search -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center w-100">
                                <i class="bx bx-menu bx-sm cursor-pointer d-block d-lg-none me-3"
                                    data-bs-toggle="sidebar" data-target="#app-email-sidebar" data-overlay=""></i>
                                <div class="mb-0 mb-lg-2 w-100">
                                    <div class="d-flex justify-content-center">
                                        @if ($grade)
                                        <button class="btn btn-success">
                                            Success
                                        </button>
                                        @else
                                        <button class="btn btn-danger">
                                            Faild
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mx-n3 emails-list-header-hr">
                        <!-- Email List: Actions -->


                        <!-- Email View -->
                        <div class="col app-email-view flex-grow-0 bg-body" id="app-email-view">

                            <table class="table">
                                <tr>
                                    <td>Diagnostic Exam : </td>
                                    <td>{{ $exam->title }}</td>
                                </tr>
                                <tr>
                                    <td>Score : </td>
                                    <td>{{ $score }} </td>
                                </tr>
                                <tr>
                                    <td>Total Question : </td>
                                    <td>{{ $total_question }}</td>
                                </tr>
                                <tr>
                                    <td>Right Question : </td>
                                    <td>{{ $right_question }}</td>
                                </tr>
                                <tr>
                                    <td>Wrong Question : </td>
                                    <td>{{ $total_question - $right_question }}</td>
                                </tr>
                                <tr>
                                    <td>Daily Time : </td>
                                    <td>
                                        @if ($studentDiaExam->exam->time <= $exam->time)
                                            <span style="color: green">
                                                +{{ $studentDiaExam->exam->daily}}
                                                <br>
                                                Student solution time : - {{ date('i:s',

                                                strtotime($studentDiaExam->exam->time)) }}
                                            </span>
                                            @else
                                            <span style="color: red">
                                                -{{ $studentDiaExam->exam->daily}}
                                                <br>
                                                Student solution time : - {{ date('i:s',

                                                strtotime($studentDiaExam->exam->time)) }}
                                            </span>
                                            @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="d-flex justify-content-center">
                                        <button id="scrollButton" class="btn btn-danger mx-2 mistake_btn">
                                            Recommendation
                                        </button>
                                        <a href="{{route('dia_exam_mistake_pdf', ['id' => $dia_id])}}"
                                            class="btn btn-danger">
                                            PDF
                                        </a>
                                        <a href="{{route('dia_exam_report_pdf', ['id' => $dia_id])}}"
                                            class="btn btn-danger mx-2">
                                            Report
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="app-email card my-3 mistakes_questions d-none">
    <div class="border-0">
        <div class="row g-0  p-3 align-items-center">
            @php
            $arr_id = [];
            $arr = [];
            @endphp
            @foreach ( $mistakes as $item )
            @php
            $arr[$item->lessons->chapter->id] = $item;
            @endphp
            @endforeach


            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12  mt-2">
                    <thead>
                        <tr>
                            <th class="col-6" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Chapter Name</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($arr as $item)
                        <tr>
                            <td style="text-align: start !important">{{ $item->lessons->chapter->chapter_name }}
                            </td>
                            <td style="text-align: start !important"> <a
                                    href="{{ route('buy_chapter', ['id' => $item->lessons->chapter->id]) }}"
                                    class="conBtn">
                                    Buy
                                </a>
                                @php
                                $arr_id[] = $item->lessons->chapter->id;
                                @endphp</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <form action="{{ route('dia_buy_chapters') }}" method="POST">
                @csrf
                <input type="hidden" name="ids" value="{{ json_encode($arr_id) }}" />
                <button class="conBtn">
                    Buy All
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    let mistakes_questions = document.querySelector('.mistakes_questions');
        let mistake_btn = document.querySelector('.mistake_btn');
        let ans_item_btn = document.querySelectorAll('.ans_item_btn');
        let ans_item = document.querySelectorAll('.ans_item');

        for (let i = 0, end = ans_item_btn.length; i < end; i++) {
            ans_item_btn[i].addEventListener('click', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == ans_item_btn[j]) {
                        ans_item[j].classList.toggle('d-none');
                    }
                }
            })
        }
        mistake_btn.addEventListener('click', () => {
            mistakes_questions.classList.toggle('d-none');
        })
</script>

<script>
    // JavaScript to scroll to the end
    document.getElementById("scrollButton").onclick = function () {
        window.scrollTo(0, document.body.scrollHeight);
    }
</script>
@endsection

@include('Student.inc.footer')