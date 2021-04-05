{{-- Notes Modal --}}
<div class="modal fade" tabindex="-1" id="newNote">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Note</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('note.store') }}" method="post" class="form-validate">
                    @csrf
                    <input type="hidden" name="task" value="{{ $reads->id }}">

                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Notes<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" name="notes" required></textarea>
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