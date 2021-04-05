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
                    <input type="hidden" name="project" value="{{ $project->id }}">
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
                                         @foreach($allTasks as $id => $contactname)
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
                                <label class="form-label" for="cf-default-textarea">Assigned Rep</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" data-search="on" name="assigned_rep">
                                        <option selected disabled>Type to search</option>
                                        @foreach($representatives as $id => $repname)
                                            <option value="{{ $repname->id }}">{{ $repname->name }}</option>

                                        @endforeach

                                    </select>
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