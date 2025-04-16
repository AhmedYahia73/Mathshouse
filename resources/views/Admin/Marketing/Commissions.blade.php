
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
{{-- <x-default-layout>
    @section('title','Commissions')
    <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
        <thead class="fs-7 text-gray-500 text-uppercase">
            <tr>
                <th>Service</th>
                <th>Commission</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commission as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <span class="form-check-label fw-semibold text-muted">
                        {{$item->precentage}} %
                    </span>
                    @if($item->state)
                    <input class="form-check-input" type="checkbox" value="1" checked="checked">
                    @else
                    <input class="form-check-input" type="checkbox" value="0" />
                    @endif
                </label>
                </td>
            <td>
            <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter{{$item->id}}">
                          Edit
                        </button> 

                        <!-- Modal -->
                        <form method="POST" action="{{route('edit_commission')}}">
                          @csrf
                        <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content px-2">
                              <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Edit Course</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                            <div class="my-2">
                                <label>
                                    Precentage
                                </label>
                                <input class="form-control" type="number" name="precentage" value="{{$item->precentage}}" />
                            </div>
                            
                            <label style="cursor:pointer;" class="text-center form-check form-switch form-check-custom form-check-solid">
                                <span class="form-check-label fw-semibold text-muted">
                                    Checked ==> {{$item->precentage}} %
                                </span>
                                @if($item->state)
                                <input class="form-check-input" name="state" type="checkbox" value="1" checked="checked">
                                @else
                                <input class="form-check-input" name="state" type="checkbox" value="1" />
                                @endif
                            </label>

                              <input type="hidden" value="{{$item->id}}" name="id" />
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
                      </div>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-default-layout> --}}

<x-default-layout>
    @section('title','Commissions')
    <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
        <thead class="fs-7 text-gray-500 text-uppercase">
            <tr>
                <th>#</th>
                <th>Affilate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($affilate as $item)
              @php
                $course = 0;
                $chapter = 0;
                $exam = 0;
                $question = 0;
                $live = 0;
              @endphp
              @foreach ( $item->commisions as $element )
                  @if ( $element->name == 'Course' )
                    @php
                      $course = $element;
                    @endphp
                  @elseif ( $element->name == 'Chapter' )
                    @php
                      $chapter = $element;
                    @endphp
                  @elseif ( $element->name == 'Exams' )
                    @php
                      $exam = $element;
                    @endphp
                  @elseif ( $element->name == 'Questions' )
                    @php
                      $question = $element;
                    @endphp
                  @elseif ( $element->name == 'Live Session' )
                    @php
                      $live = $element;
                    @endphp
                  @endif
              @endforeach
            <tr>
              <td>{{$loop->iteration}}</td>
                <td>{{$item->user->f_name . ' ' . $item->user->l_name }}</td>
            <td>
            <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter{{$item->id}}">
                          Edit
                        </button> 

                        <!-- Modal -->
                        <form method="POST" action="{{route('edit_commission')}}">
                          @csrf
                        <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content px-2">
                              <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Edit Commission</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                              <div class="my-2">
                                  <label>
                                    Course
                                  </label>
                                  <input type="hidden" name="name[]" value="Course" />
                                  
                                  <input class="form-control" type="number" name="precentage[]" value="{{@$course->precentage}}" placeholder="Course" />
                              </div>

                              <div class="my-2">
                                  <label>
                                    Chapter
                                  </label>
                                  <input type="hidden" name="name[]" value="Chapter" />
                                  
                                  <input class="form-control" type="number" name="precentage[]" value="{{@$chapter->precentage}}" placeholder="Chapter" />
                              </div>

                              <div class="my-2">
                                  <label>
                                    Exams
                                  </label>
                                  <input type="hidden" name="name[]" value="Exams" />
                                  
                                  <input class="form-control" type="number" name="precentage[]" value="{{@$exam->precentage}}" placeholder="Exams" />
                              </div>

                              <div class="my-2">
                                  <label>
                                    Questions
                                  </label>
                                  <input type="hidden" name="name[]" value="Questions" />
                                  
                                  <input class="form-control" type="number" name="precentage[]" value="{{@$question->precentage}}" placeholder="Questions" />
                              </div>

                              <div class="my-2">
                                  <label>
                                    Live Session
                                  </label>
                                  <input type="hidden" name="name[]" value="Live Session" />
                                  
                                  <input class="form-control" type="number" name="precentage[]" value="{{@$live->precentage}}" placeholder="Live Session" />
                              </div>
                            

                              <input type="hidden" value="{{$item->id}}" name="id" />
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
                      </div>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-default-layout>