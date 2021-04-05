<div class="modal fade" tabindex="-1" id="sendEstimate">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Estimate</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <p>This will send an email to the lead informing them about their estimate, along with instructions on how to log in and take action.</p>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>