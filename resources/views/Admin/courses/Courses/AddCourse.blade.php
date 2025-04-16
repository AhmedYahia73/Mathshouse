@section('title', 'Add Course')

@error('course_name')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror
@error('teacher_id')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror
@error('course_price')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror
@error('category_id')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror

<style>
    .remove_btn {
        border: none;
        background: red;
        padding: 10px 15px;
        border-radius: 8px;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
        cursor: pointer;
    }
</style>

<!--end::Action-->

<div class="modal fade" id="kt_modal_create_question" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-fullscreen p-9">
        <!--begin::Modal content-->
        <div class="modal-content modal-rounded">
            <!--begin::Modal header-->
            <div class="modal-header py-7 d-flex justify-content-between">
                <!--begin::Modal title-->
                <h2>Add Course</h2>
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

                    <form class="px-3" action="{{ route('course_add') }}" method="POST"
                        enctype="multipart/form-data">
                        <!--begin::Step 1-->
                        <div class="current" data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                @csrf
                                <div>
                                    {{--  Page One --}}
                                    <div class='my-3'>
                                        <label>Course Name</label>
                                        <input class='form-control' name="course_name" placeholder="Course Name" />
                                    </div>
                                    <div class='my-3'>
                                        <label>Category</label>
                                        <select name="category_id" class="form-control">
                                            <option disabled selected>
                                                Select Category
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->cate_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='my-3'>
                                        <label>Description</label>
                                        <textarea class='form-control' name="course_des" placeholder="Description"></textarea>
                                    </div>

                                    <div class='my-3'>
                                        <label>Image</label>
                                        <input class='form-control' type="file" name="course_url"
                                            placeholder="Image" />
                                    </div>
                                    {{--  End Page One --}}
                                </div>

                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">

                                {{-- Page Two --}}

                                <div class='my-3'>
                                    <label>Teachers</label>
                                    <select name="teacher_id" class="form-control">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->nick_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='my-3'>
                                    <label>Pre requisition</label>
                                    <textarea class='form-control' name="pre_requisition" placeholder="Pre requisition"></textarea>
                                </div>
                                <div class='my-3'>
                                    <label>What you gain</label>
                                    <textarea class='form-control' name="gain" placeholder="What you gain"></textarea>
                                </div>
                                {{-- End Page Two --}}
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 5-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                {{-- Page Three --}}
                                <div class="pricing_data">
                                    <div class="section_idea my-3 d-flex align-items-center">
                                        <span>Duration</span>
                                        <input type="number" name="duration[]"
                                            class="form-control mx-2 form-control-lg" placeholder="Duration" />
                                        <span>Days</span>
                                    </div>

                                    <div class='my-3'>
                                        <label>Price</label>
                                        <input class='form-control' name="price[]" placeholder="Price" />
                                    </div>
                                    <div class='my-3'>
                                        <label>Discount</label>
                                        <input class='form-control' name="discount[]" placeholder="Discount" />
                                    </div>
                                    <hr />
                                </div>
                                <div class="pricing_list">

                                </div>
                                <div class="mt-3">
                                    <button type="button" class='btn btn-success pricing_button'>
                                        Add New Pricing
                                    </button>
                                </div>
                                {{-- End Page Three --}}
                            </div>
                            <!--end::Wrapper-->
                        </div>

                        <!--end::Step 5-->
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
                                <button type="button" class="btn btn-lg btn-primary continue_btn"
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
        $(document).ready(function (){
            $(".details_btn").click(function() {
                console.log("firstfirstfirstfirst")
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

            console.log("kll")
            $(".add_price_btn").on("click", function() {
                var parPrice = `#${$(this).parent().attr("id")}`;
                var priceSection = $(parPrice).find(".pricing_div");
                console.log("kkkk");
                var newPricing = `<div class="pricing">
                <div class='my-3'>
                    <label>Duration</label>
                    <input class='form-control'
                        name="duration[]" placeholder="Duration" />
                </div>
                <div class='my-3'>
                    <label>Price</label>
                    <input class='form-control'
                        name="price[]" placeholder="Price" />
                </div>
                <div class='my-3'>
                    <label>Discount</label>
                    <input class='form-control'
                        name="discount[]" placeholder="Discount" />
                </div>
                 <button type="button" class="btn btn-danger btn_remove_price">Remove</button>
             </div>`;

                $(priceSection).append(newPricing)

                $(".btn_remove_price").each((val, ele) => {
                    // console.log("ele",ele)
                    $(ele).click(function() {
                        $(ele).closest(".pricing").remove();
                    })
                    // console.log("val",val)
                })
            })


            $(".pricing_button").click(function() {
                var newPricing = `<div class="pricing_data">
                                    <div class="section_idea my-3 d-flex align-items-center">
                                        <span>Duration</span>
                                        <input type="number" name="duration[]"
                                            class="form-control mx-2 form-control-lg" placeholder="Duration" />
                                        <span>Days</span>
                                    </div>

                                    <div class='my-3'>
                                        <label>Price</label>
                                        <input class='form-control' name="price[]" placeholder="Price" />
                                    </div>
                                    <div class='my-3'>
                                        <label>Discount</label>
                                        <input class='form-control' name="discount[]" placeholder="Discount" />
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <span class="remove_btn" id="btn_remove">Remove</span>
                                    </div>
                                    <hr />
                                </div>`;

                $(".pricing_list").append(newPricing)

                $(".remove_btn").each((val, ele) => {
                    // console.log("ele",ele)
                    $(ele).click(function() {
                        $(ele).closest(".pricing_data").remove();
                    })
                    // console.log("val",val)
                })
            })

        })
    </script>

@endsection
