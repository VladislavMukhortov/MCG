<div class="modal fade zoom" tabindex="-1" id="modalNewLvl3">
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
                    <label class="form-label" for="lvl_3_lvls1">Select Parent lvl1</label>
                    <input class="form-control" readonly value="level 1" id="lvl_3_lvls1">
                    <label class="form-label" for="lvl_3_lvls2">Select Parent lvl2</label>
                    <select id="lvl_3_lvls2" class="form-control" name="lvl2">
                        <option disabled selected>--choose lvl2--</option>
                        @if($level_2)
                            @foreach($level_2 as $item)
                                <option value="{{ $item->id }}">{{ $item->level_name . ' ' . $item->level_description }}</option>
                            @endforeach
                        @endif
                    </select>

                    <label class="form-label" for="name-lvl3">level name</label>
                    <input class="form-control" id="name-lvl3" name="name">

                    <label class="form-label" for="description-lvl-3">level description</label>
                    <input class="form-control" id="description-lvl-3" name="description">

                    <div class="modal-footer text-right">
                        <button type="submit" class="save_csi_codes btn btn-primary">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
