@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Requests
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item fs-17px"><a href="{{ route('questions.index') }}">Questions</a></li>
                    <li class="breadcrumb-item active fs-17px">View Question Details</li>
                </ul>
            </nav>
        </div><!-- .nk-block-head-content -->

    </div>
</div>

<div class="nk-block-head nk-block-head-sm mr-1 ml-1">

    <div class="nk-block-between">

        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editQuestion">
                                <em class="icon ni ni-pen-alt-fill"></em>
                                <span>Edit Question</span>
                            </a>
                        </li>
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newNote">
                                <em class="icon ni ni-note-add"></em>
                                <span>New Note</span>
                            </a>
                        </li>
                        <li class="nk-block-tools-opt">
                            <a href="javascript:void(0)" class="btn btn-primary  upload-attachment" data-toggle="modal" data-target="#modalTop">
                                <em class="icon ni ni-cloud"></em>
                                <span>New Attachment</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

<div class="col-xxl-12">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-info"></em>Details</h6>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-inner">
                        <div class="nk-block">
                            <div class="profile-ud-list">
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">#</span>
                                        <span class="profile-ud-value">{{ $question->id }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Description</span>
                                        <span class="profile-ud-value">{{ $question->description }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Subject</span>
                                        <span class="profile-ud-value">{{ $question->subject }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Lead</span>
                                        <span class="profile-ud-value">{{ optional($question->lead)->title }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created By</span>
                                        <span class="profile-ud-value">{{ $question->author_name }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Created</span>
                                        <span class="profile-ud-value">{{ date('m/d/Y h:i A', strtotime($question->created_at)) }}</span>
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
<div class="col-xxl-12">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">

            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Notes</h5>
                </div>

                <table class="datatable-init table">
                    <thead>

                    <tr>
                        <th>Description</th>
                        <th class="center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($question->remarks as $remark)
                        <tr>
                            <td>{{ $remark->description }}</td>
                            <td class="center">
                                @can('delete', $remark)
                                    @include('partials._destroy', [
                                        'url'       => route('questions.remarks.destroy', [$question, $remark]),
                                        'method'    => 'DELETE',
                                        'btnClass'  => 'btn btn-dim d-none d-sm-inline-flex',
                                        'btnText'   => '<em class="icon ni ni-cross"></em><span class="d-none d-md-inline">Delete</span>'
                                        ])
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>
<div class="col-xxl-12">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">

            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Attachments</h5>
                </div>

                <table class="datatable-init table">
                    <thead>

                        <tr>
                            <th>Description</th>
                            <th>File</th>
                            <th class="center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($question->attachments as $attachment)
                        <tr>
                            <td>{{ $attachment->description }}</td>
                            <td><a href="{{ $attachment->file_url }}"
                                   download="{{ \Str::of($attachment->file_url)->afterLast('/')->__toString() }}"
                                >Download</a>
                            </td>
                            <td class="center">
                                @can('delete', $attachment)
                                    @include('partials._destroy', [
                                        'url'       => route('questions.attachments.destroy', [$question, $attachment]),
                                        'method'    => 'DELETE',
                                        'btnClass'  => 'btn btn-dim d-none d-sm-inline-flex',
                                        'btnText'   => '<em class="icon ni ni-cross"></em><span class="d-none d-md-inline">Delete</span>'
                                        ])
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->
</div>
@push('modals')
    @include('Question.modals.add_note')
    @include('Question.modals.edit_question')
@endpush
<upload-form route="{{ route('questions.attachments.store', $question) }}" :user-id="{{ Auth::id() }}"></upload-form>

@endsection
@push('css')

@endpush
@push('js')

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

    @include('attachments.templates.upload-form-template')
    <script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/attachments/upload-form-modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/attachments/newVue.js') }}"></script>
@endpush
