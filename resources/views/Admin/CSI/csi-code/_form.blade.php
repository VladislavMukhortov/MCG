<form action="{{ route('csicodes.store') }}" method="post" class="form-validate">
    @csrf
    <div class="row g-4">
        <div class="col-lg-12">
            @foreach($categories as $l => $categoriesList)
                <div class="form-group">
                    <label class="form-label">CSI Code L{{$l}}
                        @if($loop->first)
                            <span style="color: red"> *</span>
                        @endif
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-select form-control"
                                data-search="on"
                                name="categories[]"
                                {{ $loop->first ? 'required' : ''}}
                                id="selectCSICategoryLVL{{$l}}"
                                {{ $l > 1 ? 'disabled' : '' }}>
                            <option selected disabled>Type to search</option>

                            @foreach($categoriesList as $category)
                                <option value="{{ $category->id }}">{{ $category->fullName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">Item Name <span style="color: red"> *</span></label>
                <div class="form-control-wrap">
                    <input type="text" class="from-control-lg form-control" name="item_name" required/>
                </div>
                @error('item_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">Building Materials <span style="color: red"> *</span></label>
                <div class="form-control-wrap">
                    <input type="number" min="0" class="from-control-lg form-control" name="building_material" value=""
                           required/>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">Decoration Materials <span style="color: red"> *</span></label>
                <div class="form-control-wrap">
                    <input type="number" min="0" class="from-control-lg form-control" name="decoration_material"
                           value="" required/>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">Labor <span style="color: red"> *</span></label>
                <div class="form-control-wrap">
                    <input type="number" min="0" class="from-control-lg form-control" name="labor" value="" required/>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">Subcontractors <span style="color: red"> *</span></label>
                <div class="form-control-wrap">
                    <input type="number" min="0" class="from-control-lg form-control" name="subcontractors" value=""
                           required/>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">Manufacturing <span style="color: red"> *</span></label>
                <div class="form-control-wrap">
                    <input type="number" min="0" class="from-control-lg form-control" name="manufacturing" value=""
                           required/>
                </div>
            </div>
        </div>
        <div id="form-csi-code-errors"></div>
    </div>
</form>
