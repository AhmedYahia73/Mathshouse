
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@section('title','History of Package')
        
<form action="{{route('package_history')}}" method="GET">
    <div class="d-flex mb-4">
        <select name="admin_id" class="form-control mx-3">
            <option disabled selected>
                Select Admin ...
            </option>
            @foreach ( $users as $item )
                <option {{@$data['admin_id'] == $item->id ? 'selected' : ''}} value="{{$item->id}}">
                    {{$item->nick_name}}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary">
            Search
        </button>
    </div>
</form>

<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
        <tr>
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Student</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Type</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Number</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Admin</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Purchasing</th>
    </thead>
    <tbody class="fs-6">
        @foreach( $small_packages as $item )
        <tr class="odd">
            <td class="sorting_1">
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->user->nick_name}}
            </td>
            <td>
                {{$item->module}}
            </td>
            <td>
                {{$item->number}}
            </td>
            <td>
                {{$item->admin->nick_name}}
            </td>
            <td>
                {{$item->purchases($item->user->id)->sum('package.price')}}$
            </td> 
        </tr>
        @endforeach
        {{$small_packages->links()}}
    </tbody>
</table>

</x-default-layout>