@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Questions
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Questions</h3>

            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Questions</h5>
                </div>

                <table class="datatable-init table">
                    <thead>

                    <tr>
                        <th>Subject</th>
                        <th>Created</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Mark Closed</th>
                        <th>View/Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $list)
                        <tr>
                            @include('Question.leads.partials._item', [
                                'item' => $list
                            ])
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->


@endsection

@section('page-js')
    <script>

    </script>
@endsection

@push('css')
    <style>

    </style>
@endpush
@push('css')
    <style>
        .show__question {
            cursor: pointer;
        }
    </style>
@endpush
@push('js')
    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/question/mark_closed_status.js') }}" defer></script>
    <script>
        $(document)
            .on("click", ".show__question", function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var questionId = $(this).data('question_id');
                $('.show__question__modal[data-question_id=' + questionId + ']').modal('show');
            });
    </script>
@endpush