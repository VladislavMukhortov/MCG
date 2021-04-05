@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Dashboard
@endsection

{{-- Page CSS --}}
@section('page-css') 
 
@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Home</h3>
            
        </div><!-- .nk-block-head-content -->
{{--            request button--}}
{{--        <div class="nk-block-head-content">--}}
{{--            <div class="toggle-wrap nk-block-tools-toggle">--}}
{{--                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>--}}
{{--                <div class="toggle-expand-content" data-content="pageMenu">--}}
{{--                    <ul class="nk-block-tools g-3">--}}
{{--                         --}}
{{--                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>New Request</span></a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div><!-- .nk-block-head-content -->--}}

    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->   

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">My Tasks</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Parent Task</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Assigned Rep</th>
                        <th>View / Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_task as $task)
                    <tr>
                        <td>
                            @if($task->parent_task)
                                {{$task->parentName->id}} ({{$task->parentName->name}})
                            @endif
                        </td>       
                        <td>{{$task->description}}</td>
                        <td>{{ Carbon\Carbon::parse($task->created_at)->format('m/d/Y h:i A')}}</td>
                        <td>{{ $task->getcreatedby->name }}</td>
                        <td>
                            @if($task->status == 1)
                                New
                            @elseif($task->status == 2)
                                In Progress
                            @elseif($task->status == 3)
                                Closed
                            @endif
                        </td>
                         
                        <td>{{ Carbon\Carbon::parse($task->due_date)->format('m/d/Y h:i A')}}</td>
                        <td>
                            @isset($task->user['name'])
                                {{ $task->user['name'] }}
                            @else

                            @endisset
                        </td>
                        <td>
                            <a href="{{ route('task.show', $task->id) }}?home=home"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a>
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
                <h5 class="card-title">Unanswered Questions</h5>
            </div>
            <table class="datatable-init table">
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
                    {{-- @foreach($requests as $request) --}}
                    <tr>
                        <td>{{-- {{ $request->id }} --}}</td>
                        <td>{{-- {{ $request->contacts->display_name }} --}}</td>
                        <td>{{-- {{ $request->contacts->email }} --}}</td>
                        <td>{{-- {{ $request->request_information }} --}}</td>
                        <td> </td>
                         
                        <td></td>
                         
                    </tr>
                    {{-- @endforeach --}}
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">New Requests</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Contact</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Request Information</th>
                         
                    </tr>
                </thead>
                <tbody>
                    @foreach($requestslist as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ optional($request->contacts)->display_name }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>
                            @if($request->status == 1)
                                New
                            @elseif($request->status == 2)
                                No Answer
                            @elseif($request->status == 3)
                                Spoke
                            @elseif($request->status == 4)
                                Unqualified
                            @elseif($request->status == 5)
                                Qualified
                            @elseif($request->status == 6)
                                Attachments Uploaded
                            @elseif($request->status == 7)
                                Lead
                            @endif
                        </td>
                        <td>
                            {{ date('m/d/Y h:i A', strtotime($request->created)) }}
                        </td>
                         
                        <td>{{$request->request_information}} </td>
                         
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
                <h5 class="card-title">Emails</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Snippet</th>
                        <th>Body</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Date/Time</th>
                         
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($requests as $request) --}}
                    <tr>
                        <td>{{-- {{ $request->id }} --}}</td>
                        <td>{{-- {{ $request->contacts->display_name }} --}}</td>
                        <td>{{-- {{ $request->contacts->email } --}}</td>
                        <td>{{-- {{ $request->request_information }} --}}</td>
                        <td>
                            
                        </td>
                         
                        <td> </td>
                         
                    </tr>
                    {{-- @endforeach --}}
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Request</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('requests.store') }}" method="post" class="form-validate">
                    @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Contact</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on" name="contact" required>
                                            <option selected disabled>Type to search</option>
                                            @foreach($contactslist as $id => $contactname)
                                            <option value="{{ $contactname->id }}">
                                            {{ $contactname->display_name }}</option>

                                            @endforeach
                                             
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    </div>
                </form> 
                 
            </div>
             
        </div>
    </div>
</div>
     

@endsection

{{-- Page JS --}}
@section('page-js') 
 
@endsection