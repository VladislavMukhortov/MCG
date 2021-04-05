<div class="modal fade" tabindex="-1" id="editQuestion">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Question</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ \Gate::check('update', $question) ? route('questions.update', $question) : 'javascript:void(0)' }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="subject">Subject<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder=""
                                           required value="{{ $question->subject }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="question-description">Description<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="question-description" placeholder=""
                                           name="description" required value="{{ $question->description }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                @can('isOwn', $question)
                                    <button type="submit" name="form-question-update" class="btn btn-lg btn-primary">Update</button>
                                @endcan
                                @cannot('isOwn', $question)
                                        <button name="form-question-update" class="btn btn-lg btn-primary disabled">Update</button>
                                @endcannot
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>