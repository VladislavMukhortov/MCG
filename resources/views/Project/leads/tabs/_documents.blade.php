<div class="tab-pane" id="tabDocuments">
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Documents</h5>
                </div>
                <table class="table" id="datatable__documents">
                    <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Created By</th>
                        <th>Created</th>
                        <th>Renewal Date</th>
                        <th>Signature</th>
                        <th>URL</th>
                        <th>View / Sign</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $document)
                        @include('Project.leads.partials.tabs._item_document', [
                            'item' => $document,
                        ])
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>