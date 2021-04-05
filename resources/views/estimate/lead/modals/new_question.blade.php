<div class="modal fade" tabindex="-1" id="newQuestion">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ask Question</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('questions.store') }}" method="post" class="form-validate">
                    @csrf
                    <input type="hidden" name="estimate_id" value="{{ $estimate->id }}">
                    <input type="hidden" name="author_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                    @if(!is_null($lead = optional(\Auth::user())->lead) && optional(\Auth::user())->is_lead)
                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                    @endif
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="name">Subject</label>
                                <input type="text" class="form-control form-control-lg"
                                       id="name" placeholder="Enter subject" name="subject" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <label class="form-label" for="description-textarea">Description<span
                                                style="color: red"> *</span></label>
                                    <textarea class="form-control form-control-sm" id="description-textarea" name="description"
                                              required></textarea>
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