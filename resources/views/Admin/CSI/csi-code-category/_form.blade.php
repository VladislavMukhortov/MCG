<form action="{{ route('csi_code_category.store') }}" method="post" class="form-validate">
    @csrf
    <input type="hidden" name="level_id" value="{{$level}}" />
        <div class="row g-4">
            <div class="col-lg-12">
                @foreach($categories as $level => $categoriesList)
                    <div class="form-group">
                        <label class="form-label">CSI Code L{{$level}} <span style="color: red"> *</span></label>
                        <div class="form-control-wrap">
                            <select class="form-select form-control" data-search="on" name="parent[]" required >
                                <option selected disabled>Type to search</option>
                                @foreach($categoriesList as $category)
                                    <option value="{{ $category->id }}">{{ $category->full_name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Code <span style="color: red"> *</span></label>
                    <div class="form-control-wrap">
                       <input type="text" class="from-control-lg form-control" name="code" value="" required/>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Description <span style="color: red"> *</span></label>
                    <div class="form-control-wrap">
                       <textarea name="description" class="form-control form-control-lg" rows="5" required></textarea>
                    </div>
                </div>
            </div>
            <div id="form-csi-code-errors"></div>
        </div>
</form>
