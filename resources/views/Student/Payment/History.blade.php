
@php
    $page_name = 'Payment History';
@endphp
@section('title','Payment History')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')


<form action="{{route('stu_payment_history')}}" method="GET">
    <div class="d-flex my-3">
        <select style="width: 150px;" name="state" class="form-control">
            <option value="Pendding">
                Select State ...
            </option>
            <option {{@$data['state'] == 'Pendding' ? 'selected' : '' }} value="Pendding">Pendding</option>
            <option {{@$data['state'] == 'Approve' ? 'selected' : '' }} value="Approve">Approve</option>
            <option {{@$data['state'] == 'Rejected' ? 'selected' : '' }} value="Rejected">Rejected</option>
        </select>

        <button class="mx-3 btn btn-info">
            Filter
        </button>
    </div>
</form>

<table class="table">
    <thead>
        <th>#</th>
        <th>Date</th> 
        <th>Service</th>
        <th>Payment Method</th>
        <th>Price</th> 
        <th>Statues</th>
        <th>Details</th>
    </thead>

    <tbody>
        @foreach( $payments as $item )
        
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$item->created_at}}
            </td>
            <td>
                {{$item->module}}
            </td>
            <td>
                {{isset($item->method->payment) ? $item->method->payment : 'Wallet' }}
            </td>
            <td>
                {{$item->price}}
            </td>  
            <td>
                @if ( $item->state == 'Rejected' )
                    <button class="btn btn-info rejected_btn">Rejected</button>
                     
                    <div class="modal show_popup fade show d-none" id="modalCenter" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Rejected Reason</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{$item->rejected_reason}}
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary close_popup_btn" data-bs-dismiss="modal">
                                Close
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>
                @else
                    {{$item->state}}
                @endif
            </td>
            <td>
                <a href="{{route('payment_invoice', ['id'=> $item->id])}}" class="btn btn-primary">
                    Invoice
                </a>
            </td>
        </tr>
        @endforeach

        {{$payments->links()}}
    </tbody>
</table>

<script> 
    let show_popup = document.querySelectorAll('.show_popup');
    let btn_close = document.querySelectorAll('.btn-close');
    let close_popup_btn = document.querySelectorAll('.close_popup_btn');
    let rejected_btn = document.querySelectorAll('.rejected_btn');

    for (let i = 0, end = rejected_btn.length; i < end; i++) {
        rejected_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == rejected_btn[j] ) {
                    show_popup[j].classList.remove('d-none');
                }
            }
        });
        btn_close[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == show_popup[j] ) {
                    show_popup[j].classList.add('d-none');
                }
            }
        });
        close_popup_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == close_popup_btn[j] ) {
                    show_popup[j].classList.add('d-none');
                }
            }
        })
    } 
</script>
<script>
    let mistakes_questions = document.querySelectorAll('.mistakes_questions');
    let mistake_btn = document.querySelectorAll('.mistake_btn');
    let ans_item_btn = document.querySelectorAll('.ans_item_btn');
    let ans_item = document.querySelectorAll('.ans_item');
    
    for (let i = 0, end = ans_item_btn.length; i < end; i++) {
        ans_item_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == ans_item_btn[j] ) {
                    ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
    for (let i = 0, end = mistake_btn.length; i < end; i++) {
        mistake_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == mistake_btn[j] ) {
                    mistakes_questions[j].classList.toggle('d-none');
                }
            }
        });
    }
</script>
@endsection

@include('Student.inc.footer')
