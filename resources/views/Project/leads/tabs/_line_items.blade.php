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
                                    <lead-project-line-items-node-parent
                                            :line-item-id=" {{ $lineItems->id }} "
                                            :estimate-id="{{ $project->estimate->id }}"
                                    ></lead-project-line-items-node-parent>
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
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/line-items.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/lead-line-items-estimate-tab.css') }}">
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    @include('Project.leads.partials.tabs._line-items-tab-template')

    <script type="text/javascript" src="{{ asset('js/project/lead/line-items-tab.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/project/newVue.js') }}"></script>
@endpush