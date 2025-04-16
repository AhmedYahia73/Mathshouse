
@php
  function fun_admin(){
    return 'admin';
  }
@endphp
<x-default-layout>
@include('success')
    @section('title','Payment Request')

<div class="col-xl-9 col-md-8 col-12 mb-md-0 my-4">
    <div class="card invoice-preview-card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
          <div class="mb-xl-0 mb-4">
            <div class="d-flex align-items-center svg-illustration mb-3 gap-2">
              <img style="height: 80px; width: 80px;" src="{{asset('assets/media/logos/Maths_house.png')}}" />
              <span class="app-brand-text h3 mb-0 fw-bold">Math House</span>
            </div>
          </div>
          <div>
            <div class="mb-2">
              <span class="me-1">Date Issues:</span>
              <span class="fw-semibold">{{$payment->created_at}}</span>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
        <div class="row p-sm-3 p-0">
          <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
            <h6 class="pb-2">Reciept:</h6>
            @if (empty($payment->payment_method_id ))
            Wallet
          @else
          <img style="height: 150px; width: 150px;" src="{{asset('images/payment_reset/' . $payment->image)}}" />
          @endif
          </div>
          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
            <h6 class="pb-2">Service</h6>
            @if ($payment->module == 'Chapters')
              @if (count($service) == 0)
                Chapter
              @else
              Course: {{$service[0]->chapter->course->course_name}}<br />
              Chapters: <br />
              @foreach ($service as $item)
                {{$item->chapter->chapter_name}}<br />
              @endforeach
              @endif
            @elseif ($payment->module == 'Package')
              @if (empty($service))
                Package
              @else
               Package: {{$service->package->name}} <br />
               Course: {{$service->package->course->course_name}} <br />
               Category: {{$service->package->course->category->cate_name}}
              @endif
            @endif
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-betwee">
        <div class="col-xl-6 col-md-12 col-sm-7 col-12 px-4 py-3">
          <h6 class="pb-2">Status</h6>
          {{$payment->state}}
        </div>
        <div class="table-responsive px-4 py-3">
          <h6 class="pb-2">Items</h6>
          @if ( count($payment->order) == 0 )
              Package
          @endif
            @foreach ( $payment->order as $item )
                {{$item->chapter_name}}
                <br />
            @endforeach 
        </div>
      </div>

      <div class="table-responsive px-4">
        <h6 class="pb-2">Payment Method</h6>
        {{isset($payment->method->payment) ? $payment->method->payment : 'Wallet'}}
         
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <span class="fw-semibold">Total:</span>
            <span>${{$payment->price}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-default-layout>