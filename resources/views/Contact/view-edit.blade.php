@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Contacts
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
                    <li class="breadcrumb-item active fs-17px"><a href="{{ route('contacts.index') }}">Contacts</a></li>
                    <li class="breadcrumb-item  fs-17px">View Contact Details</li>
                </ul>
            </nav>    
        </div><!-- .nk-block-head-content -->  
         
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block-head nk-block-head-sm ml-2">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
{{--                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newRequest"><em class="icon ni ni-plus-sm"></em><span>New Request</span></a></li>--}}
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newNote"><em class="icon ni ni-edit"></em><span>New Note</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#composeEmail0"><em class="icon ni ni-mail"></em><span>Compose Email</span></a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="col-xxl-6">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3 mb-3">
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
            <div class="card-inner">
                <div class="nk-block">
                    
                    <div class="profile-ud-list">
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Name</span>
                                <span class="profile-ud-value">{{$reads->name . ' ' . $reads->last_name }}</span>
                            </div>
                        </div>
                         
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Phone</span>
                                <span class="profile-ud-value">{{$reads->phone}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Address</span>
                                <span class="profile-ud-value">{{$fullAddress}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Email</span>
                                <span class="profile-ud-value">
                                    {{$reads->email}}
                                </span>
                            </div>
                        </div>
                        
                    </div><!-- .profile-ud-list -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<div class="col-xxl-6 mt-5">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-inbox-fill"></em><span>Requests</span></a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-edit"></em><span>Notes</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-mail"></em><span>Emails</span></a>
                </li>
            </ul>
            <div class="tab-content">
{{--                <div class="tab-pane active" id="tabItem5">--}}
{{--                    <div class="nk-block nk-block-lg">--}}
{{--                        <div class="card card-bordered card-preview">--}}
{{--                            <div class="card-inner">--}}
{{--                                <div class="card-head">--}}
{{--                                    <h5 class="card-title">Requests</h5>--}}
{{--                                </div>--}}
{{--                                <table class="datatable-init table">--}}
{{--                                    <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>#</th>--}}
{{--                                            <th>Created</th>--}}
{{--                                            <th>Created By</th>--}}
{{--                                            <th>Request Information</th>--}}
{{--                                            <th class="text-muted">View / Edit</th>--}}
{{--                                            <th class="text-muted">Delete</th>--}}
{{--                                        </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                        @foreach($requestlist as $list)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $list->id }}</td>--}}
{{--                                            <td>{{ date('m/d/Y h:i A', strtotime($list->created)) }}</td>--}}
{{--                                            <td>{{ $list->user->name }}</td>--}}
{{--                                            <td>{{ $list->request_information }}</td>--}}
{{--                                            <td><a href="{{ route('requests.show', $list->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ route('requests.destroy', $list->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>--}}
{{--                                                <form action="{{ route('requests.destroy', $list->id) }}" method="post" class="d-none" id="delete_{{$list->id}}">--}}
{{--                                                    @method('delete')--}}
{{--                                                    @csrf--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        @endforeach--}}
{{--                                        --}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div><!-- .card-preview -->--}}
{{--                    </div> <!-- nk-block -->--}}
{{--                </div>--}}
                <div class="tab-pane active" id="tabItem6">
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
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($reads->contactsNote)
                                            @foreach($reads->contactsNote as $list)
                                                @if($list->notes)
                                                    <tr>
                                                        <td>{{ Carbon\Carbon::parse($list->notes->created_at)->format('Y-m-d') }}</td>

                                                        <td>{{ $list->notes->notes }}</td>

                                                        <td>
                                                            <a href="{{ route('note.destroy', $list->notes->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->notes->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                                            <form action="{{ route('note.destroy', $list->notes->id) }}" method="post" class="d-none" id="delete_{{$list->notes->id}}">
                                                                @method('delete')
                                                                @csrf
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
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
                                            <td>{{-- {{ $contact->email }} --}}</td>
                                            <td>{{-- {{ $contact->email }} --}}</td>

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
 
{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Contact</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('contacts.update',$reads->id) }}" method="post" id="contactForm">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="first" placeholder="First" id="first" value="{{ $reads->name }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label mt-3" for="name"></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="last" placeholder="Last" id="last" value="{{ $reads->last_name }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-email">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="email" placeholder="abc@gmail.com" name="email"  value="{{ $reads->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="phone" placeholder="Enter a phone" name="phone" value="{{ $reads->phone }}">
                                </div>
                            </div>
                        </div>                    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="address" placeholder="Enter a location" name="address" value="{{ $reads->address->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="street-address">Street Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="street-address" placeholder="Enter a street address" name="street" value="{{ $reads->address->street }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="state">State<span style="color: red"> *</span></label>
                                <select class="form-control" id="state" name="state">
                                    @foreach($states as $item)
                                        <option value="{{ $item }}" @if($item == $reads->address->state) selected @endif>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
{{--                                <div class="form-control-wrap">--}}
{{--                                    <input type="text" class="form-control" id="state" placeholder="Enter a state" name="state" value="{{ $state }}">--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="city">City</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="city" placeholder="Enter a city" name="city" value="{{ $reads->address->city }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="zip">Zip</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="zip" placeholder="Enter a zip" name="zip" value="{{ $reads->address->zip }}">
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

{{-- Request Modal --}}

{{--<div class="modal fade" tabindex="-1" id="newRequest">--}}
{{--    <div class="modal-dialog modal-dialog-top" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">New Request</h5>--}}
{{--                <a href="#" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <em class="icon ni ni-cross"></em>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <form action="{{ route('requests.store') }}" method="post">--}}
{{--                    @csrf--}}
{{--                        <input type="hidden" name="contact" value="{{ $reads->id }}">--}}
{{--                        <div class="row g-4">--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">Created Date</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <div class="form-icon form-icon-right">--}}
{{--                                            <em class="icon ni ni-calendar-alt"></em>--}}
{{--                                        </div>--}}
{{--                                        <input type="text" class="form-control date-picker" name="date" placeholder="mm/dd/yyyy">--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">Created Time</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <input type="time" class="form-control" placeholder="Input placeholder" name="time">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="cf-default-textarea">Request Information</label>--}}
{{--                                    <div class="form-control-wrap">--}}
{{--                                        <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder=" " name="request_information"></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{-- Notes Modal --}}
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
                    <input type="hidden" name="contact" value="{{ $reads->id }}">

                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Notes<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" name="notes" required></textarea>
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

{{-- Compose Email Modal --}}

<div class="modal fade" tabindex="-1" id="composeEmail">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Compose Email</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Subject</label>
                                <div class="form-control-wrap">

                                    <input type="text" class="form-control" name="subject" placeholder=" " value=" ">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Body</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder=" " name="note"></textarea>
                                </div>
                            </div>
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


@endsection

@section('page-js')
    <script type="text/javascript" src="{{ asset('js/contact/contact-validate.js') }}"></script>
@endsection
