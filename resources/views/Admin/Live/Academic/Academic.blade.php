@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
    @section('title','Academic')
    @include('success')
    
    <form action="{{route('ad_filter_academic')}}" method="GET">
        <div class="d-flex my-3">
            <input type="hidden" value="{{ $categories }}" class="category" />
            <input type="hidden" value="{{ $courses }}" class="course" />
            <input type="hidden" value="{{ $chapters }}" class="chapter" />
            <input type="hidden" value="{{ $lessons }}" class="lesson" />

            <select name="category_id" class="form-control mx-2 sel_category">
             
                <option disabled selected>
                    Select Category ...
                </option>
                @foreach ( $categories as $category )
                    <option value="{{$category->id}}">
                        {{$category->cate_name}}
                    </option>
                @endforeach
            </select>

            <select name="course_id" class="form-control mx-2 sel_course">
                
                <option disabled selected>
                    Select Course ...
                </option>
            </select>

            <select name="chapter_id" class="form-control mx-2 sel_chapter">
               
                <option disabled selected>
                    Select Chapter ...
                </option>
            </select>

            <select name="lesson_id" class="form-control mx-2 sel_lesson">
                
                <option disabled selected>
                    Select Lesson ...
                </option>
            </select>
        </div>

        <div class="d-flex align-items-center my-3">
        
            <div class="mb-3 w-100 fv-row">
                <label>
                    Group
                </label>
                <div class=" mb-4 mb-md-0 my-2 px-3" data-select2-id="49">
                    <div class="select2-danger" data-select2-id="48">
                        <div class="position-relative" data-select2-id="47">
                            <select name="group_id[]" id="select1Danger" class="select2 form-select select2-hidden-accessible" multiple="" data-select2-id="select1Danger" tabindex="-1" aria-hidden="true">
                                @foreach( $groups as $group )
                                <option value="{{$group->id}}" data-select2-id="group{{$group->id}}">
                                    {{$group->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 w-100 fv-row">
                <label>
                    Students
                </label>
                <div class=" mb-4 mb-md-0 my-2 px-3" data-select2-id="46">
                    <div class="select2-danger" data-select2-id="45">
                        <div class="position-relative" data-select2-id="44">
                            <select name="user_id[]" id="select2Danger" class="select2 form-select select2-hidden-accessible" multiple="" data-select2-id="select2Danger" tabindex="-1" aria-hidden="true">
                                @foreach( $students as $user )
                                <option value="{{$user->id}}" data-select2-id="stu{{$user->id}}">
                                    {{$user->nick_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex my-3">
            
            <select name="state" class="form-control mx-2">
                @isset( $state_item )
                    <option value="{{$state_item['id']}}" selected>
                        {{$state_item['state']}}
                    </option>
                @endisset
                <option disabled selected>
                    Select State ...
                </option>
                <option value="attend">
                    Attendance
                </option>
                <option value="absence">
                    Absence
                </option>
            </select>

            <button class="btn btn-primary mx-2">
                Search
            </button>
        </div>
    </form>

    <script>
        let sel_category = document.querySelector('.sel_category');
        let sel_course = document.querySelector('.sel_course');
        let sel_chapter = document.querySelector('.sel_chapter');
        let sel_lesson = document.querySelector('.sel_lesson');
        let category = document.querySelector('.category');
        let course = document.querySelector('.course');
        let chapter = document.querySelector('.chapter');
        let lesson = document.querySelector('.lesson');
        course = course.value;
        course = JSON.parse(course);
        chapter = chapter.value;
        chapter = JSON.parse(chapter);
        lesson = lesson.value;
        lesson = JSON.parse(lesson);

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

        sel_course.addEventListener('change', () => {
            sel_chapter.innerHTML = `
            <option disabled selected>
                Select Chapter ...
            </option>`;
            chapter.forEach(element => {
                if (sel_course.value == element.course_id) {
                    sel_chapter.innerHTML += `
            <option value="${element.id}">
                ${element.chapter_name}
            </option>`;
                }
            });
        })

        sel_chapter.addEventListener('change', () => {
            sel_lesson.innerHTML = `
            <option disabled selected>
                Select Lesson ...
            </option>`;
            lesson.forEach(element => {
                if (sel_chapter.value == element.chapter_id) {
                    sel_lesson.innerHTML += `
                    <option value="${element.id}">
                        ${element.lesson_name}
                    </option>`;
                }
            });
        })
    </script>
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>

    <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('assets/js/forms-tagify.js')}}"></script>
    <script src="{{asset('assets/js/forms-typeahead.js')}}"></script>

</x-default-layout>