@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
    @section('title','Reports')
    @include('success')

    <style>
        .view_text{
            cursor: pointer;
        }
        .view_text:hover{
            color: #0000ff;
        }
    </style>
    
    
    <div>
        
        <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
            <thead class="fs-7 text-gray-500 text-uppercase">
                    <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Date</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Student</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Question</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Details</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Statues</th>
                    <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action</th>
            </thead>
            <tbody class="fs-6">
                @foreach($report as $item)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$item->date}}
                    </td>
                    <td>
                        {{$item->student->nick_name}}
                    </td>
                    <td>
                        <label class="view_text" data-bs-toggle="modal" data-bs-target="#modalQuestion{{$item->id}}">
                          view
                        </label>

                        <!-- Modal --> 
                        <div class="modal fade" id="modalQuestion{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Question</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                            <div class="my-2 px-3">
                                Question :
                                <br />
                                {{$item->question->question}}

                                @if ( !empty( $item->question->q_url) )
                                <img class="w-150px h-150px" src="{{asset('images/questions/' . $item->question->q_url)}}" />
                                @endif
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
                    </td>
                    <td>
                        <label class="view_text" data-bs-toggle="modal" data-bs-target="#modalDetails{{$item->id}}">
                          view
                        </label>

                        <!-- Modal --> 
                        <div class="modal fade" id="modalDetails{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> 

                            <div class="my-2 px-3">
                              Answer of question
                              <br />
                              Category : {{$item->question->lessons->chapter->course->category->cate_name}}
                              <br />
                              Course : {{$item->question->lessons->chapter->course->course_name}}
                              <br />
                              Chapter : {{$item->question->lessons->chapter->chapter_name}}
                              <br />
                              Category : {{$item->question->lessons->lesson_name}}
                              <br />
                              Month : {{$item->question->month}}
                              <br />
                              Year : {{$item->question->year}}
                              <br />
                              Section : {{$item->question->section}}
                              <br />
                              Q Num : {{$item->question->q_num}}
                              <br />
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
                    </td>
                    <td>
                        {{$item->statues}}
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
                                <form method="POST" action="{{route('Ad_report_question_edit', ['id' => $item->id])}}" enctype="multipart/form-data">
                                  @csrf
                                <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        
                                        <h5 class="modal-title" id="modalCenterTitle">Edit Report</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div> 
        
                                    <div class="my-2 px-3">
                                        <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                          <input id="pendding_item" class="form-check-input" type="radio" value="pendding" name="statues" checked='checked'>
                                          <label for="pendding_item" class="form-check-label">Pendding</label>
                                        </div>
                                        <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                          <input id="inprogress_item" class="form-check-input" type="radio" value="inprogress" name="statues">
                                          <label for="inprogress_item" class="form-check-label">Inprogress</label>
                                        </div>
                                        <div class="m-3 form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                          <input id="done_item" class="form-check-input" type="radio" value="done" name="statues">
                                          <label for="done_item" class="form-check-label">Done</label>
                                        </div>
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
                                        Are You Sure To Delete This Report ??
                                      </div>
        
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                          Close
                                        </button>
                                        <a href="{{route('Ad_report_question_del', ['id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            {{$report->links()}}
        </table>
    </div>
    
</x-default-layout>