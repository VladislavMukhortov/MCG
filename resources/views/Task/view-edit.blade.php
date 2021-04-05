@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Tasks Details
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')

@include('Task.partials._page_path')

@include('Task.partials._details_section')

@include('Task.partials._task_notes_section')

@endsection

@push('modals')
    @include('Task.modals.add_note', ['reads' => $task ?? $reads])
    @include('Task.modals.edit_task', ['reads' => $task ?? $reads])
@endpush

@section('page-js') 
 
@endsection
