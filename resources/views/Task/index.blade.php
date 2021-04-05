@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Task
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <a href="{{ route('task.index') }}">
                <h3 class="nk-block-title page-title">Task</h3>
            </a>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content mt-4">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>New Task</span></a></li>
                         
                         
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->

    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

<div class="modal fade" tabindex="-1" id="modalTop">
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
</div>
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
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
                    @foreach($all_task as $list)
                    <tr>
                        <td>{{ $list->name }}</td>
                        <td>{{ Carbon\Carbon::parse($list->created_at)->format('m/d/Y h:i A')}}</td>
                        <td>{{ $list->getcreatedby->name }}</td>
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
                        <td>{{ $list->user['name'] }}</td>
                        <td><a href="{{ route('task.show', $list->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
 
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
