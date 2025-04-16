
@php
    $page_name = 'Dashboard';
@endphp
@section('title', 'Dashboard')
@include('Affilate.inc.header')
@include('Affilate.inc.menu')
@extends('Affilate.inc.nav')

@section('page_content') 
@include('success')

<div class="my-3">
    <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
        <thead class="fs-7 text-gray-500 text-uppercase">
            <tr>
                <th>Service</th>
                <th>Commission</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($services as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <span class="form-check-label fw-semibold text-muted">
                        {{$item->precentage}} %
                    </span>
                    @if($item->state)
                    <input class="form-check-input" type="checkbox" value="1" checked="checked">
                    @else
                    <input class="form-check-input" type="checkbox" value="0" />
                    @endif
                </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
@endsection

@include('Affilate.inc.footer')
