@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Estimate Template

@endsection

{{-- Page CSS --}}
@section('page-css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{asset('assets/css/line-items.css') }}">
@endsection

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <nav>
                    <ul class="breadcrumb breadcrumb-arrow">
                        <li class="breadcrumb-item fs-17px"><a href="{{ route('estimate-templates.index') }}">Estimate
                                Tempaltes</a></li>
                        <li class="breadcrumb-item active fs-17px">Estimate Template Details</li>
                    </ul>
                </nav>
            </div><!-- .nk-block-head-content -->

        </div>
    </div>
    <div class="nk-block-head nk-block-head-sm ml-2">

        <div class="nk-block-between">

            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="{{ URL::route('estimate-templates.get-line-items',['id'=>$reads->id]) }}"
                                   class="btn btn-primary edit-line-items"

                                >
                                    <em class="icon ni ni-edit"></em>
                                    <span>Edit Line Items</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="col-xxl-6">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-title-group align-start gx-3">
                    <div class="card-title" style="margin-top:15px;">
                        <h6 class="title"><em class="icon ni ni-info"></em> Details</h6>

                    </div>
                    <div class="card-tools">
                        <div class="dropdown">
                            <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal"
                               data-target="#editEstimateTemplate"><em class="icon ni ni-edit"></em><span><span
                                        class="d-none d-md-inline">Edit</span></a>
                            <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal"
                               data-target="#modalTop"><em class="icon ni ni-edit"></em></a>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-inner">
                            <div class="card-title-group align-start gx-3 mb-3">
                                <div class="card-title" style="margin-top:15px;">
                                    <h6 class="title"><em class="icon ni ni-info"></em> Info</h6>

                                </div>
                            </div>
                            <div class="nk-block">
                                <div class="profile-ud-list">
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">#</span>
                                            <span class="profile-ud-value">{{$reads->id}}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Template Name</span>
                                            <span class="profile-ud-value">{{ $reads->template_name }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Created</span>
                                            <span
                                                class="profile-ud-value">{{ date('m/d/Y h:i A', strtotime($reads->created)) }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Created By</span>
                                            <span class="profile-ud-value">{{$reads->user->name}}</span>
                                        </div>
                                    </div>
                                </div><!-- .profile-ud-list -->
                            </div><!-- .nk-block -->
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
                    <a class="nav-link active" data-toggle="tab" href="#tabItem5"><em
                            class="icon ni ni-edit"></em><span>Line Items</span></a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem5">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Line Items</h5>
                                </div>
                                <table class="table table-border">
                                    <thead>
                                    <tr>
                                        <th width="100%">Item Name</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
{{--                                        @if(optional($reads->lineItems)->csi_code)--}}
{{--                                        @foreach(optional($reads->lineItems)->csi_code as $items)--}}
{{--                                            @if(!empty($items['children']))--}}
{{--                                                @include('estimate.line-items-table',['child_items'=>$items, 'padding'=>'25'])--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                        @endif--}}
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>

            </div>
        </div>
    </div><!-- .card-preview -->
    <div class="modal fade zoom" tabindex="-1" id="modalEstimateTemplate">
        <div class="modal-dialog modal-lg" role="modal" style="min-width: 90%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add CSI Codes</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body estimate-template-model-body">
                <estimate-template :template="{{ $reads->id }}"></estimate-template>
                </div>

            </div>
        </div>
    </div>
    @push('modals')
        @include('estimate.estimate-template.modals._edit_template_modal', ['item' => $reads])
    @endpush
@endsection
@section('page-js')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    @include('estimate.line-items-template')
 
    <script type="text/javascript" src="{{ asset('js/estimate-template/line-items.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/estimate-template/estimate-template.js') }}"></script>
    @if ($errors->lead->any())
        <script>
            $( document ).ready(function() {
                $('#editEstimateTemplate').modal('show');
            });
        </script>
    @endif
@endsection
