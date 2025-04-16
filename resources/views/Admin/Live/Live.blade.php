@php
function fun_admin()
{
return 'admin';
}
@endphp
<x-default-layout>
    @section('title', 'Live')
    @include('success')
    <style>
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
            z-index: 999999999;
        }

        .screen_popup {
            height: 450px;
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
            font-weight: bold;
        }

        .close_btn {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
        }

        .modal-footer {
            padding: 0 !important;
            border-top: none !important;
        }

        .sessionNameFaild,
        .sessionDateFaild,
        .sessionFormFaild,
        .sessionToFaild,
        .sessionTypeFaild,
        .sessionGroupFaild,
        .sessionUserFaild,
        .categoryFaild,
        .courseFaild,
        .chapterFaild,
        .lessonFaild,
        .teacherFaild,
        .session_linkFaild,
        .material_linkFaild {
            font-size: 1.1rem;
            color: red;
            font-weight: 500;
        }
    </style>

    @error('link')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('date')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('from')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('to')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('lesson_id')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('type')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('access_dayes')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('price')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('teacher_id')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('repeat')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror

    <div class="my-3">

        <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_question">Add Session</a>
    </div>
    <!--end::Action-->

    <div class="modal fade" id="kt_modal_create_question" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-fullscreen p-9">
            <!--begin::Modal content-->
            <div class="modal-content modal-rounded">
                <!--begin::Modal header-->
                <div class="modal-header py-7 d-flex justify-content-between">
                    <!--begin::Modal title-->
                    <h2>Create Session</h2>
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
                        <form action="{{ route('add_session') }}" method="POST" enctype="multipart/form-data"
                            class="mx-auto w-100 mw-600px pb-10" novalidate="novalidate"
                            id="kt_modal_create_campaign_stepper_form">
                            {{-- Info Tap --}}
                            @csrf
                            <div class="info_section" id="info_section">
                                <div class="pb-2">
                                    <!--begin::Title-->
                                    <h1 class="fw-bold text-gray-900">Info</h1>
                                    <!--end::Title-->
                                </div>
                                <div class="mb-5 fv-row">
                                    <!--begin::Label-->
                                    <label>
                                        Session Name
                                    </label>
                                    <input class="form-control sessionName" name="name" placeholder="Session Name">
                                    <span class="sessionNameFaild d-none mt-3">Please Set Session Name</span>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label>
                                        Session Date
                                    </label>
                                    <input class="form-control sessionDate" name="date" type="date"
                                        placeholder="Session Date">
                                    <span class="sessionDateFaild d-none mt-3">Please Set Session Date</span>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label>
                                        From
                                    </label>
                                    <input class="form-control sessionFrom" name="from" type="time"
                                        placeholder="Session From">
                                    <span class="sessionFormFaild d-none mt-3">Please Set Start Time</span>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label>
                                        To
                                    </label>
                                    <input class="form-control sessionTo" name="to" type="time"
                                        placeholder="Session To">
                                    <span class="sessionToFaild d-none mt-3">Please Set End Time</span>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label>
                                        Type
                                    </label>
                                    <select class="form-control sel_add_type" name="type">
                                        <option value="">
                                            Select Type ...
                                        </option>
                                        <option value="group">
                                            group
                                        </option>
                                        <option value="private">
                                            private
                                        </option>
                                        <option value="session">
                                            session
                                        </option>
                                    </select>
                                    <span class="sessionTypeFaild d-none mt-3">Please Chose Type </span>
                                </div>
                                <div class="mb-5 fv-row sel_add_group">
                                    <label>
                                        Group
                                    </label>
                                    <select class="form-control sesstionGroup" name="group_id">
                                        <option value="">
                                            Select Group ...
                                        </option>
                                        @foreach ($groups as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="sessionGroupFaild d-none mt-3">Please Chose Session Group</span>
                                </div>

                                <div class="mb-5 fv-row">
                                    <label>
                                        Users
                                    </label>
                                    <div class="col-md-12 mb-4 mb-md-0 my-2" data-select2-id="46">
                                        <div class="select2-danger" data-select2-id="45">
                                            <div class="position-relative" data-select2-id="44">
                                                <select name="user_id[]" id="select2Dangeradd"
                                                    class="select2 form-select select2-hidden-accessible sesstionUser"
                                                    multiple="" data-select2-id="select2Dangeradd" tabindex="-1"
                                                    aria-hidden="true">
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        data-select2-id="add_{{ $user->id }}">
                                                        {{ $user->nick_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span class="sessionUserFaild d-none mt-3">Please Set User</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success details_btn disabled" id="details_btn">
                                    Next
                                </button>
                            </div>
                            {{-- Details Tap --}}
                            <div class="details_section d-none" id="details_section">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <div class="pb-2">
                                        <!--begin::Title-->
                                        <h1 class="fw-bold text-gray-900">Academic</h1>
                                        <!--end::Title-->
                                    </div>

                                    <!--begin::Input group-->

                                    {{-- Start Make Type For Session Explnation Rexplenation Mistake --}}

                                    <div class="mb-5 fv-row sel_add_group" id="select_type_group">
                                        <label>
                                            Type Session Relational
                                        </label>
                                        <select class="form-control sesstionGroup" id="select_type_session"
                                            name="session_types">
                                            <option value="">
                                                Select Type Session ...
                                            </option>
                                            @foreach ($types as $item)
                                            <option value="{{ $item }}">
                                                {{ $item }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="sessionGroupFaild d-none mt-3">Please Chose Session Group</span>
                                    </div>

                                    {{-- End Make Type For Session Explnation Rexplenation Mistake --}}

                                    <div class="mb-5 fv-row">
                                        <label>
                                            Category
                                        </label>
                                        <select class="form-control sel_cate1" id="select_category">
                                            <option value="">
                                                Select Category ...
                                            </option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->cate_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="categoryFaild d-none mt-3">Please Chose Category</span>
                                    </div>

                                    <div class="mb-5 fv-row">
                                        <label>
                                            Course
                                        </label>
                                        <select class="form-control sel_course1" name="course_id" id="select_course">
                                            <option value="">
                                                Select Course ...
                                            </option>
                                        </select>
                                        <span class="courseFaild d-none mt-3">Please Chose Course</span>
                                    </div>

                                    <div class="mb-5 fv-row">
                                        <label>
                                            Chapter
                                        </label>
                                        <select class="form-control sel_chapter1" id="select_chapter">
                                            <option value="">
                                                Select Chapter ...
                                            </option>
                                        </select>
                                        <span class="chapterFaild d-none mt-3">Please Chose Chapter</span>
                                    </div>

                                    <div class="mb-5 fv-row">
                                        <label>
                                            Lesson
                                        </label>
                                        <select name="lesson_id" class="form-control sel_lesson1">
                                            <option value="">
                                                Select Lesson ...
                                            </option>
                                        </select>
                                        <span class="lessonFaild d-none mt-3">Please Chose Lesson</span>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label>
                                            Teacher
                                        </label>
                                        <select class="form-control teacher_session" name="teacher_id">
                                            <option value="">
                                                Select Teacher ...
                                            </option>
                                            @foreach ($teachers as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nick_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="teacherFaild d-none mt-3">Please Chose Teacher</span>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <button type="button" class="btn btn-secondary prev_info">
                                    Back
                                </button>
                                <button type="button" class="btn btn-success pricing_btn disabled">
                                    Next
                                </button>
                            </div>
                            {{-- Priceing Tap --}}
                            <div class="priceing_section d-none" id="priceing_section">
                                <!--begin::Wrapper-->
                                <div class="w-100">

                                    <!--begin::Heading-->
                                    <div class="pb-2">
                                        <!--begin::Title-->
                                        <h1 class="fw-bold text-gray-900">Links</h1>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="ideas" id="ideas">

                                        <div class="idea">
                                            <div class="section_idea">
                                                <span>Session Link</span>
                                                <input name="link" value=""
                                                    class="form-control form-control-lg session_link">
                                                <span class="session_linkFaild d-none mt-3">Please Set Session
                                                    Link</span>
                                            </div>
                                            <div class="section_syllabus">
                                                <span>Material Link</span>
                                                <input name="material_link" value=""
                                                    class="form-control form-control-lg material_link">
                                                <span class="material_linkFaild d-none mt-3">Please Set Material
                                                    Link</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="ideas" id="ideas">

                                        <div class="idea">
                                            <div class="section_syllabus">
                                                <span>Teacher Material Link</span>
                                                <input name="teacher_material" value=""
                                                    class="form-control form-control-lg teacher_material">
                                                <span class="material_linkFaild d-none mt-3">Please Set Teacher Material
                                                    Link</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-3"
                                    style="display: flex;align-items: center;justify-content: space-between;">
                                    <span class='btn btn-secondary prev_details'>
                                        Back
                                    </span>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary disabled subPriceing">Submit</button>
                                    </div>
                                </div>
                            </div>

                            <!--end::Wrapper-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Stepper-->
                </div>
                <!--begin::Modal body-->
            </div>
        </div>
    </div>




    <input type="hidden" class="cate" value="{{ $categories }}" />
    <input type="hidden" class="course" value="{{ $courses }}" />
    <input type="hidden" class="chapter" value="{{ $chapters }}" />
    <input type="hidden" class="lesson" value="{{ $lessons }}" />



    <table id="kt_profile_overview_table"
        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
        <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-20px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table"
                rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending"
                style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-85px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Session
                Date</th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Session
                Name</th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">From
            </th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">To</th>
            {{-- <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                Duration</th> --}}
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                Category</th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Course
            </th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Lesson
            </th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Type
            </th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Teacher
            </th>
            <th class="min-w-60px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action
            </th>
        </thead>
        <tbody class="fs-6">
            @foreach ($sessions as $session)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $session->date }}
                </td>
                <td>
                    {{ $session->name }}
                </td>
                <td>
                    {{ $session->from }}
                </td>
                <td>
                    {{ $session->to }}
                </td>
                {{-- <td>
                    {{ $session->duration }}
                </td> --}}
                <td>
                    {{ $session->lesson->chapter->course->category->cate_name ??
                    $session->course_mistake->category->cate_name }}
                </td>
                <td>
                    {{ $session->lesson->chapter->course->course_name ?? $session->course_mistake->course_name }}
                </td>
                <td>
                    @if (empty($session->lesson->lesson_name))

                    <small style="color:red">This Course Is Mistake and Don't Have Lesson</small>
                    @else
                    {{$session->lesson->lesson_name}}
                    @endif
                </td>
                <td>
                    {{ $session->type }}
                </td>
                <td>
                    {{ $session?->teacher?->nick_name }}
                </td>

                <td>
                    <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm edit_btn" data-bs-toggle="modal"
                            data-bs-target="#modalCenter{{ $session->id }}">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalDelete{{ $session->id }}">
                            Delete
                        </button>

                        <!-- Modal -->
                        <form method="POST" action="{{ route('session_edit', ['id' => $session->id]) }}">
                            @csrf
                            <div class="modal fade" id="modalCenter{{ $session->id }}" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-fullscreen p-9">
                                    <!--begin::Modal content-->
                                    <div class="modal-content modal-rounded">
                                        <!--begin::Modal header-->
                                        <div class="modal-header py-7 d-flex justify-content-between">
                                            <!--begin::Modal title-->
                                            <h2>Edit Session</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                data-bs-dismiss="modal">
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
                                            <div class="info_section" id="info_section{{ $session->id }}">
                                                <div class="pb-2">
                                                    <!--begin::Title-->
                                                    <h1 class="fw-bold text-gray-900">Info</h1>
                                                    <!--end::Title-->
                                                </div>
                                                <div class="mb-5 fv-row">
                                                    <!--begin::Label-->
                                                    <label>
                                                        Session Name
                                                    </label>
                                                    <input class="form-control" name="name" value="{{ $session->name }}"
                                                        placeholder="Session Name">
                                                </div>
                                                <div class="mb-5 fv-row">
                                                    <label>
                                                        Session Date
                                                    </label>
                                                    <input class="form-control" name="date" type="date"
                                                        value="{{ $session->date }}" placeholder="Session Date">
                                                </div>
                                                <div class="mb-5 fv-row">
                                                    <label>
                                                        From
                                                    </label>
                                                    <input class="form-control" name="from" type="time"
                                                        value="{{ $session->from }}" placeholder="Session From">
                                                </div>
                                                <div class="mb-5 fv-row">
                                                    <label>
                                                        To
                                                    </label>
                                                    <input class="form-control" value="{{ $session->to }}" name="to"
                                                        type="time" placeholder="Session To">
                                                </div>
                                                <div class="mb-5 fv-row">
                                                    <label>
                                                        Type
                                                    </label>
                                                    <select class="form-control" name="type">
                                                        <option value="{{ $session->type }}" selected>
                                                            {{ $session->type }}
                                                        </option>
                                                        <option value="group">
                                                            group
                                                        </option>
                                                        <option value="private">
                                                            private
                                                        </option>
                                                        <option value="session">
                                                            session
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-5 fv-row">
                                                    <label>
                                                        Group
                                                    </label>
                                                    <select class="form-control" name="group_id">
                                                        <option value="{{ $session->group_id }}" selected>
                                                            {{ @$session->group->name }}
                                                        </option>
                                                        @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}">
                                                            {{ $group->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-5 fv-row">
                                                    <label>
                                                        Users
                                                    </label>
                                                    <div class="select2-danger" data-select2-id="33">
                                                        <div class="position-relative" data-select2-id="443">
                                                            <select id="select2Danger" name="user_id[]"
                                                                class="select2 form-select select2-hidden-accessible"
                                                                multiple=""
                                                                data-select2-id="select2Danger{{ $session->id }}"
                                                                tabindex="-1" aria-hidden="true">
                                                                @foreach ($session->users as $user)
                                                                <option value="{{ $user->id }}" selected
                                                                    data-select2-id="edit{{ $session->id }}{{ $user->id }}">
                                                                    {{ $user->nick_name }}</option>
                                                                @endforeach
                                                                @foreach ($users as $user)
                                                                <option value="{{ $user->id }}"
                                                                    data-select2-id="{{ $user->id }}">
                                                                    {{ $user->nick_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-success details_btn"
                                                    id="details_btn">
                                                    Next
                                                </button>
                                            </div>
                                            {{-- Details Tap --}}
                                            <div class="details_section d-none" id="details_section{{ $session->id }}">
                                                <!--begin::Wrapper-->
                                                <div class="w-100">
                                                    <div class="pb-2">
                                                        <!--begin::Title-->
                                                        <h1 class="fw-bold text-gray-900">Academic</h1>
                                                        <!--end::Title-->
                                                    </div>
                                                    {{-- Start Make Type For Session Explnation Rexplenation Mistake
                                                    --}}

                                                    <div class="mb-5 fv-row sel_add_group" id="select_type_group">
                                                        <label>
                                                            Type Session Relational
                                                        </label>
                                                        <select class="form-control sesstionGroup"
                                                            id="select_type_session" name="session_types">
                                                            <option value="{{ $session->session_types }}">
                                                             {{$session->session_types}}
                                                            </option>
                                                            @foreach ($types as $item)
                                                            @if ($item != $session->session_types )
                                                            <option value="{{ $item }}">
                                                                {{ $item }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="sessionGroupFaild d-none mt-3">Please Chose Session
                                                            Group</span>
                                                    </div>

                                                    {{-- End Make Type For Session Explnation Rexplenation Mistake --}}
                                                    <!--begin::Input group-->
                                                    <div class="mb-5 fv-row">
                                                        <label>
                                                            Category
                                                        </label>
                                                        <select class="form-control sel_cate2">
                                                            <option
                                                                value="{{ $session->lesson->chapter->course->category->id  ?? $session->course_mistake->category->id}}"
                                                                selected>
                                                                {{
                                                                $session->lesson->chapter->course->category->cate_name
                                                                ?? $session->course_mistake->category->cate_name
                                                                }}
                                                            </option>
                                                            @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->cate_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-5 fv-row">
                                                        <label>
                                                            Course
                                                        </label>
                                                        <select class="form-control sel_course2">
                                                            <option
                                                                value="{{ $session->lesson->chapter->course->id ?? $session->course_mistake->id }}"
                                                                selected>
                                                                {{ $session->lesson->chapter->course->course_name ??
                                                                $session->course_mistake->course_name}}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-5 fv-row">
                                                        <label>
                                                            Chapter
                                                        </label>
                                                        <select class="form-control sel_chapter2">
                                                            <option value="{{ $session->lesson->chapter->id ?? " This
                                                                Session Is Mistake and Don\'t Have Lesson" }}" selected>
                                                                {{ $session->lesson->chapter->chapter_name
                                                                ??
                                                                "This Session Is Mistake and Don\'t Have Lesson" }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-5 fv-row">
                                                        <label>
                                                            Lesson
                                                        </label>
                                                        <select name="lesson_id" class="form-control sel_lesson2">
                                                            <option value="{{ $session->lesson_id }}" selected>
                                                                {{ $session->lesson->lesson_name ?? 'Lesson Name Empy'}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <!--end::Input group-->

                                                    <div class="mb-5 fv-row">
                                                        <label>
                                                            Teacher
                                                        </label>
                                                        <select class="form-control teacher_session_2"
                                                            name="teacher_id">
                                                            <option value="{{ $session?->teacher?->id }}" selected>
                                                                {{ $session?->teacher?->nick_name }}
                                                            </option>
                                                            @foreach ($teachers as $teacher)
                                                            <option value="{{ $teacher->id }}">
                                                                {{ $teacher->nick_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary prev_info">
                                                    Back
                                                </button>
                                                <button type="button" class="btn btn-success pricing_btn">
                                                    Next
                                                </button>
                                            </div>
                                            {{-- Priceing Tap --}}
                                            <div class="priceing_section d-none"
                                                id="priceing_section{{ $session->id }}">
                                                <!--begin::Wrapper-->
                                                <div class="w-100">

                                                    <!--begin::Heading-->
                                                    <div class="pb-2">
                                                        <!--begin::Title-->
                                                        <h1 class="fw-bold text-gray-900">Links</h1>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="ideas" id="ideas">

                                                        <div class="idea">
                                                            <div class="section_idea">
                                                                <span>Session Link</span>
                                                                <input name="link" value="{{ $session->link }}"
                                                                    class="form-control form-control-lg form-control-solid">
                                                            </div>
                                                            <div class="section_syllabus">
                                                                <span>Material Link</span>
                                                                <input name="material_link"
                                                                    value="{{ $session->material_link }}"
                                                                    class="form-control form-control-lg form-control-solid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="ideas" id="ideas">

                                                        <div class="idea">
                                                            <div class="section_syllabus">
                                                                <span>Teacher Material Link</span>
                                                                <input name="teacher_material" value="{{ $session->teacher_material }}"
                                                                    class="form-control form-control-lg teacher_material">
                                                                <span class="material_linkFaild d-none mt-3">Please Set Teacher Material
                                                                    Link</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span class='btn btn-secondary prev_details'>
                                                        Back
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                            <!--end::Stepper-->
                                        </div>
                                        <!--begin::Modal body-->
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDelete{{ $session->id }}" tabindex="-1" aria-hidden="true"
                            style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="modalCenterTitle">Delete Session</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class='p-3'>
                                        Are You Sure To Delete
                                        <span class='text-danger'>
                                            {{ $session->link }} ?
                                        </span>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <a href="{{ route('del_session', ['id' => $session->id]) }}"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            {{ $sessions->links() }}
        </tbody>
    </table>

    <script>
        let sel_cate2 = document.querySelectorAll('.sel_cate2');
        let sel_course2 = document.querySelectorAll('.sel_course2');
        let sel_chapter2 = document.querySelectorAll('.sel_chapter2');
        let sel_lesson2 = document.querySelectorAll('.sel_lesson2');
        let cate = document.querySelector('.cate');
        let course = document.querySelector('.course');
        let chapter = document.querySelector('.chapter');
        let lesson = document.querySelector('.lesson');
        let teacher_session_2 = document.querySelectorAll('.teacher_session_2');
        let edit_btn = document.querySelectorAll('.edit_btn');
        course = course.value;
        course = JSON.parse(course);
        chapter = chapter.value;
        chapter = JSON.parse(chapter);
        lesson = lesson.value;
        lesson = JSON.parse(lesson);

        for (let i = 0, end = edit_btn.length; i < end; i++) {
            edit_btn[i].addEventListener('click', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == edit_btn[j]) {
                        $.ajax("{{ route('teacher_courses') }}", {
                            type: 'GET', // http method
                            data: {
                                course_id: sel_course2[j].value
                            }, // data to submit
                            success: function(data) {
                                let teacher_id = teacher_session_2[j].value;
                                teacher_session_2[j].innerHTML = `
                            <option value="">
                                Select Teacher ...
                            </option>
                            `;
                                data.teacher.forEach(item => {
                                    if (item.user != null) {
                                        if (item.user.id == teacher_id) {
                                            teacher_session_2[j].innerHTML += `
                                        <option value="${item.user.id}" selected>
                                            ${item.user.nick_name}
                                        </option>
                                        `;
                                        } else {
                                            teacher_session_2[j].innerHTML += `
                                        <option value="${item.user.id}">
                                            ${item.user.nick_name}
                                        </option>
                                        `;
                                        }
                                    }
                                });
                            }
                        });
                    }
                }
            });
        }

        for (let i = 0, end = sel_course2.length; i < end; i++) {
            sel_course2[i].addEventListener('change', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == sel_course2[j]) {
                        $.ajax("{{ route('teacher_courses') }}", {
                            type: 'GET', // http method
                            data: {
                                course_id: sel_course2[j].value
                            },
                            success: function(data) {
                                let teacher_id = teacher_session_2[j].value;
                                teacher_session_2[j].innerHTML = `
                            <option value="">
                                Select Teacher ...
                            </option>
                            `;
                                data.teacher.forEach(item => {
                                    if (item.user != null) {
                                        if (item.user.id == teacher_id) {
                                            teacher_session_2[j].innerHTML += `
                                        <option value="${item.user.id}" selected>
                                            ${item.user.nick_name}
                                        </option>
                                        `;
                                        } else {
                                            teacher_session_2[j].innerHTML += `
                                        <option value="${item.user.id}">
                                            ${item.user.nick_name}
                                        </option>
                                        `;
                                        }
                                    }
                                });
                            }
                        });
                    }
                }
            });
        }

        for (let i = 0, end = sel_cate2.length; i < end; i++) {
            sel_cate2[i].addEventListener('change', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == sel_cate2[j]) {
                        sel_course2[j].innerHTML = `
                        <option value="">
                            Select Course ...
                        </option>`;
                        course.forEach(element => {
                            if (sel_cate2[j].value == element.category_id) {
                                sel_course2[j].innerHTML += `
                                <option value="${element.id}">
                                    ${element.course_name}
                                </option>`;
                            }
                        });
                    }
                }
            });
        }
        for (let i = 0, end = sel_course2.length; i < end; i++) {
            sel_course2[i].addEventListener('change', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == sel_course2[j]) {
                        sel_chapter2[j].innerHTML = `
                        <option value="">
                            Select Chapter ...
                        </option>`;
                        chapter.forEach(element => {
                            if (sel_course2[j].value == element.course_id) {
                                sel_chapter2[j].innerHTML += `
                                <option value="${element.id}">
                                    ${element.chapter_name}
                                </option>`;
                            }
                        });
                    }
                }
            });
        }
        for (let i = 0, end = sel_chapter2.length; i < end; i++) {
            sel_chapter2[i].addEventListener('change', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == sel_chapter2[j]) {
                        sel_lesson2[j].innerHTML = `
                        <option value="">
                            Select Lesson ...
                        </option>`;
                        lesson.forEach(element => {
                            if (sel_chapter2[j].value == element.chapter_id) {
                                sel_lesson2[j].innerHTML += `
                                <option value="${element.id}">
                                    ${element.lesson_name}
                                </option>`;
                            }
                        });
                    }
                }
            });
        }


        let sel_cate1 = document.querySelector('.sel_cate1');
        let sel_course1 = document.querySelector('.sel_course1');
        let sel_chapter1 = document.querySelector('.sel_chapter1');
        let sel_lesson1 = document.querySelector('.sel_lesson1');
        let teacher_session = document.querySelector('.teacher_session');

        sel_course1.addEventListener('change', () => {
            $.ajax("{{ route('teacher_courses') }}", {
                type: 'GET',
                data: {
                    course_id: sel_course1.value
                },
                success: function(data) {
                    let teacher_id = teacher_session.value;
                    teacher_session.innerHTML = `
                    <option value="">
                        Select Teacher ...
                    </option>
                    `;
                    data.teacher.forEach(item => {
                        if (item.user != null) {
                            if (item.user.id == teacher_id) {
                                teacher_session.innerHTML += `
                                <option value="${item.user.id}" selected>
                                    ${item.user.nick_name}
                                </option>
                                `;
                            } else {
                                teacher_session.innerHTML += `
                                <option value="${item.user.id}">
                                    ${item.user.nick_name}
                                </option>
                                `;
                            }
                        }
                    });
                }
            });
        });

        sel_cate1.addEventListener('change', () => {
            sel_course1.innerHTML = `
            <option value="">
                Select Course ...
            </option>`;
            course.forEach(element => {
                if (sel_cate1.value == element.category_id) {
                    sel_course1.innerHTML += `
                    <option value="${element.id}">
                        ${element.course_name}
                    </option>`;
                }
            });
        });
        sel_course1.addEventListener('change', () => {
            sel_chapter1.innerHTML = `
            <option value="">
                Select Chapter ...
            </option>`;
            chapter.forEach(element => {
                if (sel_course1.value == element.course_id) {
                    sel_chapter1.innerHTML += `
                    <option value="${element.id}">
                        ${element.chapter_name}
                    </option>`;
                }
            });
        });
        sel_chapter1.addEventListener('change', () => {
            sel_lesson1.innerHTML = `
            <option value="">
                Select Lesson ...
            </option>`;
            lesson.forEach(element => {
                if (sel_chapter1.value == element.chapter_id) {
                    sel_lesson1.innerHTML += `
                    <option value="${element.id}">
                        ${element.lesson_name}
                    </option>`;
                }
            });
        });
    </script>

    <script>
        let add_new_idea = document.querySelector('#add_new_idea');
        let ideas = document.querySelector('.ideas');
        add_new_idea.addEventListener('click', () => {
            ideas.innerHTML += `
            <div class="idea">
            <hr />
            <div class="section_idea">
                <span>Answer PDF</span>
                <input type="file" name="ans_pdf[]" class="form-control form-control-lg form-control-solid">
            </div>
            <div class="section_syllabus">
                <span>Answer Video</span>
                <input type="file" name="ans_video[]" class="form-control form-control-lg form-control-solid">
            </div>
            <button type="button" class="btn btn-danger btn_remove_idea">Remove</button>
            </div>`;
            let btn_remove_idea = document.querySelectorAll('.btn_remove_idea');
            for (let i = 0, end = btn_remove_idea.length; i < end; i++) {
                btn_remove_idea[i].addEventListener('click', (e) => {
                    for (let j = 0; j < end; j++) {
                        if (e.target == btn_remove_idea[j]) {
                            btn_remove_idea[j].parentElement.remove()
                        }
                    }
                });
            }
        });
    </script>
    <!--end::Step 5-->
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

    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(() => {
            $("#close_btn").click(() => {
                $("#screen_repeat").addClass("d-none")
            })
            $(".btn_repeat").click(() => {
                $("#screen_repeat").addClass("d-none")
            })
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
            })

            $(".prev_info").click(function() {
                var details_id = `#${$(this).parent().attr("id")}`;
                var info_id = `#${$(this).parent().prev().attr("id")}`;

                $(details_id).addClass("d-none");
                $(info_id).removeClass("d-none");
            })

            $(".prev_details").click(function() {
                var priceing_id = `#${$(this).parent().parent().attr("id")}`;
                var details_id = `#${$(this).parent().parent().prev().attr("id")}`;

                $(priceing_id).addClass("d-none");
                $(details_id).removeClass("d-none");
            })

            /* Infoo */
            /* Check Faild At info */
            function checkFaildInfo() {
                /* Session Name */
                if ($('.sessionName').val() == "") {
                    $(".sessionNameFaild").removeClass("d-none");
                    $(".details_btn").addClass("disabled")
                } else {
                    $(".sessionNameFaild").addClass("d-none");
                }
                /* Session Date */
                if ($('.sessionDate').val() == "") {
                    $(".sessionDateFaild").removeClass("d-none");
                    $(".details_btn").addClass("disabled")
                } else {
                    $(".sessionDateFaild").addClass("d-none");
                }
                /* Session From */
                if ($('.sessionFrom').val() == "") {
                    $(".sessionFormFaild").removeClass("d-none");
                    $(".details_btn").addClass("disabled")
                } else {
                    $(".sessionFormFaild").addClass("d-none");
                }
                /* Session To */
                if ($('.sessionTo').val() == "") {
                    $(".sessionToFaild").removeClass("d-none");
                    $(".details_btn").addClass("disabled")
                } else {
                    $(".sessionToFaild").addClass("d-none");
                }
                /* Session Type */
                if ($('.sel_add_type').val() == "") {
                    $(".sessionTypeFaild").removeClass("d-none");
                    $(".details_btn").addClass("disabled")
                } else {
                    $(".sessionTypeFaild").addClass("d-none");
                }
                /* Session Group */
                // if ($('.sesstionGroup').val() == "") {
                //     $(".sessionGroupFaild").removeClass("d-none");
                //     $(".details_btn").addClass("disabled")
                // } else {
                //     $(".sessionGroupFaild").addClass("d-none");
                // }
                /* Session User */
                // if ($('.sesstionUser').val() == "") {
                //     $(".sessionUserFaild").removeClass("d-none");
                //     $(".details_btn").addClass("disabled")
                // } else {
                //     $(".sessionUserFaild").addClass("d-none");
                // }
            }
            /* Check data in info */
            function conditionInfo() {
                if ($(".sessionName").val() && $(".sessionDate").val() && $(".sessionFrom").val() && $(
                        ".sessionTo").val() && $(".sel_add_type").val() !== "") {
                    $(".details_btn").removeClass("disabled")
                    checkFaildInfo()
                } else {
                    checkFaildInfo()
                }
            }

            $(".sessionName").change(function() {
                conditionInfo()
            })
            $(".sessionDate").change(function() {
                conditionInfo()
            })
            $(".sessionFrom").change(function() {
                conditionInfo()
            })
            $(".sessionTo").change(function() {
                conditionInfo()
            })
            $(".sel_add_type").change(function() {
                conditionInfo()
            })
            // $(".sesstionGroup").change(function() {
            //     conditionInfo()
            // })
            // $(".sesstionUser").change(function() {
            //     conditionInfo()
            // })
            /* Details */
            /* Check Faild At Details */
            function checkFaildDetails() {
                /* Session Category */
                if ($('.sel_cate1').val() == "") {
                    $(".categoryFaild").removeClass("d-none");
                    $(".pricing_btn").addClass("disabled")
                } else {
                    $(".categoryFaild").addClass("d-none");
                }
                /* Session Course */
                if ($('.sel_course1').val() == "") {
                    $(".courseFaild").removeClass("d-none");
                    $(".pricing_btn").addClass("disabled")
                } else {
                    $(".courseFaild").addClass("d-none");
                }
                /* Session Chapter */
                if ($('.sel_chapter1').val() == "") {
                    $(".chapterFaild").removeClass("d-none");
                    $(".pricing_btn").addClass("disabled")
                } else {
                    $(".chapterFaild").addClass("d-none");
                }
                /* Session Lesson */
                if ($('.sel_lesson1').val() == "") {
                    $(".lessonFaild").removeClass("d-none");
                    $(".pricing_btn").addClass("disabled")
                } else {
                    $(".lessonFaild").addClass("d-none");
                }
                /* Session Teacher */
                if ($('.teacher_session').val() == "") {
                    $(".teacherFaild").removeClass("d-none");
                    $(".pricing_btn").addClass("disabled")
                } else {
                    $(".teacherFaild").addClass("d-none");
                }
            }
            /* Check data in details */
            function conditionDetails() {
                if ($(".sel_cate1").val() && $(".sel_course1").val() && $(".sel_chapter1").val() && $(
                        ".sel_lesson1").val() && $(".teacher_session").val() !== "") {
                    $(".pricing_btn").removeClass("disabled")
                    checkFaildDetails()
                } else {
                    checkFaildDetails()
                }
            }

            $(".sel_cate1").change(function() {
                conditionDetails()
            })
            $(".sel_course1").change(function() {
                conditionDetails()
            })
            $(".sel_chapter1").change(function() {
                conditionDetails()
            })
            $(".sel_lesson1").change(function() {
                conditionDetails()
            })
            $(".teacher_session").change(function() {
                conditionDetails()
            })

            /* Priceing */
            /* Check Faild At Priceing */
            function checkFaildPriceing() {
                /* Session Link */
                if ($('.session_link').val() == "") {
                    $(".session_linkFaild").removeClass("d-none");
                    $(".subPriceing").addClass("disabled")
                } else {
                    $(".session_linkFaild").addClass("d-none");
                }
                /* Session material Link */
                if ($('.material_link').val() == "") {
                    $(".material_linkFaild").removeClass("d-none");
                    $(".subPriceing").addClass("disabled")
                } else {
                    $(".material_linkFaild").addClass("d-none");
                }
            }
            /* Check data in Priceing */
            function conditionPriceing() {
                if ($(".session_link").val() && $(".material_link").val() !== "") {
                    $(".subPriceing").removeClass("disabled")
                    checkFaildPriceing()
                } else {
                    checkFaildPriceing()
                }
            }

            $(".session_link").keyup(function() {
                conditionPriceing()
            })
            $(".material_link").keyup(function() {
                conditionPriceing()
            })
        })
    </script>
    {{-- <script>
        $(document).ready(function () {
            // Initially hide all groups
            $('#select_category, #select_course, #select_chapter, .sel_lesson1').parent().show();
            // Handle change event for session type dropdown
            $('#select_type_session').on('change', function () {
                const selectedType = $(this).val();
                    console.log(selectedType);
                // Hide all dropdown groups
                // Show specific dropdowns based on the selected type
                if (selectedType === 'rexplanation') {
                    $('#select_category,#select_course,#select_chapter,.sel_lesson1').parent().show();
                } else if (selectedType === 'explanation') {
                    $('#select_category,#select_course,#select_chapter,.sel_lesson1').parent().show();
                } else if (selectedType === 'mistake') {
            $(' #select_chapter, .sel_lesson1').parent().hide();
            $(' #select_chapter, .sel_lesson1').parent().val();
                // $('.sel_lesson1').parent().hide();
                    $('#select_course').parent().show();

                    if(selectedType != ""){
                        $(".details_btn").removeClass("disabled")
                    }
                }
                // Trigger the change event to set the initial visibility
            });
            $('#select_type_session').trigger('change');

        });
    </script> --}}

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('../../assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('../../assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>

</x-default-layout>