
@php
    $page_name = 'Diagnostic Exam History';
@endphp
@section('title','Chapters')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')

<style>
 .innerTr{
    display: flex;
    justify-content: space-between;
 }
 .innerTd{
    border-bottom:0
 }
 .inner_row{
    display: flex;
    justify-content: space-between;
 }

</style>

<table class="table">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Date</th>
        <th>Score</th>
        <th>Time</th>
        <th>PDF</th>
        <th>Report</th>
        <th>Recommendation</th>
    </thead>

    <tbody>
        @foreach( $dia_history as $item )
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->exams->title}}
            </td>
            <td>
                {{$item->date}}
            </td>
            <td>
                {{$item->score}}
            </td>
            <td>
                {{$item->time}}
            </td>
            <td>
                <a href="{{route('dia_exam_mistake_pdf', ['id' => $item->id])}}" class="btn btn-primary">
                    PDF
                </a>
            </td>
            <td>
                <a href="{{route('dia_exam_report_pdf', ['id' => $item->id])}}" class="btn btn-primary">
                    Report
                </a>
            </td>
            <td>
                <button class="btn btn-primary mistake_btn">
                    Recommendation
                </button>

                <div class="app-email card my-3 mistakes_questions d-none">
                    <div class="border-0">
                        <div class="row g-0  p-3 align-items-center">
                            @php
                                $arr_id = [];
                                $ch_arr = [];
                            @endphp
                            @foreach ( $item->mistakes as $item )
                            @if ( !isset($ch_arr[$item->question->lessons->chapter->chapter_name]) )
                            <table class="table">
                                <tr class="inner_row">
                                    <td>
                                    Chapter => {{$item->question->lessons->chapter->chapter_name}}
                                    </td>
                                    <td>
                                        <a href="{{route('buy_chapter', ['id' => $item->question->lessons->chapter->id])}}" class="btn btn-primary">
                                            Buy
                                        </a>
                                        @php
                                            $arr_id[] = $item->question->lessons->chapter->id;
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                            @endif
                            @php
                                $ch_arr[$item->question->lessons->chapter->chapter_name] = $item->question->lessons->chapter->chapter_name;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    let mistakes_questions = document.querySelectorAll('.mistakes_questions');
    let mistake_btn = document.querySelectorAll('.mistake_btn');
    let ans_item_btn = document.querySelectorAll('.ans_item_btn');
    let ans_item = document.querySelectorAll('.ans_item');

    for (let i = 0, end = ans_item_btn.length; i < end; i++) {
        ans_item_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == ans_item_btn[j] ) {
                    ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
    for (let i = 0, end = mistake_btn.length; i < end; i++) {
        mistake_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == mistake_btn[j] ) {
                    mistakes_questions[j].classList.toggle('d-none');
                }
            }
        });
    }
</script>
@endsection

@include('Student.inc.footer')
