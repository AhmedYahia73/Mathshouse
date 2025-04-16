
@php
    $page_name = 'Question History';
@endphp
@section('title','Chapters')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')

<table class="table">
    <thead>
        <th>#</th>
        <th>Year</th>
        <th>Month</th> 
        <th>Section</th> 
        <th>Code</th>
        <th>Answer</th>
        <th>Time</th>
        <th>Mistakes</th>
    </thead>

    <tbody>
        @foreach( $q_history as $item )
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->question->year}}
            </td>
            <td>
                {{$item->question->month}}
            </td>
            <td>
                {{$item->question->section}}
            </td>
            <td>
                {{$item->question->q_code}}
            </td>
            <td>
                {{$item->answer ? 'True' : 'False'}}
            </td>
            <td>
                {{$item->time}}
            </td> 
            <td>
                @if ( !$item->answer )
                <a href="{{route('question_mistakes', ['id' => $item->id])}}" class="btn btn-primary mistake_btn">
                    View Mistakes
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@include('Student.inc.footer')
