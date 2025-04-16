
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@include('success')
@section('title','Wallet History')

    <form class="my-3" action="{{route('filter_wallet_history')}}" method="GET">
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

<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Student</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Price</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Receipt</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Date</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Statue</th> 
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Rejected Reasons</th> 
    </thead>
    <tbody class="fs-6">
        @foreach($wallets as $item)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
              {{$item->student->f_name . ' ' . $item->student->l_name . ' (' . $item->student->nick_name . ')'}}
            </td>
            <td>
                ${{$item->wallet}}
            </td>
            <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalReceipt{{$item->id}}">
                          view
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalReceipt{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Approve Payment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div> 
                              
                              <img src="{{asset('images/wallet/' . $item->image)}}" />
                              
                            </div>
                          </div>
                        </div>
            </td>
            <td>
                {{$item->date}}
            </td>
            <td>
                {{$item->state}}
            </td> 
            <td>
                {{$item->rejected_reason}}
            </td> 
        </tr>
        @endforeach
        {{$wallets->links()}}
    </tbody>
</table>
</x-default-layout>