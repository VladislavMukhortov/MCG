@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Projects
@endsection

{{-- Page CSS --}}
@push('css')
{{--    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">--}}
@endpush

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $project->name }}</h3>

            </div><!-- .nk-block-head-content -->

        </div><!-- .nk-block-between -->
{{--        <div class="col-xxl-12 mb-2 estimate-template-section">--}}
{{--            <div class="progress progress-lg ">--}}
{{--                @foreach (\App\Models\ProjectStatus::getStatuses() as $key => $statusName)--}}
{{--                    <div class="progress-bar rounded bg-{{ $key > $project->status_id ? 'warning' : 'success'  }} font-weight-bold" data-progress="16">{{ $statusName }}</div>--}}
{{--                    @if(!$loop->last)--}}
{{--                        <em class="icon ni ni-caret-right-fill" style="font-size: 18px;"></em>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="col-xxl-12">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-title-group align-start gx-3">
                    <div class="card-title" style="margin-top:15px;">
                        <h6 class="title"><em class="icon ni ni-info"></em>Details</h6>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-inner">
                            <div class="nk-block">
                                <div class="profile-ud-list">
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Project Name</span>
                                            <span class="profile-ud-value">{{ $project->name }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Created Date</span>
                                            <span class="profile-ud-value">
                                                {{ date('m/d/Y h:i A', strtotime($project->created_at)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Created By</span>
                                            <span class="profile-ud-value">{{ $project->author_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-12">
        <div class="card card-bordered card-preview mt-5">
            <div class="card-inner">
                <ul class="nav nav-tabs mt-n3">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabLineItems"><em class="icon ni ni-opt-dot"></em><span>Line Items</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabAttachments"><em class="icon ni ni-cloud"></em><span>Attachments</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabCompletionReports"><em class="icon ni ni-question"></em><span>Completion Reports</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabPayments"><em class="icon ni ni-question"></em><span>Payments</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabDocuments"><em class="icon ni ni-question"></em><span>Documents</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('Project.leads.tabs._line_items', [
                        'lineItems' => $lineItems
                    ])
                    @include('Project.leads.tabs._attachments', [
                        'attachments' => $project->attachments
                    ])
                    @include('Project.leads.tabs._completion_reports', [
                        'reports' => $project->completionReports
                    ])
                    @include('Project.leads.tabs._payments', [
                        'payments' => $project->payments
                    ])
                    @include('Project.leads.tabs._documents', [
                        'documents' => $project->documents
                    ])
                </div>
            </div>
        </div>
    </div>

@endsection

@push('modals')

@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <style>
        .top {
            display: flex;
            justify-content: space-between;
        }
        .top > .dataTables_filter {

        }
        .top  > .dataTables_length {

        }
    </style>
@endpush
@section('page-js')
    <script>
        $(document).ready(function() {
            $('#datatable__attachments').DataTable({
                "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                "language": {
                    "lengthMenu": "Show &nbsp; _MENU_"
                }
            });
            $('#datatable__reports').DataTable({
                "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                "language": {
                    "lengthMenu": "Show &nbsp; _MENU_"
                }
            });
            $('#datatable__payments').DataTable({
                "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                "language": {
                    "lengthMenu": "Show &nbsp; _MENU_"
                }
            });
            $('#datatable__documents').DataTable({
                "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                "language": {
                    "lengthMenu": "Show &nbsp; _MENU_"
                }
            });
        });
    </script>
@endsection