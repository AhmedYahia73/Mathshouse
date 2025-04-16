@php
function fun_admin(){
return 'admin';
}
$arr = [];
@endphp
<x-default-layout>

  <a href="#" class="btn btn-primary w-150px mx-3 h-45px" data-bs-toggle="modal"
    data-bs-target="#kt_modal_create_question">
    Add Admin
  </a>

  <!-- Modal -->
  <form method="POST" action="{{route('role_admin_add')}}">
    @csrf
    <div class="modal fade" id="kt_modal_create_question" tabindex="-1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">

            <h5 class="modal-title" id="modalCenterTitle">Add Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="px-3 my-2 d-flex align-items-center">
            <label class="form-check-label w-100px">Role Name</label>
            <input name="user_admin" class="form-control ml-2" placeholder="Role Name" />
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="admin_item" class="form-check-input" type="checkbox" value="Admin" name="roles[]">
            <label for="admin_item" class="form-check-label">Admin</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Users_item" class="form-check-input" type="checkbox" value="Users" name="roles[]">
            <label for="Users_item" class="form-check-label">Users</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="User_wallet_item" class="form-check-input" type="checkbox" value="User Wallet" name="roles[]">
            <label for="User_wallet_item" class="form-check-label">User Wallet</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Courses_item" class="form-check-input" type="checkbox" value="Courses" name="roles[]">
            <label for="Courses_item" class="form-check-label">Courses</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Exam_item" class="form-check-input" type="checkbox" value="Settings" name="roles[]">
            <label for="Exam_item" class="form-check-label">Settings</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Live_item" class="form-check-input" type="checkbox" value="Live" name="roles[]">
            <label for="Live_item" class="form-check-label">Live</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Packages_item" class="form-check-input" type="checkbox" value="ReportIssues" name="roles[]">
            <label for="Packages_item" class="form-check-label">ReportIssues</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Packages_item" class="form-check-input" type="checkbox" value="Packages" name="roles[]">
            <label for="Packages_item" class="form-check-label">Packages</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="report_item" class="form-check-input" type="checkbox" value="ReportIssues" name="roles[]">
            <label for="report_item" class="form-check-label">Report Issues</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Payment_item" class="form-check-input" type="checkbox" value="Payment" name="roles[]">
            <label for="Payment_item" class="form-check-label">Payment</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Slider_item" class="form-check-input" type="checkbox" value="Slider" name="roles[]">
            <label for="Slider_item" class="form-check-label">Slider</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="Affilate_item" class="form-check-input" type="checkbox" value="Affilate" name="roles[]">
            <label for="Affilate_item" class="form-check-label">Affilate</label>
          </div>

          <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <input id="marketing_item" class="form-check-input" type="checkbox" value="Marketing" name="roles[]">
            <label for="marketing_item" class="form-check-label">Marketing</label>
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
  <!--begin::Modal body-->

  @section('title','Role Admin')
  @error('user_admin')
  <div class="alert alert-danger">
    {{$message}}
  </div>
  @enderror
  <div class="px-5">
    @include('success')
    <table id="kt_profile_overview_table"
      class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
      <thead class="fs-7 text-gray-500 text-uppercase">
        <tr>
          <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table"
            rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;"
            aria-sort="descending">Name</th>
          <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
            aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Role</th>
          <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
            aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action</th>
      </thead>
      <tbody class="fs-6">
        @foreach( $user_admin as $item )
        <tr class="odd">
          <td class="sorting_1">
            {{$item->user_admin}}
          </td>
          <td data-order="2023-10-25T00:00:00+03:00">
            @foreach ( $item->user_role as $element )
            {{$arr[] = $element->admin_role}}
            <br />
            @endforeach
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
              <form method="POST" action="{{route('role_admin_edit', ['id' => $item->id])}}">

                @csrf
                <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true"
                  style="display: none;">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      @if(in_array('Admin', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="admin{{$item->id}}" class="form-check-input" type="checkbox" value="Admin"
                          name="roles[]" checked='checked'>
                        <label for="admin{{$item->id}}" class="form-check-label">Admin</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="admin{{$item->id}}" class="form-check-input" type="checkbox" value="Admin"
                          name="roles[]">
                        <label for="admin{{$item->id}}" class="form-check-label">Admin</label>
                      </div>
                      @endif
                      @if(in_array('Reports', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="reports{{$item->id}}" class="form-check-input" type="checkbox" value="Reports"
                          name="roles[]" checked='checked'>
                        <label for="reports{{$item->id}}" class="form-check-label">Reports</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="reports{{$item->id}}" class="form-check-input" type="checkbox" value="Reports"
                          name="roles[]">
                        <label for="reports{{$item->id}}" class="form-check-label">Reports</label>
                      </div>
                      @endif
                      @if(in_array('Users', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="users{{$item->id}}" class="form-check-input" type="checkbox" value="Users"
                          name="roles[]" checked='checked'>
                        <label for="users{{$item->id}}" class="form-check-label">Users</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="users{{$item->id}}" class="form-check-input" type="checkbox" value="Users"
                          name="roles[]">
                        <label for="users{{$item->id}}" class="form-check-label">Users</label>
                      </div>
                      @endif
                      @if(in_array('User Wallet', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="user_wallet{{$item->id}}" class="form-check-input" type="checkbox" value="User Wallet"
                          name="roles[]" checked='checked'>
                        <label for="user_wallet{{$item->id}}" class="form-check-label">User Wallet</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="user_wallet{{$item->id}}" class="form-check-input" type="checkbox" value="User Wallet"
                          name="roles[]">
                        <label for="user_wallet{{$item->id}}" class="form-check-label">User Wallet</label>
                      </div>
                      @endif
                      @if(in_array('Courses', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Courses{{$item->id}}" class="form-check-input" type="checkbox" value="Courses"
                          name="roles[]" checked='checked'>
                        <label for="Courses{{$item->id}}" class="form-check-label">Courses</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Courses{{$item->id}}" class="form-check-input" type="checkbox" value="Courses"
                          name="roles[]">
                        <label for="Courses{{$item->id}}" class="form-check-label">Courses</label>
                      </div>
                      @endif
                      @if(in_array('Settings', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Settings{{$item->id}}" class="form-check-input" type="checkbox" value="Settings"
                          name="roles[]" checked='checked'>
                        <label for="Settings{{$item->id}}" class="form-check-label">Settings</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Settings{{$item->id}}" class="form-check-input" type="checkbox" value="Settings"
                          name="roles[]">
                        <label for="Settings{{$item->id}}" class="form-check-label">Settings</label>
                      </div>
                      @endif
                      @if(in_array('Live', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Live{{$item->id}}" class="form-check-input" type="checkbox" value="Live"
                          name="roles[]" checked='checked'>
                        <label for="Live{{$item->id}}" class="form-check-label">Live</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Live{{$item->id}}" class="form-check-input" type="checkbox" value="Live"
                          name="roles[]">
                        <label for="Live{{$item->id}}" class="form-check-label">Live</label>
                      </div>
                      @endif
                      @if(in_array('Packages', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Packages{{$item->id}}" class="form-check-input" type="checkbox" value="Packages"
                          name="roles[]" checked='checked'>
                        <label for="Packages{{$item->id}}" class="form-check-label">Packages</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Packages{{$item->id}}" class="form-check-input" type="checkbox" value="Packages"
                          name="roles[]">
                        <label for="Packages{{$item->id}}" class="form-check-label">Packages</label>
                      </div>
                      @endif
                      @if(in_array('ReportIssues', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="ReportIssues{{$item->id}}" class="form-check-input" type="checkbox" value="ReportIssues"
                          name="roles[]" checked='checked'>
                        <label for="ReportIssues{{$item->id}}" class="form-check-label">Report Issues</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="ReportIssues{{$item->id}}" class="form-check-input" type="checkbox" value="ReportIssues"
                          name="roles[]">
                        <label for="ReportIssues{{$item->id}}" class="form-check-label">Report Issues</label>
                      </div>
                      @endif
                      @if(in_array('Payment', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Payment{{$item->id}}" class="form-check-input" type="checkbox" value="Payment"
                          name="roles[]" checked='checked'>
                        <label for="Payment{{$item->id}}" class="form-check-label">Payment</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Payment{{$item->id}}" class="form-check-input" type="checkbox" value="Payment"
                          name="roles[]">
                        <label for="Payment{{$item->id}}" class="form-check-label">Payment</label>
                      </div>
                      @endif
                      @if(in_array('Slider', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Slider{{$item->id}}" class="form-check-input" type="checkbox" value="Slider"
                          name="roles[]" checked='checked'>
                        <label for="Slider{{$item->id}}" class="form-check-label">Slider</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Slider{{$item->id}}" class="form-check-input" type="checkbox" value="Slider"
                          name="roles[]">
                        <label for="Slider{{$item->id}}" class="form-check-label">Slider</label>
                      </div>
                      @endif
                      @if(in_array('Affilate', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Affilate{{$item->id}}" class="form-check-input" type="checkbox" value="Affilate"
                          name="roles[]" checked='checked'>
                        <label for="Affilate{{$item->id}}" class="form-check-label">Affilate</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Affilate{{$item->id}}" class="form-check-input" type="checkbox" value="Affilate"
                          name="roles[]">
                        <label for="Affilate{{$item->id}}" class="form-check-label">Affilate</label>
                      </div>
                      @endif
                      @if(in_array('Marketing', $arr))
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Marketing{{$item->id}}" class="form-check-input" type="checkbox" value="Marketing"
                          name="roles[]" checked='checked'>
                        <label for="Marketing{{$item->id}}" class="form-check-label">Marketing</label>
                      </div>
                      @else
                      <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input id="Marketing{{$item->id}}" class="form-check-input" type="checkbox" value="Marketing"
                          name="roles[]">
                        <label for="Marketing{{$item->id}}" class="form-check-label">Marketing</label>
                      </div>
                      @endif

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

                      <h5 class="modal-title" id="modalCenterTitle">Delete Role</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class='p-3'>
                      Are You Sure To Delete Roles of
                      <span class='text-danger'>
                        {{$item->user_admin}} ??
                      </span>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                      </button>
                      <a href="{{route('role_del_admin', ['id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        @php
        $arr = [];
        @endphp
        @endforeach

      </tbody>
    </table>
  </div>




</x-default-layout>