
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@include('success')
    @section('title','Live Report')

  <form class="my-3" action="{{route('ad_live_report')}}" method="GET">
    <div class="my-2 d-flex">
      <div class="d-flex align-items-center mx-2">
        <label>
          From
        </label>
        <input type="date" value="{{@$data['from']}}" name="from" class="form-control mx-2" />
      </div>
      <div class="d-flex align-items-center mx-2">
        <label>
          To
        </label>
        <input type="date" value="{{@$data['to']}}" name="to" class="form-control mx-2" />
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
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Session</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Date</th>
    </thead>
    <tbody class="fs-6">
        @foreach($students as $item)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->student->f_name . ' ' . $item->student->l_name . ' (' .$item->student->nick_name . ')'}}
            </td>
            <td>
                {{$item->session->name}}
            </td>
            <td>
                {{Illuminate\Support\Carbon::parse($item->created_at)->toDateString()}}
            </td>
        </tr>
        @endforeach
        {{$students->links()}}
    </tbody>
</table>
</x-default-layout>