@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Documents
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Documents</h3>

            </div>
{{--            <div class="nk-block-head-content">--}}
{{--                <div class="toggle-wrap nk-block-tools-toggle upload-document">--}}
{{--                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>--}}
{{--                    <div class="toggle-expand-content  upload-document" data-content="pageMenu">--}}
{{--                        <ul class="nk-block-tools g-3">--}}
{{--                            <li class="nk-block-tools-opt">--}}
{{--                                <a href="javascript:void(0)" class="btn btn-primary upload-document" data-toggle="modal" data-target="#modalTop">--}}
{{--                                    <em class="icon ni ni-plus-sm"></em><span>New Document</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- .nk-block-head-content -->--}}
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Documents</h5>
                </div>

                <table class="datatable-init table">
                    <thead>

                    <tr>
                        <th>Document Name</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Date Sent</th>
                        <th>View / Sign</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $document)
                        @include('documents.leads.partials._item', ['item' => $document])
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
@endsection

@push('js')

@endpush
