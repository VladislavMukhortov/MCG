<div class="col-xxl-6 mt-3">
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Notes</h5>
                </div>
                <table class="datatable-init table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Notes</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if($reads->tasksNote)
                        @foreach($reads->tasksNote as $list)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($list->notes->created_at)->format('Y-m-d') }}</td>
                                <td>{{ $list->notes->created_by_name }}</td>
                                <td>{{ $list->notes->notes }}</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>