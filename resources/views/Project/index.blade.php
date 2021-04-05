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
            <a href="{{ route('projects.index') }}">
                <h3 class="nk-block-title page-title">Projects</h3>
            </a>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">My Projects</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Leads</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Project Name</th>
                        <th class="text-muted">View / Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ownProjects as $ownProject)
                    <tr>
                        <td>{{ $ownProject->lead->name . ' ' . $ownProject->lead->last_name }}</td>
                        <td>{{ date('m/d/y g:i A', strtotime($ownProject->created_at)) }}</td>
                        <td>{{ $ownProject->author_name }}</td>
                        <td>{{ $ownProject->name }}</td>
                        <td>
                            <a href="{{ route('projects.show', $ownProject->id) }}">
                                <em class="icon ni ni-eye-alt text-primary fs-17px"></em> View
                            </a>/<a href="#">
                                <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">All Projects</h5>
            </div>
            <table class="datatable-init table">
                <thead>

                    <tr>
                        <th>Leads</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Project Name</th>
                        <th class="text-muted">View</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->lead->name .  $project->lead->last_name }}</td>
                        <td>{{ date('m/d/y g:i A', strtotime($project->created_at)) }}</td>
                        <td>{{ $project->author_name }}</td>
                        <td>{{ $project->name }}</td>
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}">
                                <em class="icon ni ni-eye-alt text-primary fs-17px"></em> View
                            </a>
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
