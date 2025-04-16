@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
    @include('Admin.Users.AddTeacher')
    @include('success')
    @section('title', 'Teachers')
    <style>
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

    <div style="display: flex; align-items: center;justify-content: flex-start">
        <input type="text" class="my-3 form-control" placeholder="Search..." style="width: 200px;" id="myInput">
    </div>

    <div class="card-datatable table-responsive" style="overflow-x: hidden">
        <table class="datatables-users border-top display table-hover table-striped" id="cm-list">
            <thead>
                <tr>
                    <th scope="row">Name</th>
                    <th scope="row">Phone</th>
                    <th scope="row">Email</th>
                    <th scope="row">Category</th>
                    <th scope="row">Course</th>
                    <th scope="row">Image</th>
                    <th scope="row">Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($teachers as $item)
                    <tr>
                        <td style="width: 8%;">
                            <p>
                                {{ $item->nick_name }}
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
                                @php
                                    $arr = [];
                                @endphp
                                @foreach ($item->teacher_courses as $element)
                                    @if (!isset($arr[$element->category->id]) && ($arr[$element->category->id] = $element))
                                        {{ $element->category->cate_name }}
                                    @endif
                                @endforeach
                            </p>
                        </td>
                        <td style="width: 8%;">
                            <p>
                                @foreach ($item->teacher_courses as $element)
                                    {{ $element->course_name }}
                                    <br />
                                @endforeach
                            </p>
                        </td>
                        <td style="width: 8%;">
                            <p>
                                <img src="{{ asset('/images/users/' . $item->image) }}"
                                    style="height: 100px;width:120px;  object-fit: contain !important;object-position: center !important;" />
                            </p>
                        </td>
                        <td style="width: 8%;">
                            <p>
                            <div class="mt-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter{{ $item->u_id }}">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalDelete{{ $item->u_id }}">
                                    Delete
                                </button>

                                <!-- Modal -->
                                <form method="POST" action="{{ route('teacher_edit') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="modalCenter{{ $item->u_id }}" tabindex="-1"
                                        aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h5 class="modal-title" id="modalCenterTitle">Edit Teacher</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label>
                                                        Name
                                                    </label>
                                                    <input class='form-control' name="nick_name"
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
                                                    <label>
                                                        Phone
                                                    </label>
                                                    <input class='form-control' name="phone"
                                                        value="{{ $item->phone }}" placeholder="Phone" />
                                                </div>

                                                <div class='my-3 px-3'>
                                                    <label>Category</label>
                                                    <div class="select2-danger" data-select2-id="33">
                                                        <div class="position-relative" data-select2-id="443">
                                                            <select id="select2Danger_edit{{ $item->u_id }}"
                                                                name="category_id[]"
                                                                class="select2 form-select sel_cate select2-hidden-accessible"
                                                                multiple=""
                                                                data-select2-id="select2Danger_edit{{ $item->u_id }}"
                                                                tabindex="-1" aria-hidden="true">
                                                                @foreach ($categories as $category)
                                                                    @if (in_array($category->id, json_decode($item->teacher_courses->pluck('category_id'))))
                                                                        <option selected value="{{ $category->id }}">
                                                                            {{ $category->cate_name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->cate_name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class='my-3 px-3'>
                                                    <label>Course</label>
                                                    <div class="select2-danger" data-select2-id="33">
                                                        <div class="position-relative" data-select2-id="443">
                                                            <select id="select1Danger_edit{{ $item->u_id }}"
                                                                name="course_id[]"
                                                                class="select2 sel_course form-select select2-hidden-accessible"
                                                                multiple=""
                                                                data-select2-id="select1Danger_edit{{ $item->u_id }}"
                                                                tabindex="-1" aria-hidden="true">
                                                                @foreach ($courses as $course)
                                                                    @if (in_array($course->id, json_decode($item->teacher_courses->pluck('id'))))
                                                                        <option selected value="{{ $course->id }}">
                                                                            {{ $course->course_name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $course->id }}">
                                                                            {{ $course->course_name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
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
                                                        Image
                                                    </label>
                                                    <input class='form-control' name="image" type="file" />
                                                </div>

                                                <input type="hidden" value="{{ $item->u_id }}" name="user_id" />
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
                                <div class="modal fade" id="modalDelete{{ $item->u_id }}" tabindex="-1"
                                    aria-hidden="true" style="display: none;">
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
                                                    {{ $item->nick_name }} ??
                                                </span>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{ route('del_teacher', ['id' => $item->u_id]) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", () => {
                var vale = $("#myInput").val().toLowerCase();
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

        let show_history = document.querySelectorAll('.show_history');
        let history = document.querySelectorAll('.history');
        for (let i = 0, end = show_history.length; i < end; i++) {
            show_history[i].addEventListener('click', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == show_history[j]) {
                        history[j].classList.toggle('d-none');
                    }
                }
            })
        }
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


</x-default-layout>
