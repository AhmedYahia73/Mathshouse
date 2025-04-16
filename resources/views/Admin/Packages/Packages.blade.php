
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@section('title','Package')
    
@error('name')
<div class="alert alert-danger">
{{$message}}
</div>
@enderror
@error('module')
  <div class="alert alert-danger">
  {{$message}}
  </div>
@enderror
@error('number')
  <div class="alert alert-danger">
  {{$message}}
  </div>
@enderror
@error('price')
  <div class="alert alert-danger">
  {{$message}}
  </div>
@enderror
@error('duration')
  <div class="alert alert-danger">
  {{$message}}
  </div>
@enderror
<button type="button" class="btn btn-primary btn-edit my-3" data-bs-toggle="modal" data-bs-target="#addModalCenter">
  Add New Package
</button>

<input type="hidden" class="categories" value="{{$categories}}" />
<input type="hidden" class="courses" value="{{$courses}}" />

<form method="POST" action="{{route('add_package')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="addModalCenter" tabindex="-1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content px-2">
          
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Add New Package</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>


            <div class="info_section" id="info_section">
                <div class='my-3'>
                    <label>Package Name</label>
                    <input class='form-control' name="name" placeholder="Package Name" />
                </div>
                <div class='my-3'>
                    <label>Module</label>
                    <select class="form-control sel_module" name="module">
                      <option disabled selected>
                        Select Module ...  
                      </option>
                      <option value="Exam">Exam</option>
                      <option value="Question">Question</option>
                      <option value="Live">Live</option>
                    </select>
                </div>
                <div class='my-3'>
                    <label>Category</label>
                    <select class="form-control sel_category1" name="course_id">
                      <option disabled selected>
                        Select Category ...  
                      </option>
                      @foreach ( $categories as $category )
                      <option value="{{$category->id}}">{{$category->cate_name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class='my-3 sel_course'>
                    <label>Course</label>
                    <select class="form-control sel_course1" name="course_id">
                      <option disabled selected>
                        Select Course ...  
                      </option> 
                    </select>
                </div>
                <div class='my-3'>
                    <label>Number</label>
                    <input class='form-control' name="number" placeholder="Number" />
                </div>
                <div class='my-3'>
                    <label>Price</label>
                    <input class='form-control' name="price" placeholder="Price" />
                </div>
                <div class='my-3'>
                    <label>Duration</label>
                    <input class='form-control' name="duration" placeholder="Duration" />
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

<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
        <tr>
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Name</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Module</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Category</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Course</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Number</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Price</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Duration</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action</th>
    </thead>
    <tbody class="fs-6">
        @foreach( $package as $item )
        <tr class="odd">
            <td class="sorting_1">
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->name}}
            </td>
            <td>
                {{$item->module}}
            </td>
            <td>
                {{$item->course->category->cate_name}}
            </td>
            <td>
                {{$item->course->course_name}}
            </td>
            <td>
                {{$item->number}}
            </td>
            <td>
                {{$item->price}}
            </td>
            <td>
                {{$item->duration}}
            </td>
            <td>
            <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" id="{{$item->id}}" class="btn btn-primary btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter{{$item->id}}">
                          Edit
                        </button>
                        <button type="button"id="{{$item->id}}"  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete{{$item->id}}">
                          Delete
                        </button>

                        <!-- Modal -->
                        <form method="POST" action="{{route('edit_package', ['id' => $item->id])}}" enctype="multipart/form-data">
                          @csrf
                          <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content px-2">
                                
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalCenterTitle">Edit Package</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>


                                  <div class="info_section" id="info_section{{$item->id}}">
                                      <div class='my-3'>
                                          <label>Package Name</label>
                                          <input class='form-control' value="{{$item->name}}" name="name" placeholder="Package Name" />
                                      </div>
                                      <div class='my-3'>
                                          <label>Module</label>
                                          <select class="form-control" name="module"> 
                                            @if ($item->module == 'Exam')
                                              <option value="Exam" selected>Exam</option>
                                            @else
                                              <option value="Exam">Exam</option>
                                            @endif
                                            @if ($item->module == 'Question')
                                              <option value="Question" selected>Question</option>
                                            @else
                                              <option value="Question">Question</option>
                                            @endif
                                            @if ($item->module == 'Live')
                                              <option value="Live" selected>Live</option>
                                            @else
                                              <option value="Live">Live</option>
                                            @endif 
                                          </select>
                                      </div>
                                      <div class='my-3'>
                                          <label>Category</label>
                                          <select class="form-control sel_category2" name="course_id">
                                            <option disabled selected>
                                              Select Category ...  
                                            </option>
                                            @foreach ( $categories as $category )
                                            @if ($category->id == $item->course->category->id)
                                            <option selected value="{{$category->id}}">{{$category->cate_name}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->cate_name}}</option>
                                            @endif
                                            @endforeach
                                          </select>
                                      </div>
                                      <div class='my-3'>
                                          <label>Course</label>
                                          <select class="form-control sel_course2" name="course_id">
                                            <option disabled selected>
                                              Select Course ...  
                                            </option>
                                            @foreach ( $courses->where('category_id', $item->course->category->id) as $course )
                                            @if ( $course->id == $item->course_id )
                                            <option value="{{$course->id}}" selected>{{$course->course_name}}</option>
                                            @else
                                            <option value="{{$course->id}}">{{$course->course_name}}</option>
                                            @endif
                                            @endforeach
                                          </select>
                                      </div>
                                      <div class='my-3'>
                                          <label>Number</label>
                                          <input class='form-control' name="number" value="{{$item->number}}" placeholder="Number" />
                                      </div>
                                      <div class='my-3'>
                                          <label>Price</label>
                                          <input class='form-control' name="price" value="{{$item->price}}" placeholder="Price" />
                                      </div>
                                      <div class='my-3'>
                                          <label>Duration</label>
                                          <input class='form-control' name="duration" value="{{$item->duration}}" placeholder="Duration" />
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
                                
                                <h5 class="modal-title" id="modalCenterTitle">Delete Package</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div> 
                              
                              <div class='p-3'>
                                Are You Sure To Delete
                                <span class='text-danger'>
                                  {{$item->name}} ??
                                </span>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <a href="{{route('del_package', ['id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
            </td>
        </tr>
        @endforeach
        {{$package->links()}}
    </tbody>
</table>

<script>
  let sel_category1 = document.querySelector('.sel_category1');
  let sel_course1 = document.querySelector('.sel_course1');

  let sel_category2 = document.querySelectorAll('.sel_category2');
  let sel_course2 = document.querySelectorAll('.sel_course2');
 
  let courses = document.querySelector('.courses');
  courses = courses.value;
  courses = JSON.parse(courses);

  sel_category1.addEventListener('change', () => {
    sel_course1.innerHTML = `<option selected disabled>Select Course ...</option>`;
    courses.forEach(item => {
      if (sel_category1.value == item.category_id) {
        sel_course1.innerHTML += `
        <option value="${item.id}">${item.course_name}</option>
        `;
      }
    });
  });

  for (let i = 0, end = sel_category2.length; i < end; i++) {
    sel_category2[i].addEventListener('change', ( e ) => {
      for (let j = 0; j < end; j++) { 
        if (e.target == sel_category2[j]) {
          sel_course2[j].innerHTML = `<option selected disabled>Select Course ...</option>`;
          courses.forEach(item => {
            if (sel_category2[j].value == item.category_id) {
              sel_course2[j].innerHTML += `
              <option value="${item.id}">${item.course_name}</option>
              `;
            }
          })
        }
      }
    })
  }

</script>
</x-default-layout>