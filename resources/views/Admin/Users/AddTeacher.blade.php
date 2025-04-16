 

@error('name')
    <div class="alert alert-danger">
    {{$message}}
    </div>
@enderror
@error('email')
    <div class="alert alert-danger">
    {{$message}}
    </div>
@enderror
@error('phone')
    <div class="alert alert-danger">
    {{$message}}
    </div>
@enderror
@error('course_id')
    <div class="alert alert-danger">
    {{$message}}
    </div>
@enderror

<a href="#" class="btn btn-primary er fs-6 px-8 py-4 my-2" data-bs-toggle="modal"
data-bs-target="#kt_modal_create_question">Add Teacher</a>
<!--end::Action-->

<div class="modal fade" id="kt_modal_create_question" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-fullscreen p-9">
        <!--begin::Modal content-->
        <div class="modal-content modal-rounded">
            <!--begin::Modal header-->
            <div class="modal-header py-7 d-flex justify-content-between">
                <!--begin::Modal title-->
                <h2>Add Teacher</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-5">
                <!--begin::Stepper-->
                <div class="stepper stepper-links d-flex flex-column" id="kt_modal_create_campaign_stepper">
               
                    <!--begin::Form-->
                    
                        <form class="px-3" action="{{route('add_teacher')}}" 
                        method="POST" enctype="multipart/form-data">
                        <!--begin::Step 1-->
                        <div class="current" data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                @csrf
                                <div>
                                    {{--  Page One --}}
                                <div class='my-3'>
                                    <label>Name</label>
                                    <input class='form-control' value="{{@$data['nick_name']}}" name="nick_name" placeholder="Name" />
                                </div>
                                <div class='my-3'>
                                    <label>E-mail</label>
                                    <input class='form-control' value="{{@$data['email']}}" name="email" placeholder="E-mail" />
                                </div>
                                <div class='my-3'>
                                    <label>Phone</label>
                                    <input class='form-control' value="{{@$data['phone']}}" name="phone" placeholder="Phone" />
                                </div>
                                
                                <div class="my-3">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                                        <span class="input-group-text">
                                        <i class="fa fa-eye" id="togglePassword" 
                                        style="cursor: pointer"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class='my-3'>
                                    <label>Category</label> 
                                    <div class="select2-danger" data-select2-id="33">
                                        <div class="position-relative" data-select2-id="443">
                                            <select id="select2Danger" name="category_id[]"
                                                class="select2 form-select sel_cate select2-hidden-accessible"
                                                multiple=""
                                                data-select2-id="select2Danger"
                                                tabindex="-1" aria-hidden="true">
                                                @foreach($categories as $category)
                                                @if ( isset($data['category_id']) && in_array($category->id, @$data['category_id']) )
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
                                        </div>
                                    </div>
                                </div>
                                <input class="categories" value="{{$categories}}" type="hidden" />
                                <input class="courses" value="{{$courses}}" type="hidden" />
                                <div class='my-3'>
                                    <label>Course</label>
                                    <div class="select2-danger" data-select2-id="33">
                                        <div class="position-relative" data-select2-id="443">
                                            <select id="select1Danger" name="course_id[]"
                                                class="select2 sel_course form-select select2-hidden-accessible"
                                                multiple=""
                                                data-select2-id="select1Danger"
                                                tabindex="-1" aria-hidden="true">
                                                @foreach($courses as $course)
                                                @if ( isset($data['course_id']) && in_array($course->id, @$data['course_id']) )
                                                <option value="{{$course->id}}" selected>
                                                    {{$course->course_name}}
                                                </option>
                                                @else
                                                <option value="{{$course->id}}">
                                                    {{$course->course_name}}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input class="form-control" type="file" name="image" />

                                    {{--  End Page One --}}
                                </div>
    
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-10">
                            <!--begin::Wrapper-->
                            <div class="me-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3"
                                    data-kt-stepper-action="previous">
                                    <i class="ki-duotone ki-arrow-left fs-3 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Back</button>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <div>
                                <button class="btn btn-lg btn-primary">
                                    Submit
                                </button>
                                <button class='btn btn-danger' type="reset">
                                    Clear
                                </button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--begin::Modal body-->
        </div>
    </div>
</div>
 
    @section('script')
        <script>
            <!--begin::Javascript
            -->
        <script>
            var hostUrl = "assets/";
        </script>
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
        <script src="assets/plugins/global/lessonSc.js"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/lessonSc.js') }}"></script>
    
    
        </script>
        <!--
                           The "super-build" of CKEditor&nbsp;5 served via CDN contains a large set of plugins and multiple editor types.
                           See https://ckeditor.com/docs/ckeditor5/latest/installation/getting-started/quick-start.html#running-a-full-featured-editor-from-cdn
                       -->
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/super-build/ckeditor.js"></script>
        <!--
                           Uncomment to load the Spanish translation
                           <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/super-build/translations/es.js"></script>
                       -->
       
<script>
    let sel_cate = document.querySelector('.sel_cate');
    let sel_course = document.querySelector('.sel_course');
    let courses = document.querySelector('.courses');
    courses = courses.value;
    courses = JSON.parse(courses);
    
    sel_cate.addEventListener('change', () => {
        sel_course.innerHTML = `
        <option disabled selected>
            Select Course
        </option>`;
        courses.forEach(element => {
            if ( sel_cate.value == element.category_id ) {
                sel_course.innerHTML += `
                <option value="${element.id}">
                    ${element.course_name}
                </option>`;
            }
        });
    });

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
   
  // toggle the type attribute
  const type = password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});
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