@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Attachments
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Attachments</h3>

            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle upload-attachment">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content  upload-attachment" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="javascript:void(0)" class="btn btn-primary upload-attachment" data-toggle="modal" data-target="#modalTop">
                                    <em class="icon ni ni-plus-sm"></em><span>New Attachment</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Attachments</h5>
                </div>

                <table class="table" id="datatable__attachments">
                    <thead>

                    <tr>
                        <th>Attachment Description</th>
                        <th>File</th>
                        <th>Uploaded</th>
                        <th>Uploaded By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attachments as $attachment)
                        @include('attachments.leads.partials._item', ['item' => $attachment])
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
    <upload-form route="{{ route('attachments.store_json') }}"
                 :user-id="{{ Auth::id() }}"
                 :lead-id="{{ optional(Auth::user()->lead)->id }}"
    ></upload-form>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

    @include('attachments.templates.upload-form-template')
    <script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/attachments/upload-form-modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/attachments/newVue.js') }}"></script>

{{--    todo conflict with bundle.js in master layout when registering this vue components in newVue.js--}}
    <script>
        $(document).ready(function() {
            $('#datatable__attachments').DataTable({
                "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                "language": {
                    "lengthMenu": "Show &nbsp; _MENU_"
                },
            });
            // $('#datatable__attachments_length').s

        } );
    </script>
@endpush
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
