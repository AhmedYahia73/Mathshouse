@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
    @section('title','Report List')
    @include('success')
    
    <div class="mb-4" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px; padding: 30px;" >
        <form action="{{route('Ad_report_list_add')}}" method="POST">
            @csrf

            <input class="form-control my-2" name="list" placeholder="Report Name ..."/>
            
            <div class="d-flex my-2">
                <button class="btn btn-primary mr-2">
                    Submit
                </button>
                <button type="reset" class="btn btn-danger mx-2">
                    Clear
                </button>
            </div>
        </form>
    </div>
    
    <div style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px; padding: 30px;" >
        
        <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
            <thead class="fs-7 text-gray-500 text-uppercase">
                    <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Report</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action</th>
            </thead>
            <tbody class="fs-6">
                @foreach($list as $item)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$item->list}}
                    </td>
                    <td>
                    <div class="mt-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter{{$item->id}}">
                                  Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete{{$item->id}}">
                                  Delete
                                </button>
        
                                <!-- Modal -->
                                <form method="POST" action="{{route('Ad_report_list_edit', ['id' => $item->id])}}" enctype="multipart/form-data">
                                  @csrf
                                <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        
                                        <h5 class="modal-title" id="modalCenterTitle">Edit Report</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div> 
        
                                    <div class="my-2 px-3">
                                        <label>
                                        Report
                                        </label>
                                        <input class='form-control' value="{{$item->list}}" name="list" placeholder="Report" />
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
                                <div class="modal fade" id="modalDelete{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        
                                        <h5 class="modal-title" id="modalCenterTitle">Delete Report</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div> 
                                      
                                      <div class='p-3'>
                                        Are You Sure To Delete
                                        <span class='text-danger'>
                                          {{$item->list}} ??
                                        </span>
                                      </div>
        
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                          Close
                                        </button>
                                        <a href="{{route('Ad_report_list_del', ['id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            {{$list->links()}}
        </table>
    </div>
    
</x-default-layout>