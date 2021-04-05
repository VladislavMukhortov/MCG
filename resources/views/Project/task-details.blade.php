@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Tasks
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')

    @include('Project.partials._page_path_task_details', [
        'project'   => $project,
        'task'      => $task
    ])

    @include('Task.partials._details_section', ['reads' => $task])

    @include('Task.partials._task_notes_section', ['reads' => $task])

@endsection

@push('modals')
    @include('Task.modals.add_note', ['reads' => $task ?? $reads])
    @include('Task.modals.edit_task', [
            'representative'    => $representatives,
            'reads'             => $task ?? $reads,
            'all_task'          => $allTasks,
        ])
@endpush

@section('page-js')

@endsection
