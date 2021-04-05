<div class="modal fade" tabindex="-1" id="editEstimateTemplate">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estimate-templates.update', $item) }}" method="post" class="form-validate">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="template_name">Template Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input class="form-control form-control-sm @error('template_name') is-invalid @enderror"
                                           name="template_name"
                                           value="{{ $item->template_name }}"
                                           id="template_name"
                                           required>
                                    @error('template_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
