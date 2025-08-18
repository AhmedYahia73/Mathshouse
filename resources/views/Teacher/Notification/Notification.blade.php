
@php
    $page_name = 'Notifications';
@endphp
@include('Teacher.inc.header')
@include('Teacher.inc.menu')
@extends('Teacher.inc.nav')
@section('title','Profile')

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

@include('Teacher.inc.footer')