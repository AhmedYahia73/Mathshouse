
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@include('success')
    @section('title','Payment Report')

  <form class="my-3" action="{{route('ad_payment_report')}}" method="GET">
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
    Total : {{count($payment)}} Students
  </h4>
  <h4>
    Total Payment: ${{$payment->sum('price')}} 
  </h4>
<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Student</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Price</th>
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
                ${{$item->price}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-default-layout>