<div class="modal fade" tabindex="-1" id="addPayout">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payout</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('projects.payouts.store', $project->id) }}" method="post" id="paymentForm">
                    @method('POST')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label">Date</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" class="form-control date-picker" name="date" placeholder="mm/dd/yyyy" required>
                                        </div>
                                        <label class="form-label">Subcontractor</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select form-control form-control-lg" data-search="on" name="subcontractor_id">
                                                <option selected disabled>Type to search</option>

                                                 @foreach($subcontractors as $subcontractor)
                                                    <option value="{{ $subcontractor->id }}">
                                                        {{ $subcontractor->company_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select form-control form-control-lg" data-search="off" name="status_id" required>

                                                @foreach(\App\Models\PayoutStatus::getStatuses()->toArray() as $statusId => $statusName)
                                                    <option value="{{ $statusId }}" >{{$statusName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="form-label">Amount</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left"><i class="icon ni ni-money"></i></div>
                                            <input type="number" class="from-control-lg form-control currency" name="amount" required/>
                                            <div class="form-text-hint"><span class="">USD</span></div>
                                        </div>
                                    </div>
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
