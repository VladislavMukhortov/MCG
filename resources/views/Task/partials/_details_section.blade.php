<div class="col-xxl-6">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3 mb-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-info"></em> Details</h6>

                </div>
                <div class="card-tools">
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em><span><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em></a>

                    </div>
                </div>
            </div>
            <div class="card-inner">
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
                                <span class="profile-ud-value">{{ Carbon\Carbon::parse($reads->created_at)->format('m/d/Y h:i A')}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Name</span>
                                <span class="profile-ud-value">{{$reads->name}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Created By</span>
                                <span class="profile-ud-value">
                                    {{$reads->getcreatedby->name}}
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Assigned Rep</span>
                                <span class="profile-ud-value">
                                    @isset($reads->user['name'])
                                        {{ $reads->user['name'] }}
                                    @else

                                    @endisset
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Description</span>
                                <span class="profile-ud-value">
                                    {{$reads->description}}
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Parent Task</span>
                                <span class="profile-ud-value">
                                    @if($reads->parent_task)
                                        {{$reads->parentName->id}} ({{$reads->parentName->name}})
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Status</span>
                                <span class="profile-ud-value">{{ $reads->status_name }}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Due Date</span>
                                <span class="profile-ud-value">
                                   {{ Carbon\Carbon::parse($reads->due_date)->format('m/d/Y h:i A')}}
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Lead</span>
                                <span class="profile-ud-value">
                                    @if($reads->lead)
                                        {{ $leadName }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Project</span>
                                <span class="profile-ud-value">
                                    @if($reads->taskProject)
                                    <a href="{{ route('projects.show', $reads->taskProject) }}">
                                        {{ optional($reads->taskProject)->name }}
                                    </a>
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
