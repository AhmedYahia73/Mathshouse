@php
function fun_admin(){
return 'admin';
}
@endphp
<x-default-layout>
  @include('success')
  <style>
    .list_item {
      display: list-item;
    }

    .ordered_lit {
      display: ???;
    }
  </style>
  <!-- Button trigger modal -->
  <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
  <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
  <!--begin::Fonts(mandatory for all pages)-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Vendor Stylesheets(used for this page only)-->
  <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
  <!--end::Vendor Stylesheets-->
  <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
  <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
  <!--end::Global Stylesheets Bundle-->
  @section('title','Payment')
  @error('payment')
  <div class="alert alert-danger">
    {{$message}}
  </div>
  @enderror

  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalAddCenter">
    Add New Payment
  </button>

  <form method="POST" action="{{route('payment_add')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalAddCenter" tabindex="-1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">

            <h5 class="modal-title" id="modalCenterTitle">Add Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="my-2 px-3">
            <label>
              Payment
            </label>
            <input class='form-control' name="payment" placeholder="Payment" />
          </div>

          <div class="my-2 px-3">
            <label>
              Description
            </label>
            <input class='form-control' name="description" placeholder="Description" />
          </div>

          <div class="my-2 px-3">
            <label>
              Logo
            </label>
            <input class='form-control' name="logo" type="file" />
          </div>

          <div class="my-2 px-3">
            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
              <label class="px-2">
                Statue
              </label>
              <input class="form-check-input" type="checkbox" value="1" name="statue" checked />
            </div>
          </div>
          {{-- Form Rebeat For Currancy --}}
          <div class="mb-10 fv-row">
            <label>
              Currencies
            </label>
            <div class="select2-danger" data-select2-id="33">
              <div class="position-relative" data-select2-id="443">
                <select id="select2Dangeradd" name="currancy[]" class="select2 form-select select2-hidden-accessible"
                  multiple="" data-select2-id="select2Dangeradd" tabindex="-1" aria-hidden="true">
                  @foreach ($currancies as $currancy)
                  <option value="{{ $currancy->id }}">
                    {{ $currancy->currency }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          {{-- Form Rebeat For Currancy --}}

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
      <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
        colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;"
        aria-sort="descending">#</th>
      <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
        aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Payout</th>
      <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
        aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Logo</th>
      <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
        aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Descrition</th>
      <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
        aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Currancies</th>
      <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
        aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Statue</th>
      <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1"
        aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action</th>
    </thead>
    <tbody class="fs-6">
      @foreach($payments as $item)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          {{$item->payment}}
        </td>
        <td>
          <img style="height: 120px;width: 120px;;" src="{{asset('images/payment/' . $item->logo)}}" />
        </td>
        <td>
          {{$item->description}}
        </td>
        <td>
          <div class="ordered_list">
            @foreach ($item->payment_currancies as $currancy)
            <div class="list_item">{{ $currancy->currency }}</div>
            @endforeach
          </div>
        </td>
        <td>
          <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
            {{$item->statue ? 'On' : 'Off'}}
          </div>
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
            <form method="POST" action="{{route('payment_edit')}}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{$item->id}}" />
              <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="modalCenterTitle">Add Payment</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="my-2 px-3">
                      <label>
                        Payment
                      </label>
                      <input class='form-control' value="{{$item->payment}}" name="payment" placeholder="Payment" />
                    </div>

                    <div class="my-2 px-3">
                      <label>
                        Description
                      </label>
                      <input class='form-control' value="{{$item->description}}" name="description"
                        placeholder="Description" />
                    </div>

                    <div class="my-2 px-3">
                      <label>
                        Logo
                      </label>
                      <input class='form-control' name="logo" type="file" />
                    </div>

                    <div class="my-2 px-3">
                      <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <label class="px-2">
                          Statue
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="statue" {{$item->statue == 1?
                        'checked' : null}} />
                      </div>
                    </div>
                    {{-- Form Repeat For Currency --}}
                    <div class="mb-10 fv-row">
                      <label class="m-1">
                        Select Currancies
                      </label>
                      <div class="select2-danger" data-select2-id="33">
                        <div class="position-relative" data-select2-id="443">
                          <select id="select2Dangeradd{{ $item->id }}" name="currancy[]"
                            class="select2 form-select select2-hidden-accessible" multiple=""
                            data-select2-id="select2Dangeradd{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            @foreach ($currancies as $currancy)
                            <option value="{{ $currancy->id }}" @if($item->payment_currancies->contains('id',
                              $currancy->id)) selected
                              @endif>
                              {{ $currancy->currency }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    {{-- Form Repeat For Currency --}}
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

                    <h5 class="modal-title" id="modalCenterTitle">Delete Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class='p-3'>
                    Are You Sure To Delete
                    <span class='text-danger'>
                      {{$item->payment}} ??
                    </span>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                      Close
                    </button>
                    <a href="{{route('del_payment', ['id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
    {{$payments->links()}}
  </table>
  <!--end::Modal - Invite Friend-->
  <!--end::Modals-->
  <!--begin::Javascript-->
  <script>
    var hostUrl = "assets/";
  </script>
  <!--begin::Global Javascript Bundle(mandatory for all pages)-->
  <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
  <!--end::Global Javascript Bundle-->
  <!--begin::Vendors Javascript(used for this page only)-->
  <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
  <!--end::Vendors Javascript-->
  <!--begin::Custom Javascript(used for this page only)-->
  <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
  <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
  <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
  <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
  <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
  <script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
  <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
  <!--end::Custom Javascript-->
  <!--end::Javascript-->

  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

  <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>

  <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

  <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>

  <!-- Main JS -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  <!-- Page JS -->
  <script src="{{asset('assets/js/forms-selects.js')}}"></script>
  <script src="{{asset('assets/js/forms-tagify.js')}}"></script>
  <script src="{{asset('assets/js/forms-typeahead.js')}}"></script>
</x-default-layout>