<form action="{{ route('csicodes3.store') }}" method="post" class="form-validate">
    @csrf
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">CSI Code L1 <span style="color: red"> *</span></label>
                    <div class="form-control-wrap">
                        <select class="form-select form-control" data-search="on" name="csicode1" required>
                            <option selected disabled>Please select CSIL1 code</option>
                            @foreach($csil1 as $csi)
                                <option value="{{ $csi->id }}">{{ $csi->full_name }}</option>
                            @endforeach
                           
                             
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">CSI Code L2 <span style="color: red"> *</span></label>
                    <div class="form-control-wrap">
                        <select class="form-select form-control" data-search="on" name="csicode2" required>
                            <option selected disabled>Please select CSIL2 code</option>
                            @foreach($csil2 as $csi)
                                <option value="{{ $csi->id }}">{{ $csi->full_name }}</option>
                            @endforeach
                           
                             
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Code <span style="color: red"> *</span></label>
                    <div class="form-control-wrap">
                       <input type="text" class="from-control-lg form-control" name="code" required/>
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
        </div>

    </div>
</form> 