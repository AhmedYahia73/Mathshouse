@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
    @section('title', 'Raw Score')
    @include('success')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <a href="#" class="btn btn-primary er fs-6 px-8 py-4 my-3" data-bs-toggle="modal"
        data-bs-target="#kt_modal_create_api_key">Add</a>
    <style>
        .removeScoreQuestion {
            display: block;
            margin-top: 10px;
            border: none;
            background: red;
            font-size: 1.2rem;
            padding: 7px 9px;
            border-radius: 8px;
            color: #fff;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }
    </style>
    {{-- Start Model For Add New Category --}}
    <div class="modal fade" id="kt_modal_create_api_key" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_create_api_key_header">
                    <!--begin::Modal title-->
                    <h2>Add Raw Score</h2>
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
                <!--end::Modal header-->
                <!--begin::Form-->
                <form id="kt_modal_create_api_key_form" action="{{ route('addScore') }}" method="POST"
                    enctype="multipart/form-data" class="form">
                    @csrf

                    <div class="p-3">
                        <div class="my-2">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Name" />
                        </div>

                        <div class="my-2">
                            <label>Category</label>
                            <select class="form-control cate_sel">
                                <option disabled selected>
                                    Select Category
                                </option>

                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->cate_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-2">
                            <label>Course</label>
                            <select class="form-control course_sel" name="course_id">
                                <option disabled selected>
                                    Select Course
                                </option>
                            </select>
                        </div>

                        <div class="my-2">
                            <label>Score</label>
                            <input class="form-control" name="score" placeholder="Score" />
                        </div>

                        <input type="hidden" class="course_items" value="{{ $courses }}" />

                        <div class="my-2">
                            <label>Number of Questions</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control question_num" name="q_num"
                                    placeholder="Number of Questions" />
                                <button type="button" class="btn btn-primary show_list mx-2 w-150px">
                                    Show List
                                </button>
                            </div>
                        </div>

                        <div class="score_list"></div>

                    </div>
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="submit" value="Submit" id="kt_modal_create_api_key_submit"
                            class="btn btn-primary">
                            ADD
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <table id="kt_profile_overview_table"
        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
        <thead class="fs-7 text-gray-500 text-uppercase">
            <tr>
                <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table"
                    rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending"
                    style="width: 336.359px;" aria-sort="descending">SL</th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Name
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Category</th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Course
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Score
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action
                </th>
        </thead>
        <tbody class="fs-6">
            @foreach ($score_sheet as $item)
                <tr class="odd">
                    <td class="sorting_1">
                        {{ $loop->iteration }}
                    </td>
                    <td class="sorting_1">
                        {{ $item->name }}
                    </td>
                    <td class="sorting_1">
                        {{ $item->course->category->cate_name }}
                    </td>
                    <td class="sorting_1">
                        {{ $item->course->course_name }}
                    </td>
                    <td class="sorting_1">
                        {{ $item->score }}
                    </td>
                    <td class="sorting_1">
                        <div class="menu-item px-3">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_invite_friends{{ $item->id }}">Edit</button>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#kt_del_btn{{ $item->id }}">Delete</button>
                        </div>
                    </td>
                </tr>
                {{-- start Model With Delet --}}
                <div class="modal fade" id="kt_del_btn{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header pb-0 border-0 justify-content-end">
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
                            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">

                                Are You Sure Delete
                                <span class="text-danger">
                                    {{ $item->name }}
                                </span>
                                <div class="mt-5">
                                    <a href="{{ route('scoreDelete', ['id' => $item->id]) }}" class="btn btn-danger">
                                        Delete
                                    </a>
                                    <div class="btn btn-primary" data-bs-dismiss="modal">
                                        Cancel
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>

                {{-- start Model With Edit --}}
                    @csrf
                    <div class="modal fade" id="kt_modal_invite_friends{{ $item->id }}" tabindex="-1"
                        aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header pb-0 pt-2 border-0 justify-content-end">
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
                                <div class="modal-body scroll-y pt-0">
                                    <!--begin::Heading-->
                                    <div class="text-center mb-2">
                                        <!--begin::Title-->
                                        <h1>Edit Raw Score</h1>
                                        <!--end::Title-->


                                    </div>
                                    <!--end::Heading-->

                                    <div class="myformScore" id="myformScore{{ $item->id }}">
                                        <div class="p-3 formScoreEdit" id="formScoreEdit{{ $item->id }}">
                                            <input type="hidden" name="score_id" value="{{ $item->id }}"
                                            class="score_id">
                                            <div class="my-2">
                                                <label>Name</label>
                                                <input class="form-control scoreName" name="name"
                                                    value="{{ $item->name }}" placeholder="Name" />
                                            </div>

                                            <div class="my-2">
                                                <label>Category</label>
                                                <select class="form-control cate_sel2"
                                                    id="cate_sel2{{ $item->id }}">
                                                    <option>
                                                        Select Category
                                                    </option>
                                                    <option value="{{ $item->course->category->id }}">
                                                        {{ $item->course->category->cate_name }}
                                                    </option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->cate_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="my-2">
                                                <label>Course</label>
                                                <select class="form-control course_sel2"
                                                    id="course_sel2{{ $item->id }}" name="course_id">
                                                    <option disabled>
                                                        Select Course
                                                    </option>
                                                    <option selected value="{{ $item->course->id }}">
                                                        {{ $item->course->course_name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="my-2">
                                                <label>Score</label>
                                                <input class="form-control score" name="score"
                                                    value="{{ $item->score }}" placeholder="Score" />
                                            </div>

                                            <input type="hidden" class="course_items"
                                                id="course_items{{ $item->id }}" value="{{ $courses }}" />

                                            <div class="my-2">
                                                <label>Number of Questions</label>
                                                <div class="d-flex">
                                                    <input class="form-control question_num" type="number"
                                                        value="{{ count($item->score_list) }}"
                                                        id="question_num{{ $item->id }}" name="q_num"
                                                        placeholder="Number of Questions" />
                                                    <button type="button"
                                                        class="new_list btn btn-primary show_list ms-3 p-0"
                                                        id="new_list{{ $item->id }}">
                                                        Add List
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="score_list_edit mt-5 d-flex flex-column"
                                                id="score_list_edit{{ $item->id }}">
                                                <div
                                                    class="col-md-12 d-flex justify-content-start gap-7 border-bottom">
                                                    <h5>Row</h5>
                                                    <h5>Score</h5>
                                                </div>
                                                @foreach ($item->score_list as $element)
                                                <div
                                                class="mt-4 d-flex justify-content-between align-items-baseline gap-3 pb-3 border-bottom scors">
                                                <input type="hidden" class="question_num" value="{{ $element->question_num }}"
                                                    name="question_num[]" />
                                                        <h4 style="width: 8% !important;">{{ $element->question_num }}
                                                            -
                                                        </h4>
                                                        <input class="form-control scoreQuestion" id="scoreQuestion"
                                                            value="{{ $element->score }}" name="score_list[]" />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <span class="removeScoreQuestion">Remove</span>
                                            <div class="col-md-12 d-flex justify-content-end mt-5">
                                                {{-- <span class="btn btn-primary btnTest">Test</span> --}}
                                                <button class="btn btn-primary btnEdit">Edit Score</button>
                                            </div>
              
                </div>
                <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
                </div>
                </form>
            @endforeach
        </tbody>
        {{ $score_sheet->links() }}
    </table>

    <script>
        let cate_sel1 = document.querySelector('.cate_sel');
        let course_sel1 = document.querySelector('.course_sel');
        let course_items1 = document.querySelector('.course_items');
        course_items1 = course_items1.value;
        course_items1 = JSON.parse(course_items1);

        cate_sel1.addEventListener('change', () => {
            course_sel1.innerHTML = `<option selected disabled>
                        Select Course    
                    </option>`;
            course_items1.forEach(item => {
                if (item.category_id == cate_sel1.value) {
                    course_sel1.innerHTML += `
                    <option value="${item.id}">
                        ${item.course_name}    
                    </option>
                    `;
                }
            });
        })

        $(document).ready(function() {


        //     var parScore = `#${$(this).closest(".modal-body").find(".formScoreEdit").attr("id")}`;
        //     var cate_sel = `#${$(parScore).find('.cate_sel').attr("id")}`;
        //     var cate_sel2 = `#${$(parScore).find('.cate_sel2').attr("id")}`;
        //     var course_sel = `#${$(parScore).find('.course_sel').attr("id")}`;
        //     var course_sel2 = `#${$(parScore).find('.course_sel2').attr("id")}`;
        //     var course_items = `#${$(parScore).find('.course_items').attr("id")}`;
        //     $(course_items) = $(course_items).val();
        //     $(course_items) = JSON.parse(course_items);
        //     $(cate_sel).change(() => {
        //         console.log(123);
        //         $(course_sel).innerHTML = `
        // <option disabled selected>
        //     Select Course     
        // </option>`;

        //         $(course_items).each(element => {
        //             if (element.category_id == $(cate_sel).val()) {
        //                 $(course_sel).innerHTML += `
        //         <option value="${element.id}">
        //             ${element.course_name}   
        //         </option>`;
        //             }
        //         });
        //     });
        //     $(cate_sel2).change(() => {
        //         console.log(123);
        //         $(course_sel2).innerHTML = `
        // <option disabled selected>
        //     Select Course     
        // </option>`;

        //         $(course_items).each(element => {
        //             if (element.category_id == $(cate_sel2).val()) {
        //                 $(course_sel2).innerHTML += `
        //         <option value="${element.id}">
        //             ${element.course_name}   
        //         </option>`;
        //             }
        //         });
        //     });

            let question_num = document.querySelector('.question_num');
            let show_list = document.querySelector('.show_list');
            let score_list = document.querySelector('.score_list');
            show_list.addEventListener('click', () => {
                let num = question_num.value;
                num = parseInt(num);
                let score_arr = '';
                for (let i = 1; i <= num; i++) {
                    score_arr += `
                <tr>
                    <td>
                        <input type="hidden" value="${i}" name="question_num[]" />
                        ${i}
                    </td>
                    <td>
                        <input class="form-control" name="score_list[]" />
                    </td>  
                </tr>
                `;
                }
                score_list.innerHTML = `
            <table class="table">
                <thead>
                    <th class="col-2">Row Score</th>
                    <th>Score</th>    
                </thead> 
                <tbody>
                    ${score_arr}  
                </tbody>   
            </table>
            `;
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".removeScoreQuestion", function() {
                var parScore = `#${$(this).closest(".modal-body").find(".formScoreEdit").attr("id")}`;
                var scoreEle = $(parScore).find(".scors");
                // $(this).parent().remove();
                $(scoreEle).last().remove();
                // $(scoreEle).each((val, ele) => {
                //     console.log("eleeeeee", ele)
                // })
                console.log("SSSSSSSSSSSSSSss")
            })
            $(".new_list").click(function() {
                var sec_app = `#${$(this).closest(".modal-body").find('.score_list_edit').attr("id")}`;
                var countScore = $(this).closest(".modal-body").find('.question_num').val();
                var indexScore = $(sec_app).find(".scors").length;

                for (let i = 0; i < parseInt(countScore); i++) {
                    var newScore = `<div class="new_score mt-4 d-flex justify-content-between align-items-baseline gap-3 pb-3 border-bottom scors">
                                         <input type="hidden" class="question_num" value=${indexScore + i + 1} name="question_num[]" />                
                                        <h4 style="width: 8% !important;">
                                        ${indexScore + i + 1} -</h4>
                                        <input class="form-control scoreQuestion"
                                            name="score_list[]" />
                                    </div>`;
                    $(sec_app).append(newScore)
                    // console.log(i)
                }
                // console.log(sec_app)


            })
            // $(".btnTest").each(function(val, ele) {
            $(".cate_sel2").change(function() {
                var parScore = `#${$(this).closest(".modal-body").find(".formScoreEdit").attr("id")}`;

                var seleCategory = `#${$(parScore).find('.cate_sel2').attr("id")}`;
                var seleCourse = `#${$(parScore).find('.course_sel2').attr("id")}`;
                var course_items = `#${$(parScore).find('.course_items').attr("id")}`;
                var allCoursesArr = $(course_items).val();
                var allCoursesData = JSON.parse(allCoursesArr);

                console.log("######");
                console.log("seleCategory", seleCategory);
                console.log("seleCourse", seleCourse);
                console.log("course_items", course_items);
                console.log("allCoursesArr", allCoursesArr);
                console.log("allCoursesData", allCoursesData);

                // $(seleCategory).change(() => {
                // function() {
                $(seleCourse).empty()
                $(seleCourse).append(`
                        <option>
                            Select Course   
                        </option>`);

                $(allCoursesData).each((val, ele) => {
                    console.log("ele", ele)
                    if (ele.category_id == $(seleCategory).val()) {
                        $(seleCourse).append(`
                            <option value="${ele.id}">
                                ${ele.course_name}   
                            </option>`);
                    }
                });
                // };
            })

            $(".btnEdit").click(function() {
                var parScore = `#${$(this).closest(".modal-body").find(".formScoreEdit").attr("id")}`;
                var score_id = $(parScore).find(".score_id").val();
                var score_name = $(parScore).find(".scoreName").val();
                var score_category = $(parScore).find(".cate_sel2").val();
                var score_course = $(parScore).find(".course_sel2").val();
                var score = $(parScore).find(".score").val();
                var score_num = $(parScore).find(".question_num").val();

                console.log("parScore", parScore)
                console.log("score_id", score_id)
                console.log("score_name", score_name)
                console.log("score_category", score_category)
                console.log("score_course", score_course)
                console.log("score", score)
                console.log("score_num", score_num)

                var scoreList = [];
                var questionNumbers = [];
                var scoreEle = $(parScore).find(".scors");
                console.log("scoreEle", scoreEle)
                $(scoreEle).each((val, ele) => {
                    console.log("score", ele)
                    var questionNum = $(ele).find(".question_num").val();
                    questionNumbers.push(val + 1 );
                    var scoreQuestion = $(ele).find(".scoreQuestion").val();
                    scoreList.push(scoreQuestion);
                })
                console.log("scoreList", scoreList)
                console.log("questionNumbers", questionNumbers)

                var scoreEdite = {
                    id: score_id,
                    name: score_name,
                    category: score_category,
                    course: score_course,
                    score: score,
                    num: score_num,
                    questionNumbers: questionNumbers,
                    scores: scoreList,
                }

                $.ajax({
                    url: "{{ route('scoreEdit') }}",
                    type: "GET",
                    data: {
                        score_list: scoreEdite
                    },
                    success: function(data) {
                        console.log("data", data)
                        location.reload()
                    }
                })
            })
            // })
        })
    </script>

</x-default-layout>
