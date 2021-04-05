<!-- Modal -->
<div class="modal fade" id="exampleModalPayment{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('projects.payments.store', $project->id) }}" method="post" id="paymentForm">
                    @method('POST')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Amount</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><i class="icon ni ni-money"></i></div>
                                    <input type="number" class="from-control-lg form-control" name="amount" value="{{$amount}}" required/>
                                    <div class="form-text-hint"><span class="">USD</span></div>
                                </div>
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" data-search="off" name="status_id" required>
                                        <option value="{{$status_id}}">{{$status}}</option>
                                        @foreach(\App\Models\PaymentStatus::getStatuses()->toArray() as $statusId => $statusName)
                                           @if($statusName != $status) <option value="{{ $statusId }}" >{{$statusName }}</option> @endif
                                        @endforeach
                                    </select>
                                </div>
                                <label class="form-label">Due Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-calendar-alt"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="due_date" value="{{$date}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="payment_id" value="{{$id}}">
                                <input type="hidden" name="payment_flag" value="edit">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>