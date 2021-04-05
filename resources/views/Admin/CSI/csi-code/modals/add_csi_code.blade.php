<div class="modal fade zoom" tabindex="-1" id="modalNewCsi">
    <div class="modal-dialog modal-lg" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title csi-code-modal-lvl">CSI Code</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body csi-model-body">
                <form action="{{ route('csi-code.store') }}" method="post" class="form-validate">
                    @csrf
                    <label class="form-label" for="csi_lvls1">Select Parent lvl1</label>
                    <select id="csi_lvls1" class="form-control" name="level_1_id">
                        <option disabled selected>--choose lvl1--</option>
                        @if($level_1)
                            @foreach($level_1 as $item)
                                <option value="{{ $item->id }}">{{ $item->level_name . ' ' . $item->level_description }}</option>
                            @endforeach
                        @endif
                    </select>

                    <label class="form-label" id="csi_lvls2-label" for="csi_lvls2" style="display: none">Select Parent lvl2</label>
                    <select id="csi_lvls2" class="form-control" name="level_2_id" style="display: none">
                        <option disabled selected>--choose lvl2--</option>
                    </select>

                    <label class="form-label" id="csi_lvls3-label" for="csi_lvls3" style="display: none">Select Parent lvl3</label>
                    <select id="csi_lvls3" class="form-control" name="level_3_id" style="display: none">
                        <option disabled selected>--choose lvl3--</option>
                    </select>

                    <label class="form-label" id="csi_lvls4-label" for="csi_lvls4" style="display: none">Select Parent lvl4</label>
                    <select id="csi_lvls4" class="form-control" name="level_4_id" style="display: none">
                        <option disabled selected>--choose lvl4--</option>
                    </select>

                    <label class="form-label" for="name-csi">Code name</label>
                    <input required class="form-control" id="name-csi" name="code_name">

                    <label class="form-label" for="building_materials">Building materials</label>
                    <input required class="form-control" id="building_materials" name="building_materials" type="number">

                    <label class="form-label" for="decoration_materials">Decoration materials</label>
                    <input required class="form-control" id="decoration_materials" name="decoration_materials" type="number">

                    <label class="form-label" for="labor">Labor</label>
                    <input required class="form-control" id="labor" name="labor" type="number">

                    <label class="form-label" for="subcontractors">Subcontractors</label>
                    <input required class="form-control" id="subcontractors" name="subcontractors" type="number">

                    <label class="form-label" for="manufacturing">Manufacturing</label>
                    <input required class="form-control" id="manufacturing" name="manufacturing" type="number">
                    <div class="modal-footer text-right">
                        <button type="submit" class="save_csi_codes btn btn-primary">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>