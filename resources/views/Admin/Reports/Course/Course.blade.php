
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@include('success')
    @section('title','Courses Report')

  <form class="my-3" action="{{route('ad_course_report')}}" method="GET">
    <div class="py-5 d-flex">
      <select name="category_id" class="form-control sel_category mx-2">
          <option disabled selected>
              Select Category ...
          </option>
          @foreach( $categories as $category )
              <option {{@$data['category_id'] == $category->id ? 'selected': ''}} value="{{$category->id}}">
                  {{$category->cate_name}}
              </option>
          @endforeach
      </select>
      
      <select name="course_id" class="form-control sel_course_items mx-2">
          <option disabled selected>
              Select Course ...
          </option>
          @foreach( $courses as $course )
          @if( @$data['course_id'] == $course->id )
          <option value="{{$course->id}}" selected>
              {{$course->course_name}}
          </option>
          @elseif( @$data['category_id'] == $course->category_id )
          <option value="{{$course->id}}">
              {{$course->course_name}}
          </option>
          @endif
          @endforeach
      </select>
      
      <input type="hidden" value="{{$courses}}" class="course" />
    
      <button class="btn btn-primary mx-2">
          Submit
      </button>
</div>
  </form>

  <h4>
    Total : {{count($payment)}} Students
  </h4>

<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Student</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Course</th>
    </thead>
    <tbody class="fs-6">
        @foreach($payment as $item)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td> 
                {{$item->user->f_name . ' ' . $item->user->l_name . ' (' .$item->user->nick_name . ')'}}
            </td>
            <td>
                {{$item->course}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>  

<script>
  let sel_category = document.querySelector('.sel_category');
  let sel_course_items = document.querySelector('.sel_course_items');
  let course = document.querySelector('.course');
  course = course.value;
  course = JSON.parse(course);

  sel_category.addEventListener('change', () => {
    sel_course_items.innerHTML = `
    <option disabled selected>
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
  });
</script>
</x-default-layout>