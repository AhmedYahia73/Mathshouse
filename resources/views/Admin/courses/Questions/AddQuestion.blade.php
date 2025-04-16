 @php
     function fun_admin()
     {
         return 'admin';
     }
 @endphp

 <style>
     #container {
         width: 1000px;
         margin: 20px auto;
     }

     .ck-editor__editable[role="textbox"] {
         /* editing area */
         min-height: 200px;
     }

     .ck-content .image {
         /* block images */
         max-width: 80%;
         margin: 20px auto;
     }

     .screen {
         position: fixed;
         height: 100vh;
         width: 100vw;
         top: 0;
         left: 0;
         background-color: #000000cc;
         display: flex;
         align-items: center;
         justify-content: center;
         z-index: 111111;
     }

     .screen_popup {
         height: 300px;
         width: 300px;
         background-color: #fff;
         padding: 30px;
         position: relative;
     }

     .screen_popup img {
         width: 200px;
         height: 200px;
         border-radius: 50%;
         border: 1px solid #ccc;
     }

     .screen_text {
         color: red;
         font-weight: bold;
     }

     .close_btn {
         position: absolute;
         top: 20px;
         right: 20px;
         cursor: pointer;
     }

     .newAnswer {
         display: flex;
         align-items: center;
         justify-content: flex-end;
     }

     .addNewAnswer {
         border: none;
         background: #1b84ff;
         color: #fff;
         padding: 10px;
         border-radius: 8px;
         font-weight: 600;
         cursor: pointer;
     }

     .removeNewAnswer,
     .removeLastAnswer {
         border: none;
         background: red;
         color: #fff;
         padding: 10px;
         border-radius: 8px;
         font-weight: 600;
         cursor: pointer;
     }

     .faildDes,
     .faildImage,
     .faildAnswer,
     .faildTypeMcq,
     .faildTypeGrid,
     .faildDiff,
     .faildType,
     .faildCategory,
     .faildCourse,
     .faildChapter,
     .faildLesson,
     .faildYear,
     .faildMonth,
     .faildNum,
     .faildPdf,
     .faildVideo {
         display: block;
         color: red;
         font-weight: 500;
         font-size: 1.2rem;
         margin-top: 5px !important;
     }
 </style>


 <div class="screen d-none">
     <div class="screen_popup">
         <img src="{{ asset('images/inc/1.jpg') }}" />
         <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
             <i class="ki-duotone close_btn ki-cross fs-1">
                 <span class="path1"></span>
                 <span class="path2"></span>
             </i>
         </div>
         <div class="screen_text"></div>
     </div>
 </div>

 <!--begin::Action-->
 @include('success')
 <!--end::Action-->

 <div class="modal fade" id="kt_modal_create_question" tabindex="-1" aria-hidden="true">
     <!--begin::Modal dialog-->
     <div class="modal-dialog modal-fullscreen p-9">
         <!--begin::Modal content-->
         <div class="modal-content modal-rounded">
             <!--begin::Modal header-->
             <div class="modal-header py-7 d-flex justify-content-between">
                 <!--begin::Modal title-->
                 <h2>Add Question</h2>
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
                     <!--begin::Nav-->
                     <div class="stepper-nav justify-content-center py-2">
                         <!--begin::Step 1-->
                         <div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
                             <h3 class="stepper-title">Info</h3>
                         </div>
                         <!--end::Step 1-->
                         <!--begin::Step 2-->
                         <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                             <h3 class="stepper-title">Details</h3>
                         </div>
                         <!--end::Step 2-->
                         <!--begin::Step 3-->
                         <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                             <h3 class="stepper-title">Answer</h3>
                         </div>
                         <!--end::Step 3-->
                     </div>
                     <!--end::Nav-->
                     <!--begin::Form-->
                     <form action="{{ route('add_q') }}" method="POST" enctype="multipart/form-data"
                         class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate"
                         id="kt_modal_create_campaign_stepper_form">
                         <!--begin::Step 1-->
                         <div class="current" data-kt-stepper-element="content">
                             <!--begin::Wrapper-->
                             <div class="w-100">
                                 @csrf
                                 <div>
                                     <!--begin::Input group-->
                                     <div class="mb-5 fv-row">
                                         <!--begin::Label-->
                                         <label class="required form-label mb-3">Question</label>
                                         <!--end::Label-->

                                         <!--begin::Input-->
                                         <textarea id="editor" value="{{ old('question') }}" name="question" class="form-control" required></textarea>
                                         <!--end::Input-->
                                         <span class="faildDes d-none">Please Enter Question</span>
                                     </div>
                                     <!--end::Input group-->
                                     <!--begin::Input group-->
                                     <div class="mb-5 fv-row">
                                         <!--begin::Label-->
                                         <label class="required form-label mb-3">Question Image</label>
                                         <!--end::Label-->
                                         <!--begin::Input-->
                                         <input name="q_url" value="{{ old('q_url') }}" type="file"
                                             class="form-control questionImage" />
                                         <!--end::Input-->
                                         <span class="faildImage d-none">Please Enter Question Image</span>
                                     </div>
                                     <!--end::Input group-->
                                     <!--begin::Input group-->
                                     <div class="mb-5 fv-row">
                                         <!--begin::Label-->
                                         <label class="required form-label mb-3">Answer Type</label>
                                         <!--end::Label-->
                                         <!--begin::Input-->
                                         <select class="form-control ans_type" name="ans_type">
                                             <option value="">
                                                 Select Answer Type
                                             </option>
                                             <option value="MCQ">
                                                 MCQ
                                             </option>
                                             <option value="Grid_in">
                                                 Grid in
                                             </option>
                                         </select>
                                         <!--end::Input-->
                                         <span class="faildAnswer d-none">Please Enter Answer Type</span>
                                         <span class="faildTypeMcq d-none">Please Choose The Answer</span>
                                     </div>

                                     <div class="d-flex add_ans d-none"
                                         style="align-items: flex-start;justify-content: space-between">
                                         <div class="allAnswer"
                                             style="width: 100%; display: flex;flex-direction: column;">
                                             <input type="number" class="form-control answerGrid"
                                                 value="{{ old('grid_ans[]') }}" style="width: 100%;" name="grid_ans[]"
                                                 placeholder="Answer" />
                                         </div>
                                         <button type="button" class="btn add_ans_btn btn-success mx-2"
                                             style="margin: 0;height: 100% !important;">Add</button>
                                     </div>
                                     <div class="mb-5 fv-row ans_div_Mcq d-none">
                                     </div>
                                     <div class="fv-row ans_div_Grid d-none">
                                     </div>
                                     <span class="faildTypeGrid d-none">Please Enter The Answer</span>

                                     <!--end::Input group-->
                                     <!--begin::Input group-->
                                     <div class="mb-5 fv-row">
                                         <!--begin::Label-->
                                         <label class="required form-label mb-3">Difficulty</label>
                                         <!--end::Label-->
                                         <!--begin::Input-->
                                         <select class="form-control difficulty" name="difficulty">
                                             <option value="">
                                                 Select Difficulty
                                             </option>
                                             <option value="A">
                                                 A
                                             </option>
                                             <option value="B">
                                                 B
                                             </option>
                                             <option value="C">
                                                 C
                                             </option>
                                             <option value="D">
                                                 D
                                             </option>
                                             <option value="E">
                                                 E
                                             </option>
                                         </select>
                                         <!--end::Input-->
                                         <span class="faildDiff d-none">Please Enter Difficulty</span>
                                     </div>
                                     <div class="mb-5 fv-row">
                                         <!--begin::Label-->
                                         <label class="required form-label mb-3">Question Type</label>
                                         <!--end::Label-->
                                         <!--begin::Input-->
                                         <select class="form-control q_type" name="q_type">
                                             <option value="">
                                                 Select Question Type
                                             </option>
                                             <option value="Trail">
                                                 Trail
                                             </option>
                                             <option value="Parallel">
                                                 Parallel
                                             </option>
                                             <option value="Extra">
                                                 Extra
                                             </option>
                                         </select>
                                         <!--end::Input-->
                                         <span class="faildType d-none">Please Enter Question Type</span>
                                     </div>
                                     <!--end::Input group-->
                                 </div>

                             </div>
                             <!--end::Wrapper-->
                         </div>
                         <!--end::Step 1-->
                         <!--begin::Step 2-->
                         <div data-kt-stepper-element="content">
                             <!--begin::Wrapper-->
                             <div class="w-100">

                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Category</label>
                                     <!--End::Label-->

                                     <!--begin::Input-->
                                     <select class="form-control sel_category2" name="category_id">
                                         <option value="">
                                             Select Category
                                         </option>
                                         @foreach ($categories as $category)
                                             <option value="{{ $category->id }}">
                                                 {{ $category->cate_name }}
                                             </option>
                                         @endforeach
                                     </select>
                                     <!--end::Input-->
                                     <span class="faildCategory d-none">Please Enter Category</span>
                                 </div>
                                 <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Course</label>
                                     <!--End::Label-->

                                     <!--begin::Input-->
                                     <select class="form-control sel_my_course2" name="course_id">
                                         <option value="">
                                             Select Course
                                         </option>
                                     </select>
                                     <!--end::Input-->
                                     <span class="faildCourse d-none">Please Enter Course</span>
                                 </div>
                                 <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Chapter</label>
                                     <!--End::Label-->

                                     <!--begin::Input-->
                                     <select class="form-control sel_my_chapter2" name="chapter_id">
                                         <option value="">
                                             Select Chapter
                                         </option>
                                     </select>
                                     <!--end::Input-->
                                     <span class="faildChapter d-none">Please Enter Chapter</span>
                                 </div>
                                 <!--end::Input group-->

                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Lesson</label>
                                     <!--begin::Input-->
                                     <select class="form-control sel_my_lesson2" name="lesson_id">
                                         <option value="">
                                             Select Lesson
                                         </option>
                                     </select>
                                     <!--end::Input-->
                                     <span class="faildLesson d-none">Please Enter Lesson</span>
                                 </div>
                                 <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Year</label>
                                     <!--End::Label-->

                                     <!--begin::Input-->
                                     <select class="form-control year" name="year">
                                         <option value="">
                                             Select Year
                                         </option>
                                         @for ($i = 2000; $i <= date('Y'); $i++)
                                             <option value="{{ $i }}">
                                                 {{ $i }}
                                             </option>
                                         @endfor
                                     </select>
                                     <!--end::Input-->
                                     <span class="faildYear d-none">Please Enter Year</span>
                                 </div>
                                 <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Month</label>
                                     <!--End::Label-->

                                     <!--begin::Input-->
                                     <select class="form-control month" name="month">
                                         <option value="">
                                             Select Month ...
                                         </option>
                                         <option value="1">Jan</option>
                                         <option value="2">Fab</option>
                                         <option value="3">Mar</option>
                                         <option value="4">April</option>
                                         <option value="5">May</option>
                                         <option value="6">June</option>
                                         <option value="7">July</option>
                                         <option value="8">Aug</option>
                                         <option value="9">Sept</option>
                                         <option value="10">Oct</option>
                                         <option value="11">Nov</option>
                                         <option value="12">Dec</option>
                                     </select>
                                     <!--end::Input-->
                                     <span class="faildMonth d-none">Please Enter Month</span>
                                 </div>
                                 <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Code</label>
                                     <!--End::Label-->

                                     <!--begin::Input-->
                                     <select name="q_code" class="form-control ques_code">
                                         <option value="">Select Exam Code</option>
                                         @foreach ($exams as $exam)
                                             <option value="{{ $exam->id }}">{{ $exam->exam_code }}</option>
                                         @endforeach
                                     </select>
                                     <!--end::Input-->
                                 </div>
                                 <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Section</label>
                                     <!--begin::Input-->
                                     <select class="form-control section" name="section">
                                         <option value="">
                                             Select Section
                                         </option>
                                         <option value="1">
                                             1
                                         </option>
                                         <option value="2">
                                             2
                                         </option>
                                         <option value="3">
                                             3
                                         </option>
                                         <option value="4">
                                             4
                                         </option>
                                     </select>
                                     <!--end::Input-->
                                 </div>
                                 <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                     <!--begin::Label-->
                                     <label class="fs-6 fw-semibold mb-2">Question Num</label>
                                     <!--End::Label-->

                                     <!--begin::Input-->
                                     <input type="number" value="{{ old('q_num') }}" min="0"
                                         max="80" class="form-control q_num" name="q_num"
                                         placeholder="Question Num" required />
                                     <!--end::Input-->
                                     <span class="faildNum d-none">Please Enter Question Num</span>
                                 </div>
                                 <!--end::Input group-->

                             </div>
                             <!--end::Wrapper-->
                         </div>
                         <!--end::Step 2-->
                         <!--begin::Step 5-->
                         <div data-kt-stepper-element="content">
                             <!--begin::Wrapper-->
                             <div class="w-100">
                                 <!--begin::Heading-->
                                 <div class="pb-10 pb-lg-12">
                                     <!--begin::Title-->
                                     <h1 class="fw-bold text-gray-900">Answers</h1>
                                     <!--end::Title-->
                                     <!--begin::Description-->
                                     <div class="text-muted fw-semibold fs-2 d-flex align-items-center">
                                         <div class="section_add_idea" style="margin-left:15px ">
                                             <button id="add_new_idea" type="button"
                                                 class="my-3 btn_add btn btn-lg btn-primary d-inline-block">Add New
                                                 Answer</button>
                                         </div>
                                     </div>
                                     <!--end::Description-->
                                 </div>
                                 <!--end::Heading-->
                                 <!--begin::Input group-->
                                 <div class="ideas" id="ideas">
                                     <div class="idea">
                                         <div class="section_idea">
                                             <span>Answer PDF</span>
                                             <input type="file" name="ans_pdf[]" class="form-control questionPdf">
                                             <span class="faildPdf d-none">Please Enter Answer PDF</span>
                                         </div>
                                         <div class="section_syllabus">
                                             <span>Answer Video</span>
                                             <input name="ans_video[]" class="form-control questionVideo">
                                             <span class="faildVideo d-none">Please Enter Answer Video</span>
                                         </div>
                                     </div>
                                     <hr />
                                 </div>
                             </div>
                             <!--end::Wrapper-->
                         </div>

                         <!--end::Step 5-->
                         <!--begin::Actions-->
                         <div class="d-flex flex-stack pt-10">
                             <!--begin::Wrapper-->
                             <div class="me-2">
                                 <button type="button" class="btn btn-lg btn-light-primary me-3 btnBack"
                                     data-kt-stepper-action="previous">
                                     <i class="ki-duotone ki-arrow-left fs-3 me-1">
                                         <span class="path1"></span>
                                         <span class="path2"></span>
                                     </i>Back</button>
                             </div>
                             <!--end::Wrapper-->
                             <!--begin::Wrapper-->
                             <div>
                                 <button class="btn btn-lg btn-primary subBtn d-none ">
                                     Submit
                                 </button>
                                 <button type="button" class="btn btn-lg btn-primary continue_btn disabled"
                                     data-kt-stepper-action="next">Continue
                                     <i class="ki-duotone ki-arrow-right fs-3 ms-1 me-0">
                                         <span class="path1"></span>
                                         <span class="path2"></span>
                                     </i></button>
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
         /* select category, courses, chapter, lesson */

         let sel_category2 = document.querySelector('.sel_category2');
         let sel_my_course2 = document.querySelector('.sel_my_course2');
         let sel_my_chapter2 = document.querySelector('.sel_my_chapter2');
         sel_category2.addEventListener('change', (e) => {
             sel_my_course2.innerHTML = `
        <option value="">
            Select Course
        </option>`;
             courses.forEach(element => {
                 if (e.target.value == element.category_id) {
                     sel_my_course2.innerHTML += `
                <option value="${element.id}">
                    ${element.course_name}
                </option>`;

                 }
             });
         });
         sel_my_course2.addEventListener('change', (e) => {
             sel_my_chapter2.innerHTML = `
        <option value="">
            Select Chapter
        </option>`;
             chapters.forEach(element => {
                 if (e.target.value == element.course_id) {
                     sel_my_chapter2.innerHTML += `
                <option value="${element.id}">
                    ${element.chapter_name}
                </option>`;

                 }
             });
         });
         sel_my_chapter2.addEventListener('change', (e) => {
             sel_my_lesson2.innerHTML = `
        <option value="">
            Select Lesson
        </option>`;
             lessons.forEach(element => {
                 if (e.target.value == element.chapter_id) {
                     sel_my_lesson2.innerHTML += `
                <option value="${element.id}">
                    ${element.lesson_name}
                </option>`;

                 }
             });
         });

         /* Select year, Month, section, Question Num*/

         let continue_btn = document.querySelector('.continue_btn');
         let q_num = document.querySelector('.q_num');
         let year = document.querySelector('.year');
         let month = document.querySelector('.month');
         let section = document.querySelector('.section');
         let sel_my_lesson2 = document.querySelector('.sel_my_lesson2');
         let q_type = document.querySelector('.q_type');
         let ques_code = document.querySelector('.ques_code');
         let close_btn = document.querySelector('.close_btn');
         let screen = document.querySelector('.screen');
         let screen_text = document.querySelector('.screen_text');

         close_btn.addEventListener('click', () => {
             screen.classList.add('d-none');
         });

         continue_btn.addEventListener('click', () => {
             if ($('.q_num').val() != "") {
                 let obj = {
                     'year': year.value,
                     'month': month.value,
                     'section': section.value,
                     'q_num': q_num.value,
                     'q_type': q_type.value,
                     'q_code': ques_code.value,
                     'lesson' : sel_my_lesson2.value,
                     '_token': "{{ csrf_token() }}"
                 };
                 console.log(obj);
                 $.ajax({
                     url: "{{ route('question_type') }}",
                     type: 'POST',
                     data: obj,
                     success: function(data) {
                         console.log(data);
                         if (data != 1) {
                             screen.classList.remove('d-none');
                             screen_text.innerHTML = data;
                         }
                     }
                 })
             }
         });
     </script>
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
     <script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

     </script>
     <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/super-build/ckeditor.js"></script>
     <script>
         $(document).ready(function() {
             $("#add_new_idea").click(function() {
                 var newIdea = `
                <div class="idea mt-4">
                    <div class="idea my-2">
                        <div class="section_idea">
                            <span>Answer PDF</span>
                            <input type="file" name="ans_pdf[]" class="form-control">
                        </div>
                        <div class="section_syllabus">
                            <span>Answer Video</span>
                            <input name="ans_video[]" class="form-control">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn_remove_idea">Remove</button>
                </div>`;

                $(".ideas").append(newIdea)

                $(".btn_remove_idea").each((val, ele) => {
                     // console.log("ele",ele)
                    $(ele).click(function() {
                        $(ele).closest(".idea").remove();
                    })
                     // console.log("val",val)
                })
            });


                let ans_type = document.querySelector('.ans_type');
                let ans_div = document.querySelector('.ans_div');
                let add_ans = document.querySelector('.add_ans');
                let add_ans_btn = document.querySelector('.add_ans_btn');
                let add_new = document.querySelector('.addNewAnswer');

                var newAnswerGride =
                    `<input type="number" class="form-control answerGrid my-2" name="grid_ans[]" placeholder="Answer" />`;
                $(".add_ans_btn").click(function() {
                    $(".ans_div_Grid").append(newAnswerGride);
                });
                $(".ans_type").change(function() {
                    if ($(".ans_type").val() == 'MCQ') {
                        $(".add_ans").addClass('d-none');
                        $(".ans_div_Grid").empty();

                        $(".ans_div_Mcq").removeClass('d-none');
                        $(".ans_div_Mcq").empty();

                        $(".ans_div_Mcq").append(`<div class="my-2 allAnswerMcq">
                        <div class="d-flex align-items-center mb-3 gap-2">
                            <input name="mcq_answers" class="mcq_answer_radio" value="A" id="mcq_a" type="radio" checked/>
                            <input class="form-control letter_choice" value="A" name="mcq_char[]" placeholder="Letter Choice" />
                        </div>
                        <input class="form-control" name="mcq_ans[]" placeholder="Answer" />
                        </div>
                        <div class="my-2">
                            <div class="d-flex align-items-center mb-3 gap-2">
                        <input name="mcq_answers" class="mcq_answer_radio" value="B" id="mcq_b" type="radio" />
                        <input class="form-control letter_choice mb-3" value="B" name="mcq_char[]" placeholder="Letter Choice" />
                        </div>
                        <input class="form-control" name="mcq_ans[]" placeholder="Answer B" />
                        </div>
                        <div class="my-2">
                            <div class="d-flex align-items-center mb-3 gap-2">
                        <input name="mcq_answers" class="mcq_answer_radio" value="C" id="mcq_c" type="radio" />
                        <input class="form-control letter_choice mb-3" value="C" name="mcq_char[]" placeholder="Letter Choice" />
                        </div>
                        <input class="form-control" name="mcq_ans[]" placeholder="Answer C" />
                        </div>
                        <div class="my-2">
                            <div class="d-flex align-items-center mb-3 gap-2">
                        <input name="mcq_answers" class="mcq_answer_radio" value="D" id="mcq_d" type="radio" />
                        <input class="form-control letter_choice mb-3" value="D" name="mcq_char[]" placeholder="Letter Choice" />
                        </div>
                        <input class="form-control" name="mcq_ans[]" placeholder="Answer D" />
                        </div>

                        <div class="my-2 newAnswerSe">

                        </div>
                        <div class="newAnswer">
                            <button type="button" class="addNewAnswer">New Answer</button>
                            <button type="button" class="removeNewAnswer d-none">Remove Answer</button>
                            </div>`);

                     let letter_choice = document.querySelectorAll('.letter_choice');
                     let mcq_answer_radio = document.querySelectorAll('.mcq_answer_radio');

                    //  for (let i = 0, end = letter_choice.length; i < end; i++) {
                    //      letter_choice[i].addEventListener('input', function(e) {
                    //          for (let j = 0; j < end; j++) {
                    //              if (e.target == letter_choice[j]) {
                    //                  mcq_answer_radio[j].value = letter_choice[j].value;
                    //                  console.log(letter_choice[j].value)
                    //              }
                    //          }
                    //      });
                    //  }
                    for (let i = 0, end = letter_choice.length; i < end; i++) {
                        letter_choice[i].addEventListener('input', function(e) {
                            for (let j = 0; j < end; j++) {
                                if (e.target == letter_choice[j]) {
                                    mcq_answer_radio[j].value = e.target.value; // Change the radio button's value
                                    console.log(e.target.value); // Log the updated value to console
                                }
                            }
                        });
                    }


                     $(".addNewAnswer").click(function() {
                         $(this).toggleClass("d-none");
                         $(".newAnswerSe").append(`<div class="d-flex align-items-center mb-3 gap-2">
                                            <input name="mcq_answers" class="mcq_answer_radio"
                                                value="New Answer" id="mcq_New"
                                                type="radio" />
                                            <input class="form-control letter_choice mb-3"
                                                value="New Answer" name="mcq_char[]"
                                                placeholder="Letter Choice" />
                                        </div>
                                        <input class="form-control" name="mcq_ans[]"
                                            placeholder="New Answer" />`);
                         $(".removeNewAnswer").toggleClass("d-none");
                     })
                     $(".removeNewAnswer").click(function() {
                         $(this).toggleClass("d-none");
                         $(".addNewAnswer").toggleClass("d-none");
                         $(".newAnswerSe").empty();
                     })
                 } else if ($(".ans_type").val() == 'Grid_in') {
                     $(".ans_div_Mcq").addClass('d-none');
                     $(".add_ans").removeClass('d-none');
                     $(".ans_div_Grid").removeClass('d-none');
                 }
             })


         })
     </script>
     <script>
         // This sample still does not showcase all CKEditor&nbsp;5 features (!)
         // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
         CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
             // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
             toolbar: {
                 items: [
                     'exportPDF', 'exportWord', '|',
                     'findAndReplace', 'selectAll', '|',
                     'heading', '|',
                     'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                     'removeFormat', '|',
                     'bulletedList', 'numberedList', 'todoList', '|',
                     'outdent', 'indent', '|',
                     'undo', 'redo',
                     '-',
                     'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                     'alignment', '|',
                     'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                     '|',
                     'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                     'textPartLanguage', '|',
                     'sourceEditing'
                 ],
                 shouldNotGroupWhenFull: true
             },
             // Changing the language of the interface requires loading the language file using the <script> tag.
             // language: 'es',
             list: {
                 properties: {
                     styles: true,
                     startIndex: true,
                     reversed: true
                 }
             },
             // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
             heading: {
                 options: [{
                         model: 'paragraph',
                         title: 'Paragraph',
                         class: 'ck-heading_paragraph'
                     },
                     {
                         model: 'heading1',
                         view: 'h1',
                         title: 'Heading 1',
                         class: 'ck-heading_heading1'
                     },
                     {
                         model: 'heading2',
                         view: 'h2',
                         title: 'Heading 2',
                         class: 'ck-heading_heading2'
                     },
                     {
                         model: 'heading3',
                         view: 'h3',
                         title: 'Heading 3',
                         class: 'ck-heading_heading3'
                     },
                     {
                         model: 'heading4',
                         view: 'h4',
                         title: 'Heading 4',
                         class: 'ck-heading_heading4'
                     },
                     {
                         model: 'heading5',
                         view: 'h5',
                         title: 'Heading 5',
                         class: 'ck-heading_heading5'
                     },
                     {
                         model: 'heading6',
                         view: 'h6',
                         title: 'Heading 6',
                         class: 'ck-heading_heading6'
                     }
                 ]
             },
             // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
             placeholder: 'Welcome to CKEditor 5!',
             // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
             fontFamily: {
                 options: [
                     'default',
                     'Arial, Helvetica, sans-serif',
                     'Courier New, Courier, monospace',
                     'Georgia, serif',
                     'Lucida Sans Unicode, Lucida Grande, sans-serif',
                     'Tahoma, Geneva, sans-serif',
                     'Times New Roman, Times, serif',
                     'Trebuchet MS, Helvetica, sans-serif',
                     'Verdana, Geneva, sans-serif'
                 ],
                 supportAllValues: true
             },
             // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
             fontSize: {
                 options: [10, 12, 14, 'default', 18, 20, 22],
                 supportAllValues: true
             },
             // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
             // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
             htmlSupport: {
                 allow: [{
                     name: /.*/,
                     attributes: true,
                     classes: true,
                     styles: true
                 }]
             },
             // Be careful with enabling previews
             // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
             htmlEmbed: {
                 showPreviews: true
             },
             // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
             link: {
                 decorators: {
                     addTargetToExternalLinks: true,
                     defaultProtocol: 'https://',
                     toggleDownloadable: {
                         mode: 'manual',
                         label: 'Downloadable',
                         attributes: {
                             download: 'file'
                         }
                     }
                 }
             },
             // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
             mention: {
                 feeds: [{
                     marker: '@',
                     feed: [
                         '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                         '@chocolate', '@cookie', '@cotton', '@cream',
                         '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                         '@gummi', '@ice', '@jelly-o',
                         '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                         '@sesame', '@snaps', '@soufflé',
                         '@sugar', '@sweet', '@topping', '@wafer'
                     ],
                     minimumCharacters: 1
                 }]
             },
             // The "super-build" contains more premium features that require additional configuration, disable them below.
             // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
             removePlugins: [
                 // These two are commercial, but you can try them out without registering to a trial.
                 // 'ExportPdf',
                 // 'ExportWord',
                 'AIAssistant',
                 'CKBox',
                 'CKFinder',
                 'EasyImage',
                 // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                 // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                 // Storing images as Base64 is usually a very bad idea.
                 // Replace it on production website with other solutions:
                 // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                 // 'Base64UploadAdapter',
                 'RealTimeCollaborativeComments',
                 'RealTimeCollaborativeTrackChanges',
                 'RealTimeCollaborativeRevisionHistory',
                 'PresenceList',
                 'Comments',
                 'TrackChanges',
                 'TrackChangesData',
                 'RevisionHistory',
                 'Pagination',
                 'WProofreader',
                 // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                 // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                 'MathType',
                 // The following features are part of the Productivity Pack and require additional license.
                 'SlashCommand',
                 'Template',
                 'DocumentOutline',
                 'FormatPainter',
                 'TableOfContents',
                 'PasteFromOfficeEnhanced'
             ]
         });
     </script>

     <script>
         $(document).ready(function() {
             console.clear();
             //  var desQuestion = $(".ck-editor__main p");
             var questionImage = $(".questionImage");
             var questionAnswer = $(".ans_type");
             var questionDifficulty = $(".difficulty");
             var questionType = $(".q_type");
             var questionGrid = $(".answerGrid");
             /* ###### */
             var questionCategory = $(".sel_category2");
             var questionCourse = $(".sel_my_course2");
             var questionChapter = $(".sel_my_chapter2");
             var questionLesson = $(".sel_my_lesson2");
             var questionYear = $(".year");
             var questionMonth = $(".month");
             var questionNum = $(".q_num");
             /* ###### */
             var questionPdf = $(".questionPdf");
             var questionVideo = $(".questionVideo");

             function checkValGrid() {
                 if ($(".ans_type").val() == "Grid_in") {

                     $(".answerGrid").each((index, ele) => {
                         console.log("aaaaaaaaaa", $(ele).val())
                         console.log("index", index)
                         if ($(ele).val() == "") {
                             $(".faildTypeGrid").removeClass("d-none")
                             $(".continue_btn").addClass("disabled")
                         } else {
                             $(".faildTypeGrid").addClass("d-none")
                             $(".continue_btn").removeClass("disabled")
                         }
                         $(ele).keyup(function() {
                             if ($(ele).val() == "") {
                                 $(".faildTypeGrid").removeClass("d-none")
                                 checkValOne()
                             } else {
                                 $(".faildTypeGrid").addClass("d-none")
                                 checkValOne()
                             }

                         })
                     })
                 }
             }

             function checkValOne() {
                 if ($(questionAnswer).val() !== "" &&
                     $(questionDifficulty).val() !== "" && $(questionType).val() !== "") {
                     $(".continue_btn").removeClass("disabled")
                     checkValGrid()
                 } else {
                     $(".continue_btn").addClass("disabled")
                     checkValGrid()
                 }
             }

             function checkValThree() {
                 if ($(questionPdf).val() !== "" && $(questionVideo).val()) {
                     console.log("yessssssssss")
                     $(".subBtn").removeClass("d-none")
                     $(".subBtn").removeClass("disabled")
                 } else {
                     console.log("noooooooooo")
                     $(".subBtn").addClass("d-none")
                     $(".subBtn").addClass("disabled")
                     console.log("questionPdf", $(".questionPdf").val())
                     console.log("questionVideo", $(".questionVideo").val())
                 }
             }

             function checkValTwo() {
                 if ($(questionCategory).val() !== "" && $(questionCourse).val() !== "" &&
                     $(questionChapter).val() !== "" && $(questionLesson).val() !== "" && $(questionNum).val() !== ""
                 ) {
                     console.log("yessssssssss")
                     $(".continue_btn").removeClass("disabled")
                 } else {
                     console.log("noooooooooo")
                     $(".continue_btn").addClass("disabled")
                     console.log("sel_category2", $(".sel_category2").val())
                     console.log("sel_my_course2", $(".sel_my_course2").val())
                     console.log("sel_my_lesson2", $(".sel_my_lesson2").val())
                     console.log("year", $(".year").val())
                     console.log("month", $(".month").val())
                     console.log("q_num", $(".q_num").val())
                 }
             }

             function checkValFaild() {
                 /* questionCategory */
                 if ($(questionCategory).val() == "") {
                     $(".faildCategory").removeClass("d-none")
                 } else {
                     $(".faildCategory").addClass("d-none")
                 }
                 /* questionCourse */
                 if ($(questionCourse).val() == "") {
                     $(".faildCourse").removeClass("d-none")
                 } else {
                     $(".faildCourse").addClass("d-none")
                 }
                 /* questionChapter */
                 if ($(questionChapter).val() == "") {
                     $(".faildChapter").removeClass("d-none")
                 } else {
                     $(".faildChapter").addClass("d-none")
                 }
                 /* questionLesson */
                 if ($(questionLesson).val() == "") {
                     $(".faildLesson").removeClass("d-none")
                 } else {
                     $(".faildLesson").addClass("d-none")
                 }
                 /* questionYear */
                 if ($(questionYear).val() == "") {
                     $(".faildYear").removeClass("d-none")
                 } else {
                     $(".faildYear").addClass("d-none")
                 }
                 /* questionMonth */
                 if ($(questionMonth).val() == "") {
                     $(".faildMonth").removeClass("d-none")
                 } else {
                     $(".faildMonth").addClass("d-none")
                 }
                 /* questionNum */
                 if ($(questionNum).val() == "") {
                     $(".faildNum").removeClass("d-none")
                 } else {
                     $(".faildNum").addClass("d-none")
                 }
             }

             function checkValFaildSub() {
                 /* questionPdf */
                 if ($(questionPdf).val() == "") {
                     $(".faildPdf").removeClass("d-none")
                 } else {
                     $(".faildPdf").addClass("d-none")
                 }
                 /* questionVideo */
                 if ($(questionVideo).val() == "") {
                     $(".faildVideo").removeClass("d-none")
                 } else {
                     $(".faildVideo").addClass("d-none")
                 }
             }
             $(".continue_btn").click(function() {
                 console.log('click')
                 //   $(this).addClass("disabled")
                 //  checkValOne();
                 checkValTwo();
             })
             $(".btnBack").click(function() {
                 checkValTwo();
                 checkValOne();
             })
             $(".continue_btn").click(function() {
                 if ($(questionGrid).val == "") {
                     $(".faildTypeGrid").removeClass("d-none")
                     console.log("Yes")
                 } else {
                     $(".faildTypeGrid").addClass("d-none")

                 }
             })

             $(".add_ans_btn").click(function() {
                 checkValGrid();
             });
             //  /* desQuestion */
             //  $(".ck-editor__main p").on('keyup', function() {
             //      if ($(desQuestion).text() == "") {
             //          console.log("yes")
             //          $(".faildDes").removeClass("d-none")
             //          console.log($(desQuestion)).text()
             //      } else {
             //          console.log("noo")
             //          console.log($(desQuestion)).text()
             //          $(".faildDes").addClass("d-none")
             //      }
             //      checkValOne();
             //  })
             /* questionImage */
             //  $(".questionImage").on('change', function() {

             //      if ($(questionImage).val() == "") {
             //          $(".faildImage").removeClass("d-none")
             //      } else {
             //          $(".faildImage").addClass("d-none")
             //      }
             //      checkValOne();
             //  })
             /* questionAnswer */
             $(".ans_type").on('change', function() {

                 if ($(questionAnswer).val() == "") {
                     $(".faildAnswer").removeClass("d-none")
                 } else {
                     $(".faildAnswer").addClass("d-none")
                 }
                 checkValOne();
                 //  checkValGrid();

             })
             /* questionDifficulty */
             $('.difficulty').on('change', function() {
                 if ($(questionDifficulty).val() == "") {
                     $(".faildDiff").removeClass("d-none")
                 } else {
                     $(".faildDiff").addClass("d-none")
                 }
                 checkValOne();
             })
             //  $(".add_ans_btn").click(function() {
             //  })
             /* questionType */
             $('.q_type').on('change', function() {
                 if ($(questionType).val() == "") {
                     $(".faildType").removeClass("d-none")
                 } else {
                     $(".faildType").addClass("d-none")
                 }
                 checkValOne();
             })
             /* questionGrid */
             //  $('.q_type').on('change', function() {
             //      if ($(this).val() == "Grid_in") {
             //          $(questionGrid).each((ele, index) => {

             //              if ($(ele).val() == "") {
             //                  $(".faildTypeGrid").removeClass("d-none")
             //              } else {
             //                  $(".faildTypeGrid").addClass("d-none")
             //              }
             //          })
             //      }
             //      checkValOne();
             //  })
             /* ##################### */
             /* questionCategory */
             $(".sel_category2").on('change', function() {
                 checkValFaild();
                 checkValTwo();
             })
             /* questionCourse */
             $(".sel_my_course2").on('change', function() {
                 checkValFaild();
                 checkValTwo();
             })
             /* questionChaoter */
             $(".sel_my_chapter2").on('change', function() {
                 checkValFaild();
                 checkValTwo();
             })
             /* questionLesson */
             $(".sel_my_lesson2").on('change', function() {
                 checkValFaild();
                 checkValTwo();
             })
             /* questionYear */
             //  $(".year").on('change', function() {
             //      checkValFaild();
             //      checkValTwo();
             //  })
             /* questionMonth */
             //  $(".month").on('change', function() {
             //      checkValFaild();
             //      checkValTwo();
             //  })
             /* questionNum */
             $(".q_num").on('keyup', function() {
                 checkValFaild();
                 checkValTwo();
             })
             /* ########## */
             /* questionPdf */
             $(".questionPdf").on("change", function() {
                 checkValFaildSub();
                 checkValThree();
             })
             /* questionVideo */
             $(".questionVideo").on("keyup", function() {
                 checkValFaildSub();
                 checkValThree();
             })
         })
     </script>
 @endsection
