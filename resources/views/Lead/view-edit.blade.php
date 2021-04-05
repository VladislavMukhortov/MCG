@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
Leads

@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item fs-17px"><a href="{{ route('leads.index') }}">Leads</a></li>
                    <li class="breadcrumb-item active fs-17px">View Leads Details</li>
                </ul>
            </nav>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
{{--                    <ul class="nk-block-tools g-3">--}}
{{--                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newLead"><em class="icon ni ni-user-add-fill"></em><span>New Lead</span></a></li>--}}
{{--                    </ul>--}}
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addContact"><em class="icon ni ni-user-add-fill"></em><span>+ Contact</span></a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div>
</div>
<div class="nk-block-head nk-block-head-sm ml-2">
    @if(session()->has('email-success'))
        <div class="alert alert-success">
            {{ session()->get('email-success') }}
        </div>
    @endif
    <div class="nk-block-between">

        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newRequest"><em class="icon ni ni-plus-sm"></em><span>New Request</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalEstimate"><em class="icon ni ni-coin-alt-fill"></em><span>New Estimate</span></a></li>
                        {{-- <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newContact"><em class="icon ni ni-user-add-fill"></em><span>New Contact</span></a></li> --}}
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newNote"><em class="icon ni ni-edit"></em><span>New Note</span></a></li>
{{--                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newAttachment"><em class="icon ni ni-upload-cloud"></em><span>New Attachment</span></a></li>--}}
                        <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-primary upload-attachment" data-toggle="modal" data-target="#newAttachment"><em class="icon ni ni-upload-cloud"></em><span>New Attachment</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newTask"><em class="icon ni ni-list-round"></em><span>New Task</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#composeEmail"><em class="icon ni ni-mail"></em><span>Compose Email</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#leadLinkEmail"><em class="icon ni ni-mail"></em><span>Send new form request</span></a></li>


                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="col-xxl-6 mb-2">
    <div class="progress progress-lg">
        @php
            $status = [1 => 'New', 2 => 'Attachments Received', 3 => 'Pre-Estimate Sent', 4 => 'Walk-Thru Scheduled', 5 => 'Final Estimate Sent', 6 => 'Closed Lost', 7 => 'Closed Won'];
        @endphp

        @foreach ($status as $key => $statusGet)
             <div class="progress-bar bg-{{ $key > $reads->status ? 'warning':'success'  }} font-weight-bold" data-progress="15">{{ $statusGet }}</div>
             @if ($key != 7)
                <em class="icon ni ni-caret-right-fill" style="font-size: 18px;"></em>
             @endif
        @endforeach
    </div>
</div>
<div class="col-xxl-6">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-info"></em> Details</h6>

                </div>
                <div class="card-tools">
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalLarge"><em class="icon ni ni-edit"></em><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em></a>

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
                                        <span class="profile-ud-label">Primary Contact</span>
                                        <span class="profile-ud-value">{{ $reads->name . ' ' . $reads->last_name}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Email</span>
                                        <span class="profile-ud-value">{{ $reads->email}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Phone</span>
                                        <span class="profile-ud-value">{{ $reads->phone }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Date of Initial Contact</span>
                                        <span class="profile-ud-value">
                                            {{ date('m/d/Y', strtotime($reads->date_of_initial_contact)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Title
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->title}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Lead Referral Source
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->lead_referral_source}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Industry
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->industry}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Address
                                        </span>
                                        <span class="profile-ud-value">
                                            {{ $fullAddress }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Company
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->company}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Status
                                        </span>
                                        <span class="profile-ud-value">
                                            @if($reads->status == 1)
                                                New
                                            @elseif($reads->status == 2)
                                                Attachments Received
                                            @elseif($reads->status == 3)
                                                Pre-Estimate Sent
                                            @elseif($reads->status == 4)
                                                Walk-Thru Scheduled
                                            @elseif($reads->status == 5)
                                                Final Estimate Sent
                                            @elseif($reads->status == 6)
                                                Closed Lost
                                            @elseif($reads->status == 7)
                                                Closed Won
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Project Type
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->project_type}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Project Description
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->project_description}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created By
                                        </span>
                                        <span class="profile-ud-value">
                                            {{ optional($reads->getCreatedby)->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created
                                        </span>
                                        <span class="profile-ud-value">
                                            {{ date('m/d/Y h:i A', strtotime($reads->created)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Rating
                                        </span>
                                        <span class="profile-ud-value">
                                            {{-- {{$reads->attachment_link_sent}} --}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Request #
                                        </span>
                                        <span class="profile-ud-value">
                                            {{ optional($reads->getRequest)->id }}
                                         </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Budget
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->budget}}

                                         </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Request Information
                                        </span>
                                        <span class="profile-ud-value">
                                             {{ optional($reads->getRequest)->request_information }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Current Estimate
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->current_estimate}}
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
<div class="col-xxl-6">

<div class="card card-bordered card-preview mt-5">
    <div class="card-inner">
        <ul class="nav nav-tabs mt-n3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabItem1"><em class="icon ni ni-coin-alt-fill"></em><span>Estimate</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem2"><em class="icon ni ni-coin-alt-fill"></em><span>Contacts</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem3"><em class="icon ni ni-edit"></em><span>Notes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem4"><em class="icon ni ni-upload-cloud"></em><span>Attachments</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-align-center"></em><span>Activities</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-check-thick"></em><span>Tasks</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-question"></em><span>Questions</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem8"><em class="icon ni ni-mail"></em><span>Emails</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem9"><em class="icon ni ni-inbox-fill"></em><span>Requests</span></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabItem1">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">Estimates</h5>
                            </div>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Created By</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Date Sent</th>
                                        <th>View / Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estimatelist as $list)
                                    <tr>
                                        <td>{{ date('m/d/Y h:i A', strtotime($list->created_at)) }}</td>
                                        <td>{{ $list->getCreatedby->name }}</td>
                                        <td>
                                            @if($list->type == 1)
                                                Pre-Estimate
                                            @elseif($list->type == 2)
                                                Final Estimate
                                            @endif
                                        </td>
                                        <td>
                                            @if($list->status == 1)
                                                Draft
                                            @elseif($list->status == 2)
                                                Sent
                                            @elseif($list->status == 3)
                                                Viewed
                                            @elseif($list->status == 4)
                                                Rejected
                                            @elseif($list->status == 5)
                                                Approved
                                            @elseif($list->status == 6)
                                                Project
                                            @endif
                                        </td>
                                        <td>{{ $list->date_sent }}</td>
                                        <td>
                                            <a href="{{ route('estimate-reps.show', $list->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('estimate-reps.destroy', $list->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                            <form action="{{ route('estimate-reps.destroy', $list->id) }}" method="post" class="d-none" id="delete_{{$list->id}}">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

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
                                <h5 class="card-title">Contacts</h5>
                            </div>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contactlist as $list)
                                    <tr>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->phone }}</td>
                                        <td>{{ $list->email }}</td>
                                        <td>{{ $list->address }}</td>
                                        <td>
                                            <a href="{{ route('remove-from-lead', $list->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                            <form action="{{ route('remove-from-lead', $list->id) }}" method="post" class="d-none" id="delete_{{$list->id}}">
                                                <input name="contact_id" value="{{ $list->id }}">
                                                <input name="lead_id" value="{{ $reads->id }}">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

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
                                <h5 class="card-title">Notes</h5>
                            </div>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($reads->leadsNote)
                                        @foreach($reads->leadsNote as $list)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($list->notes->created_at)->format('Y-m-d') }}</td>

                                            <td>{{ $list->notes->notes }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
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
                                    @if($attachmentlist)
                                       @foreach($attachmentlist as $attach)
                                        <tr>
                                            <td>{{ $attach->attachment_description }}</td>
                                            <td>
                                                @if($attach->file)
                                                    <a href="{{ $attach->file }}" download="">File</a>
                                            </td>
                                                @endif
                                            <td>{{ Carbon\Carbon::parse($attach->created_at)->format('Y-m-d')}}</td>

                                        </tr>
                                    @endforeach
                                    @endif

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
                                <h5 class="card-title">Activities</h5>
                            </div>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>User</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($reads->leadActivities)
                                        @foreach($reads->leadActivities as $activity)
                                        <tr>
                                            <td>{{ date('m/d/Y h:i A', strtotime($activity->activities->created_at)) }}</td>
                                            <td>@if($activity->activities->getuser){{ $activity->activities->getuser['name'] }}@endif</td>
                                            <td>@if($activity->activities){{ $activity->activities->description }}@endif</td>
                                        </tr>
                                        @endforeach
                                   @endif

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
                                <h5 class="card-title">Tasks</h5>
                            </div>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>Created</th>
                                        <th>Created By</th>
                                        <th>Name</th>
                                         <th>Status</th>
                                        <th>Due Date</th>
                                        <th>View / Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lead_task as $list)
                                    <tr>
                                        <td>{{ Carbon\Carbon::parse($list->created_at)->format('m/d/Y h:i A')}}</td>
                                        <td>{{ $list->getcreatedby->name }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>
                                            @if($list->status == 1)
                                                New
                                            @elseif($list->status == 2)
                                                In Progress
                                            @elseif($list->status == 3)
                                                Closed
                                            @endif
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($list->due_date)->format('m/d/Y h:i A')}}</td>
                                        <td>
                                            <a href="{{ route('task.show', $list->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a>
                                        </td>
                                    </tr>
                                    @endforeach

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
            <div class="tab-pane" id="tabItem8">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">Emails</h5>
                            </div>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Subject</th>
                                        <th>Snippet</th>
                                        <th>From</th>
                                        <th>To</th>
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

                                    </tr>
                                    {{-- @endforeach --}}

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
                                <h5 class="card-title">Requests</h5>
                            </div>
                            <table class="datatable-init table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Created</th>
                                    <th>Created By</th>
                                    <th>Request Information</th>
                                    <th class="text-muted">View / Edit</th>
                                    <th class="text-muted">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($requestlist as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ date('m/d/Y h:i A', strtotime($list->created)) }}</td>
                                        <td>{{ $list->user->name }}</td>
                                        <td>{{ $list->request_information }}</td>
                                        <td><a href="{{ route('requests.show', $list->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                                        <td>
                                            <a href="{{ route('requests.destroy', $list->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                            <form action="{{ route('requests.destroy', $list->id) }}" method="post" class="d-none" id="delete_{{$list->id}}">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

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

{{--@php--}}
{{--    $first_name = $last_name = null;--}}

{{--    $full_name = optional($reads->getUser)->name;--}}
{{--    $name = explode(' ', $full_name);--}}
{{--    if (isset($name[0])){--}}
{{--        $first_name = $name[0];--}}
{{--    }--}}
{{--    if (isset($name[1])){--}}
{{--        $last_name = $name[1];--}}
{{--    }--}}

{{--    $state = $address =$street_address = $city =$zip = null;--}}
{{--    $full_address = optional($reads->getRequest)->contacts['address'];--}}
{{--    $add = explode(',', $full_address);--}}
{{--    if(strlen($add[0]) > 2){--}}
{{--        if (isset($add[0])){--}}
{{--            $address = $add[0];--}}
{{--        }--}}
{{--        if (isset($add[1])){--}}
{{--            $street_address = $add[1];--}}
{{--        }--}}
{{--        if (isset($add[2])){--}}
{{--            $state = $add[2];--}}
{{--        }--}}
{{--        if (isset($add[3])){--}}
{{--            $city = $add[3];--}}
{{--        }--}}
{{--        if (isset($add[4])){--}}
{{--            $zip = $add[4];--}}
{{--            $zip = str_replace(".", "", $zip);--}}
{{--        }--}}
{{--    }--}}

{{--@endphp--}}



<div class="modal fade" tabindex="-1" id="modalEstimate">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Estimate</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estimate-reps.store') }}" method="post" class="form-validate">
                    @csrf
                    <input type="hidden" name="lead_id" value="{{ $reads->id }}">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Type<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-control form-select" name="type" data-placeholder="Select a option" required>
                                            <option label="empty" value=""></option>
                                            <option value="1">Pre-Estimate</option>
                                            <option value="2">Final Estimate</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Job Name<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-control form-select" name="job_name" data-placeholder="Select a option" required>
                                            <option label="empty" value=""></option>
                                            <option value="1">Interior Project - Apartment</option>
                                            <option value="2">Interior Project - House</option>
                                            <option value="3">Interior Project - Commercial</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                </form>

            </div>

        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalLarge">
    <div class="modal-dialog modal-lg modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Lead</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>

            <div class="modal-body">
                @if ($errors->lead->all())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->lead->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('leads.update',$reads->id) }}" method="post"  id="leadForm">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Primary Contact<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="first" placeholder="First" id="first-lead" value="{{ $reads->name }}">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label mt-3" for="name"></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="last" placeholder="Last" id="last-lead" value="{{ $reads->last_name }}">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="email-lead" name="email" placeholder="Email" required value="{{ $reads->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Phone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="phone" id="phone-lead" value="{{ old('phone') ?? $reads->phone  }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="address-lead" placeholder="Enter a location" name="address" value="@if($reads->address){{ $reads->address->address }}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Street Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="street-address-lead" placeholder="Enter a street address" name="street" value="@if($reads->address){{  $reads->address->street  }}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="state-lead">State<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select name="state" id="state-lead" class="form-control">
                                        @foreach ($states as $key => $value)
                                            <option name="state" value="@if($reads->address){{ $value }}@endif"
                                                    @if($reads->address)
                                                        @if ( $reads->address->state == $value)
                                                            selected
                                                        @endif
                                                    @endif
                                            >{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">City</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="city-lead" placeholder="Enter a city" name="city" value="@if($reads->address){{  $reads->address->city }}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="zip">Zip</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="zip-lead" placeholder="Enter a zip" name="zip" value="@if($reads->address){{  $reads->address->zip }}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Company</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="company" placeholder="Company" value="{{ old('company') ?? $reads->company }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Project Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder="Project Description" name="project_description">{{ old('project_description') ?? $reads->project_description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Title</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') ?? $reads->title }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Lead Referral Source</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="lead_referral_source" placeholder="Lead Referral Source" value="{{ old('lead_referral_source') ?? $reads->lead_referral_source }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Date of Initial Contact</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-calendar-alt"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="date_of_initial_contact" placeholder="mm/dd/yyyy" value="{{ old('date_of_initial_contact') ?? date('m/d/Y', strtotime($reads->date_of_initial_contact)) }}">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Industry</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="industry" placeholder="Industry" value="{{ old('industry') ?? $reads->industry }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" name="status">
                                        <option value="1" {{ $reads->status == 1 ? 'selected':'' }}>New</option>
                                        <option value="2" {{ $reads->status == 2 ? 'selected':'' }}>Attachments Received</option>
                                        <option value="3" {{ $reads->status == 3 ? 'selected':'' }}>Pre-Estimate Sent</option>
                                        <option value="4" {{ $reads->status == 4 ? 'selected':'' }}>Walk-Thru Scheduled</option>
                                        <option value="5" {{ $reads->status == 5 ? 'selected':'' }}>Final Estimate Sent</option>
                                        <option value="6" {{ $reads->status == 6 ? 'selected':'' }}>Closed Lost</option>
                                        <option value="7" {{ $reads->status == 7 ? 'selected':'' }}>Closed Won</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Rating</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="rating" placeholder="Rating" value="{{ old('rating') ?? $reads->rating }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="default-03">Budget</label>
                                <div class="form-control-wrap">
                                    <div class="form-text-hint">
                                        <span class="overline-title">Usd</span>
                                    </div>
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-coin-alt-fill"></em>
                                    </div>
                                    <input type="text" class="form-control" id="default-03" placeholder="0.00" name="budget" value="{{ old('budget') ?? $reads->budget }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Project Type</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="project_type" placeholder="Project Type" value="{{ old('project_type') ?? $reads->project_type }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="default-03">Current Estimate</label>
                                <div class="form-control-wrap">
                                    <div class="form-text-hint">
                                        <span class="overline-title">Usd</span>
                                    </div>
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-coin-alt-fill"></em>
                                    </div>
                                    <input type="text" class="form-control" id="current_estimate" placeholder="0.00" name="current_estimate" value="{{ old('current_estimate') ?? $reads->current_estimate }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--<div class="modal fade" tabindex="-1" id="newAttachment">--}}
{{--    <div class="modal-dialog modal-dialog-top" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">New Attachment</h5>--}}
{{--                <a href="#" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <em class="icon ni ni-cross"></em>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <form action="{{ route('attachments.store') }}" method="post" class="form-validate" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="lead" value="{{ $reads->id }}">--}}
{{--                     <div class="row g-4">--}}

{{--                        <div class="col-lg-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="email-address">Attachment Description</label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"  name="attachment_description"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="default-06">File</label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input type="file" multiple class="custom-file-input" id="customFile" name="file">--}}
{{--                                        <label class="custom-file-label" for="customFile">Choose file</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                </div>--}}
{{--                </form>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="modal fade" tabindex="-1" id="newTask">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Task</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('task.store') }}" method="post" class="form-validate">
                    @csrf
                    <input type="hidden" name="lead" value="{{ $reads->id }}">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-full-name">Name<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="name" id="fv-full-name" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Parent Task</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on" name="parent_task">
                                            <option selected disabled>Type to search</option>
                                            @foreach($all_task as $id => $contactname)
                                            <option value="{{ $contactname->id }}">{{ $contactname->id }} ({{ $contactname->name }})</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Due Date</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-calendar-alt"></em>
                                        </div>
                                        <input type="text" class="form-control date-picker" name="date" placeholder="mm/dd/yyyy">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Due Time</label>
                                    <div class="form-control-wrap">
                                        <input type="time" class="form-control" placeholder="Input placeholder" name="time">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="cf-default-textarea">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder=" " name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>


<div class="modal fade" tabindex="-1" id="newNote">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Note</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('note.store') }}" method="post" class="form-validate">
                    @csrf
                    <input type="hidden" name="lead" value="{{ $reads->id }}">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Notes<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"  name="notes" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                </div>
                </form>

            </div>

        </div>
    </div>
</div>

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
                @if ($errors->email->all())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->email->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('leads.compose-email',$reads->id) }}" method="post" id="composeForm">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <p>This will send an email to the lead with a link to upload the necessary attachments</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Subject</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="subject" placeholder="Company" value="{{  old('subject-email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Message</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder="Project Description" name="body">{{ old('body-email') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="formName" value="composeemail">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                </div>
                </form>

            </div>

        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="addContact">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">+ Contact</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('add-to-lead') }}" method="post" id="addContactForm">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="col-12">
                                    <div class="form-control-wrap">
                                        <input hidden name="lead_id" value="{{ $reads->id }}">
                                        <div>
                                            <label class="form-label" for="state">Contacts<span style="color: #ff0000"> *</span></label>
                                            <select class="form-control" id="add-contact" name="contact_id">
                                                <option disabled selected value="no"> -- select contact -- </option>
                                                    @foreach($contacts as $contact)
                                                        <option value="{{ $contact->id }}">
                                                            {{ $contact->name }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--<div class="modal fade" tabindex="-1" id="newLead">--}}
{{--    <div class="modal-dialog modal-dialog-top" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">New Lead</h5>--}}
{{--                <a href="#" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <em class="icon ni ni-cross"></em>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}

{{--                <form action="{{ route('leads.store') }}" method="post" id="leadForm">--}}
{{--                    @csrf--}}
{{--                    <div class="row g-4">--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="name">Name<span style="color: #ff0000"> *</span></label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" name="first" placeholder="First" id="first-lead">--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label mt-3" for="name"></label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" name="last" placeholder="Last" id="last-lead">--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="email">Email<span style="color: red"> *</span></label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="email" class="form-control"  id="email-lead" placeholder="abc@gmail.com" name="email">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="phone">Phone<span style="color: #ff0000"> *</span></label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" id="phone-lead" placeholder="Enter a phone" name="phone">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="address">Address</label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" id="address-lead" placeholder="Enter a location" name="address">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="street-address">Street Address</label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" id="street-address-lead" placeholder="Enter a street address" name="street_address">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="state">State<span style="color: #ff0000"> *</span></label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <select class="form-control" id="state" name="state-lead">--}}
{{--                                        @foreach($states as $state)--}}
{{--                                            <option value="{{ $state }}">--}}
{{--                                                {{ $state }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    --}}{{--                                        <input type="text" class="form-control" id="state" placeholder="Enter a state" name="state">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="city">City</label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" id="city-lead" placeholder="Enter a city" name="city">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="zip">Zip</label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" id="zip-lead" placeholder="Enter a zip" name="zip">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}

{{-- Request Modal --}}

<div class="modal fade" tabindex="-1" id="newRequest">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Request</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('requests.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="lead" value="{{ $reads->id }}">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Created Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-calendar-alt"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="date" placeholder="mm/dd/yyyy">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Created Time</label>
                                <div class="form-control-wrap">
                                    <input type="time" class="form-control" placeholder="Input placeholder" name="time">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="cf-default-textarea">Request Information</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder=" " name="request_information"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="leadLinkEmail">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send New Link to Lead</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('lead-form-create') }}" method="post">
                    @csrf
                    <input type="hidden" name="lead-id" value="{{ $reads->id }}">
                    <input type="hidden" name="user-id" value="{{ $lead->id }}">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <p>This will send an email to the lead with link to unique prefill request form.</p>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
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
                 :lead-id="{{ $reads->id }}"
                 :with-type="false"
    ></upload-form>
</div>
@endsection

@section('page-js')

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
@include('attachments.templates.upload-form-template')

<script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/attachments/upload-form-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/request/line-items.js') }}"></script>
{{--    <script src="{{ URL::asset('js/app.js') }}"></script>--}}
<script src="{{ URL::asset('js/leads/lead-temp-validate.js') }}"></script>
<script>
    $(document).on('submit', "#addContactForm", function (e) {
        let select = $("#add-contact");
        let error = $(".error");
        let message = "Select contact";

        if (select.val() === null) {
            e.preventDefault();
            error.remove();
            select.parent().append("<span class='help-block error'>" + message + "</span>");
        } else {
            error.remove();
        }
    });

</script>
<script type="text/javascript">
//     $().ready(function() {
//     $("#leadForm").validate({
//         rules: {
//             first: "required",
//             last: "required",
//             name: "required",
//             // user_role_id: {
//             //     required: true
//             // },
//             email: {
//                 required: true,
//                 email: true
//             },
//
//
//         },
//         messages: {
//             first: "Please enter your name",
//             last: "Please enter your name",
//             name: "Please enter your name",
//             // user_role_id: {
//             //    required: "Please provide a role." ,
//             // },
//
//             email:{
//                required: "Please provide a email." ,
//                email: "Please enter a valid email address."
//             },
//
//
//         }
//     });
//
// });
</script>
        @if ($errors->lead->any())
        <script>
        $( document ).ready(function() {
            $('#modalLarge').modal('show');
        });
        </script>
        @endif
        @if ($errors->email->any())
        <script>
            $( document ).ready(function() {
                $('#composeEmail').modal('show');
            });
    </script>
            <script>

                    //2. Получить элемент, к которому необходимо добавить маску
                    $("#phone").mask("8(999) 999-9999");
            </script>

    @endif

@endsection
