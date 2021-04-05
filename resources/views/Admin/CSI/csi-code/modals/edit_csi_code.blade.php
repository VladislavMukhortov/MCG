<div class="modal fade zoom" tabindex="-1" id="modalEditCsi{{ $csiTree['code_id'] }}">
    <div class="modal-dialog modal-lg" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title csi-code-modal-lvl">CSI Code</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body csi-model-body">
                <form action="{{ route('csi-code.update', $csiTree['code_id']) }}" method="post" class="form-validate">
                    @csrf
                    <label class="form-label" for="csi_lvls1-edit">Select Parent lvl1</label>
                    <select id="csi_lvls1-edit" class="form-control" name="level_1_id">
                        <option disabled selected>--choose lvl1--</option>
                        @foreach($level_1 as $item)
                            <option @if($item->id == $csiTree['id']) selected @endif value="{{ $item->id }}">{{ $item->level_name . ' ' . $item->level_description }}</option>
                        @endforeach
                    </select>
                    <label class="form-label" id="csi_lvls2-label-edit" for="csi_lvls2-edit" @if($csiTree['type'] == 'empty') style="display: none" @endif>Select Parent lvl2</label>
                    <select id="csi_lvls2-edit" class="form-control" name="level_2_id" @if($csiTree['type'] == 'empty') style="display: none" @endif>
                        <option disabled selected>--choose lvl2--</option>
                        @if($csiTree['type'] != 'empty')
                            @foreach($level_2 as $item)
                                <option class="added-option-2" @if($item->id == $csiTree['children']['id']) selected @endif value="{{ $item->id }}">{{ $item->level_name . ' ' . $item->level_description }}</option>
                            @endforeach
                        @endif
                    </select>

                    <label class="form-label" id="csi_lvls3-label-edit" for="csi_lvls3-edit" @if($csiTree['children']['type'] == 'empty') style="display: none" @endif>Select Parent lvl3</label>
                    <select id="csi_lvls3-edit" class="form-control" name="level_3_id" @if($csiTree['children']['type'] == 'empty') style="display: none" @endif>
                        <option disabled selected>--choose lvl3--</option>
                        @if($csiTree['children']['type'] != 'empty')
                            @foreach($level_3 as $item)
                                <option class="added-option-3" @if($item->id == $csiTree['children']['children']['id']) selected @endif value="{{ $item->id }}">{{ $item->level_name . ' ' . $item->level_description }}</option>
                            @endforeach
                        @endif
                    </select>

                    <label class="form-label" id="csi_lvls4-label-edit" for="csi_lvls4-edit" @if($csiTree['children']['children']['type'] == 'empty') style="display: none" @endif>Select Parent lvl4</label>
                    <select id="csi_lvls4-edit" class="form-control" name="level_4_id" @if($csiTree['children']['children']['type'] == 'empty') style="display: none" @endif>
                        <option disabled selected>--choose lvl4--</option>
                        @if($csiTree['type'] != 'empty')
                            @foreach($level_4 as $item)
                                <option class="added-option-4" @if($item->id == $csiTree['children']['children']['children']['id']) selected @endif value="{{ $item->id }}">{{ $item->level_name . ' ' . $item->level_description }}</option>
                            @endforeach
                        @endif
                    </select>

                    <label class="form-label" for="name-csi">Code name</label>
                    <input required class="form-control" id="name-csi-edit" name="code_name">

                    <label class="form-label" for="building_materials">Building materials</label>
                    <input required class="form-control" id="building_materials-edit" name="building_materials" type="number">

                    <label class="form-label" for="decoration_materials">Decoration materials</label>
                    <input required class="form-control" id="decoration_materials-edit" name="decoration_materials" type="number">

                    <label class="form-label" for="labor">Labor</label>
                    <input required class="form-control" id="labor-edit" name="labor" type="number">

                    <label class="form-label" for="subcontractors">Subcontractors</label>
                    <input required class="form-control" id="subcontractors-edit" name="subcontractors" type="number">

                    <label class="form-label" for="manufacturing">Manufacturing</label>
                    <input required class="form-control" id="manufacturing-edit" name="manufacturing" type="number">
                    <div class="modal-footer text-right">
                        <button type="submit" class="save_csi_codes btn btn-primary">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>