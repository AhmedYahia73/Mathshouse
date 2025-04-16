
@php
    $page_name = 'Live';
    use Carbon\Carbon;
    $iter = 1;
@endphp
@section('title','Live')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')

@include('success')

<form action="{{route('v_live')}}" method="GET">
<div class="d-flex my-3">
    <select class="form-control sel_category mx-2" name="category_id">
        <option disabled selected>
            Select Category ...
        </option>
        @foreach ( $categories as $category )
            @if ( @$data['category_id'] == $category->id )
            <option value="{{$category->id}}" selected>
                {{$category->cate_name}}
            </option>
            @else
            <option value="{{$category->id}}">
                {{$category->cate_name}}
            </option>
            @endif
        @endforeach
    </select>
    <select class="form-control mx-2 sel_course" name="course_id">
        <option disabled selected>
            Select Course ...
        </option>
        @foreach ( $courses as $course )
            @if( @$data['category_id'] == $course->category_id )
            @if ( @$data['course_id'] == $course->id )
            <option value="{{$course->id}}" selected>
                {{$course->course_name}}
            </option>
            @else
            <option value="{{$course->id}}">
                {{$course->course_name}}
            </option>
            @endif
            @endif
        @endforeach
    </select>
</div>
<div class="d-flex align-items-end my-3">
    <div class="mx-2" style="width: 50%">
        <label>
            From
        </label>
        <input type="date" name="from" value="{{@$data['from']}}" class="form-control" name="" id="">
    </div>
    <div class="mx-2" style="width: 50%">
        <label>
            To
        </label>
        <input type="date" name="to" value="{{@$data['to']}}" class="form-control" name="" id="">
    </div>
    <button class="btn btn-primary mx-2 px-4">
        Search
    </button>
</div>
<input type="hidden" value="{{ $categories }}" class="category" />
<input type="hidden" value="{{ $courses }}" class="course" />

</form>


<table class="table upcoming_tbl">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Date</th> 
        <th>Lesson</th> 
        <th>From</th> 
        <th>To</th>
        <th>Attend</th>
    </thead>

    <tbody>
        @foreach( $sessions as $item )
        @if ( $item->date >= now()->format('Y-m-d') )
        <tr>
            <td>{{$iter++}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->date}}</td>
            <td>{{$item->lesson_name}}</td>
            <td>{{$item->from}}</td>
            <td>{{$item->to}}</td>
            <td>
                <button class="btn btn-primary wallet_btn">
                    Attend 
                </button>

                @if ( $item->date == date('Y-m-d') && ( Carbon::now()->addMinutes(10)->format('H:i:s') >= $item->from ) )
                    
                <div class="modal show_wallet fade show d-none" id="modalCenter" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Session</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure to attend now ?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary close_wallet_btn" data-bs-dismiss="modal">
                            Close
                        </button>
                        <a class="btn btn-success" href="{{route('use_live', ['id' => $item->id])}}">
                            Start
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
                @else    
                <div class="modal show_wallet fade show d-none" id="modalCenter" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Session</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            You can't attend this session right now please come again later
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary close_wallet_btn" data-bs-dismiss="modal">
                            Close
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                @endif
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>


<script>
    let wallet_btn = document.querySelectorAll('.wallet_btn');
    let show_wallet = document.querySelectorAll('.show_wallet');
    let btn_close = document.querySelectorAll('.btn-close');
    let close_wallet_btn = document.querySelectorAll('.close_wallet_btn');

    for (let i = 0, end = wallet_btn.length; i < end; i++) {
        wallet_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == wallet_btn[j] ) {
                    show_wallet[j].classList.remove('d-none');
                }
            }
        })
        btn_close[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == show_wallet[j] ) {
                    show_wallet[j].classList.add('d-none');
                }
            }
        })
        close_wallet_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == close_wallet_btn[j] ) {
                    show_wallet[j].classList.add('d-none');
                }
            }
        })
    }
</script>

<script>
    let sel_category = document.querySelector('.sel_category');
    let sel_course = document.querySelector('.sel_course');
    let category = document.querySelector('.category');
    let course = document.querySelector('.course');
    course = course.value;
    course = JSON.parse(course);

    sel_category.addEventListener('change', () => {
        sel_course.innerHTML = `
        <option disabled selected>
            Select Course ...
        </option>`;
        course.forEach(element => {
            if (sel_category.value == element.category_id) {
                sel_course.innerHTML += `
                <option value="${element.id}">
                    ${element.course_name}
                </option>`;
            }
        });
    })
</script>

@endsection

@include('Student.inc.footer')
