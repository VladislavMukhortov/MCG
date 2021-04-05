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
                    <input type="hidden" name="estimate" value="{{ $reads->id }}">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Attachment Type<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control " name="estimate_attachment_type" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">Existing Condition Image</option>
                                        <option value="2">Concept Image</option>
                                        <option value="3">Floor Plan</option>
                                        <option value="4">Other</option>
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