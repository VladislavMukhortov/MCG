@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Estimate

@endsection

{{-- Page CSS --}}
@section('page-css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('assets/css/line-items.css') }}">
@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item fs-17px"><a href="{{ route('estimate-reps.index') }}">Estimates</a></li>
                    <li class="breadcrumb-item active fs-17px">Estimate Details</li>
                    @if(Session::has('success'))
                        <li class="breadcrumb-item active fs-17px">  
                            <a href="javascript:void(0)" class="btn btn-success eg-toastr-success">{{ Session::get('success') }}</a>
                        </li>
                    @endif
                        
                </ul>
            </nav>    
        </div><!-- .nk-block-head-content -->  
        
    </div>
</div>
<div class="nk-block-head nk-block-head-sm ml-2">
    @if(session()->has('project-exists'))
        <div class="alert alert-danger">
            {{ session()->get('project-exists') }}
        </div>
    @endif
    <div class="nk-block-between">
      
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">

                        <li class="nk-block-tools-opt">
                            <form action="{{ route('convert') }}" method="post">
                                @csrf
                                <input type="hidden" name="lead_id" value="{{ $reads->leads->id }}">
                                <input type="hidden" name="estimate_id" value="{{ $reads->id }}">
                                <button type="submit" class="btn btn-primary">Convert to project</button>
                            </form>
                        </li>

                        <li class="nk-block-tools-opt">
                            <a href="{{ URL::route('estimates.get-line-items', ['id' => $reads->id]) }}"
                               class="btn btn-primary  edit-line-items"
                            >
                                <em class="icon ni ni-edit"></em>
                                <span>Edit Line Items</span>
                            </a>
                        </li>

                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#insertTemplate"><em class="icon ni ni-copy"></em><span>Insert Template</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#uploadCsv"><em class="icon ni ni-upload"></em><span>Upload CSV</span></a></li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newNote"><em class="icon ni ni-edit"></em><span>New Note</span></a></li>
                        <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#newAttachment"><em class="icon ni ni-upload-cloud"></em><span>New Attachment</span></a></li>
                    </ul>
                    <ul class="nk-block-tools g-3">

                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newPreview"><em class="icon ni ni-eye-fill"></em><span>Preview</span></a></li>


                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#sendEstimate"><em class="icon ni ni-mail-fill"></em><span>Send Estimate</span></a></li>
                    </ul>
                         
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="col-xxl-12 mb-2 estimate-template-section">
    <div class="progress progress-lg ">
        @php
            $status = [1 => 'Draft', 2 => 'Sent', 3 => 'Viewed', 4 => 'Rejected', 5 => 'Approved', 6 => 'Project'];
        @endphp

        @foreach ($status as $key => $statusGet)
             <div class="progress-bar rounded bg-{{ $key > $reads->status ? 'warning':'success'  }} font-weight-bold" data-progress="16">{{ $statusGet }}</div>
             @if ($key != 6)
                <em class="icon ni ni-caret-right-fill" style="font-size: 18px;"></em>
             @endif
        @endforeach
    </div> 
</div>
<div class="col-xxl-12">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-info"></em> Details</h6>
                     
                </div>
                <div class="card-tools">
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#editEstimate"><em class="icon ni ni-edit"></em><span><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#editEstimate"><em class="icon ni ni-edit"></em></a>
                         
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
                                        <span class="profile-ud-label">Lead</span>
                                        <span class="profile-ud-value">
                                            {{ $reads->leads->name . ' ' . $reads->leads->last_name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Email</span>
                                        <span class="profile-ud-value">
                                            {{ $reads->leads->email }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Phone</span>
                                        <span class="profile-ud-value">
                                            {{ optional($reads->leads)->phone}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Type</span>
                                        <span class="profile-ud-value">{{-- {{ date('m/d/Y h:i A', strtotime($reads->created)) }} --}}
                                            @if($reads->type == 1)
                                               Pre-Estimate
                                            @elseif($reads->type == 2)
                                               Final Estimate
                                            
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Status</span>
                                        <span class="profile-ud-value">
                                            @if($reads->status == 1)
                                                Draft
                                            @elseif($reads->status == 2)
                                                Sent
                                            @elseif($reads->status == 3)
                                                Viewed
                                            @elseif($reads->status == 4)
                                                Rejected
                                            @elseif($reads->status == 5)
                                                Approved
                                            @elseif($reads->status == 6)
                                                Project
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Total Price</span>
                                        <span class="profile-ud-value">{{ $reads->total_price }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created By

                                        </span>
                                        <span class="profile-ud-value">
                                            {{$reads->getCreatedby->name}}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Date Created
                                        </span>
                                        <span class="profile-ud-value">
                                           {{ date('m/d/Y h:i A', strtotime($reads->created_at)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Date Sent</span>
                                        <span class="profile-ud-value">
                                            @if($reads->date_sent)
                                                {{ date('m/d/Y h:i A', strtotime($reads->date_sent)) }}
                                            @else
                                                 
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">PDF URL</span>
                                        <span class="profile-ud-value">{{-- {{ date('m/d/Y h:i A', strtotime($reads->created)) }} --}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Cover Photo</span>
                                        <span class="profile-ud-value">
                                            @if($reads->cover_photo)
                                            <img src="{{ Storage::url($reads->cover_photo) }}" height="120px" width="120px" alt="Image">
                                            @else
                                                 
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
    </div>
</div>
<div class="card card-bordered card-preview mt-5">
    <div class="card-inner">
        <ul class="nav nav-tabs mt-n3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabItem4"><em class="icon ni ni-opt-dot"></em><span>Line Items</span></a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-upload-cloud"></em><span>Attachments</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-align-center"></em><span>Activities</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-edit"></em><span>Notes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem8"><em class="icon ni ni-help-fill"></em><span>Questions</span></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabItem4">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            {{--TODO search, export, filters--}}
                            <div class="col-md-12">
                                <div class="table" id="estimateTab">
                                    <div class="table__head">
                                        <div class="table--left">
                                            <div>Item name</div>
                                        </div>
                                        <div class="table--right">
                                            <div>Quantity</div>
                                            <div>BM</div>
                                            <div>DM</div>
                                            <div>Sub</div>
                                            <div>Labor</div>
                                            <div>Total</div>
                                            <div>Delete</div>
                                        </div>
                                    </div>
                                    <div class="table__body">

{{--                                        @if(!is_null($reads->lineItems))--}}
{{--                                            <line-items-node-parent--}}
{{--                                                    :line-item-id=" {{ $reads->lineItems->id }} "--}}
{{--                                                    :estimate-id="{{ $reads->id }}"--}}
{{--                                                    ></line-items-node-parent>--}}
{{--                                        @else--}}
{{--                                            No Data--}}
{{--                                        @endif--}}
                                        No Data
                                    </div>
                                </div>
                            </div>
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
                            <table class="table" id="datatable__attachments">
                                <thead>
                                    <tr>
                                        <th>Attachments Description</th>
                                        <th>Attachment type</th>
                                        <th>File</th>
                                        <th>Uploaded</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   @if($reads->attachments)
                                    @foreach($reads->attachments as $attachment)
                                        <tr>
                                            <td>{{ $attachment->attachment_description }}</td>
                                                <td>
                                                    {{ $attachment['attachment_type'] }}
                                                </td>
                                            <td>
                                                @if($attachment->file)
{{--                                                    <a href="{{ Storage::url($attachment->file) }}" download="">File</a>--}}
                                                    <a href="{{ asset($attachment->file) }}" download="">File</a>
                                                @endif
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($attachment->created_at)->format('Y-m-d')}}</td>
                                            
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
                                <h5 class="card-title">Activities</h5>
                            </div>
                            <table class="table" id="datatable__activities">
                                <thead>
                                    <tr>
                                        <th>Date/Time</th>  
                                        <th>User</th>
                                        <th>Description</th>
                                    </tr>       
                                </thead>
                                <tbody>
                                    @if($reads->estimateActivities)
                                        @foreach($reads->estimateActivities as $activity)
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
            {{-- <div class="tab-content"> --}}
            <div class="tab-pane" id="tabItem7">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">Notes</h5>
                            </div>
                            <table class="table" id="datatable__notes">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Notes</th>    
                                    </tr>      
                                </thead>
                                <tbody>
                                    @if($reads->estimateNotes)
                                        @foreach($reads->estimateNotes as $list)
                                            @include('estimate.partials._note_item', ['item'=>$list])
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
                                <h5 class="card-title">Questions</h5>
                            </div>
                            <table class="table" id="datatable__questions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($reads->questions as $question)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $question->subject }}</td>
                                        <td>{{ $question->description }}</td>
                                        <td>{{ $question->status_title }}</td>
                                        <td>{{ date('m/d/Y', strtotime($question->created_at)) }}</td>
                                        <td>{{ $question->author_name }}</td>
                                         
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
<div class="modal fade zoom" tabindex="-1" id="modalEstimateTemplate">
    <div class="modal-dialog modal-lg" role="modal" style="min-width: 90%">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Line Items</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body estimate-template-model-body">
                <estimate-template :template="{{ $reads->id }}"></estimate-template>
            </div>
        </div>
    </div>
</div>

<div class="btn btn-success eg-toastr-success"></div>
<upload-form route="{{ route('attachments.store_json') }}"
             :user-id="{{ Auth::id() }}"
             :estimate-id="{{ $reads->id }}"
             :with-type="true"
></upload-form>
@endsection

@push('modals')
    @include('estimate.modals.insert_estimate-template')
{{--    @include('estimate.modals.add_attachment')--}}
    @include('estimate.modals.send_estimate')
    @include('estimate.modals.edit_estimate')
    @include('estimate.modals.add_note')
@endpush

@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/line-items-estimate-tab.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush

@section('page-js') 
 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
@include('estimate.line-items-tab-template')
@include('estimate.line-items-template')

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

@include('attachments.templates.upload-form-template')
<script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/attachments/upload-form-modal.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/estimate/line-items-tab.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/estimate/line-items.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/estimate/estimate-template.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#datatable__attachments').DataTable({
            "dom": '<"top"fl>rt<"bottom"ip><"clear">',
            "language": {
                "lengthMenu": "Show &nbsp; _MENU_"
            }
        });
        $('#datatable__activities').DataTable({
            "dom": '<"top"fl>rt<"bottom"ip><"clear">',
            "language": {
                "lengthMenu": "Show &nbsp; _MENU_"
            }
        });
        $('#datatable__notes').DataTable({
            "dom": '<"top"fl>rt<"bottom"ip><"clear">',
            "language": {
                "lengthMenu": "Show &nbsp; _MENU_"
            }
        });
        $('#datatable__questions').DataTable({
            "dom": '<"top"fl>rt<"bottom"ip><"clear">',
            "language": {
                "lengthMenu": "Show &nbsp; _MENU_"
            }
        });
    } );
</script>
@endsection

@push('css')
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

@push('js')
    @if ($errors->any())

        <script>
            $( document ).ready(function() {
                $('#editEstimate').modal('show');
            });
        </script>
    @endif
    <script>
        $(document)
            .on("click", ".show__note", function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var noteId = $(this).data('note_id');
                $('.show__note__modal[data-note_id=' + noteId + ']').modal('show');
            });
    </script>
@endpush