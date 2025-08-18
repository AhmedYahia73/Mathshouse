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
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalParentAdd">
        Add Notification
    </button> 
    <!-- Modal -->
    <form method="POST" enctype="multipart/form-data" action="{{ route('add_notifictions') }}">
        @csrf
        <div class="modal fade" id="modalParentAdd" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="modalCenterTitle">Add Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

         
                    <div class='my-2 px-3'>
                        <label>Material Link</label>
                        <input class='form-control' name="material_link" placeholder="Material Link" />
                    </div>
                    <div class='my-2 px-3'>
                        <label>Material File</label>
                        <input class='form-control' type="file" name="material_file" placeholder="Material File" />
                    </div>

                    <div class="my-2 px-3">
                        <label>
                            Date Time
                        </label>
                        <input class='form-control' name="date" 
                        type="datetime-local"
                        required
                        step="1" placeholder="Date Time" />
                    </div>
                    <div class='my-2 px-3'>
                        <label>Notification</label>
                        <textarea class='form-control' type="texatarea" name="text" placeholder="Notification"></textarea>
                    </div>

                    <div class="my-2 px-3">
                        <select name="parents[]" class="mySelect mySelectParent" multiple>
                            @foreach ($parents as $element)
                                <option value="{{ $element->id }}">
                                    {{ $element->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-2 px-3">
                        <select name="students[]" class="mySelect mySelectStudent" multiple>
                            @foreach ($students as $element)
                                <option value="{{ $element->id }}">
                                    {{ $element->nick_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-2 px-3">
                        <select name="teachers[]" class="mySelect mySelectTeacher" multiple>
                            @foreach ($teachers as $element)
                                <option value="{{ $element->id }}">
                                    {{ $element->nick_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>  

                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
 



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
                    date
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Time
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Action
                </th>
            </thead>
            <tbody class="fs-6">
                @foreach ($notifications as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item['text'] }}
                    </td>
                    <td class="text-center">
                        <a href="{{ $item['material_link'] }}" class="text-primary">
                            Open Link
                        </a>
                    </td> 
                    <td>
                        {{ $item['date'] }}
                    </td>
                    <td>
                        {{ $item['time'] }}
                    </td> 

                    <td>
                        <div class="mt-3"> 
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm edit_btn" data-bs-toggle="modal"
                                data-bs-target="#modalCenter{{ $item['id'] }}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalDelete{{ $item['id'] }}">
                                Delete
                            </button> 


                        <!-- Modal -->
                        <form method="POST" action="{{ route('update_notifictions', ['id' => $item['id']]) }}">
                           @csrf
                            <div class="modal fade" id="modalCenter{{ $item['id'] }}" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalCenterTitle">Add Notification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                            
                                        <div class='my-2 px-3'>
                                            <label>Material Link</label>
                                            <input class='form-control' name="material_link" value="{{ $item['material_link'] }}" placeholder="Material Link" />
                                        </div>
                                        <div class='my-2 px-3'>
                                            <label>Material File</label>
                                            <input class='form-control' type="file" name="material_file" placeholder="Material File" />
                                        </div>

                                        <div class="my-2 px-3">
                                            <label>
                                                Date Time
                                            </label>
                                            <input class='form-control' name="date" 
                                            type="datetime-local"
                                            required value="{{ \Carbon\Carbon::parse($item['date'])->format('Y-m-d\TH:i:s') }}"
                                            step="1" placeholder="Date Time" />
                                        </div>
                                        <div class='my-2 px-3'>
                                            <label>Notification</label>
                                            <textarea class='form-control' type="texatarea" name="text" placeholder="Notification">{{ $item['text'] }}</textarea>
                                        </div> 

                                        <div class="my-2 px-3">
                                            <select name="parents[]" class="mySelect mySelectParent" multiple>
                                                @foreach ($parents as $element)
                                                    <option value="{{ $element->id }}"
                                                        @if (in_array($element->id, $item['parent']->pluck('id')->toArray())) selected @endif>
                                                        {{ $element->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="my-2 px-3">
                                            <select name="students[]" class="mySelect mySelectStudent" multiple>
                                                @foreach ($students as $element)
                                                    <option value="{{ $element->id }}"
                                                        @if (in_array($element->id, $item['students']->pluck('id')->toArray())) selected @endif>
                                                        {{ $element->nick_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="my-2 px-3">
                                            <select name="teachers[]" class="mySelect mySelectTeacher" multiple>
                                                @foreach ($teachers as $element)
                                                    <option value="{{ $element->id }}"
                                                        @if (in_array($element->id, $item['teachers']->pluck('id')->toArray())) selected @endif>
                                                        {{ $element->nick_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>  

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                            <!-- Modal -->
                            <div class="modal fade" id="modalDelete{{ $item['id'] }}" tabindex="-1" aria-hidden="true"
                                style="display: none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class='p-3'>
                                            Are You Sure To Delete ??
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <a href="{{ route('delete_notifictions', ['id' => $item['id']]) }}"
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
        $(document).ready(function() {
            $('.mySelect').select2({
                placeholder: "Select Students",
                allowClear: true
            });
            $('.mySelectStudent').select2({
                placeholder: "Select Students",
                allowClear: true
            });
            $('.mySelectParent').select2({
                placeholder: "Select Parent",
                allowClear: true
            });
            $('.mySelectTeacher').select2({
                placeholder: "Select Teacher",
                allowClear: true
            });
        });
    </script>

    @endsection
</x-default-layout>