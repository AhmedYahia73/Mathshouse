
@php
    $page_name = 'Exam History';
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
        <th>PDF</th>
        <th>View Mistakes</th>
        <th>Recommendation</th>
    </thead>

    <tbody>
        @foreach( $exam_history as $element )
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$element->exams->title}}
            </td>
            <td>
                {{$element->date}}
            </td>
            <td>
                {{$element->score}}
            </td>
            <td>
            <a href="{{route('exam_mistake_pdf', ['id' => $element->id])}}" class="btn btn-primary mistake_btn">
                PDF
            </a>
            </td>
            <td>
            <a href="{{route('exam_mistakes', ['id' => $element->id])}}" class="btn btn-primary mistake_btn">
                View Mistakes
            </a>
            </td>
            <td>
            <button class="btn btn-primary recomm_btn">
                Recommendation
            </button>

<div class="app-email card my-3 reomm_questions d-none">
    <div class="border-0 p-0">
        <div class="row g-0  p-3 align-items-center">
            @php
                $arr_id = [];
                $ch_arr = [];
            @endphp
            @foreach ( $element->mistakes as $item )
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
                <hr/>
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
    let ans_item_btn = document.querySelectorAll('.ans_item_btn');
    let q_ans_item = document.querySelectorAll('.q_ans_item');
    let close_qiuzze_btn = document.querySelectorAll('.close_qiuzze_btn');
    let close_form_btn = document.querySelectorAll('.close_form_btn');

    for (let i = 0, end = ans_item_btn.length; i < end; i++) {
        ans_item_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == ans_item_btn[j] ) {
                    q_ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
    for (let i = 0, end = close_qiuzze_btn.length; i < end; i++) {
        close_qiuzze_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == close_qiuzze_btn[j] ) {
                    q_ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
    for (let i = 0, end = close_form_btn.length; i < end; i++) {
        close_form_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == close_form_btn[j] ) {
                    q_ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
</script>
<script>
    let reomm_questions = document.querySelectorAll('.reomm_questions');
    let recomm_btn = document.querySelectorAll('.recomm_btn');

    for (let i = 0, end = recomm_btn.length; i < end; i++) {
        recomm_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == recomm_btn[j] ) {
                    reomm_questions[j].classList.toggle('d-none');
                }
            }
        });
    }
</script>

@endsection

@include('Student.inc.footer')
