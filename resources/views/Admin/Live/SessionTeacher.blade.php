@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
    @section('title', 'Teacher Session')
    @include('success')

<div class="my-3 d-flex justify-content-center">
    <button class="btn btn-primary upcoming_btn mx-2" style="width: 180px; height: 45px;">
        Upcoming
    </button>
    <button class="btn btn-primary history_btn mx-2" style="width: 180px; height: 45px;">
        History
    </button>
</div>

<div class="upcoming_tbl {{@$data['tbl_name'] == 'upcoming_tbl' ? '' : 'd-none'}}">
    <form method="GET" action="{{route('filter_teacher_session')}}"> 
        <input type="hidden" name="tbl_name" value="upcoming_tbl" />
        <div class="pb-2 d-flex">
            <select name="category_id" class="form-control sel_category mx-2">
                <option selected value="">
                    Select Category ...
                </option>
                @foreach ($categories as $category)
                    <option {{ @$data['category_id'] == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->cate_name }}
                    </option>
                @endforeach
            </select>
    
            <select name="course_id" class="form-control sel_course_items mx-2">
                <option selected value="">
                    Select Course ...
                </option>
                @foreach ($courses as $course)
                    @if (@$data['course_id'] == $course->id)
                        <option value="{{ $course->id }}" selected>
                            {{ $course->course_name }}
                        </option>
                    @elseif(@$data['category_id'] == $course->category_id)
                        <option value="{{ $course->id }}">
                            {{ $course->course_name }}
                        </option>
                    @endif
                @endforeach
            </select>
    
            <input type="hidden" value="{{ $courses }}" class="course" /> 
        </div>
           <div class="pb-2 d-flex">
            <select name="teacher_id" class="form-control mx-2">
                <option selected value="">
                    Select Teacher ...
                </option>
                @foreach ($teachers as $teacher)
                    <option {{ @$data['teacher_id'] == $teacher->id ? 'selected' : '' }} value="{{ $teacher->id }}">
                        {{ $teacher->nick_name }}
                    </option>
                @endforeach
            </select>
    
            <input type="date" name="date" value="{{@$data['date']}}" class="form-control" />
    
            <input type="hidden" value="{{ $courses }}" class="course" />
            <button class="btn btn-primary mx-2">
                Submit
            </button>
        </div>
        
    </form>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Teacher</th>
            <th>Name</th>
            <th>Date</th> 
            <th>From</th> 
            <th>To</th>
        </thead>

        <tbody>
            @foreach( $sessions as $item )
            @if ( $item->date >= now() )
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->teacher->nick_name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->date}}</td>
                <td>{{$item->from}}</td>
                <td>{{$item->to}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>


<div class="history_tbl {{@$data['tbl_name'] == 'history_tbl' ? '' : 'd-none'}}"">
    <form method="GET" action="{{route('filter_teacher_session')}}"> 
        <input type="hidden" name="tbl_name" value="history_tbl" />
        <div class="pb-2 d-flex">
            <select name="category_id" class="form-control sel_category mx-2">
                <option selected value="">
                    Select Category ...
                </option>
                @foreach ($categories as $category)
                    <option {{ @$data['category_id'] == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->cate_name }}
                    </option>
                @endforeach
            </select>

            <select name="course_id" class="form-control sel_course_items mx-2">
                <option selected value="">
                    Select Course ...
                </option>
                @foreach ($courses as $course)
                    @if (@$data['course_id'] == $course->id)
                        <option value="{{ $course->id }}" selected>
                            {{ $course->course_name }}
                        </option>
                    @elseif(@$data['category_id'] == $course->category_id)
                        <option value="{{ $course->id }}">
                            {{ $course->course_name }}
                        </option>
                    @endif
                @endforeach
            </select>

            <input type="hidden" value="{{ $courses }}" class="course" /> 
        </div>
        <div class="pb-2 d-flex">
            <select name="teacher_id" class="form-control sel_category mx-2">
                <option selected value="">
                    Select Teacher ...
                </option>
                @foreach ($teachers as $teacher)
                    <option {{ @$data['teacher_id'] == $teacher->id ? 'selected' : '' }} value="{{ $teacher->id }}">
                        {{ $teacher->nick_name }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{@$data['date']}}" class="form-control" />

            <input type="hidden" value="{{ $courses }}" class="course" />
            <button class="btn btn-primary mx-2">
                Submit
            </button>
        </div>
        
    </form>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Teacher</th>
            <th>Name</th>
            <th>Date</th> 
            <th>From</th> 
            <th>To</th>
            <th>Statue</th>
        </thead>

        <tbody>
            @foreach( $sessions as $item )
            @if ( $item->date <= now() )
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->teacher->nick_name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->date}}</td>
                <td>{{$item->from}}</td>
                <td>{{$item->to}}</td>
                <td>
                    @php
                        $attend = false;   
                    @endphp
                    @foreach ( $item->users_attend as $element )
                        @if ( $element->position == 'teacher' )
                        @php
                            $attend = true;
                        @endphp
                        @endif
                    @endforeach
                    {{$attend ? 'Attend' : 'Missed'}}
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

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
    let upcoming_btn = document.querySelector('.upcoming_btn');
    let history_btn = document.querySelector('.history_btn');
    let upcoming_tbl = document.querySelector('.upcoming_tbl');
    let history_tbl = document.querySelector('.history_tbl');

    upcoming_btn.addEventListener('click', () => {
        console.log(7685);
        upcoming_tbl.classList.toggle('d-none');
        history_tbl.classList.add('d-none');
    });

    history_btn.addEventListener('click', () => {
        console.log(786);
        history_tbl.classList.toggle('d-none');
        upcoming_tbl.classList.add('d-none');
    });
</script>
<script>
    let sel_category = document.querySelector('.sel_category');
    let sel_course_items = document.querySelector('.sel_course_items');
    let course = document.querySelector('.course');
    course = course.value;
    course = JSON.parse(course);

    sel_category.addEventListener('change', () => {
        sel_course_items.innerHTML = `
    <option selected value="">
        Select Course ...
    </option>`;
        course.forEach(element => {
            if (sel_category.value == element.category_id) {
                sel_course_items.innerHTML += `
      <option value="${element.id}">
          ${element.course_name}
      </option>`;
            }
        });
    })
</script>

</x-default-layout>
