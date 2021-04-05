<div class="tab-pane" id="tabCompletionReports">
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Completion Reports</h5>
                </div>
                <table class="table" id="datatable__reports">
                    <thead>
                    <tr>
                        <th>Subcontractor</th>
                        <th>Date / Time</th>
                        <th>Notes</th>
                        <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            @include('Project.leads.partials.tabs._item_completion_report', [
                                'item' => $report,
                            ])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>