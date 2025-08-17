@php
function fun_admin()
{
return "admin";
}
@endphp
<x-default-layout>

    @section('title', 'Notification')
    @include('success')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @error('faild')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    </div>
{{-- parent, teachers, students, material_link,material_file, text, date, time  --}}
{{--  
    add_notifictions => parents[], students[], teachers[], material_link, material_file, text, date
--}}
    <div class="px-5">
        <!--begin::Action-->
        <a href="#" class="btn btn-primary er fs-6 px-8 py-4 mx-2" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_campaign">Add Notification</a>
        <!--end::Action-->
 



        <table id="kt_profile_overview_table"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
            <thead class="fs-7 text-gray-500 text-uppercase">
         
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    #
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Text
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Material Link
                </th> 
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Material File
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    date
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Time
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Students
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Teachers
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Parents
                </th>
            </thead>
            <tbody class="fs-6">
                @foreach ($notifications as $item)
                <tr>
                    <td class="text-center">
                        <a href="{{ $item->material_link }}" class="text-primary">
                            Open Link
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ $item->material_link }}" class="text-primary">
                            Open Link
                        </a>
                    </td>
                    <td>
                        {{ $lesson->lesson_name }}
                    </td>
                    <td>
                        {{ $lesson->chapter->course->category->cate_name ?? "Empty" }}
                    </td>
                    <td>
                        {{ $lesson->chapter->course->course_name ?? "Empty" }}
                    </td>
                    <td>
                        {{ $lesson->chapter->chapter_name ?? "Empty" }}
                    </td>

                    <td>
                        <div class="mt-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalCenter{{ $lesson->id }}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalDelete{{ $lesson->id }}">
                                Delete
                            </button>

                            <!-- Modal -->


                            <form method="POST" id="form-edit{{ $lesson->id }}" action="{{ route('lesson_edit') }}"
                                class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="modalCenter{{ $lesson->id }}" tabindex="-1"
                                    aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content px-2">
                                            <input type="hidden" value="{{ $lesson->id }}" name="chapter_id" />

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Edit Lesson</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>


                                            <div class="info_section" id="info_section{{ $lesson->id }}">
                                                <div class='my-3'>
                                                    <label>Lesson Name</label>
                                                    <input class='form-control' value="{{ $lesson->lesson_name }}"
                                                        name="lesson_name" placeholder="Lesson Name" />
                                                </div>
                                                <div class='my-3'>
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control">
                                                        <option value="{{ $lesson->chapter->course->category->id ?? "
                                                            Empty" }}">
                                                            {{ $lesson->chapter->course->category->cate_name ??
                                                            "Empty"}}
                                                        </option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->cate_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class='my-3'>
                                                    <label>Course</label>
                                                    <select name="Course_id" class="form-control">
                                                        <option value="{{ $lesson->chapter->course->id ?? " Empty" }}">
                                                            {{ $lesson->chapter->course->course_name ?? "Empty"}}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class='my-3'>
                                                    <label>Chapter</label>
                                                    <select name="chapter_id" class="form-control">
                                                        <option value="{{ $lesson->chapter->id }}">
                                                            {{ $lesson->chapter->chapter_name }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class='my-3'>
                                                    <label>Description</label>
                                                    <textarea class='form-control' name="lesson_des"
                                                        placeholder="Description">{{ $lesson->lesson_des }}</textarea>
                                                </div>
                                                <input value="{{ $lesson->id }}" type="hidden" name="lesson_id" />

                                                <div class='my-3'>
                                                    <label>Image</label>
                                                    <input class='form-control' type="file" name="lesson_url"
                                                        placeholder="Image" />
                                                </div>
                                                <button type="button" class="btn btn-success details_btn"
                                                    id="details_btn{{ $lesson->id }}">
                                                    Next
                                                </button>
                                            </div>

                                            <div class="details_section d-none" id="details_section{{ $lesson->id }}">
                                                <div class='my-3'>
                                                    <label>Teacher</label>
                                                    <select name="teacher_id" class="form-control">
                                                        <option value="{{ $lesson?->teacher?->id }}">
                                                            {{ $lesson?->teacher?->nick_name }}
                                                        </option>
                                                        @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}">
                                                            {{ $teacher->nick_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class='my-3'>
                                                    <label>Pre requisition</label>
                                                    <textarea class='form-control' name="pre_requisition"
                                                        placeholder="Pre requisition">{{ $lesson->pre_requisition }}</textarea>
                                                </div>
                                                <div class='my-3'>
                                                    <label>What you gain</label>
                                                    <textarea class='form-control' name="gain"
                                                        placeholder="What you gain">{{ $lesson->gain }}</textarea>
                                                </div>
                                                <button type="button" class="btn btn-secondary prev_info">
                                                    Back
                                                </button>
                                                <button type="button" class="btn btn-success pricing_btn">
                                                    Next
                                                </button>
                                            </div>

                                            <div class="priceing_section d-none" id="priceing_section{{ $lesson->id }}">


                                                <div class="text-muted fw-semibold fs-2 d-flex align-lessons-center">
                                                    <div class="section_add_idea" style="margin-left:15px ">
                                                        <button id="add_new_Pricing{{ $lesson->id }}" type="button"
                                                            class="my-3 btn_add btn btn-lg btn-primary d-inline-block add_new_Pricing">Add
                                                            New Idea</button>
                                                    </div>
                                                </div>
                                                <div class="mt-3 PricesDef" id="PricesDef{{ $lesson->id }}">
                                                </div>
                                                @foreach ($lesson->ideas as $idea)
                                                <div class='my-3'>
                                                    <label>Idea</label>

                                                    <input class='form-control' value="{{ $idea->idea }}" name="idea[]"
                                                        placeholder="Idea" />
                                                </div>
                                                <div class='my-3'>
                                                    <label>Syllabus</label>
                                                    <input class='form-control' value="{{ $idea->syllabus }}"
                                                        name="syllabus[]" placeholder="Syllabus" />
                                                </div>
                                                <div class='my-3'>
                                                    <label>Idea Order</label>
                                                    {{ $idea->idea_order }}
                                                    <input class='form-control' value="{{ $idea->idea_order }}"
                                                        name="idea_order[]" placeholder="Idea Order" />
                                                </div>
                                                <div class='my-3'>
                                                    <label>Video Link</label>
                                                    <input class='form-control' name="v_link[]"
                                                        value="{{ $idea->v_link }}" placeholder="Video Link" />
                                                </div>
                                                <div class='my-3'>
                                                    <label>Pdf</label>
                                                    <input type="file" class='form-control' value="{{ $idea->pdf }}"
                                                        name="pdf[]" />
                                                </div>

                                                <div class="mt-3 Prices" id="Prices{{ $lesson->id }}">
                                                </div>
                                                @endforeach
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button class="btn btn-primary">Submit</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>


                            <!-- Modal -->
                            <div class="modal fade" id="modalDelete{{ $lesson->id }}" tabindex="-1" aria-hidden="true"
                                style="display: none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class='p-3'>
                                            Are You Sure To Delete
                                            <span class='text-danger'>
                                                {{ $lesson->lesson_name }} Lesson ??
                                            </span>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <a href="{{ route('del_lesson', ['id' => $lesson->id]) }}"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <div class="modal fade" id="kt_modal_create_campaign" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-fullscreen p-9">
                <!--begin::Modal content-->
                <div class="modal-content modal-rounded">
                    <!--begin::Modal header-->
                    <div class="modal-header py-7 d-flex justify-content-between">
                        <!--begin::Modal title-->
                        <h2>Add Lesson</h2>
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
                    <div class="modal-body m-5">
                        <!--begin::Stepper-->
                        <div class="stepper stepper-links d-flex flex-column" id="kt_modal_create_campaign_stepper">
                            <!--begin::Nav-->
                            <div class="stepper-nav justify-content-center py-2">
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">INFO</h3>
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Details</h3>
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 4-->
                                <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Ideas</h3>
                                </div>
                                <!--end::Step 4-->
                            </div>
                            <!--end::Nav-->
                            <!--begin::Form-->
                            <form class="mx-auto w-100 mw-600px pt-15 pb-10" method="POST"
                                action="{{ route('addLesson') }}" novalidate="novalidate"
                                id="kt_modal_create_campaign_stepper_form" enctype="multipart/form-data">

                                <!--begin::Step 1-->
                                <div class="current" data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        @csrf
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-15">
                                            <!--begin::Title-->
                                            <h2 class="fw-bold d-flex align-items-center text-gray-900">Information
                                                About
                                                Lesson Details
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Campaign name will be used as reference within your campaign reports">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label mb-3">Lesson Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="lesson_name" placeholder="" value="" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        {{-- Start Selector category --}}
                                        <div class="row g-9 mb-8">
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-6 fw-semibold mb-2">Category</label>
                                                <select class="form-select sel_cate form-select-solid"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Select a Category" name="category_id">
                                                    <option disable selected>Select Category...</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->cate_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="hidden" class="categories" value="{{ $categories }}" />
                                            <input type="hidden" class="courses" value="{{ $courses }}" />
                                            <input type="hidden" class="chapters" value="{{ $chapters }}" />
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-6 fw-semibold mb-2">Courses</label>
                                                <select class="form-select sel_course_add form-select-solid"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Select a Courses" name="course_id">
                                                    <option disable selected>Select Course...</option>
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-6 fw-semibold mb-2">Chapter</label>
                                                <select class="form-select sel_chapter_add form-select-solid"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Select a Chapter" name="chapter_id">
                                                    <option disable selected>Select Chapter...</option>
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-12 fv-row">
                                                <label class="required fs-6 fw-semibold mb-2">Descrition</label>
                                                <textarea name="lesson_des" class="form-control"
                                                    placeholder="Description"></textarea>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-12 fv-row">
                                                <label class="required fs-6 fw-semibold mb-2">Image</label>
                                                <Input name="lesson_url" class="form-control" type="file" />
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->

                                            <!--end::Col-->
                                        </div>
                                        {{-- Start Selector category --}}
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 1-->

                                <!--begin::Step 2-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-12">
                                            <!--begin::Title-->
                                            <h1 class="fw-bold text-gray-900">Details about Lesson</h1>
                                            <!--end::Title-->
                                            <!--begin::Description-->

                                            <!--end::Description-->
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Input group-->
                                        <div class="row g-9 mb-8">
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-6 fw-semibold mb-2">Teacher</label>
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Select a Category"
                                                    name="teacher_id">
                                                    <option disabled selected>Select Teacher...</option>
                                                    @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->nick_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-5 fv-row">

                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-semibold mb-2">Pre requisition</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid" rows="3"
                                                name="pre_requisition" placeholder="Pre requisition"></textarea>
                                            <!--end::Input-->
                                        </div>

                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">What you Gain</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" rows="3" name="gain"
                                            placeholder="What you Gain"></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-12">
                                            <!--begin::Title-->
                                            <h1 class="fw-bold text-gray-900">Ideas</h1>
                                            <!--end::Title-->
                                            <!--begin::Description-->
                                            <div class="text-muted fw-semibold fs-2 d-flex align-items-center">If you
                                                need
                                                add more idea, please check
                                                <div class="section_add_idea" style="margin-left:15px ">
                                                    <button id="add_idea" type="button"
                                                        class="btn_add btn btn-lg btn-primary add_idea_btn d-inline-block">Add
                                                        New Idea</button>
                                                </div>
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="ideas_div">

                                            <div class="idea">
                                                <div class="section_idea">
                                                    <span>Idea</span>
                                                    <input name="idea[]" type="text"
                                                        class="form-control form-control-lg">
                                                </div>
                                                <div class="section_syllabus">
                                                    <span>Syllabus</span>
                                                    <input name="syllabus[]" type="text"
                                                        class="form-control form-control-lg">
                                                </div>
                                                <div class="section_syllabus">
                                                    <span>Idea Order</span>
                                                    <input name="idea_order[]" type="text"
                                                        class="form-control form-control-lg">
                                                </div>
                                                <div class="section_pdf">
                                                    <span>Pdf</span>
                                                    <input name="pdf[]" type="file"
                                                        class="form-control form-control-lg">
                                                </div>
                                                <div class="section_video_link">
                                                    <span>Video Link</span>
                                                    <input name="v_link[]" type="text"
                                                        class="form-control form-control-lg">
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    console.clear();
                                                    console.log("first")
                                                    $(".add_idea_btn").click(function() {
                                                        var newPricing = `<div class="idea">
                                     <div class="section_idea">
                                         <span>Idea</span>
                                         <input name="idea[]" type="text" class="form-control form-control-lg">
                                     </div>
                                     <div class="section_syllabus">
                                         <span>Syllabus</span>
                                         <input name="syllabus[]" type="text" class="form-control form-control-lg">
                                     </div>
                                     <div class="section_syllabus">
                                         <span>Idea Order</span>
                                         <input name="idea_order[]" type="text" class="form-control form-control-lg">
                                     </div>
                                     <div class="section_pdf">
                                         <span>Pdf</span>
                                         <input name="pdf[]" type="file" class="form-control form-control-lg">
                                     </div>
                                     <div class="section_video_link">
                                         <span>Video Link</span>
                                         <input name="v_link[]" type="text" class="form-control form-control-lg">
                                     </div>
                                     <button type="button" class="btn btn-danger btn_remove_idea">Remove</button>
                                 </div>`;

                                                        $(".ideas_div").append(newPricing)

                                                        $(".btn_remove_idea").each((val, ele) => {
                                                            // console.log("ele",ele)
                                                            $(ele).click(function() {
                                                                $(ele).closest(".idea").remove();
                                                            })
                                                            // console.log("val",val)
                                                        })
                                                    })
                                                })
                                            </script>
                                            <script>
                                                //             let add_idea_btn = document.querySelector('.add_idea_btn');
                                                //             let ideas_div = document.querySelector('.ideas_div');
                                                //             add_idea_btn.addEventListener('click', () => {
                                                //                 ideas_div.innerHTML += `
    // <div class="idea">
    //     <div class="section_idea">
    //         <span>Idea</span>
    //         <input name="idea[]" type="text" class="form-control form-control-lg">
    //     </div>
    //     <div class="section_syllabus">
    //         <span>Syllabus</span>
    //         <input name="syllabus[]" type="text" class="form-control form-control-lg">
    //     </div>
    //     <div class="section_syllabus">
    //         <span>Idea Order</span>
    //         <input name="idea_order[]" type="text" class="form-control form-control-lg">
    //     </div>
    //     <div class="section_pdf">
    //         <span>Pdf</span>
    //         <input name="pdf[]" type="file" class="form-control form-control-lg">
    //     </div>
    //     <div class="section_video_link">
    //         <span>Video Link</span>
    //         <input name="v_link[]" type="text" class="form-control form-control-lg">
    //     </div>
    //     <button type="button" class="btn btn-danger btn_remove_idea">Remove</button>
    // </div>`;
                                                //                 let btn_remove_idea = document.querySelectorAll('.btn_remove_idea');
                                                //                 for (let i = 0, end = btn_remove_idea.length; i < end; i++) {
                                                //                     btn_remove_idea[i].addEventListener('click', (e) => {
                                                //                         for (let j = 0; j < end; j++) {
                                                //                             if (e.target == btn_remove_idea[j]) {
                                                //                                 btn_remove_idea[j].parentElement.remove()
                                                //                             }
                                                //                         }
                                                //                     });
                                                //                 }
                                                //             })
                                            </script>
                                        </div>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-stack pt-10">
                                    <!--begin::Wrapper-->
                                    <div class="me-2">
                                        <button type="button" class="btn btn-lg btn-light-primary me-3"
                                            data-kt-stepper-action="previous" data-kt-stepper-state="hide-on-last-step">
                                            <i class="ki-duotone ki-arrow-left fs-3 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Back</button>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Wrapper-->
                                    <div>
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Done
                                        </button>
                                        <button type="button" class="btn btn-lg btn-primary"
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
    </div>
    
    @section('script')
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    {{-- <script src="assets/plugins/global/lessonSc.js"></script> --}}
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="../../assets/js/widgets.bundle.js"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-campaign.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/lessonSc.js') }}"></script>

    </script>
    <script>
        $(document).ready(() => {
                $(".details_btn").click(function() {
                    var info_id = `#${$(this).parent().attr("id")}`;
                    var details_id = `#${$(this).parent().next().attr("id")}`;


                    $(info_id).addClass("d-none");
                    $(details_id).removeClass("d-none");

                });
                $(".pricing_btn").click(function() {
                    var details_id = `#${$(this).parent().attr("id")}`;
                    var priceing_id = `#${$(this).parent().next().attr("id")}`;

                    $(details_id).addClass("d-none");
                    $(priceing_id).removeClass("d-none");
                });

                $(".prev_info").click(function() {
                    var details_id = `#${$(this).parent().attr("id")}`;
                    var info_id = `#${$(this).parent().prev().attr("id")}`;

                    $(details_id).addClass("d-none");
                    $(info_id).removeClass("d-none");
                });

                $(".prev_details").click(function() {
                    var priceing_id = `#${$(this).parent().parent().attr("id")}`;
                    var details_id = `#${$(this).parent().parent().prev().attr("id")}`;

                    $(priceing_id).addClass("d-none");
                    $(details_id).removeClass("d-none");
                });

            })
    </script>

    <script>
        $(document).ready(() => {
                $(".add_new_Pricing").each((ele, val) => {

                    var poi_id = `#${$(val).attr("id")}`

                    $(poi_id).click(() => {
                        console.log(ele);
                        var ele_count = ++ele;
                        console.log(ele_count);

                        var sec_id =
                            `#${$(poi_id).parent().parent().parent().find(".Prices").attr("id")}`;
                        var sec_Def_id =
                            `#${$(poi_id).parent().parent().parent().find(".PricesDef").attr("id")}`;

                        Prices = ` <div class="Price">
                  <hr />
                    <div class="section_idea my-2">
                        <span>Idea</span>
                        <input type="text" name="idea[]" class="form-control form-control-lg" placeholder="Idea">
                    </div>
                    <div class="section_idea my-2">
                        <span>Syllabus</span>
                        <input name="syllabus[]" class="form-control form-control-lg" placeholder="Syllabus">
                    </div>
                    <div class="section_idea my-2">
                      <span>Idea Order</span>
                      <input name="idea_order[]" class="form-control form-control-lg" placeholder="Idea Order">
                    </div>
                    <div class="section_idea my-2">
                      <span>Video Link</span>
                      <input name="v_link[]" class="form-control form-control-lg" placeholder="Video Link">
                    </div>
                    <div class="section_idea my-2">
                      <span>Pdf</span>
                      <input type="file" name="pdf[]" class="form-control form-control-lg">
                    </div>
                    <button type="button" class="col-md-12 btn btn-danger btn_remove_idea" id="btn${ele_count}">Remove</button>
                    </div>`;
                        if ($(sec_id).length >= 1) {
                            $(sec_id).append(Prices);
                        } else {
                            $(sec_Def_id).append(Prices);

                        }

                        $(".btn_remove_idea").each((elebt, valbt) => {
                            var btnId = `#${$(valbt).attr("id")}`

                            $(btnId).click(() => {
                                $(btnId).parent().remove();
                            })
                        })
                    });

                });

            })
    </script>
    @endsection
</x-default-layout>