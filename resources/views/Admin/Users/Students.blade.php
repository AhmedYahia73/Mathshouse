@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
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
    @error('parent_email')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @error('parent_phone')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    @include('Admin.Users.stu_header')
    @include('success')
    @section('title', 'Students')
    <style>
        #ship-list_filter>label {
            display: flex;
            align-items: baseline;
            justify-content: flex-end;
            color: #373f4d;
            font-size: 1.2rem;
        }

        #ship-list_length>label {
            font-size: 1.2rem;
            color: #373f4d;
        }

        /* ###### */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: center;
            /* border: 1px solid #ccc; */
        }

        .table th {
            width: 18% !important;
            text-align: center !important;
            color: #fff !important;
            background-color: #23aac0 !important;

        }

        .table td {
            /* text-align: center !important; */
            color: #1e1e1e !important;
            font-size: 1rem;
            font-family: sans-serif;
            /* background-color: #386ca6; */
        }

        .table td p {
            margin-bottom: 0 !important;
            text-overflow: ellipsis;
            width: 90%;
            white-space: nowrap;
            overflow: hidden;
            transition: all 0.2s ease-in-out;
        }

        .table td p:hover {
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="d-flex col-12 align-items-center justify-content-start gap-6">

    <div style="display: flex; align-items: center;justify-content: flex-start">
        <input type="text" class="my-3 form-control" placeholder="Search..." style="width: 200px;" id="myInput">
    </div>
    <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
        <span style="font-size: 1.2rem;font-weight: 600;">Section:</span>
        <select id="selPayment" name="selPayment" class="form-control">
            <option value="">Select Payment</option>
            <option value="free">Free</option>
            <option value="paid">Paid</option>
        </select>
    </div>  
</div>
    <div class="mt-4 card-datatable table-responsive" style="overflow-x: hidden">
        <table class="datatables-users border-top display table-hover table-striped" id="cm-list">
            <thead>
                <tr>
                    <th scope="row">Name</th>
                    <th scope="row">Details</th>
                    <th scope="row">Phone</th>
                    <th scope="row">Email</th>
                    <th scope="row">Parent Phone</th>
                    <th scope="row">Payment</th>
                    <th scope="row">History</th>
                    <th scope="row">Wallet</th>
                    <th scope="row">Action</th>
            </thead>
            <tbody id="myTable">
                @foreach ($students as $item)
                    <tr>
                        <td style="width: 8%;">
                            <p>

                                {{ $item->f_name . ' ' . $item->l_name . ' (' . $item->nick_name . ')' }}
                            </p>
                        </td>
                        <td style="width: 8%;">
                            <p>

                                <a class="btn btn-info btn-sm" href="{{ route('stu_details', ['id' => $item->id]) }}">
                                    View
                                </a>
                            </p>
                        </td>
                        <td style="width: 8%;">
                            <p>
                                {{ $item->phone }}
                            </p>
                        </td>
                        <td style="width: 8%;">
                            <p>

                                {{ $item->email }}
                            </p>
                        </td>
                        <td style="width: 8%;">
                            <p>

                                {{ $item->parent_phone }}
                            </p>
                        </td>

                        <td>
                            {{$item->payment_req_approve->count() > 0 ? 'Paid' : 'Free'}}
                        </td>


                        <td style="width: 8%;">
                            <p>

                                <a href="{{ route('student_payments', ['id' => $item->id]) }}"
                                    class='btn btn-primary btn-sm'>
                                    View
                                </a>
                            </p>
                        </td>

                        @can('Wallet')
                            <td style="width: 8%;">
                                @php
                                    $wallet = DB::table('wallets')
                                        ->where('student_id', $item->id)
                                        ->where('state', 'Approve')
                                        ->get();
                                    $total = 0;
                                @endphp

                                <button type="button" class="btn btn-sm btn-primary show_wallet">
                                    View
                                </button>
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter{{ $item->id }}">
                                    Top up
                                </button>
                                <div class='wallet_h d-none'>
                                    @php
                                        foreach ($wallet as $w_item) {
                                            $total += $w_item->wallet;
                                        }
                                    @endphp
                                    {{ $total }}$
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modalCenter{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Top Up</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('ad_add_wallet') }}">
                                                @csrf
                                                <div class='p-3'>
                                                    Add Amount Wallet
                                                </div>
                                                <div class="px-3">
                                                    <input class="form-control" name="wallet" type="number" />
                                                </div>
                                                <input class="form-control" name="student_id" type="hidden"
                                                    value="{{ $item->id }}" />
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-success" data-bs-dismiss="modal">
                                                        Confirm
                                                    </button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @endcan

                        <td style="width: 8%;">
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
                                <form method="POST" action="{{ route('stu_edit') }}">
                                    @csrf
                                    <div class="modal fade" id="modalCenterEdit{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h5 class="modal-title" id="modalCenterTitle">Edit Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class='my-2 px-3'>
                                                    <label>First Name</label>
                                                    <input class='form-control' value="{{ $item->f_name }}"
                                                        name="f_name" placeholder="First Name" />
                                                </div>
                                                <div class='my-2 px-3'>
                                                    <label>Last Name</label>
                                                    <input class='form-control' name="l_name"
                                                        value="{{ $item->l_name }}" placeholder="Last Name" />
                                                </div>
                                                <div class="my-2 px-3">
                                                    <label>
                                                        Nick Name
                                                    </label>
                                                    <input class='form-control' name="name"
                                                        value="{{ $item->nick_name }}" placeholder="Name" />
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label>
                                                        E-mail
                                                    </label>
                                                    <input class='form-control' name="email"
                                                        value="{{ $item->email }}" placeholder="E-mail" />
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label>Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-lock"></i></span>
                                                        <input class="form-control password_field" type="password"
                                                            name="password" placeholder="Password" />
                                                        <span class="input-group-text">
                                                            <i class="fa fa-eye togglePassword"
                                                                style="cursor: pointer"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label>
                                                        Phone
                                                    </label>
                                                    <input class='form-control' name="phone"
                                                        value="{{ $item->phone }}" placeholder="Phone" />
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label>
                                                        Parent Phone
                                                    </label>
                                                    <input class='form-control' name="parent_phone"
                                                        value="{{ $item->parent_phone }}"
                                                        placeholder="Parent Phone" />
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label>
                                                        Parent E-mail
                                                    </label>
                                                    <input class='form-control' name="parent_email"
                                                        value="{{ $item->parent_email }}"
                                                        placeholder="Parent E-mail" />
                                                </div>

                                                <input type="hidden" value="{{ $item->id }}" name="user_id" />
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
                                                <a href="{{ route('del_stu', ['id' => $item->id]) }}"
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


    <script>
        $(document).ready(function() {
            // new DataTable('#cm-list', {
            //     search: {
            //         return: true
            //     },
            //     responsive: true,
            //     "aLengthMenu": [
            //         [5, 10, 25, -1],
            //         [5, 10, 25, "All"]
            //     ],
            //     "iDisplayLength": 10
            // });
        });
    </script>
    <script>
        let show_wallet = document.querySelectorAll('.show_wallet');
        let wallet_h = document.querySelectorAll('.wallet_h');
        for (let i = 0, end = show_wallet.length; i < end; i++) {
            show_wallet[i].addEventListener('click', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == show_wallet[j]) {
                        wallet_h[j].classList.toggle('d-none')
                    }
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", () => {
                var vale = $("#myInput").val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(vale) > -1);
                })
            })
            $("#selPayment").on("change", () => {
                var vale = $("#selPayment").val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(vale) > -1);
                })
            })

            const togglePassword = document.querySelectorAll(".togglePassword");
            const password_field = document.querySelectorAll(".password_field");

            for (let i = 0, end = togglePassword.length; i < end; i++) {
                togglePassword[i].addEventListener("click", function(e) {
                    for (let j = 0; j < end; j++) {
                        if (e.target == togglePassword[j]) {
                            // toggle the type attribute
                            const type = password_field[j].getAttribute("type") === "password" ? "text" :
                                "password";
                            password_field[j].setAttribute("type", type);
                            // toggle the eye icon
                            this.classList.toggle('fa-eye');
                            this.classList.toggle('fa-eye-slash');
                        }
                    }
                });
            }
        })
    </script>

</x-default-layout>
