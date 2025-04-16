
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@include('success')
    @section('title','Grade Report')

  <form class="my-3" action="{{route('ad_grade_report')}}" method="GET">
    <div class="my-3 d-flex">
      <div class="d-flex align-items-center mx-2">
        <label>
          Grade
        </label>
        <select class="form-control w-250px" name="grade">
          <option disabled selected>
            Select Grade ...
          </option>
            @for ($i = 1; $i < 14; $i++)
                <option {{@$data['grade'] == $i ? 'selected' : null}} value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
      </div>
      <div class="mx-2">
        <button class="btn btn-primary">
          Filter
        </button>
      </div>
    </div>
  </form>

  <h4>
    Total : {{count($stu_count)}} Students
  </h4>
<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Student</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">E-mail</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Phone</th>
    </thead>
    <tbody class="fs-6">
        @foreach($students as $item)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td> 
                {{$item->f_name . ' ' . $item->l_name . ' (' .$item->nick_name . ')'}}
            </td>
            <td>
                {{$item->email}}
            </td>
            <td>
                {{$item->phone}}
            </td>
        </tr>
        @endforeach
        {{$students->links()}}
    </tbody>
</table>
</x-default-layout>