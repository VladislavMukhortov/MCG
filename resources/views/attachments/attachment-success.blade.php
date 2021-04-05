@extends('layouts.attachment')

{{-- Page Title --}}
@section('page-title')
    Requests

@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    @if(isset($success))
        <div class="alert alert-success">
            {{ $success }}
        </div>
    @endif
@endsection

@section('page-js')


@endsection
