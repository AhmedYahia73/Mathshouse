@php
function fun_admin()
{
    return 'admin';
}
@endphp

<x-default-layout>

    @error('lesson_id')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('q_code')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('q_type')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('q_num')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('month')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('year')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('section')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('difficulty')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('question')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('ans_type')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
    @section('title', 'Questions')
    <input value="{{$exam_items}}" class="exam_input" type="hidden" />
    <form action="{{ route('ad_report_filter_question') }}" method="GET">
        <div class="modal-body scroll-y m-5">
            <div class="d-flex">
                <!--begin::Input group-->
                <div class="mb-5 fv-row w-300px mx-2">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Category Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="category_id" id="sel_Category" class="form-control sel_cate">
                        <option disabled selected>
                            Select Category
                        </option>
                        @foreach ($categories as $category)
                            <option  {{@$data['category_id'] == $category->id ? 'selected' : ''}} value="{{ $category->id }}">
                                {{ $category->cate_name }}
                            </option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <input type="hidden" class="categories" value="{{ $categories }}" />
                <input type="hidden" class="courses" value="{{ $courses }}" />
                <input type="hidden" class="chapters" value="{{ $chapters }}" />
                <input type="hidden" class="lessons" value="{{ $lessons }}" />
                <!--begin::Input group-->
                <div class="mb-5 fv-row w-300px mx-2">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Course Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="course_id" id="sel_course" class="form-control sel_course">
                        <option disabled selected>
                            Select Course
                        </option>
                        @foreach ($courses as $course)
                            @if( @$data['course_id'] == $course->id )
                            <option value="{{ $course->id }}" selected>
                                {{ $course->course_name }}
                            </option>
                            @elseif( @$data['category_id'] == $course->category_id )
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }}
                            </option>
                            @endif
                        @endforeach
                        
                    </select>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-5 fv-row w-300px mx-2">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Chapter Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="chapter_id" id="sel_chapter" class="form-control sel_chapter">
                        <option disabled selected>
                            Select Chapter
                        </option>
                        @foreach ($chapters as $chapter)
                            @if( @$data['chapter_id'] == $chapter->id )
                            <option value="{{ $chapter->id }}" selected>
                                {{ $chapter->chapter_name }}
                            </option>
                            @elseif( @$data['course_id'] == $chapter->course_id )
                            <option value="{{ $chapter->id }}">
                                {{ $chapter->chapter_name }}
                            </option>
                            @endif
                        @endforeach
                        {{-- @foreach ($chapters as $chapter)
                            <option value="{{ $chapter->id }}">
                                {{ $chapter->chapter_name }}
                            </option>
                        @endforeach --}}
                    </select>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-5 fv-row w-300px mx-2">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Lesson Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="lesson_id" id="sel_lesson" class="form-control sel_lesson">
                        <option disabled selected>
                            Select Lesson
                        </option>
                        @foreach ($lessons as $lesson)
                            @if( @$data['lesson_id'] == $lesson->id )
                            <option value="{{ $lesson->id }}" selected>
                                {{ $lesson->lesson_name }}
                            </option>
                            @elseif( @$data['chapter_id'] == $lesson->chapter_id )
                            <option value="{{ $lesson->id }}">
                                {{ $lesson->lesson_name }}
                            </option>
                            @endif
                        @endforeach
                        {{-- @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">
                                {{ $lesson->lesson_name }}
                            </option>
                        @endforeach --}}
                    </select>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <div class="d-flex align-items-center">
                <!--begin::Input group-->
                <div class="mb-5 fv-row w-300px mx-2">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Type</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="q_type" class="form-control">
                        <option disabled selected>
                            Select Type
                        </option>
                        <option {{@$data['q_type'] == 'Trail' ? 'selected' : ''}} value="Trail">
                            Trail
                        </option>
                        <option {{@$data['q_type'] == 'Parallel' ? 'selected' : ''}} value="Parallel">
                            Parallel
                        </option>
                        <option {{@$data['q_type'] == 'Extra' ? 'selected' : ''}} value="Extra">
                            Extra
                        </option>
                    </select>
                </div>
                <!--end::Input-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row w-300px mx-2">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Exam</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="exam_id" class="form-control exam_items">
                        <option disabled selected>
                            Select Exam
                        </option>
                        @foreach ( $exam_items as $item )
                            @if ( $item->id == @$data['exam_id'] )
                            <option value="{{$item->id}}" selected>
                                {{$item->title}}
                            </option>
                            @elseif( $item->course_id == @$data['course_id'] )
                            <option value="{{$item->id}}">
                                {{$item->title}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!--end::Input-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row w-300px mx-2">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Month</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    @php
                        $months = ['Jan', 'Fab', 'Mar', 'April', 'May', 'June', 'Jule',
                        'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
                    @endphp
                    <select name="month" class="form-control">
                        <option disabled selected>
                            Select Month
                        </option>
                        @foreach ($months as $key => $item)
                            @if ($key + 1 == @$data['month'])
                            <option value="{{$key + 1}}" selected>{{$item}}</option>
                            @else
                            <option value="{{$key + 1}}">{{$item}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!--end::Input-->
                <button class="btn btn-primary mt-3 mx-2">
                    Filter
                </button>
            </div> 
            <!--end::Input group--> 
        </div>
    </form>



    @if( isset($filter) )
        <form method="POST" action="{{route('exam_pdf')}}">
            @csrf
            <input type="hidden" name="questions" value="{{json_encode($questions)}}" />
            <button class="btn btn-success mx-5">
                Show PDF
            </button>
        </form>
    @endif


    <script>
        let sel_cate = document.querySelector('.sel_cate');
        let sel_course = document.querySelector('.sel_course');
        let sel_chapter = document.querySelector('.sel_chapter');
        let sel_lesson = document.querySelector('.sel_lesson');
        let categories = document.querySelector('.categories');
        let courses = document.querySelector('.courses');
        let chapters = document.querySelector('.chapters');
        let lessons = document.querySelector('.lessons');
        let exam_items = document.querySelector('.exam_items');
        let exam_input = document.querySelector('.exam_input');
        exam_input = exam_input.value;
        exam_input = JSON.parse(exam_input);
        courses = courses.value;
        courses = JSON.parse(courses);
        chapters = chapters.value;
        chapters = JSON.parse(chapters);
        lessons = lessons.value;
        lessons = JSON.parse(lessons);
        sel_cate.addEventListener('change', (e) => {
            sel_course.innerHTML = `                            
            <option disabled selected>
                Select Course
            </option>`;
            courses.forEach(element => {
                if (e.target.value == element.category_id) {
                    sel_course.innerHTML += `                            
            <option value="${element.id}">
                ${element.course_name}
            </option>`;

                }
            });
        });

        sel_course.addEventListener('change', (e) => {
            sel_chapter.innerHTML = `                            
            <option disabled selected>
                Select Chapter
            </option>`;
            chapters.forEach(element => {
                if (e.target.value == element.course_id) {
                    sel_chapter.innerHTML += `                            
            <option value="${element.id}">
                ${element.chapter_name}
            </option>`;

                }
            });
            exam_items.innerHTML = `                            
            <option disabled selected>
                Select Exam
            </option>`;
            exam_input.forEach(element => {
                if ( element.course_id == sel_course.value ) {
                    exam_items.innerHTML += `                            
                    <option value="${element.id}">
                        ${element.title}
                    </option>`;
                }
            });
        });

        sel_chapter.addEventListener('change', (e) => {
            sel_lesson.innerHTML = `                            
            <option disabled selected>
                Select Lesson
            </option>`;
            lessons.forEach(element => {
                if (e.target.value == element.chapter_id) {
                    sel_lesson.innerHTML += `                            
            <option value="${element.id}">
                ${element.lesson_name}
            </option>`;

                }
            });
        });


    </script>
    @section('script')
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <!--end::Vendors Javascript-->
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/create-campaign.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
        </script>

    @endsection
</x-default-layout>
