@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
Questions
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Questions</h3>

            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Questions</h5>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary"><em class="ni ni-filter"></em>Add filters</a>
            </div>

            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>View/Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->subject }}</td>
                            <td>{{ $list->description }}</td>
                            <td>{{ $list->created_at }}</td>
                            <td>{{ $list->author_name }}</td>
                            <td>{{ $list->status_title }}</td>
                            <td>
                                <a href="{{ route('questions.show', $list->id) }}"><em class="ni ni-eye-alt"></em> View / Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->


@endsection

@section('page-js') 

@endsection
    