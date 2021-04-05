<div class="modal fade" tabindex="-1"  id="editCsiCodeCategory{{ $item->id }}">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Csi Code Category</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin_settings.csi_code_categories.update', $item) }}" method="post" class="form-validate">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="code_{{$item->id}}">Code<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input class="form-control form-control-sm"
                                           id="code_{{$item->id}}"
                                           name="code"
                                           value="{{$item->code}}" required>
                                </div>
{{--                                @error('code')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="code_description_{{$item->id}}">Description<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm"
                                              id="code_description_{{$item->id}}"
                                              name="description"
                                              required>{{$item->description}}</textarea>
{{--                                    @error('description')--}}
{{--                                    <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                    @enderror--}}
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
@push('js')

@endpush