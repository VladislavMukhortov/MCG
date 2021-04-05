@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Projects
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Projects</h3>

            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Projects</h5>
                </div>

                <table class="datatable-init table">
                    <thead>

                    <tr>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Project Name</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        @include('Project.leads.partials._item', ['item' => $project])
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->


@endsection

@section('page-js')

@endsection
