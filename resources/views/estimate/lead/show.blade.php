@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Estimate
@endsection

{{-- Page CSS --}}
@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('assets/css/line-items.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/lead-line-items-estimate-tab.css') }}">
@endpush

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm ml-2">

        <div class="nk-block-between">

            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#scheduleCall">
                                    <em class="icon ni ni-call"></em><span>Schedule Call</span></a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newQuestion">
                                    <em class="icon ni ni-question"></em><span>Ask Question</span></a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="javascript:void(0)" class="btn btn-primary  upload-attachment">
                                    <em class="icon ni ni-cloud"></em><span>Upload Attachment</span>
                                </a>
                            </li>
                        </ul>
{{--todo next step:...--}}
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="col-xxl-12 mb-2 estimate-template-section">
        <div class="progress progress-lg ">
            @foreach (\App\Models\EstimateRepository::getStatuses() as $key => $statusName)
                <div class="progress-bar rounded bg-{{ $key > $estimate->status ? 'warning' : 'success'  }} font-weight-bold" data-progress="16">{{ $statusName }}</div>
                @if(!$loop->last)
                    <em class="icon ni ni-caret-right-fill" style="font-size: 18px;"></em>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-xxl-12">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-title-group align-start gx-3">
                    <div class="card-title" style="margin-top:15px;">
                        <h6 class="title"><em class="icon ni ni-info"></em> Details</h6>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-inner">
                            <div class="nk-block">
                                <div class="profile-ud-list">
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Date Sent</span>
                                            <span class="profile-ud-value">
                                                @if($estimate->date_sent)
                                                    {{ date('m/d/Y h:i A', strtotime($estimate->date_sent)) }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Type</span>
                                            <span class="profile-ud-value">{{ $estimate->type_name }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Total price</span>
                                            <span class="profile-ud-value">{{ $estimate->total_price }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created By</span>
                                        <span class="profile-ud-value">{{ $estimate->created_by_name }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item"></div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Status</span>
                                            <span class="profile-ud-value">{{ $estimate->status_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-bordered card-preview mt-5">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem1"><em class="icon ni ni-opt-dot"></em><span>Line Items</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem2"><em class="icon ni ni-cloud"></em><span>Attachments</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem3"><em class="icon ni ni-question"></em><span>Questions</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem1">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="col-md-12">
                                    <div class="table" id="estimateTab">
                                        <div class="table__head">
                                            <div class="table--left--head">
                                                <div>Folder</div>
                                                <div>CSI Code L1</div>
                                                <div>CSI Code L2</div>
                                                <div>CSI Code L3</div>
                                                <div>Name</div>
                                            </div>
                                            <div class="table--right--head">
                                                <div>Quantity</div>
                                                <div>Total Cost</div>
                                            </div>
                                        </div>
                                        <div class="table__body">
                                            @if(!is_null($estimate->lineItems))
                                                <lead-line-items-node-parent
                                                        :line-item-id=" {{ $estimate->lineItems->id }} "
                                                        :estimate-id="{{ $estimate->id }}"
                                                ></lead-line-items-node-parent>
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

                <div class="tab-pane" id="tabItem2">
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
                                            <th>Uploaded</th>
                                            <th>Uploaded By</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($estimate->attachments->count())
                                            @foreach($estimate->attachments as $attachment)
                                                <tr>
                                                    @include('estimate.lead.partials._item_attachment', [
                                                        'attachment'    => $attachment,
                                                        'estimate'      => $estimate
                                                    ])
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <div class="tab-pane" id="tabItem3">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Questions</h5>
                                </div>
                                <table class="table" id="datatable__questions">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Created By</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($estimate->questions as $question)
                                            <tr>
                                                @include('estimate.lead.partials._item_question', ['question' => $question])
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
                <upload-form route="{{ route('attachments.store_json') }}"
                             :estimate-id="{{ $estimate->id }}"
                             :user-id="{{ Auth::id() }}"
                ></upload-form>
        </div>
    </div>
</div>
@endsection

@push('modals')
    @include('estimate.lead.modals.new_question')
    @include('estimate.lead.modals.schedule_call')
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush
@section('page-js')
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

        @include('estimate.lead.partials._line-items-tab-template')
        @include('attachments.templates.upload-form-template')
        <script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/attachments/upload-form-modal.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/estimate/lead/line-items-tab.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/estimate/lead/line-items.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#datatable__attachments').DataTable({
                    "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                    "language": {
                        "lengthMenu": "Show &nbsp; _MENU_"
                    }
                });
                $('#datatable__questions').DataTable({
                    "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                    "language": {
                        "lengthMenu": "Show &nbsp; _MENU_"
                    }
                });
            } );
        </script>
@endsection
@push('css')
    <style>
        .top {
            display: flex;
            justify-content: space-between;
        }
        .top > .dataTables_filter {

        }
        .top  > .dataTables_length {

        }
    </style>

@endpush