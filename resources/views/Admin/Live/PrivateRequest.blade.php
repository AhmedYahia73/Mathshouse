
@php
  function fun_admin(){
    return 'admin';
  }
  $iter = 1;
@endphp
<x-default-layout>
    @section('title','Private Request')
    @include('success')
    
<button id="btn_print" class=" btn btn-success">
    <i class="fa-solid fa-print mr-2"></i>
    Print
</button>

<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
    <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="min-w-250px sorting sorting_desc" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 336.359px;" aria-sort="descending">#</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">User Name</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Date</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">From</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">To</th>
            <th class="min-w-150px sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 205.188px;">Teacher</th>
    </thead>
    <tbody class="fs-6">
        @foreach($users as $item)
        @foreach ($item->private_session as $element)
            <tr>
              <td>
                  {{$iter++}}
              </td>
              <td>
                  {{$item->name}}
              </td>
              <td>
                  {{$element->date}}
              </td> 
              <td>
                  {{$element->from}}
              </td>
              <td>
                  {{$element->to}}
              </td>
              <td>
                  {{$element->teacher->nick_name}}
              </td>
              
          </tr>
        @endforeach
        @endforeach
    </tbody>
</table>


<script>
        let btn  = document.getElementById("btn_print");

        btn.addEventListener('click', () => {
            window.print();
        })
</script>
</x-default-layout>