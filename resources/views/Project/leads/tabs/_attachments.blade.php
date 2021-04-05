<div class="tab-pane" id="tabAttachments">
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Attachments</h5>
                </div>
                <table class="table" id="datatable__attachments">
                    <thead>
                    <tr>
                        <th>Attachments Description</th>
                        <th>File</th>
                        <th>Subcontractor</th>
                        <th>General Contractor</th>
                        <th>Uploaded</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach($attachments as $attachment)
                            @include('Project.leads.partials.tabs._item_attachment', [
                                'item' => $attachment,
                            ])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>