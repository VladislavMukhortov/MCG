<div class="modal fade zoom" tabindex="-1" id="modalNewLvl1">
    <div class="modal-dialog modal-lg" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title csi-code-modal-lvl">CSI Code</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body csi-model-body">
                <form action="{{ route('csi-level.store') }}" method="post" class="form-validate">
                    @csrf
                    <label class="form-label" for="name-lvl1">level name</label>
                    <input class="form-control" id="name-lvl1" name="name">

                    <label class="form-label" for="description-lvl-1">level description</label>
                    <input class="form-control" id="description-lvl-1" name="description">

                    <div class="modal-footer text-right">
                        <button type="submit" class="save_csi_codes btn btn-primary">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>