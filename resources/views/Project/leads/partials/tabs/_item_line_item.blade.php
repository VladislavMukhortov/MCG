<div class="tab-pane active" id="tabLineItems">
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="col-md-12">
                    <div class="table" id="estimateTab">
                        <div class="table__head">
                            <div class="table--left--head">
                                <div>CSI Code</div>
                            </div>
                            <div class="table--right--head">
                                <div>Quantity</div>
                                <div>Status</div>
                            </div>
                        </div>
                        <div class="table__body">
                            @if(!is_null($lineItems))
                                {{--                                                <lead-line-items-node-parent--}}
                                {{--                                                        :line-item-id=" {{ $project->lineItems->id }} "--}}
                                {{--                                                        :estimate-id="{{ $project->id }}"--}}
                                {{--                                                ></lead-line-items-node-parent>--}}
                            @else
                                No Data
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>