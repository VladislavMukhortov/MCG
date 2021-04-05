<div class="modal fade" tabindex="-1" id="newDocument">
<div class="modal-dialog modal-dialog-top">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Generate document</h5>
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <div class="modal-body">
            <form action="{{ route('project-documents.store') }}" method="post" class="form-validate">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label" for="select-document-type">Select document type</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="document_type">
                                    <option disabled selected value="0">--select document type--</option>
                                    <option value="1">Work Agreement, Architectural</option>
                                    <option value="2">Engineering Service Contract</option>
                                    <option value="3">Home Improvement Contract</option>
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