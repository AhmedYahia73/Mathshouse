
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

            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-success my-3"
                    data-bs-toggle="modal" data-bs-target="#modalPayout">
                    Request Payout
                </button>

                <!-- Modal -->
                <form method="POST" action="{{ route('aff_add_payout_req') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="modalPayout" tabindex="-1"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content px-2">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Request Payout</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="p-3">
                                    <div class="d-flex my-2">
                                        <label style="width: 180px;">
                                            Amount
                                        </label>
                                        <input type="number" min="0" max="{{$affilate->wallet}}" name="amount" class="form-control mx-2" required />
                                    </div>
                                    
                                    <div class="d-flex my-2">
                                        <label style="width: 180px;">
                                            Payout Method
                                        </label>
                                        <select name="payment_method" class="form-control mx-2" required />
                                            <option disabled selected>
                                                Select Payout Method ...
                                            </option>
                                            @foreach ( $payment_method as $item )
                                                <option value="{{$item->id}}">
                                                    {{$item->payment}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary"
                                        data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Conversion Chart-->

    </div>
</div>
 
@endsection

@include('Affilate.inc.footer')
