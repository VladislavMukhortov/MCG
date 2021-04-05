@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
Projects

@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection
@section('page-js')
    <script>
        $(document).ready(function()
        {
            $('.currency').val("0.00");
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/payment/store_validation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/payout/store_validation.js') }}"></script>
@endsection
{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item fs-17px"><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active fs-17px">View Project Details</li>
                </ul>
            </nav>
        </div><!-- .nk-block-head-content -->

    </div>
</div>
<div class="nk-block-head nk-block-head-sm mr-1 ml-1">

    <div class="nk-block-between">

        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addBidder"><em class="icon ni ni-user-add-fill"></em><span>Add Bidders</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#assignWorker"><em class="icon ni ni-user-check-fill"></em><span>Assign Workers</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPayment"><em class="icon ni ni-money"></em><span>Add Payment</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPayout"><em class="icon ni ni-sign-usd"></em><span>Add Payout</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newDocument"><em class="icon ni ni-file-docs"></em><span>Generate Documents</span></a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block-head nk-block-head-sm ml-1">

    <div class="nk-block-between">

        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newTask"><em class="icon ni ni-check-thick"></em><span>New Task</span></a></li>

                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newAttachment"><em class="icon ni ni-upload-cloud"></em><span>New Attachment</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newNote"><em class="icon ni ni-edit"></em><span>New Note</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newOrder"><em class="icon ni ni-reload"></em><span>New Change Order</span></a></li>


                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="col-xxl-8 mb-2">
    <div class="progress progress-lg">
        @php
            $statuses = \App\Models\ProjectStatus::getStatuses()->toArray();
        @endphp

        @foreach ($statuses as $key => $statusGet)
            <div class="progress-bar bg-{{ $key > $project->status_id ? 'warning':'success'  }} font-weight-bold" data-progress="20">{{ $statusGet }}</div>
            @if(!$loop->last)
                <em class="icon ni ni-caret-right-fill" style="font-size: 18px;"></em>
            @endif
        @endforeach
    </div>
</div>
<div class="col-xxl-10">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-info"></em> Details</h6>

                </div>

                <div class="card-tools">
                    @can('delete', $project)
                    <div class="dropdown">
                        @include('partials._destroy', [
                            'url'       => route('projects.destroy', $project),
                            'btnClass'  => 'btn btn-primary btn-dim d-none d-sm-inline-flex',
                            'btnText'  => '<em class="icon ni ni-cross"></em><span class="d-none d-md-inline">Delete</span>'
                            ])
                    </div>
                    @endcan
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalLarge">
                            <em class="icon ni ni-edit"></em>
                            <span class="d-none d-md-inline">Edit</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-inner">

                        <div class="nk-block">
                            <div class="profile-ud-list">
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Lead</span>
                                        <span class="profile-ud-value">{{ $lead_name }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Project Name</span>
                                        <span class="profile-ud-value">{{ $project->name }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created</span>
                                        <span class="profile-ud-value">{{ date('m/d/y g:i A', strtotime($project->created_at)) }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Project Address</span>
                                        <span class="profile-ud-value">
                                            {{ $fullAddress }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created By
                                        </span>
                                        <span class="profile-ud-value">
                                            @if($project->author_name)
                                                {{ $project->author_name }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Status
                                        </span>
                                        <span class="profile-ud-value">
                                             @if($project->status_name)
                                                {{ $project->status_name }}
                                             @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Project Total
                                        </span>
                                        <span class="profile-ud-value">
                                            @if($project->project_total)
                                                {{ $project->project_total }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            </div><!-- .profile-ud-list -->
                        </div><!-- .nk-block -->
                    </div>
                    {{-- <div class="col-md-12"> --}}

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xxl-10">
    <div class="card card-bordered card-preview mt-5">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem1">
                        <em class="icon ni ni-opt-dot"></em>
                        <span>Line Items</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem2"><em class="icon ni ni-users-fill"></em><span>Bidders</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem3"><em class="icon ni ni-tether"></em><span>Bids</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem4"><em class="icon ni ni-file"></em><span>Documents</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-upload-cloud"></em><span>Attachments</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-edit"></em><span>Notes</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-list-ol"></em><span>Completion Reports</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem8"><em class="icon ni ni-check-thick"></em><span>Tasks</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem9"><em class="icon ni ni-reload"></em><span>Change Orders</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem10"><em class="icon ni ni-money"></em><span>Payments</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem11"><em class="icon ni ni-sign-usd"></em><span>Payouts</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem12"><em class="icon ni ni-help-fill"></em><span>Questions</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem1">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Line Items</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th class="text-muted">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($estimatelist as $list)
                                        <tr>
                                            <td>{{ date('m/d/Y h:i A', strtotime($list->created_at)) }}</td>
                                            <td>{{ $list->getCreatedby->name }}</td>
                                        </tr>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem2">
                    <div class="nk-block nk-block-lg">

                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Bidders</h5>
                                </div>
                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                    <label class="custom-control-label" for="uid"></label>
                                                </div>
                                            </th>
                                            <th class="nk-tb-col"><span class="sub-text">Subcontractor</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Number of Bids</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Request Last Sent</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Send Request</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">View</span></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr class="nk-tb-item">
                                            <td class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                    <label class="custom-control-label" for="uid1"></label>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">

                                            </td>
                                            <td class="nk-tb-col tb-col-mb">

                                            </td>
                                            <td class="nk-tb-col tb-col-md">

                                            </td>
                                            <td class="nk-tb-col tb-col-lg">

                                            </td>
                                            <td class="nk-tb-col tb-col-lg">

                                            </td>
                                            <td class="nk-tb-col tb-col-md">

                                            </td>


                                        </tr> --}}<!-- .nk-tb-item  -->
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem3">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Bids</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Line Item</th>
                                            <th>Bidder</th>
                                            <th>Date/Time</th>
                                            <th>Amount</th>
                                            <th>Signature</th>
                                            <th>Attachment</th>
                                            <th>Status</th>
                                            <th class="text-muted">Approve</th>
                                            {{-- <th class="text-muted">Reject</th>     --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($estimatelist as $list)
                                        <tr>
                                            <td>{{ date('m/d/Y h:i A', strtotime($list->created_at)) }}</td>
                                            <td>{{ $list->getCreatedby->name }}</td>
                                        </tr>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem4">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Documents</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Created By</th>
                                            <th>Created</th>
                                            <th>Subcontractor</th>
                                            <th>Lead</th>
                                            <th>Status</th>
                                            <th>Date Sent</th>
                                            {{-- <th class="text-muted">Send for Signature</th>  --}}
                                            <th class="text-muted">View</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($estimatelist as $list) --}}
                                        {{-- <tr>
                                            <td> </td>
                                            <td> </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr> --}}
                                        {{-- @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem5">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Attachments</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Attachments Description</th>
                                            <th>File</th>
                                            <th>Uploaded</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($project->attachments as $attachment)
                                    <tr>
                                        <td>{{ $attachment->attachment_description }}</td>
                                        <td>
                                            @if(!is_null($attachment->file_url))
{{--                                                <a href="{{ $attachment->file_url }}" target="_blank" download="">File</a>--}}
                                                <a href="{{ URL::to($attachment->file) }}" target="_blank" download="">File</a>

                                            @endif
                                        </td>
                                        <td>{{ $attachment->uploaded }}</td>

                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem6">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Notes</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Created By</th>
                                            <th>Notes</th>
{{--                                            <th>Contact</th>--}}
{{--                                            <th>Task</th>--}}
{{--                                            <th>General Contractor</th>--}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($project->notes)
                                        @foreach($project->notes as $note)
                                            @include('Project.partials._notes_item', [
                                                'note'      => $note,
                                                'project'   => $project
                                            ])
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>

                <div class="tab-pane" id="tabItem7">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Completion Reports</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Subcontractor</th>
                                            <th>Date/Time</th>
                                            <th>Notes</th>
                                            <th>Attachment</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem8">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Tasks</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created</th>
                                            <th>Created By</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                            <th>Assigned Rep</th>
                                            <th>View / Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($project->tasks)
                                        @foreach($project->tasks as $task)
                                            @include('Project.partials._tasks_item', [
                                                'task'      => $task,
                                                'project'   => $project
                                            ])
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem9">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Change Orders</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Lead</th>
                                            <th>Created By</th>
                                            <th>Created</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if($reads->leadActivities)
                                            @foreach($reads->leadActivities as $activity)
                                            <tr>
                                                <td>{{ date('m/d/Y h:i A', strtotime($activity->activities->created_at)) }}</td>
                                                <td>{{ $activity->activities->getuser['name'] }}</td>
                                                <td>{{ $activity->activities->description }}</td>
                                            </tr>
                                            @endforeach
                                       @endif --}}

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem10">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Payments</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                            <th class="text-muted">Mark Paid</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                         @if($project->payments)
                                            @foreach($project->payments as $payment)
                                                @include('Project.partials._payments_item', [
                                                    'payment' => $payment,
                                                    'project' => $project
                                                ])
                                            @endforeach
                                       @endif

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem11">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Payouts</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Date/Time</th>
                                            <th>Subcontractor</th>
                                            <th>Amount</th>
                                            <th>Status</th>


                                            <th></th>
                                            <th></th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    @if($project->payments)
                                        @foreach($project->payouts as $payout)
                                            @include('Project.partials._payouts_item', [
                                                'payout'    => $payout,
                                                'project'   => $project
                                            ])
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem12">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Questions</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>
                                                Description
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Created
                                            </th>
                                            <th>
                                                Created By
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($contacts as $contact) --}}
                                        <tr>
                                            <td>{{-- {{ $contact->name }} --}}</td>
                                            <td>{{-- {{ $contact->phone }} --}}</td>
                                            <td>{{-- {{ $contact->email }} --}}</td>
                                            <td>{{-- {{ $contact->address }} --}}</td>
                                            <td>{{-- {{ $contact->address }} --}}</td>
                                            <td></td>

                                        </tr>
                                        {{-- @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>

            </div>
        </div>
    </div><!-- .card-preview -->
</div>

{{-- @php
    $first_name = $last_name = null;
    $full_name = $reads->getUser->name;
    $name = explode(' ', $full_name);
    if (isset($name[0])){
        $first_name = $name[0];
    }
    if (isset($name[1])){
        $last_name = $name[1];
    }

    $state = $address =$street_address = $city =$zip = null;
    $full_address = $reads->getRequest->contacts['address'];
    $add = explode(',', $full_address);
    if (isset($add[0])){
        $address = $add[0];
    }
    if (isset($add[1])){
        $street_address = $add[1];
    }
    if (isset($add[2])){
        $state = $add[2];
    }
    if (isset($add[3])){
        $city = $add[3];
    }
    if (isset($add[4])){
        $zip = $add[4];
        $zip = str_replace(".", "", $zip);
    }

@endphp --}}
<div class="modal fade" tabindex="-1" id="composeEmail">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Attachment Link</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <p>This will send an email to the lead with a link to upload the necessary attachments</p>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                </div>
                </form>

            </div>

        </div>
    </div>
</div>
<div class="extra">
<upload-form route="{{ route('attachments.store_json') }}"
             :user-id="{{ Auth::id() }}"
             :project-id="{{ $project->id }}"
             :with-type="false"
></upload-form>
</div>
@push('modals')
{{--    @include('Project.modals.add_attachment')--}}
    @include('Project.modals.edit_project')
    @include('Project.modals.add_payment')
    @include('Project.modals.add_payout')
    @include('Project.modals.add_note')
    @include('Project.modals.add_task')
    @include('Project.modals.generate_document')
@endpush

@endsection
@push('js')
    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/payment/make_paid_status.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

    @include('attachments.templates.upload-form-template')
    <script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/attachments/upload-form-modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/request/line-items.js') }}"></script>
@endpush
