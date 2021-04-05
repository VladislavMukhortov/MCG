@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Requests

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
                    <li class="breadcrumb-item fs-17px"><a href="{{ route('requests.index', $reads->lead) }}">Requests</a></li>
                    <li class="breadcrumb-item active fs-17px">View Requests Details</li>
                </ul>
            </nav>    
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
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newNote"><em class="icon ni ni-edit"></em><span>New Note</span></a></li>
{{--                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newAttachment"><em class="icon ni ni-upload-cloud"></em><span>New Attachment</span></a></li>--}}
{{--                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newLead"><em class="icon ni ni-check-thick"></em><span>Convert to Lead</span></a></li>--}}
                        <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-primary upload-attachment" data-toggle="modal" data-target="#newAttachment"><em class="icon ni ni-upload-cloud"></em><span>New Attachment</span></a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="col-xxl-6 mb-2">
    <div class="progress progress-lg">
        @php
            $status = [1 => 'New', 2 => 'No Answer', 3 => 'Spoke', 4 => 'Unqualified', 5 => 'Qualified'];
        @endphp

        @foreach ($status as $key => $statusGet)
             <div class="progress-bar bg-{{ $key > $reads->status ? 'warning':'success'  }} font-weight-bold" data-progress="20">{{ $statusGet }}</div>
             @if ($key != 5)
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
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em></a>
                         
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <div class="card-inner">
                        <div class="card-title-group align-start gx-3 mb-3">
                            <div class="card-title" style="margin-top:15px;">
                                <h6 class="title"><em class="icon ni ni-info"></em> Info</h6>
                                 
                            </div>
                        </div>
                        <div class="nk-block">
                            <div class="profile-ud-list">
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">#</span>
                                        <span class="profile-ud-value">{{$reads->id}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created</span>
                                        <span class="profile-ud-value">{{ date('m/d/Y h:i A', strtotime($reads->created)) }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created By</span>
                                        <span class="profile-ud-value">{{$reads->user->name}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Request Information</span>
                                        <span class="profile-ud-value">
                                            {{$reads->request_information}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Attachment Link Sent
                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->attachment_link_sent}}
                                        </span>
                                    </div>
                                </div>


                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Building type
                                        </span>
                                        <span class="profile-ud-value">
                                            {{ $type[$reads->type] }}

                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Building stage
                                        </span>
                                        <span class="profile-ud-value">
                                            {{ $stage[$reads->stage] }}
                                        </span>
                                    </div>
                                </div>                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Project start date
                                        </span>
                                        <span class="profile-ud-value">
                                            {{ $startDate[$reads->startdate] }}
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
                                                No Answer
                                            @elseif($reads->status == 3)
                                                Spoke
                                            @elseif($reads->status == 4)
                                                Unqualified
                                            @elseif($reads->status == 5)
                                                Qualified
                                            @elseif($reads->status == 6)
                                                Attachments Uploaded
                                            @elseif($reads->status == 7)
                                                Lead
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div><!-- .profile-ud-list -->
                        </div><!-- .nk-block -->
                    </div>
                    {{-- <div class="col-md-12"> --}}
                    <div class="card-inner">
                        <div class="card-title-group align-start gx-3 mb-3">
                            <div class="card-title" style="margin-top:15px;">
                                <h6 class="title"><em class="icon ni ni-users-fill"></em> Lead</h6>
                                 
                            </div>
                        </div>
                        <div class="nk-block">
                            <div class="profile-ud-list">
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Name</span>
                                        <span class="profile-ud-value">
                                            @isset($lead->name){{ $lead->name }}@endisset
                                            @isset($lead->last_name){{ $lead->last_name }}@endisset
                                        </span>
                                    </div>
                                </div> 
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Phone</span>
                                        <span class="profile-ud-value">
                                            @isset($lead->phone){{ $lead->phone }}@endisset
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Email</span>
                                        <span class="profile-ud-value">
                                            @isset($lead->email){{ $lead->email }}@endisset
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Address</span>
                                        <span class="profile-ud-value">
                                            @isset($lead->address){{ $lead->address['address']}}{{ $lead->address['street']}}{{ $lead->address['state']}}{{$lead->address['city']}}{{$lead->address['zip'] }}@endisset
                                        </span>
                                    </div>
                                </div>   
                            </div><!-- .profile-ud-list -->
                        </div>
                    </div><!-- .nk-block -->
                </div>
            </div>      
        </div>
    </div>
</div>
<div class="col-xxl-12 mt-5">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-edit"></em><span>Notes</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-upload-cloud"></em><span>Attachments</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-align-center"></em><span>Activities</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem8"><em class="icon ni ni-home-fill"></em><span>Floor Plan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem9"><em class="icon ni ni-home-fill"></em><span>Rooms</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem5">
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
                                        @if($reads->requestsNote)
                                            @foreach($reads->requestsNote as $list)
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
                <div class="tab-pane" id="tabItem6">
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
                                            {{-- <th>Delete</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($attachmentlist)
                                            @foreach($attachmentlist as $attach)
                                                <tr>
                                                    <td>{{ $attach->attachment_description }}</td>
                                                    <td>
                                                        @if($attach->file)
                                                            <a href="{{ URL::to($attach->file) }}" download="">File</a></td>
                                                        @endif
                                                    </td>
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
                
                <div class="tab-pane" id="tabItem7">
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
                                        @if($reads->requestActivities)
                                            @foreach($reads->requestActivities as $activity)
                                            <tr>
                                                <td>{{ date('m/d/Y h:i A', strtotime($activity->activities->created_at)) }}</td>
                                                <td>{{ $activity->activities->getuser['name'] }}</td>
                                                <td>{{ $activity->activities->description }}</td>
                                            </tr>
                                            @endforeach
                                       @endif
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
                                    <h5 class="card-title">Floor Plan</h5>
                                </div>
                                @if($attachmentlist)
                                    @foreach($attachmentlist as $attach)
                                         @if($attach['status'] == 2)
                                        <tr>
                                            <td>{{ $attach->attachment_description }}</td>
                                            <td>
                                                @if($attach->file)
                                                    <img src="{{ URL::to($attach->file) }}">
                                            @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>




                <div class="tab-pane" id="tabItem9">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Rooms</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                    <tr>
                                        <th>Room type</th>
                                        <th>Ceiling</th>
                                        <th>Walls</th>
                                        <th>Wall partition</th>
                                        <th>Floor</th>
                                        <th>Baseboard</th>
                                        <th>Crown molding</th>
                                        <th>Interior door</th>
                                        <th>Closest door</th>
                                        <th>Closest organization</th>
                                        <th>Window</th>
                                        <th>Lightfixture</th>
                                        <th>Room size</th>
                                        <th>Room info</th>
                                        <th>External photos</th>
                                        <th>Edit</th>
                                        {{-- <th>Delete</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($rooms)
                                        @foreach($rooms as $room)
                                            <tr>
                                                <td>{{ $roomType[$room->stageroom] }}</td>
                                                <td>{{ $roomWorkType[$room->ceiling] }}</td>
                                                <td>{{ $roomWorkType[$room->walls] }}</td>
                                                <td>{{ $roomWorkType[$room->wallpartition] }}</td>
                                                <td>{{ $roomWorkType[$room->floor] }}</td>
                                                <td>{{ $roomWorkType[$room->baseboard] }}</td>
                                                <td>{{ $roomWorkType[$room->crownmolding] }}</td>
                                                <td>{{ $roomWorkType[$room->interiordoor] }}</td>
                                                <td>{{ $roomWorkType[$room->closestdoor] }}</td>
                                                <td>{{ $roomWorkType[$room->closestorganization] }}</td>
                                                <td>{{ $roomWorkType[$room->window] }}</td>
                                                <td>{{ $roomWorkType[$room->lightfixture] }}</td>
                                                <td>{{ $room->roomsize }}</td>
                                                <td>{{ $room->roominfo }}</td>
                                                <td>{{ $room->roominspirationexternal }}</td>
                                                <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Room{{ $room->id }}">Edit</a></td>

                                            </tr>
                                        @endforeach
                                    @endif
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
 

{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Request</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-validate">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Contact<span style="color: red"> *</span></label>--}}
{{--                                <div class="form-control-wrap">--}}
{{--                                    <select class="form-select form-control form-control-lg" data-search="on" name="contact" required>--}}
{{--                                        <option selected disabled>Type to search</option>--}}
{{--                                        @foreach($contactslist as $id => $contatname)--}}
{{--                                        <option value="{{ $contatname->id }}" @if($contatname->id==$reads->contact) selected='selected' @endif>--}}
{{--                                        {{ $contatname->display_name }}</option>--}}

{{--                                        @endforeach--}}
{{--                                         --}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    {{-- </div> --}}
                    {{-- <div class="row g-4"> --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="status">
                                        <option value="1" {{ $reads->status == 1 ? 'selected':'' }}>New</option>
                                        <option value="2" {{ $reads->status == 2 ? 'selected':'' }}>No Answer</option>
                                        <option value="3" {{ $reads->status == 3 ? 'selected':'' }}>Spoke</option>
                                        <option value="4" {{ $reads->status == 4 ? 'selected':'' }}>Unqualified</option>
                                        <option value="5" {{ $reads->status == 5 ? 'selected':'' }}>Qualified</option>
{{--                                        <option value="6" {{ $reads->status == 6 ? 'selected':'' }}>Attachments Uploaded</option>--}}
{{--                                        <option value="7" {{ $reads->status == 7 ? 'selected':'' }}>Lead</option>--}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Created Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-calendar-alt"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="date" placeholder="mm/dd/yyyy" value="{{ date('m/d/Y', strtotime($reads->created)) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Created Time</label>
                                <div class="form-control-wrap">
                                    <input type="time" class="form-control" placeholder="Input placeholder" name="time" value="{{ date('H:i:s', strtotime($reads->created)) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="cf-default-textarea">Request Information</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder=" " name="request_information">{{ $reads->request_information }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
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
                    <input type="hidden" name="request" value="{{ $reads->id }}">

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
@if($rooms)
    @foreach($rooms as $room)
<div class="modal fade" tabindex="-1" id="Room{{ $room->id }}">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit room</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-validate">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="card-inner">
                                        <div class="field">
                                            <div class="form-group">
                                                <label class="form-label">Room {{ $roomType[$room->stageroom] }}</label>
                                                <div class="form-control-wrap">
                                                        <input hidden name="id" value="{{ $room->id }}">
                                                    <table>
                                                        <tr>
                                                            <th></th>
                                                            <th>Do nothing</th>
                                                            <th>Refinish/Refresh</th>
                                                            <th>Replace</th>
                                                            <th>Remove existing</th>
                                                            <th>Install/Add new</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Ceiling</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5"  v-validate="required" name="ceiling"  v-slot="{ errors, failed }">
                                                                <td><input value="1" id="ceiling" type="radio" v-model="ceiling" name="ceiling" {{ ($room->ceiling=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" id="ceiling" type="radio" v-model="ceiling" name="ceiling" {{ ($room->ceiling=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" id="ceiling" type="radio" v-model="ceiling" name="ceiling" {{ ($room->ceiling=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" id="ceiling" type="radio" v-model="ceiling" name="ceiling" {{ ($room->ceiling=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" id="ceiling" type="radio" v-model="ceiling" name="ceiling" {{ ($room->ceiling=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Walls</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="walls" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" v-model="walls" name="walls" {{ ($room->walls=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" v-model="walls" name="walls" {{ ($room->walls=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" v-model="walls" name="walls" {{ ($room->walls=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" v-model="walls" name="walls" {{ ($room->walls=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" v-model="walls" name="walls" {{ ($room->walls=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Wall partition</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="wallpartition" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" v-model="wallpartition" name="wallpartition" {{ ($room->wallpartition=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" v-model="wallpartition" name="wallpartition" {{ ($room->wallpartition=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" v-model="wallpartition" name="wallpartition" {{ ($room->wallpartition=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" v-model="wallpartition" name="wallpartition" {{ ($room->wallpartition=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" v-model="wallpartition" name="wallpartition" {{ ($room->wallpartition=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Floor</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="floor" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" v-model="floor" name="floor" {{ ($room->floor=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" v-model="floor" name="floor" {{ ($room->floor=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" v-model="floor" name="floor" {{ ($room->floor=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" v-model="floor" name="floor" {{ ($room->floor=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" v-model="floor" name="floor" {{ ($room->floor=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Baseboard</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="baseboard" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" v-model="baseboard" name="baseboard" {{ ($room->baseboard=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" v-model="baseboard" name="baseboard" {{ ($room->baseboard=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" v-model="baseboard" name="baseboard" {{ ($room->baseboard=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" v-model="baseboard" name="baseboard" {{ ($room->baseboard=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" v-model="baseboard" name="baseboard" {{ ($room->baseboard=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Crown molding</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="crownmolding" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" v-model="crownmolding" name="crownmolding" {{ ($room->crownmolding=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" v-model="crownmolding" name="crownmolding" {{ ($room->crownmolding=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" v-model="crownmolding" name="crownmolding" {{ ($room->crownmolding=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" v-model="crownmolding" name="crownmolding" {{ ($room->crownmolding=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" v-model="crownmolding" name="crownmolding" {{ ($room->crownmolding=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Interior Door</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="interiordoor" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" v-model="interiordoor" name="interiordoor" {{ ($room->interiordoor=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" v-model="interiordoor" name="interiordoor" {{ ($room->interiordoor=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" v-model="interiordoor" name="interiordoor" {{ ($room->interiordoor=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" v-model="interiordoor" name="interiordoor" {{ ($room->interiordoor=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" v-model="interiordoor" name="interiordoor" {{ ($room->interiordoor=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Closest door</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="closestdoor" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" name="closestdoor" {{ ($room->closestdoor=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" name="closestdoor" {{ ($room->closestdoor=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" name="closestdoor" {{ ($room->closestdoor=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" name="closestdoor" {{ ($room->closestdoor=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" name="closestdoor" {{ ($room->closestdoor=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Closest Organization</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="closestorganization" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" name="closestorganization" {{ ($room->closestorganization=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" name="closestorganization" {{ ($room->closestorganization=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" name="closestorganization" {{ ($room->closestorganization=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" name="closestorganization" {{ ($room->closestorganization=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" name="closestorganization" {{ ($room->closestorganization=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Window</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="window" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" name="window" {{ ($room->window=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" name="window" {{ ($room->window=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" name="window" {{ ($room->window=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" name="window" {{ ($room->window=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" name="window" {{ ($room->window=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                        <tr>
                                                            <td>Light fixture</td>
                                                            <validation-provider rules="oneOf:1,2,3,4,5" name="lightfixture" v-slot="{ errors, failed }">
                                                                <td><input value="1" type="radio" name="lightfixture" {{ ($room->lightfixture=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" name="lightfixture" {{ ($room->lightfixture=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" name="lightfixture" {{ ($room->lightfixture=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" name="lightfixture" {{ ($room->lightfixture=="4")? "checked" : "" }}></td>
                                                                <td><input value="5" type="radio" name="lightfixture" {{ ($room->lightfixture=="5")? "checked" : "" }}></td>
                                                            </validation-provider>
                                                        </tr>
                                                    </table>
                                                    @if($room->stageroom === 1 || $room->stageroom === 2)
                                                        <table>
                                                            <tr>

                                                                <th>Type</th>
                                                                <th>1</th>
                                                                <th>2</th>
                                                                <th>3</th>
                                                                <th>4</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Recessed Light</td>
                                                                <td><input value="1" type="radio" name="recessedlight" {{ ($room->recessedlight=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" name="recessedlight" {{ ($room->recessedlight=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" name="recessedlight" {{ ($room->recessedlight=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" name="recessedlight" {{ ($room->recessedlight=="4")? "checked" : "" }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Wall Fixture</td>
                                                                <td><input value="1" type="radio" name="wallfixture" {{ ($room->wallfixture=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" name="wallfixture" {{ ($room->wallfixture=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" name="wallfixture" {{ ($room->wallfixture=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" name="wallfixture" {{ ($room->wallfixture=="4")? "checked" : "" }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ceiling Fixture</td>
                                                                <td><input value="1" type="radio" name="ceilingfixture" {{ ($room->ceilingfixture=="1")? "checked" : "" }}></td>
                                                                <td><input value="2" type="radio" name="ceilingfixture" {{ ($room->ceilingfixture=="2")? "checked" : "" }}></td>
                                                                <td><input value="3" type="radio" name="ceilingfixture" {{ ($room->ceilingfixture=="3")? "checked" : "" }}></td>
                                                                <td><input value="4" type="radio" name="ceilingfixture" {{ ($room->ceilingfixture=="4")? "checked" : "" }}></td>
                                                            </tr>
                                                        </table>
                                                        @if($room->bathroomcurrent !== null)
                                                            <p>Bathroom works</p>
                                                            <p><bold>Current:</bold></p>

                                                                    <p><span>Bathhub</span><input value="1" type="radio" name="bathroomcurrent" {{ ($room->bathroomcurrent=="1")? "checked" : "" }}></p>
                                                                    <p><span>Walk-in Shower</span><input value="2" type="radio" name="bathroomcurrent" {{ ($room->bathroomcurrent=="2")? "checked" : "" }}></p>
                                                                    <p><span>Bathhub and Walk-in Shower</span><input value="3" type="radio" name="bathroomcurrent" {{ ($room->bathroomcurrent=="3")? "checked" : "" }}></p>
                                                            <p><bold>Requested:</bold></p>
                                                                    <p><span>New Bathub</span><input value="1" type="radio" name="bathroomreplace" {{ ($room->bathroomreplace=="1")? "checked" : "" }}></p>
                                                                    <p><span>New Walk-in Shower</span><input value="2" type="radio" name="bathroomreplace" {{ ($room->bathroomreplace=="2")? "checked" : "" }}></p>
                                                                    <p><span>Bathhub and Walk-in Shower</span><input value="3" type="radio" name="bathroomreplace" {{ ($room->bathroomreplace=="3")? "checked" : "" }}></p>
                                                                @endif

                                                        @endif



                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Room size<span style="color: red"></span></label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"  name="roomsize">{{ $room->roomsize  }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Room info<span style="color: red"></span></label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"  name="roominfo">{{ $room->roominfo }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Room external link<span style="color: red"></span></label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"  name="roominspirationexternal">{{ $room->roominspirationexternal }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
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
                </form>

            </div>

        </div>
    </div>
</div>
@endforeach
@endif
{{--<div class="modal fade" tabindex="-1" id="newLead">--}}
{{--    <div class="modal-dialog modal-dialog-top" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">Request To Lead</h5>--}}
{{--                <a href="#" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <em class="icon ni ni-cross"></em>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <form action="{{ route('leads.store',['id' => $reads->id]) }}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="row g-4">--}}
{{--                        <div class="col-lg-12">--}}
{{--                            <p>Are you sure you want to convert this request to a lead ?</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                </div>  --}}
{{--                </form> --}}
{{--                 --}}
{{--            </div>--}}
{{--             --}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

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
{{--                    <input type="hidden" name="request" value="{{ $reads->id }}">--}}
{{--                     <div class="row g-4">--}}
{{--                        --}}
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
{{--                            </div> --}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                </div>  --}}
{{--                </form> --}}
{{--                 --}}
{{--            </div>--}}
{{--             --}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

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
{{--                    <input type="hidden" name="request" value="{{ $reads->id }}">--}}
{{--                    <div class="row g-4">--}}
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
{{--                    </div>--}}
{{--                </form>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<div class="modal fade" tabindex="-1" id="composeEmail">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Attachment Link</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('attachment-email') }}" method="post">
                    @csrf
                    <input type="hidden" name="request" value="{{ $reads->id }}">
                    <input type="hidden" name="user-id" value="{{ $reads->user->id }}">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <p>This will send an email to the lead with a link to upload the necessary attachments.</p>
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
</div>--}}
<div class="extra">
<upload-form route="{{ route('attachments.store_json') }}"
             :user-id="{{ Auth::id() }}"
             :request-id="{{ $reads->id }}"
             :with-type="false"
></upload-form>
</div>
@endsection

@section('page-js')
{{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
@include('attachments.templates.upload-form-template')

<script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/attachments/upload-form-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/request/line-items.js') }}"></script>

@endsection
