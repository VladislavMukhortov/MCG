<div class="tab-pane" id="tabPayments">
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Payments</h5>
                </div>
                <table class="table" id="datatable__payments">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        @include('Project.leads.partials.tabs._item_payment', [
                            'item' => $payment
                        ])
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>