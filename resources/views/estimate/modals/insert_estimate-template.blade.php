<div class="modal fade" tabindex="-1" id="insertTemplate">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insert Template</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{route('estimate-reps.insert_template', $reads) }}"
                      method="post" class="form-validate insert-template-form" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-lg-12">
                            <p>This will insert all line items from the selected template.</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Estimate Template </label>

                                <select class="form-control form-control-lg" name="estimate_template" required>

                                    @foreach($templatelist as $id => $templatename)
                                        <option value="{{ $templatename->id }}" >
                                            {{ $templatename->template_name }}</option>

                                    @endforeach

                                </select>

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