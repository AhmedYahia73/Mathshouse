@php
function fun_admin(){
return 'admin';
}
@endphp
<x-default-layout>

  <a href="#" class="btn btn-primary w-150px mx-3 h-45px my-3" data-bs-toggle="modal"
    data-bs-target="#kt_modal_create_question">
    Add Admin
  </a>
  @section('title','Admins')

  @error('name')
  <div class="alert alert-danger">
    {{$message}}
  </div>
  @enderror
  @error('email')
  <div class="alert alert-danger">
    {{$message}}
  </div>
  @enderror
  @error('phone')
  <div class="alert alert-danger">
    {{$message}}
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
          <h2>Add Admin</h2>
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

            <form class="px-3" method="POST" action="{{ route('add_admin') }}">
              @csrf
              <div class='my-3'>
                <label>Nick Name</label>
                <input class='form-control' name="nick_name" placeholder="Nick Name" />
              </div>
              <div class='my-3'>
                <label>E-mail</label>
                <input class='form-control' name="email" placeholder="E-mail" />
              </div>
              <div class='my-3'>
                <label>Phone</label>
                <input class='form-control' name="phone" placeholder="Phone" />
              </div>
                                
              <div class="my-3">
                  <label>Password</label>
                  <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      <input class="form-control password_field" type="password" name="password" placeholder="Password" />
                      <span class="input-group-text">
                      <i class="fa fa-eye togglePassword"
                      style="cursor: pointer"></i>
                      </span>
                  </div>
              </div>

              <div class="my-3">
                <label>Role</label>
                <select class="form-control" name="user_admin_id">
                  <option selected disabled>
                    Select Role ...
                  </option>
                  @foreach ( $user_admin as $element )
                  <option value="{{$element->id}}">
                    {{$element->user_admin}}
                  </option>
                  @endforeach
                </select>
              </div>

              <div class="mt-3">
                <button class='btn btn-primary'>
                  Submit
                </button>
                <button class='btn btn-danger' type="reset">
                  Clear
                </button>
              </div>
            </form>
            {{-- End Page One --}}
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
  <div class="px-5">
    <div class='my-3'>
      <form class='d-flex' action="{{route('admin_filter')}}" method='GET'>
        <select name='user_admin_id' class='form-control mx-2'>
          <option disabled selected>
            Select Role
          </option>
          @foreach ( $user_admin as $item )
          <option {{@$data['user_admin_id'] == $item->id ? 'selected' : ''}} value='{{$item->id}}'>{{$item->user_admin}}</option>
          @endforeach
        </select>

        <button class='btn btn-primary'>
          Search
        </button>
      </form>
    </div>
    <table id="kt_profile_overview_table"
      class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
      <thead class="fs-7 text-gray-500 text-uppercase">
        <tr>
          <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table"
            rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;"
            aria-sort="descending">Nick Name</th>
          <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
            aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Phone</th>
          <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
            aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Email</th>
          <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
            aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Roles</th>
          <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
            aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Actions</th>
      </thead>
      <tbody class="fs-6">
        @foreach( $sup_admins as $item )
        <tr class="odd">
          <td class="sorting_1">
            {{$item->nick_name}}
          </td>
          <td class="sorting_1">
            {{$item->phone}}
          </td>
          <td class="sorting_1">
            {{$item->email}}
          </td>
          <td>
            Super Admin
          </td>
        </tr>
        @endforeach
        @foreach( $admins as $item )
        <tr class="odd">
          <td class="sorting_1">
            {{$item->nick_name}}
          </td>
          <td class="sorting_1">
            {{$item->phone}}
          </td>
          <td class="sorting_1">
            {{$item->email}}
          </td>
          <td data-order="2023-10-25T00:00:00+03:00">
            {{@$item->user_admin->user_admin}}
          </td>
          <td>
            <div class="mt-3">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                data-bs-target="#modalCenter{{$item->id}}">
                Edit
              </button>
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                data-bs-target="#modalDelete{{$item->id}}">
                Delete
              </button>

              <!-- Modal -->
              <form method="POST" action="{{route('admin_edit')}}">
                @csrf
                <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true"
                  style="display: none;">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="my-2 px-3">
                        <label>
                          First Name
                        </label>
                        <input class='form-control' name="f_name" value="{{$item->f_name}}"
                          placeholder="First Name" />
                      </div>

                      <div class="my-2 px-3">
                        <label>
                          Last Name
                        </label>
                        <input class='form-control' name="l_name" value="{{$item->l_name}}"
                          placeholder="Last Name" />
                      </div>

                      <div class="my-2 px-3">
                        <label>
                          Nick Name
                        </label>
                        <input class='form-control' name="nick_name" value="{{$item->nick_name}}"
                          placeholder="Nick Name" />
                      </div>

                      <div class="my-2 px-3">
                        <label>
                          E-mail
                        </label>
                        <input class='form-control' name="email" value="{{$item->email}}" placeholder="E-mail" />
                      </div>

                      <div class="my-2 px-3">
                        <label>
                          Phone
                        </label>
                        <input class='form-control' name="phone" value="{{$item->phone}}" placeholder="Phone" />
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
                          Role
                        </label>
                        <select name='user_admin_id' class='form-control'>
                          <option value='{{@$item->user_admin->id}}'>{{@$item->user_admin->user_admin}}</option>
                          @foreach ( $user_admin as $element )
                          <option value='{{$element->id}}'>{{$element->user_admin}}</option>
                          @endforeach
                        </select>
                      </div>

                      <input type="hidden" value="{{$item->id}}" name="user_id" />
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
              <div class="modal fade" id="modalDelete{{$item->id}}" tabindex="-1" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class='p-3'>
                      Are You Sure To Delete
                      <span class='text-danger'>
                        {{$item->nick_name}} ??
                      </span>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                      </button>
                      <a href="{{route('del_admin', ['id'=>$item->id])}}" class="btn btn-danger">Delete</a>
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
  </div>
  </div>
  </div>

  <script>
    const togglePassword = document.querySelectorAll(".togglePassword");
    const password_field = document.querySelectorAll(".password_field");
    
    for (let i = 0, end = togglePassword.length; i < end; i++) {
        togglePassword[i].addEventListener("click", function ( e ) {
            for (let j = 0; j < end; j++) {
                if ( e.target == togglePassword[j] ) {
                    // toggle the type attribute
                    const type = password_field[j].getAttribute("type") === "password" ? "text" : "password";
                    password_field[j].setAttribute("type", type);
                    // toggle the eye icon
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                }
            }
        });
    }
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
  </script>

</x-default-layout>