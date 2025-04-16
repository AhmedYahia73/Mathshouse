
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@include('success')
@section('title','Payment Request')

    <form class="my-3" action="{{route('filter_pendding_payment')}}" method="GET">
      <div class="my-2 d-flex">
        <div class="d-flex align-items-center mx-2">
          <label>
            From
          </label>
          <input type="date" name="from" value="{{@$data['from']}}" class="form-control mx-2" />
        </div>
        <div class="d-flex align-items-center mx-2">
          <label>
            To
          </label>
          <input type="date" name="to" value="{{@$data['to']}}" class="form-control mx-2" />
        </div>
        <div class="mx-2">
          <button class="btn btn-primary">
            Filter
          </button>
        </div>
      </div>
    </form>

    @if ( request()->routeIs('filter_pendding_payment') )
        <br />
        <a href="{{route('pendding_payment')}}" class="btn btn-primary">
          Restore List
        </a>
    @endif

<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Payment Method</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Student</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Material</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Service</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Price</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Receipt</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Date</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Statue</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Action</th>
    </thead>
    <tbody class="fs-6">
        @foreach($payment as $item)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->method->payment}}
            </td>
            <td>
                {{$item->user->f_name . ' ' . $item->user->l_name . ' (' . $item->user->nick_name . ')'}}
            </td>
            <td>
              <a href="{{route('payment_material', ['id' => $item->id])}}" class="btn btn-primary">
                View
              </a>
            </td>
            <td>
                {{$item->module}}
            </td>
            <td>
                ${{$item->price}}
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
                              
                              <img src="{{asset('images/payment_reset/' . $item->image)}}" />
                              
                            </div>
                          </div>
                        </div>
            </td>
            <td>
                {{Illuminate\Support\Carbon::parse($item->created_at)->toDateString()}}
            </td>
            <td>
                {{$item->state}}
            </td>
            <td>
            <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter{{$item->id}}">
                          Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalRejected{{$item->id}}">
                          Rejected
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Approve Payment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div> 
                              
                              <div class='p-3'>
                                Are You Sure To Approve
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <a href="{{route('approve_payment', ['id'=>$item->id])}}" class="btn btn-success">Approve</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalRejected{{$item->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h5 class="modal-title" id="modalCenterTitle">Delete Payment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div> 
                              <form action="{{route('rejected_payment', ['id'=>$item->id])}}" method="POST">
                                @csrf
                                <div class='p-3'>
                                  <input class="form-control" name="rejected_reason" placeholder="Rejected Reasons" />
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    Close
                                  </button>
                                  <button class="btn btn-danger">Reject</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    {{$payment->links()}}
</table>
</x-default-layout>