@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
SubContractors
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
                    <li class="breadcrumb-item active fs-17px"><a href="{{ route('subcontractors.index') }}">SubContractors</a></li>
                    <li class="breadcrumb-item fs-17px">Details</li>
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

                        <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-primary"><em class="icon ni ni-check-thick"></em><span>Approve</span></a></li>


                        <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-primary"><em class="icon ni ni-cross"></em><span>Reject</span></a></li>
                    </ul>
                    <ul class="nk-block-tools g-3">

                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#lineItem"><em class="icon ni ni-edit"></em><span>Assign CSI Codes</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newNote"><em class="icon ni ni-edit"></em><span>New Note</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newContact"><em class="icon ni ni-user-add-fill"></em><span>New Contact</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newAttachment"><em class="icon ni ni-upload-cloud"></em><span>New Attachment</span></a></li>
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
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalLarge"><em class="icon ni ni-edit"></em><span><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em></a>
                         
                    </div>
                </div>
            </div>  
            <div class="card-inner">
                <div class="nk-block">
                    
                    <div class="profile-ud-list">
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Company Name</span>
                                <span class="profile-ud-value">{{$reads->company_name}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Primary Contact Name</span>
                                <span class="profile-ud-value">{{$reads->userGetdata->name}}</span>
                            </div>
                        </div>
                         
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Email</span>
                                <span class="profile-ud-value">{{$reads->userGetdata->email}}</span>
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
                                <span class="profile-ud-value">{{$reads->address}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Website</span>
                                <span class="profile-ud-value">{{$reads->website}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Status</span>
                                <span class="profile-ud-value">
                                    @if($reads->status_id == 1)
                                        Pending Documents
                                    @elseif($reads->status_id == 2)
                                        Pending Approval
                                    @elseif($reads->status_id == 3)
                                        Rejected
                                    @elseif($reads->status_id == 4)
                                        Approved
                                    @endif
 
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Parent Vendor</span>
                                <span class="profile-ud-value">
                                    @if($reads->parent_vendor)
                                        {{$reads->vendor->company_name}}
                                    @else

                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Type</span>
                                <span class="profile-ud-value">
                                    @if($reads->type == 1)
                                        Architect
                                    @elseif($reads->type == 2)
                                        Business Owner
                                    @elseif($reads->type == 3)
                                        Engineer
                                    @elseif($reads->type == 4)
                                        General Contractor
                                    @elseif($reads->type == 5)
                                        Government Agency
                                    @elseif($reads->type == 6)
                                        Homeowner
                                    @elseif($reads->type == 7)
                                        Insurance / Bond
                                    @elseif($reads->type == 8)
                                        Licensing / Other Agencies
                                    @elseif($reads->type == 9)
                                        Other
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Vendor Source</span>
                                <span class="profile-ud-value">
                                    @if($reads->vendor_source == 1)
                                        Dodge Data
                                    @elseif($reads->vendor_source == 2)
                                        Personal Invite From GC
                                    @elseif($reads->vendor_source == 3)
                                        External Referral
                                    @elseif($reads->vendor_source == 4)
                                        In-Store
                                    @elseif($reads->vendor_source == 5)
                                        On-Site
                                    @elseif($reads->vendor_source == 6)
                                        Social
                                    @elseif($reads->vendor_source == 7)
                                        Trade Show
                                    @elseif($reads->vendor_source == 8)
                                        Word of Mouth
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Languages</span>
                                <span class="profile-ud-value">{{$reads->languages}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Entity Type</span>
                                <span class="profile-ud-value">
                                    @if($reads->entity_type == 1)
                                        Individual
                                    @elseif($reads->entity_type == 2)
                                        Business
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Driver's License</span>
                                <span class="profile-ud-value">
                                    @if($reads->drivers_license == 1)
                                        Yes
                                    @elseif($reads->drivers_license == 2)
                                        No
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Worker's Compensation</span>
                                <span class="profile-ud-value">
                                    @if($reads->workers_compensation == 1)
                                        Yes
                                    @elseif($reads->workers_compensation == 2)
                                        No
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">General Liability</span>
                                <span class="profile-ud-value">
                                    @if($reads->general_liability == 1)
                                        Yes
                                    @elseif($reads->general_liability == 2)
                                        No
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Licensed</span>
                                <span class="profile-ud-value">
                                    @if($reads->licensed == 1)
                                        Yes
                                    @elseif($reads->licensed == 2)
                                        No
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Years of Experience</span>
                                <span class="profile-ud-value">{{$reads->years_of_experience}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Crew Size</span>
                                <span class="profile-ud-value">{{$reads->crew_size}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Has Tools</span>
                                <span class="profile-ud-value">
                                    @if($reads->has_tools == 1)
                                        Yes
                                    @elseif($reads->has_tools == 2)
                                        No
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Has Vehicle</span>
                                <span class="profile-ud-value">
                                    @if($reads->has_vehicle == 1)
                                        Yes
                                    @elseif($reads->has_vehicle == 2)
                                        No
                                    @endif
                                </span>
                            </div>
                        </div>
                         
                         
                    </div><!-- .profile-ud-list -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="editAttachment">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attachment</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action=" " method="post" class="form-validate" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Subcontractor Attachment Type<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="subcontractor_attachment_type" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">W9</option>
                                        <option value="2">Contractor License</option>  
                                        <option value="3">Certificate of Insurance</option>
                                        <option value="4">Signed Document</option>  
                                        <option value="5">Other</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Attachment Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"  name="attachment_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="default-06">File</label>
                                <div class="form-control-wrap">
                                    <div class="custom-file">
                                        <input type="file" multiple class="custom-file-input" id="customFile" name="file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
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

<div class="col-xxl-6">
    <div class="card card-bordered card-preview mt-5">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem1"><em class="icon ni ni-user-add-fill"></em><span>Contacts</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem2"><em class="icon ni ni-coin-alt-fill"></em><span>Bids</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem3"><em class="icon ni ni-edit"></em><span>Notes</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem4"><em class="icon ni ni-align-center"></em><span>Documents</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-upload-cloud"></em><span>Attachments</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-mail"></em><span>Emails</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-edit"></em><span>CSI Codes</span></a>
                </li>
            </ul>
            <div class="tab-content">
                
                <div class="tab-pane active" id="tabItem1">
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
                                        </tr>      
                                    </thead>
                                    <tbody>
                                        @foreach($contactlist as $list)
                                        <tr>
                                            <td>{{ $list->name }}</td> 
                                            <td>{{ $list->phone }}</td>
                                            <td>{{ $list->email }}</td>
                                            <td>{{ $list->address }}</td>
                                            
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
                                    <h5 class="card-title">Bids</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Line Item</th>
                                            <th>Amount</th>
                                            <th>Date/Time</th>      
                                            <th>Signature</th>  
                                            <th>Attachment</th>    
                                            <th>Status</th>    
                                        </tr>      
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($contactlist as $list) --}}
                                        <tr>
                                            <td>{{-- {{ $list->name }} --}}</td> 
                                            <td>{{-- {{ $list->phone }} --}}</td>
                                            <td>{{-- {{ $list->email }} --}}</td>
                                            <td>{{-- {{ $list->address }} --}}</td>
                                            <td>
                                                {{-- <a href="{{ route('contacts.destroy', $list->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                                <form action="{{ route('contacts.destroy', $list->id) }}" method="post" class="d-none" id="delete_{{$list->id}}">
                                                    @method('delete')
                                                    @csrf
                                                </form> --}}
                                            </td>
                                            <td></td>
                                            <td>    </td>
                                        </tr>
                                        {{-- @endforeach --}}
                                        
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
                                        @if($reads->subContractorsNote)
                                            @foreach($reads->subContractorsNote as $list)
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
                                    <h5 class="card-title">Documents</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Created By</th>
                                            <th>Created</th>
                                            <th>URL</th>
                                            <th>Status</th>
                                            <th>Signature</th>
                                            <th>Send for Signature</th>
                                            <th>View</th>
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($activitylist as $list) --}}
                                        <tr>
                                            <td>{{-- {{ date('m/d/Y h:i A', strtotime($list->created_at)) }} --}}</td>
                                            <td>{{-- {{ $list->getuser->name }} --}}</td>
                                            <td>{{-- {{ $list->description }} --}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>
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
                                            <th>Subcontractor Attachment Type</th>
                                            <th>Attachment Description</th>
                                            <th>File</th>
                                            <th>Status</th>
                                            {{-- <th>Update</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($reads->subContractorsAttachments)
                                            @foreach($reads->subContractorsAttachments as $attach)
                                                <tr>
                                                    <td>
                                                        @if($attach->attachment->subcontractor_attachment_type == 1)
                                                            W9
                                                        @elseif($attach->attachment->subcontractor_attachment_type == 2)
                                                            Contractor License
                                                        @elseif($attach->attachment->subcontractor_attachment_type == 3)
                                                            Certificate of Insurance
                                                        @elseif($attach->attachment->subcontractor_attachment_type == 4)
                                                            Signed Document
                                                        @elseif($attach->attachment->subcontractor_attachment_type == 5)
                                                            Other
                                                        @endif
                                                    </td>
                                                    <td>{{ $attach->attachment->attachment_description }}</td>
                                                    <td>
                                                        @if($attach->attachment->file)
                                                            <a href="{{ Storage::url($attach->attachment->file) }}" download="">File</a></td>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($attach->attachment->status == 1)
                                                            Pending
                                                        @elseif($attach->attachment->status == 2)
                                                            Rejected
                                                         @elseif($attach->attachment->status == 3)
                                                            Approved
                                                        @endif
                                                    </td>
                                                     
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
                <div class="tab-pane" id="tabItem7">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">CSI Codes</h5>
                                </div>
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($contacts as $contact) --}}
                                        <tr>
                                            <td>{{-- {{ $contact->name }} --}}</td>
                                            <td>{{-- {{ $contact->phone }} --}}</td>
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
                    <input type="hidden" name="subcontractor" value="{{ $reads->id }}">
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


<div class="modal fade" tabindex="-1" id="newContact">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Contact</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('contacts.store') }}" method="post" id="contactForm">
                    @csrf
                    <input type="hidden" name="subcontractor" value="{{ $reads->id }}">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="first" placeholder="First" id="name">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label mt-3" for="name"></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="last" placeholder="Last" id="name">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="email-address">Email<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control" id="email-address" placeholder="abc@gmail.com" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="email-address">Phone</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="phone" placeholder="Enter a phone" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="email-address">Address</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="email-address" placeholder="Enter a location" name="address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="email-address">Street Address</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="email-address" placeholder="Enter a street address" name="street_address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="email-address">State</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="email-address" placeholder="Enter a state" name="state">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="email-address">City</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="email-address" placeholder="Enter a city" name="city">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="zip">Zip</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="zip" placeholder="Enter a zip" name="zip">
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


<div class="modal fade" tabindex="-1" id="newAttachment">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Attachment</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('attachments.store') }}" method="post" class="form-validate" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="subcontractor" value="{{ $reads->id }}">
                     <div class="row g-4">
                       <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Subcontractor Attachment Type<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="subcontractor_attachment_type" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">W9</option>
                                        <option value="2">Contractor License</option>  
                                        <option value="3">Certificate of Insurance</option>
                                        <option value="4">Signed Document</option>  
                                        <option value="5">Other</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Attachment Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"  name="attachment_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="default-06">File</label>
                                <div class="form-control-wrap">
                                    <div class="custom-file">
                                        <input type="file" multiple class="custom-file-input" id="customFile" name="file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
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
@php
    $first_name = $last_name = null;
    $full_name = "$reads->primary_contact_name";
    $name = explode(' ', $full_name);
    if (isset($name[0])){
        $first_name = $name[0];
    }
    if (isset($name[1])){
        $last_name = $name[1];
    }

    $state = $address =$street_address = $city =$zip = null;
    $full_address = "$reads->address";
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

@endphp

{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalLarge">
    <div class="modal-dialog modal-lg modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Subcontractor</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('subcontractors.update',$reads->id) }}" method="post" id="subcontractorForm">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Primary Contact Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="first" placeholder="First" id="name" value="{{ $first_name }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label mt-3" for="name"></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="last" placeholder="Last" id="name" value="{{ $last_name }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required value="{{$reads->userGetdata->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Company Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="full-name" name="company_name" placeholder="Company Name" required value="{{$reads->company_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Phone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$reads->phone}}" id="phone">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a location" name="address" value="{{ $address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Street Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a street address" name="street_address" value="{{ $street_address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">State</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a state" name="state" value="{{ $state }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">City</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a city" name="city" value="{{ $city }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="zip">Zip</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="zip" placeholder="Enter a zip" name="zip" value="{{ $zip }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="status" value="{{$reads->status}}">
                                        <option disabled>Select</option>
                                        <option value="1" {{ $reads->status == 1 ? 'selected':'' }}>Pending Documents</option>
                                        <option value="2" {{ $reads->status == 2 ? 'selected':'' }}>Pending Approval</option>
                                        <option value="3" {{ $reads->status == 3 ? 'selected':'' }}>Rejected</option>
                                        <option value="4" {{ $reads->status == 4 ? 'selected':'' }}>Approved</option>
                                         
                                    </select>
                                </div>
                            </div>
                        </div>
                         

                         
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="type">
                                        <option  disabled>Select</option>
                                        <option value="1" {{ $reads->type == 1 ? 'selected':'' }}>Architect</option>
                                        <option value="2" {{ $reads->type == 2 ? 'selected':'' }}>Business Owner</option>
                                        <option value="3" {{ $reads->type == 3 ? 'selected':'' }}>Engineer</option>
                                        <option value="4" {{ $reads->type == 4 ? 'selected':'' }}>General Contractor</option>
                                        <option value="5" {{ $reads->type == 5 ? 'selected':'' }}>Government Agency</option>
                                        <option value="6" {{ $reads->type == 6 ? 'selected':'' }}>Homeowner</option>
                                        <option value="7" {{ $reads->type == 7 ? 'selected':'' }}>Insurance / Bond</option>
                                        <option value="8" {{ $reads->type == 8 ? 'selected':'' }}>Licensing / Other Agencies</option>
                                        <option value="9" {{ $reads->type == 9 ? 'selected':'' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Parent Vendor</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="parent_vendor">
                                        <option disabled selected>Select</option>
                                        @foreach($vendors as $id => $companyname)
                                            <option value="{{ $companyname->id }}" @if($companyname->id==$reads->parent_vendor) selected='selected' @endif>{{ $companyname->company_name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Vendor Source</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="vendor_source">
                                        <option disabled>Select</option>
                                        <option value="1" {{ $reads->vendor_source == 1 ? 'selected':'' }}>Dodge Data</option>
                                        <option value="2" {{ $reads->vendor_source == 2 ? 'selected':'' }}>Personal Invite From GC</option>
                                        <option value="3" {{ $reads->vendor_source == 3 ? 'selected':'' }}>External Referral</option>
                                        <option value="4" {{ $reads->vendor_source == 4 ? 'selected':'' }}>In-Store</option>
                                        <option value="5" {{ $reads->vendor_source == 5 ? 'selected':'' }}>On-Site</option>
                                        <option value="6" {{ $reads->vendor_source == 6 ? 'selected':'' }}>Social</option>
                                        <option value="7" {{ $reads->vendor_source == 7 ? 'selected':'' }}>Trade Show</option>
                                        <option value="8" {{ $reads->vendor_source ==8 ? 'selected':'' }}>Word of Mouth</option>
                                    </select>
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
    

@endsection

@section('page-js') 
    <script type="text/javascript" src="{{ asset('js/subContractor/subcontractors.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/contact/contact.js') }}"></script>
@endsection
