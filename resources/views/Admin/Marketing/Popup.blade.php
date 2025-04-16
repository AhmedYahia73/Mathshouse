
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
    @section('title','Popup')

    @error('name')
    <div class="alert alert-danger">
    {{$message}}
    </div>
    @enderror

    @error('starts')
    <div class="alert alert-danger">
    {{$message}}
    </div>
    @enderror

    @error('ends')
    <div class="alert alert-danger">
    {{$message}}
    </div>
    @enderror

    <a href="#" class="btn btn-primary w-150px mx-3 h-45px" data-bs-toggle="modal"
    data-bs-target="#kt_modal_create_question">
        Add Popup
    </a> 

    <div class="modal fade" id="kt_modal_create_question" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-fullscreen p-9">
            <!--begin::Modal content-->
            <div class="modal-content modal-rounded">
                <!--begin::Modal header-->
                <div class="modal-header py-7 d-flex justify-content-between">
                    <!--begin::Modal title-->
                    <h2>Add Popup</h2>
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

                        <form method="POST" action="{{route('add_popup')}}" enctype="multipart/form-data">
                          @csrf
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content px-2">
  
                                <div class="my-2 d-flex justify-content-center">
                                    <input type="file" name="image" class="form-control" />
                                </div>
  
                                <div class="my-2 d-flex justify-content-center align-items-center"> 
                                    <label>
                                      Name
                                    </label>
                                    <input class="form-control mx-2" name="name" placeholder="Name" />
                                </div>
                                
                              <div class="mb-10 d-flex align-items-center">
                                <label>
                                    Distination
                                </label>
                                <div class="mb-4 mb-md-0 my-2 px-3" data-select2-id="46">
                                    <div class="select2-danger" data-select2-id="45">
                                        <div class="position-relative" data-select2-id="44">
                                            <select name="page_id[]" id="select2Danger" class="select2 form-select select2-hidden-accessible" multiple="" data-select2-id="select2Danger" tabindex="-1" aria-hidden="true">
                                 
                                                @foreach( $pages as $page )
                                                <option value="{{$page->id}}" data-select2-id="{{$page->id}}">
                                                    {{$page->page_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
  
                                <div class="my-2 d-flex justify-content-center align-items-center"> 
                                    <label>
                                      Starts
                                    </label>
                                    <input class="form-control mx-2" type="date" name="starts" placeholder="Starts" />
                                </div>
  
                                <div class="my-2 d-flex justify-content-center align-items-center"> 
                                    <label>
                                      Ends
                                    </label>
                                    <input class="form-control mx-2" type="date" name="ends" placeholder="Ends" />
                                </div>
  
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    Close
                                  </button>
                                  <button class="btn btn-primary">Submit</button>
                                </div>
                              </div>
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
    
    <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
      <thead class="fs-7 text-gray-500 text-uppercase">
          <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Starts</th>
              <th>Ends</th>
              <th>Distination</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach($popups as $item)
          <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->starts}}</td>
              <td>{{$item->ends}}</td>
              <td>
                @foreach ( $item->popup_pages as $element )
                    {{$element->page_name}}
                    <br />
                @endforeach
              </td>
          <td>
          <div class="mt-3">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter{{$item->id}}">
                        Edit
                      </button> 
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDel{{$item->id}}">
                        Delete
                      </button> 

                      <!-- Modal -->
                      <form method="POST" action="{{route('edit_popup', ['id' => $item->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content px-2">
                              <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Edit Popup</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                              <div class="my-2 d-flex justify-content-center">
                                  <input type="file" id="image{{$item->id}}" name="image" class="d-none" />
                                  <label for="image{{$item->id}}">
                                    <img class="w-150px h-110px" src="{{asset('images/MarketingPopup/' . $item->image)}}" />
                                  </label>
                              </div>

                              <div class="my-2 d-flex justify-content-center align-items-center"> 
                                  <label>
                                    Name
                                  </label>
                                  <input class="form-control mx-2" name="name" value="{{$item->name}}" />
                              </div>
                              
                              <div class="mb-10 d-flex align-items-center">
                                <label>
                                    Distination
                                </label>
                                <div class="mb-4 mb-md-0 my-2 px-3" data-select2-id="46">
                                    <div class="select2-danger" data-select2-id="45">
                                        <div class="position-relative" data-select2-id="44">
                                            <select name="page_id[]" id="select2Danger{{$item->id}}" class="select2 form-select select2-hidden-accessible" multiple="" data-select2-id="select2Danger{{$item->id}}" tabindex="-1" aria-hidden="true">

                                              @foreach ( $item->popup_pages as $element )
                                                <option value="{{$element->id}}" data-select2-id="{{$element->id}}" selected>
                                                    {{$element->page_name}}
                                                </option>
                                              @endforeach

                                              @foreach( $pages as $page )
                                                <option value="{{$page->id}}" data-select2-id="{{$page->id}}">
                                                    {{$page->page_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <div class="my-2 d-flex justify-content-center align-items-center"> 
                                  <label>
                                    Starts
                                  </label>
                                  <input class="form-control mx-2" type="date" name="starts" value="{{$item->starts}}" />
                              </div>

                              <div class="my-2 d-flex justify-content-center align-items-center"> 
                                  <label>
                                    Ends
                                  </label>
                                  <input class="form-control mx-2" type="date" name="ends" value="{{$item->ends}}" />
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
                    <div class="modal fade" id="modalDel{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content px-2">
                              <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Delete Popup</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                            <div class="my-2 text-danger">
                              Are you sure Delete this popup {{$item->name}} ?
                            </div>  

                              <input type="hidden" value="{{$item->id}}" name="id" />
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <a href="{{route('del_popup', ['id' => $item->id])}}" class="btn btn-danger">
                                  Delete
                                </a>
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