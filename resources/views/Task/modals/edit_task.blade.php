{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('task.update',$reads->id) }}" method="post" class="form-validate">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-full-name">Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="name" id="fv-full-name" value="{{$reads->name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Parent Task</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" data-search="on" name="parent_task">
                                        <option selected disabled>Type to search</option>

                                        @foreach($all_task as $id => $contatname)
                                            <option value="{{ $contatname->id }}" @if($contatname->id==$reads->parent_task) selected='selected' @endif>{{$contatname->id}} ({{ $contatname->name }})</option>

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
                                    <input type="text" class="form-control date-picker" name="date" placeholder="mm/dd/yyyy" value="{{ Carbon\Carbon::parse($reads->due_date)->format('m/d/Y')}}">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Due Time</label>
                                <div class="form-control-wrap">
                                    <input type="time" class="form-control" placeholder="Input placeholder" name="time" value="{{ Carbon\Carbon::parse($reads->due_date)->format('H:i')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="status" data-placeholder="Select a option">
                                        {{-- <option label="empty" value=""></option> --}}
                                        <option value="1" {{ $reads->status == 1 ? 'selected':'' }}>New</option>
                                        <option value="2" {{ $reads->status == 2 ? 'selected':'' }}>In Progress</option>
                                        <option value="3" {{ $reads->status == 3 ? 'selected':'' }}>Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Assigned Rep</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" data-search="on" name="assigned_rep">
                                        <option selected disabled>Type to search</option>
                                        @foreach($representative as $id => $repname)
                                            <option value="{{ $repname->id }}" @if($repname->id==$reads->assigned_rep) selected='selected' @endif>{{ $repname->name }}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="cf-default-textarea">Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder=" " name="description">{{ $reads->description }}</textarea>
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