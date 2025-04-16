@php
function fun_admin()
{
return 'admin';
}
@endphp
<x-default-layout>

    @section('title', 'Currency')
    @include('success')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .ideas {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            row-gap: 1.2rem;
        }

        .idea {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            row-gap: 1rem;
            padding-bottom: 20px;
            border-bottom: 1px solid #dbdbdb;
        }

        .idea .section_idea {
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .idea .section_idea>span {
            font-size: 1.2rem
        }

        .idea .section_idea>input {
            width: 80% !important;
        }

        .idea .section_syllabus {
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .idea .section_syllabus>span {
            font-size: 1.2rem
        }

        .idea .section_syllabus>input {
            width: 80% !important;
        }

        .idea .section_pdf {
            display: flex;
            align-items: center;
        }

        .idea .section_pdf>span {
            font-size: 1.2rem;
            margin-right: 15px;
        }

        .idea .section_pdf>input {
            font-size: 1.1rem;
        }

        .idea .section_video_link {
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .idea .section_video_link>span {
            font-size: 1.2rem
        }

        .idea .section_video_link>input {
            width: 80% !important;
        }

        .idea .section_add_idea {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .idea .section_add_idea>button {
            background: red !important;
        }

        .idea .section_add_idea>button:hover:not(.btn-active) {
            background: rgb(144, 18, 18) !important;
        }
    </style>


    @error('currency')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    @error('amount')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    </div>

    <div class="px-5">
        <!--begin::Action-->
        <a href="#" class="btn btn-primary er fs-6 px-8 py-4 mx-2" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_campaign">Add Currency</a>
        <!--end::Action-->

        <table id="kt_profile_overview_table"
            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
            <thead class="fs-7 text-gray-500 text-uppercase">
                <th class="min-w-250px sorting sorting_desc text-center" tabindex="0"
                    aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
                    aria-label="Manager: activate to sort column ascending" style="width: 336.359px;"
                    aria-sort="descending">#</th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Currency
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Amount
                </th>
            </thead>
            <tbody class="fs-6">
                @foreach ($currencies as $currency)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $currency->currency }}
                    </td>
                    <td>
                        {{ $currency->amount }}
                    </td>

                    <td>
                        <div class="mt-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalCenter{{ $currency->id }}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalDelete{{ $currency->id }}">
                                Delete
                            </button>

                            <!-- Modal -->


                            <form method="POST" id="form-edit{{ $currency->id }}" action="{{ route('edit_currency', ['id' => $currency->id]) }}"
                                class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="modalCenter{{ $currency->id }}" tabindex="-1"
                                    aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content px-2">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Edit Currency</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>


                                            <div class="info_section" id="info_section{{ $currency->id }}">
                                                <div class='my-3'>
                                                    <label>Currency</label>
                                                    <input class='form-control' value="{{ $currency->currency }}"
                                                    required name="currency" placeholder="Curency" />
                                                </div>
                                                <div class='my-3'>
                                                    <label>Amount</label>
                                                    <input class='form-control' value="{{ $currency->amount }}"
                                                    required name="amount" placeholder="Amount" />
                                                </div>

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
                            <div class="modal fade" id="modalDelete{{ $currency->id }}" tabindex="-1" aria-hidden="true"
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
                                                {{ $currency->currency }} ??
                                            </span>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <a href="{{ route('delete_currency', ['id' => $currency->id]) }}"
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

                      
        <form method="POST" action="{{ route('add_currency') }}"
            class="mx-auto w-100 mw-600px pt-15 pb-10" novalidate="novalidate"
            enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="kt_modal_create_campaign" tabindex="-1"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content px-2">

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Add Currency</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>


                        <div class="info_section">
                            <div class='my-3'>
                                <label>Currency</label>
                                <input class='form-control'
                                    name="currency" placeholder="Curency" required />
                            </div>
                            <div class='my-3'>
                                <label>Amount</label>
                                <input class='form-control' type="number" required
                                    name="amount" type="number" placeholder="Amount" />
                            </div>

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
        
 
    </div>

</x-default-layout>