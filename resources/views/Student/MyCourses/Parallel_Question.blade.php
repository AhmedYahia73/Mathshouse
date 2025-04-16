@php
    $page_name = 'Quizze';
@endphp
@section('title', 'Quizze')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')
    <style>
        .modal.show .modal-dialog {
            max-width: 60% !important;
        }

        .imgModal {
            width: 70%;
            max-height: 500px;
            object-fit: cover;
            object-position: center;
            border-radius: 15px;
            border: 5px solid #CF202F;
        }
    </style>
    <main class="main_wrapper overflow-hidden">

        <!-- tution__section__start -->
        <div class="tution sp_bottom_100 sp_top_100">
            <div class="full__width__padding">
                @if (count($q_parallel) == 0)
                    <h2 class="text-danger text-center">
                        Parallel Question Is Empty.
                    </h2>
                @endif
                @foreach ($q_parallel as $question)
                    <a href="{{route('solve_parallel_question', $question->id)}}" class="btn btn-primary show_question_btn">
                        Show Parallel {{ $loop->iteration }}
                    </a>

                    <br><br><br>
                @endforeach

            </div>
        </div>
        <!-- tution__section__end -->



    </main>
    
@endsection

@include('Student.inc.footer')
