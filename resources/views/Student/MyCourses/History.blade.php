
@php
    $page_name = 'Quizze History';
@endphp
@section('title','Quizze History')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')

<table class="table">
    <thead>
        <th>#</th>
        <th>Date</th>
        <th>Quizze Details</th>
        <th>Quize</th>
        <th>Score</th>
        <th>Question No.</th>
        <th>Score Details</th>
        <th>Time</th>
        <th>Delay</th>
        <th>Action</th>
    </thead>

    <tbody>
        @foreach( $history as $item )
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->date}}
            </td>
            <td>
                Course : {{$item->lesson->chapter->course->course_name}}
                <br />
                Chapter : {{$item->lesson->chapter->chapter_name}}
                <br />
                Lesson : {{$item->lesson->lesson_name}}
                <br />
            </td>
            <td>
                {{$item->quizze->title}}
            </td>
            <td>
                {{$item->score}}/100
            </td>
            <td>
                {{count($item->quizze->question)}}
            </td>
            <td>
                Right: {{$item->r_questions}}
                <br />
                Wrong: {{count($item->quizze->question) - $item->r_questions}}
            </td>
            <td>
                {{$item->time}}
            </td>
            <th>{{$item->delay}}</th>
            <td>
            <a href="{{route('quizze_mistakes', ['id' => $item->id])}}" class="btn btn-primary mistake_btn">
                View Mistakes
            </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@include('Student.inc.footer')
