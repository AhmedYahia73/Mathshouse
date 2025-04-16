
@php
    $page_name = 'Dashboard';
@endphp
@section('title', 'Dashboard')
@include('Affilate.inc.header')
@include('Affilate.inc.menu')
@extends('Affilate.inc.nav')

@section('page_content') 
@include('success')
<style>
    .rollin_service{
        cursor: pointer;
    }
    .rollin_service div{
        transition: .3s all ease-in-out;
    }
    .rollin_service:hover div{
        background-color: #f6fdc3;
    }
</style>

<div class="text-center my-3" style="font-weight: bold">
    Affilate Link:- 
    <a href="{{route('aff_link', ['id' => $affilate->id])}}">
    {{route('aff_link', ['id' => $affilate->id])}}
    </a>
</div>

<div class="container-xxl flex-grow-1 py-3 container-p-y">
    <div class="row">

        <!-- Conversion Chart-->
        <div class="col-sm-4 col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-3">
                <div class="conversion-title">
                    <h5 class="card-title mb-1">Wallet</h5>
                </div>
                <h2 class="mb-0">${{$affilate->wallet}}</h2>
                </div>
                <div class="card-body" style="position: relative;">
                <div class="resize-triggers">
                    <div class="expand-trigger">
                        <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 123px;">
                            <i class="fa-solid fa-wallet text-primary" style="font-size: 65px;"></i>
                        </div>
                    </div>
            <div class="contract-trigger"></div></div></div>
            </div>
        </div>
        <!-- End Conversion Chart-->

        <!-- Conversion Chart-->
        <div class="col-sm-4 col-12 mb-4 rollin_service">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-3">
                <div class="conversion-title">
                    <h5 class="card-title mb-1">Rollin Services</h5>
                </div>
                </div>
                <div class="card-body" style="position: relative;">
                <div class="resize-triggers">
                    <div class="expand-trigger">
                        <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 123px;">
                            <i class="fa-brands fa-servicestack text-warning" style="font-size: 65px;"></i>
                        </div>
                    </div>
            <div class="contract-trigger"></div></div></div>
            </div>
        </div>
        <!-- End Conversion Chart-->

        <!-- Conversion Chart-->
        <div class="col-sm-4 col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-3">
                <div class="conversion-title">
                    <h5 class="card-title mb-1">Total Earned</h5>
                </div>
                <h2 class="mb-0">${{$services->sum('earned')}}</h2>
                </div>
                <div class="card-body" style="position: relative;">
                <div class="resize-triggers">
                    <div class="expand-trigger">
                        <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 123px;">
                            <i class="fa-solid fa-sack-dollar" style="font-size: 65px;color:green;"></i>
                        </div>
                    </div>
            <div class="contract-trigger"></div></div></div>
            </div>
        </div>
        <!-- End Conversion Chart-->

    </div>
</div>
 
<table class="table d-none service_tbl">
    <thead>
        <th>#</th>
        <th>Service</th>
        <th>Earned</th>
    </thead>

    <tbody>
        @foreach ( $services as $item )
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->service}}
            </td>
            <td>
                {{$item->earned}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    let service_tbl = document.querySelector('.service_tbl');
    let rollin_service = document.querySelector('.rollin_service');
    
    rollin_service.addEventListener('click', () => {
        service_tbl.classList.toggle('d-none');
    })
</script>
@endsection

@include('Affilate.inc.footer')
