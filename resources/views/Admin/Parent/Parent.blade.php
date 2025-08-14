@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout> 
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
 
            
.switch {
  position: relative;
  display: inline-block;
  width: 52px;
  height: 28px;
  vertical-align: middle;
}
.switch input { display: none; }
.slider {
  position: absolute;
  cursor: pointer;
  inset: 0;
  background-color: #ccc;
  border-radius: 999px;
  transition: background .2s;
  box-shadow: inset 0 0 2px rgba(0,0,0,.2);
}
.slider::after{
  content: "";
  position: absolute;
  width: 22px;
  height: 22px;
  left: 3px;
  top: 3px;
  background: white;
  border-radius: 50%;
  transition: transform .2s;
  box-shadow: 0 1px 2px rgba(0,0,0,.2);
}
.switch input:checked + .slider {
  background-color: #4caf50;
}
.switch input:checked + .slider::after {
  transform: translateX(24px);
}

/* optional: label text */
.switch-text { margin-left: 8px; font-size:14px; vertical-align: middle; }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
        data-bs-target="#modalParentAdd">
        Add
    </button>

    <!-- Modal -->
    <form method="POST" action="{{ route('add_web_parent') }}">
        @csrf
        <div class="modal fade" id="modalParentAdd" tabindex="-1"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="modalCenterTitle">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class='my-2 px-3'>
                        <label>Name</label>
                        <input class='form-control' name="name"
                        placeholder="Name" />
                    </div> 

                    <div class="my-2 px-3">
                        <label>
                            E-mail
                        </label>
                        <input class='form-control' name="email"
                        placeholder="E-mail" />
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
                        placeholder="Phone" />
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
        
    <div class="mt-4 card-datatable table-responsive" style="overflow-x: hidden">
        <table class="datatables-users border-top display table-hover table-striped" id="cm-list">
            <thead>
                <tr>
                    <th scope="row">Name</th>
                    <th scope="row">E-Mail</th>
                    <th scope="row">Phone</th> 
                    <th scope="row">status</th>
                    <th scope="row">Action</th>
            </thead>
            <tbody id="myTable">
                @foreach ($parents as $item)
                    <tr>
                        <td >
                            <p> 
                                {{ $item->name }}
                            </p>
                        </td> 
                        <td >
                            <p>

                                {{ $item->email }}
                            </p>
                        </td>  
                        <td >
                            <p>
                                {{ $item->phone }}
                            </p>
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" id="status_switch" data-default="{{ $item->status }}" data-id="{{ $item->id }}"> <!-- ضع data-default="0" أو "1" -->
                                <span class="slider"></span>
                            </label> 

                            <br><br>
                        </td>
 

                        <td >
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
                                <form method="POST" action="{{ route('update_web_parent', $item->id) }}">
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
                                                    <label>Name</label>
                                                    <input class='form-control' name="name"
                                                        value="{{ $item->name }}" placeholder="Name" />
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
 
 
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-primary">Submit</button>
                                                </div>
                                                               
                                                <label class="switch">
                                                    <input type="checkbox" id="status_switch" data-default="{{ $item->status }}" data-id="{{ $item->id }}"> <!-- ضع data-default="0" أو "1" -->
                                                    <span class="slider"></span>
                                                </label> 

                                                <br><br>
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
                                                <a href="{{ route('delete_web_parent', ['id' => $item->id]) }}"
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
        
$(function(){ 
  var $switch = $('#status_switch');
  var def = String($switch.data('default')) === '1' ? 1 : 0;
  $switch.prop('checked', def === 1);

  $switch.on('change', function(){
    var id = $(this).data('id');
    var newStatus = $(this).is(':checked') ? 1 : 0;
    var url_api = "{{ url('Admin/Parent/status') }}" + '/' + id

    $.ajax({
      url: url_api,
      type: 'PUT',
      data: { status: newStatus,
            _token: "{{ csrf_token() }}" },
      success: function(res){
        console.log(res);
      },
      error: function(xhr){
        console.log(xhr);
      }
    });
  });
});
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
