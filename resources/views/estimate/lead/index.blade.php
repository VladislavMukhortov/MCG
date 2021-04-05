@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
Estimate
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Estimates</h5>
                </div>
                <table class="datatable-init table">
                    <thead>
                    <tr>
                        <th>Date Sent</th>
                        <th>Created By</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estimates as $estimate)
                        <tr>
                            @include('estimate.lead.partials._item', [
                                'estimate' => $estimate
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

@endsection
