{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="editEstimate">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Estimates</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estimate-reps.update',$reads->id) }}" method="post" class="form-validate" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Job Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control " name="job_name" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1" {{ $reads->job_name == 1 ? 'selected':'' }}>Interior Project - Apartment</option>
                                        <option value="2" {{ $reads->job_name == 2 ? 'selected':'' }}>Interior Project - House</option>
                                        <option value="3" {{ $reads->job_name == 3 ? 'selected':'' }}>Interior Project - Commercial</option>

                                    </select>
                                    @error('type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- </div>
                        <div class="row g-4"> --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Type<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control @error('type') is-invalid @enderror" name="type" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1" {{ $reads->type == 1 ? 'selected':'' }}>Pre-Estimate</option>
                                        <option value="2" {{ $reads->type == 2 ? 'selected':'' }}>Final Estimate</option>
                                    </select>
                                    @error('type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Status<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control  @error('status') is-invalid @enderror" name="status" data-placeholder="Select a option" required>
                                        {{-- <option label="empty" value=""></option> --}}
                                        <option value="1" {{ $reads->status == 1 ? 'selected':'' }}>Draft</option>
                                        <option value="2" {{ $reads->status == 2 ? 'selected':'' }}>Sent</option>
                                        <option value="3" {{ $reads->status == 3 ? 'selected':'' }}>Viewed</option>
                                        <option value="4" {{ $reads->status == 4 ? 'selected':'' }}>Rejected</option>
                                        <option value="5" {{ $reads->status == 5 ? 'selected':'' }}>Approved</option>
                                        <option value="6" {{ $reads->status == 6 ? 'selected':'' }}>Project</option>
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="default-06">Cover Photo</label>
                                <div class="form-control-wrap">
                                    <div class="custom-file">
                                        <input type="file" multiple class="custom-file-input @error('cover_photo') is-invalid @enderror" id="customFile" name="cover_photo">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @error('cover_photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
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