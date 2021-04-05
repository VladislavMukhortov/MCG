{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalLarge">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Project</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('projects.update', $project->id) }}" method="post" id="projectForm">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="lead_id" value="{{ $project->lead_id }}">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Project Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="name" placeholder="Project Name" id="name" value="{{ $project->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" name="status_id">
                                        @foreach (\App\Models\ProjectStatus::getStatuses()->toArray() as $id => $statusName)
                                            <option value="{{ $id }}" @if($id === $project->status->id) selected @endif">{{ $statusName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text"
                                           class="form-control"
                                           id="email-address"
                                           placeholder="Enter a location"
                                           name="address"
                                           @isset($project->address) value="{{ $project->address->address }}" @endisset>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Street Address</label>
                                <div class="form-control-wrap">
                                    <input type="text"
                                           class="form-control"
                                           id="email-address"
                                           placeholder="Enter a street address"
                                           name="street"
                                           @isset($project->address) value="{{ $project->address->street }}" @endisset>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">State</label>
                                <div class="form-control-wrap">
                                    <input type="text"
                                           class="form-control"
                                           id="email-address"
                                           placeholder="Enter a state"
                                           name="state"
                                           @isset($project->address) value="{{ $project->address->state }}" @endisset>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">City</label>
                                <div class="form-control-wrap">
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="email-address"
                                            placeholder="Enter a city"
                                            name="city"
                                            @isset($project->address) value="{{ $project->address->city }}" @endisset>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="zip">Zip</label>
                                <div class="form-control-wrap">
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="zip"
                                            placeholder="Enter a zip"
                                            name="zip"
                                            @isset($project->address) value="{{ $project->address->zip }}" @endisset>
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