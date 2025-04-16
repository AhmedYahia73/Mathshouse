
@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout> 
    @section('title', 'Student History')
    
    <div class="row">
        
    @foreach ( $data as $item )
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                    <span>Chapter Name:-</span>
                    <div class="d-flex align-items-end mt-2">
                        <h4 class="mb-0 me-2">{{$item->chapter->chapter_name}}</h4>
                    </div>
                    </div>
                    <span class="badge bg-label-danger rounded p-2">
                    <i class="bx bx-user-plus bx-sm"></i>
                    </span>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
        

</x-default-layout>