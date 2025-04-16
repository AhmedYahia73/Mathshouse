
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
    @section('title','Cancelation')
    @include('success')
<button id="btn_print" class=" btn btn-success my-3">
    <i class="fa-solid fa-print mr-2"></i>
    Print
</button>

<form method="GET" action="{{route('filter_cancelation')}}"> 
  <div class="pb-2 d-flex">
      <select name="category_id" class="form-control sel_category mx-2">
          <option selected value="">
              Select Category ...
          </option>
          @foreach ($categories as $category)
              <option {{ @$data['category_id'] == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                  {{ $category->cate_name }}
              </option>
          @endforeach
      </select>

      <select name="course_id" class="form-control sel_course_items mx-2">
          <option selected value="">
              Select Course ...
          </option>
          @foreach ($courses as $course)
              @if (@$data['course_id'] == $course->id)
                  <option value="{{ $course->id }}" selected>
                      {{ $course->course_name }}
                  </option>
              @elseif(@$data['category_id'] == $course->category_id)
                  <option value="{{ $course->id }}">
                      {{ $course->course_name }}
                  </option>
              @endif
          @endforeach
      </select>

      <input type="hidden" value="{{ $courses }}" class="course" /> 
  </div>
     <div class="pb-2 d-flex">
      <select name="teacher_id" class="form-control mx-2">
          <option selected value="">
              Select Teacher ...
          </option>
          @foreach ($teachers as $teacher)
              <option {{ @$data['teacher_id'] == $teacher->id ? 'selected' : '' }} value="{{ $teacher->id }}">
                  {{ $teacher->nick_name }}
              </option>
          @endforeach
      </select>

      <input type="date" name="date" value="{{@$data['date']}}" class="form-control" />

      <input type="hidden" value="{{ $courses }}" class="course" />
      <button class="btn btn-primary mx-2">
          Submit
      </button>
  </div>
  
</form>

    <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">User</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Date</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Time</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Category</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Course</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Session Type</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Session Name</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Teacher</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Status</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action</th>
    </thead>
    <tbody class="fs-6">
        @foreach ( $cancelations as $item )
        <tr>
          <td>
            {{$loop->iteration}}
          </td>
          <td>
            {{$item->user->name}}
          </td>
          <td>
            {{$item->date}}
          </td>
          <td>
            {{$item->time}}
          </td>
          <td>
            {{$item->session->lesson->chapter->course->category->cate_name}}
          </td>
          <td>
            {{$item->session->lesson->chapter->course->course_name}}
          </td>
          <td>
            {{$item->session->type}}
          </td>
          <td>
            {{$item->session->name}}
          </td>
          <td>
            {{$item->session->teacher->nick_name}}
          </td>
          <td>
            {{$item->statue}}
          </td>
            <td>
              <div class="mt-3">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter{{$item->id}}">
                Approve
              </button>
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete{{$item->id}}">
                Rejected
              </button>

              <!-- Modal -->
              <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">

              <h5 class="modal-title" id="modalCenterTitle">Approve Cancelation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> 

              <div class='p-3'>
              Are You Sure To Approve Cancelation ?
              </div>

              <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
              Close
              </button>
              <a href="{{route('approve_cancelation', ['id'=>$item->id])}}" class="btn btn-success">Approve</a>
              </div>
              </div>
              </div>
              </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="modalDelete{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="modal-header">

              <h5 class="modal-title" id="modalCenterTitle">Rejected Cancelation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> 

              <div class='p-3'>
              Are You Sure To Rejected Cancelation ?
              </div>

              <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
              Close
              </button>
              <a href="{{route('reject_cancelation', ['id'=>$item->id])}}" class="btn btn-danger">Rejected</a>
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

<script>
  let btn  = document.getElementById("btn_print");

  btn.addEventListener('click', () => {
    window.print();
  })
</script>
<script>
    let sel_category = document.querySelector('.sel_category');
    let sel_course_items = document.querySelector('.sel_course_items');
    let course = document.querySelector('.course');
    course = course.value;
    course = JSON.parse(course);

    sel_category.addEventListener('change', () => {
        sel_course_items.innerHTML = `
    <option selected value="">
        Select Course ...
    </option>`;
        course.forEach(element => {
            if (sel_category.value == element.category_id) {
                sel_course_items.innerHTML += `
      <option value="${element.id}">
          ${element.course_name}
      </option>`;
            }
        });
    })
</script>
</x-default-layout>