@php
$page_name = 'Live';
use Carbon\Carbon;
@endphp
@section('title','Live')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')

@include('success') 


<div>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Material Link</th>
            <th>Material File</th>
            <th>Text</th> 
        </thead>

        <tbody>
            @foreach( $notifications as $item )
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @if (!empty($item->material_link))
                            <a href="{{ $item->material_link }}" class="text-primary">
                                Open Link
                            </a>
                        @else
                            Empty
                        @endif
                    </td>
                    <td>
                        @if (!empty($item->material_file))
                            <a href="{{ asset($item->material_file_link) }}" class="btn btn-success" download>
                                Download
                            </a>
                        @else
                            Empty
                        @endif
                    </td>
                    <td>
                        {{ $item->text }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
@endsection

@include('Student.inc.footer')