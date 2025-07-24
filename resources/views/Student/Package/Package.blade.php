
@php
    $page_name = 'My Packages';
@endphp
@section('title','My Packages')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')
    <!-- Page CSS -->

    <div class="row g-4 my-4">
        <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                <span>Question</span>
                <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{$questions}}</h4>
                </div>

                    <!-- زر عرض التفاصيل -->
                    <button class="btn btn-outline-primary my-1 toggle-details" data-target="#question-details3">
                        <i class="fa fa-eye"></i> View Details
                    </button>

                    <!-- تفاصيل مخفية -->
                    <div id="question-details3" class="mt-2 d-none">
                        <ul class="list-unstyled">
                            @foreach ($question_details as $item)
                                <li>
                                    Course : {{ $item['course'] }}
                                </li>
                                <li>
                                    Number : {{ $item['number'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                <a href="{{route('q_package')}}" class="btn btn-danger my-2">
                    <i class="fa fa-plus"></i>
                    Add New Package 
                </a>
                </div>
                <span class="badge bg-label-primary rounded p-2">
                <i class="bx bx-user bx-sm"></i>
                </span>
            </div>
            </div>
        </div>
        </div>
        <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                <span>Exams</span>
                <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{$exam}}</h4>
                </div>

                    <!-- زر عرض التفاصيل -->
                    <button class="btn btn-outline-primary my-1 toggle-details" data-target="#question-details1">
                        <i class="fa fa-eye"></i> View Details
                    </button>

                    <!-- تفاصيل مخفية -->
                    <div id="question-details1" class="mt-2 d-none">
                        <ul class="list-unstyled">
                            @foreach ($exam_details as $item)
                                <li>
                                    Course : {{ $item['course'] }}
                                </li>
                                <li>
                                    Number : {{ $item['number'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                <a href="{{route('e_package')}}" class="btn btn-danger my-2">
                    <i class="fa fa-plus"></i>
                    Add New Package 
                </a>
                </div>
                <span class="badge bg-label-danger rounded p-2">
                <i class="bx bx-user-plus bx-sm"></i>
                </span>
            </div>
            </div>
        </div>
        </div>
        <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                <span>Live</span>
                <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{$live}}</h4>
                </div>

                    <!-- زر عرض التفاصيل -->
                    <button class="btn btn-outline-primary my-1 toggle-details" data-target="#question-details2">
                        <i class="fa fa-eye"></i> View Details
                    </button>

                    <!-- تفاصيل مخفية -->
                    <div id="question-details2" class="mt-2 d-none">
                        <ul class="list-unstyled">
                            @foreach ($live_details as $item)
                                <li>
                                    Course : {{ $item['course'] }}
                                </li>
                                <li>
                                    Number : {{ $item['number'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                <a href="{{route('live_package')}}" class="btn btn-danger my-2">
                    <i class="fa fa-plus"></i>
                    Add New Package 
                </a>
                </div>
                <span class="badge bg-label-success rounded p-2">
                <i class="bx bx-group bx-sm"></i>
                </span>
            </div>
            </div>
        </div>
        </div> 
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-details').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const target = document.querySelector(this.dataset.target);
                if (target.classList.contains('d-none')) {
                    target.classList.remove('d-none');
                    this.innerHTML = '<i class="fa fa-eye-slash"></i> Hide Details';
                } else {
                    target.classList.add('d-none');
                    this.innerHTML = '<i class="fa fa-eye"></i> View Details';
                }
            });
        });
    });
</script>

@endsection

@include('Student.inc.footer')