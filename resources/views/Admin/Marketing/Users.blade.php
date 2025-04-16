@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
    @section('title', 'Users')


    <a href="#" class="btn btn-primary w-150px mx-3 my-2 h-45px" data-bs-toggle="modal"
        data-bs-target="#kt_modal_create_question">
        Add User
    </a>
    @error('name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('email')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('phone')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('organization')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @include('success')

    <div class="modal fade" id="kt_modal_create_question" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-fullscreen p-9">
            <!--begin::Modal content-->
            <div class="modal-content modal-rounded">
                <!--begin::Modal header-->
                <div class="modal-header py-7 d-flex justify-content-between">
                    <!--begin::Modal title-->
                    <h2>Add User</h2>
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

                        <form class="px-3" action="{{ route('affilate_add') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class='my-3'>
                                <label>First Name</label>
                                <input class='form-control' name="f_name" placeholder="First Name" />
                            </div>

                            <div class='my-3'>
                                <label>Last Name</label>
                                <input class='form-control' name="l_name" placeholder="Last Name" />
                            </div>

                            <div class='my-3'>
                                <label>Nick Name</label>
                                <input class='form-control' name="nick_name" placeholder="Nick Name" />
                            </div>

                            <div class='my-3'>
                                <label>E-mail</label>
                                <input class='form-control' name="email" placeholder="E-mail" />
                            </div>

                            <div class='my-3'>
                                <label>Password</label>
                                <input class='form-control' type="password" name="password" placeholder="Password" autocomplete="new-password" />
                            </div>

                            <div class='my-3'>
                                <label>Phone</label>
                                <input class='form-control' name="phone" placeholder="Phone" />
                            </div>
                            <div class='my-3'>
                                <label>Organization</label>
                                <input class='form-control' name="organization" placeholder="Organization" />
                            </div>

                            <div class="mt-3">
                                <button class='btn btn-primary'>
                                    Submit
                                </button>
                            </div>
                        </form>
                        {{--  End Page One --}}
                    </div>

                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Step 1-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Stepper-->
    </div>
    <!--begin::Modal body-->
    </div>
    </div>
    </div>


    <table id="kt_profile_overview_table"
        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer px-5">
        <thead class="fs-7 text-gray-500 text-uppercase">
            <tr>
                <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table"
                    rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending"
                    style="width: 336.359px;" aria-sort="descending">Name</th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Phone
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">
                    Organization</th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Total
                earned</th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Wallet
                </th>
                <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                    colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action
                </th>
        </thead>
        <tbody class="fs-6">
            @foreach ($users as $item)
                <tr>
                    <td>{{ $item->user->nick_name }}</td>
                    <td>{{ $item->user->phone }}</td>
                    <td>{{ $item->organization }}</td>
                    <td>{{ $item->services->sum('earned') }}$</td>
                    <td>{{ $item->wallet }}$</td>
                    <td>
                        <div class="mt-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalCenterEdit{{ $item->id }}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalDeleteEdit{{ $item->id }}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <form method="POST" action="{{ route('aff_edit', ['id' => $item->user->id]) }}">
                                @csrf
                                <div class="modal fade" id="modalCenterEdit{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 class="modal-title" id="modalCenterTitle">Edit Affilate</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class='my-2 px-3'>
                                                <label>First Name</label>
                                                <input class='form-control' value="{{$item->user->f_name}}" name="f_name" placeholder="First Name" />
                                            </div>
                                            <div class='my-2 px-3'>
                                                <label>Last Name</label>
                                                <input class='form-control' name="l_name" value="{{$item->user->l_name}}" placeholder="Last Name" />
                                            </div>
                                            <div class="my-2 px-3">
                                                <label>
                                                    Nick Name
                                                </label>
                                                <input class='form-control' name="nick_name"
                                                    value="{{ $item->user->nick_name }}" placeholder="Name" />
                                            </div>

                                            <div class="my-2 px-3">
                                                <label>
                                                    E-mail
                                                </label>
                                                <input class='form-control' name="email"
                                                    value="{{ $item->user->email }}" placeholder="E-mail" />
                                            </div>

                                            <div class="my-2 px-3">
                                                <label>
                                                    Password
                                                </label>
                                                <input class='form-control' name="password" type="password" 
                                                autocomplete="new-password" placeholder="Password" />
                                            </div>

                                            <div class="my-2 px-3">
                                                <label>
                                                    Phone
                                                </label>
                                                <input class='form-control' name="phone"
                                                    value="{{ $item->user->phone }}" placeholder="Phone" />
                                            </div>

                                            <div class="my-2 px-3">
                                                <label>
                                                    Organization
                                                </label>
                                                <input class='form-control' name="organization"
                                                    value="{{ $item->organization }}" placeholder="Parent Phone" />
                                            </div>


                                            <input type="hidden" value="{{ $item->user->id }}" name="user_id" />
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
                            <div class="modal fade" id="modalDeleteEdit{{ $item->id }}" tabindex="-1"
                                aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalCenterTitle">Delete Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class='p-3'>
                                            Are You Sure To Delete
                                            <span class='text-danger'>
                                                {{ $item->nick_name }} ??
                                            </span>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <a href="{{ route('del_aff', ['id' => $item->user->id]) }}"
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
</x-default-layout>
