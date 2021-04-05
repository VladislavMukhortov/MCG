<div class="modal fade zoom" tabindex="-1" id="modalNewLvl2">
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
                    <label class="form-label" for="lvl2_lvls1">Select Parent lvl1</label>
                    <select id="lvl2_lvls1" class="form-control" name="lvl1">
                        <option disabled selected>--choose lvl1--</option>
                        @if($level_1)
                            @foreach($level_1 as $item)
                                <option value="{{ $item->id }}">{{ $item->level_name . ' ' . $item->level_description }}</option>
                            @endforeach
                        @endif
                    </select>

                    <label class="form-label" for="name-lvl2">level name</label>
                    <input class="form-control" id="name-lvl2" name="name">

                    <label class="form-label" for="description-lvl-2">level description</label>
                    <input class="form-control" id="description-lvl-2" name="description">

                    <div class="modal-footer text-right">
                        <button type="submit" class="save_csi_codes btn btn-primary">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
