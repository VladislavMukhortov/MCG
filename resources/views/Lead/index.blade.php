@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
Leads
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<?php
    session()->get('user_created');
?>
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Leads</h3>

        </div><!-- .nk-block-head-content -->


    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="nk-block-head-content mt-4">
    <div class="toggle-wrap nk-block-tools-toggle">
        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
        <div class="toggle-expand-content" data-content="pageMenu">
            <ul class="nk-block-tools g-3">

                <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>New Lead</span></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">My Leads</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Primary Contacts</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Current Estimate</th>
                        <th>Status</th>
                        <th class="text-muted">View / Edit</th>
                        <th class="text-muted">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td>@isset($lead->name){{ $lead->name }} @endisset @isset($lead->last_name){{ $lead->last_name }}@endisset</td>
                        <td>@isset($lead->email){{ $lead->email }} @endisset</td>
                        <td>@isset($lead->phone){{ $lead->phone }}@endisset</td>
                        <td>{{ $lead->current_estimate }}@isset($lead->current_estimate) $@endisset</td>
{{--                        <td>{{ $lead->getUser->name }}</td>--}}
{{--                        <td>{{ $lead->getUser->email }}</td>--}}
{{--                        <td>@if(isset($lead->getRequest->contacts)){{ $lead->getRequest->contacts['phone'] }}@endif</td>--}}
{{--                        <td>{{ $lead->current_estimate }}</td>--}}
                        <td>
                            @if($lead->status == 1)
                                New
                            @elseif($lead->status == 2)
                                Attachments Received
                            @elseif($lead->status == 3)
                                Pre-Estimate Sent
                            @elseif($lead->status == 4)
                                Walk-Thru Scheduled
                            @elseif($lead->status == 5)
                                Final Estimate Sent
                            @elseif($lead->status == 6)
                                Closed Lost
                            @elseif($lead->status == 7)
                                Closed Won
                            @endif
                        </td>

                        <td><a href="{{ route('leads.show',$lead->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                        <td>
                            @if (!$lead->estimateTemplate->count())
                                {{-- expr --}}
{{--                                <a href="{{ route('leads.destroy', $lead->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$lead->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>--}}
{{--                                <form action="{{ route('leads.destroy', $lead->id) }}" method="post" class="d-none" id="delete_{{$lead->id}}">--}}
{{--                                    @method('delete')--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
                                <a href="{{ route('leads.destroy', $lead) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$lead->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                <form action="{{ route('leads.destroy', $lead) }}" method="post" class="d-none" id="delete_{{$lead->id}}">
                                    @method('delete')
                                    @csrf
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">All Leads</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Primary Contacts</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Current Estimate</th>
                        <th>Status</th>
                        <th>View/Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allleads as $list)
                    <tr>
                        <td>{{ $list->name . ' ' . $list->last_name }}</td>
                        <td>{{ $list->email }}</td>
                        <td>{{$list->phone}}</td>
                        <td>{{-- {{ $list->contacts->email }} --}}</td>
                        <td>{{-- {{ $list->contacts->email }} --}}</td>
                        <td><a href="{{ route('leads.show',$list->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                        <td>
                            @if (isset($list->estimateTemplate) && !$list->estimateTemplate->count())
                                <a href="{{ route('leads.destroy', $list) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                <form action="{{ route('leads.destroy', $list) }}" method="post" class="d-none" id="delete_{{$list->id}}">
                                    @method('delete')
                                    @csrf
                                </form>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Lead</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form action="{{ route('leads.store') }}" method="post" id="leadForm">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name<span style="color: #ff0000"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="first" placeholder="First" id="first-lead">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label mt-3" for="name"></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="last" placeholder="Last" id="last-lead">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control"  id="email-lead" placeholder="abc@gmail.com" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone<span style="color: #ff0000"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="phone-lead" placeholder="Enter a phone" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="address-lead" placeholder="Enter a location" name="address">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="street-address">Street Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="street-address-lead" placeholder="Enter a street address" name="street">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="state">State<span style="color: #ff0000"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control" id="state-lead" name="state">
                                        @foreach($states as $state)
                                            <option value="{{ $state }}">
                                                {{ $state }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{--                                        <input type="text" class="form-control" id="state" placeholder="Enter a state" name="state">--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="city">City</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="city-lead" placeholder="Enter a city" name="city">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="zip">Zip</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="zip-lead" placeholder="Enter a zip" name="zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
</div>

@endsection

@section('page-js')
    <script type="text/javascript" src="{{ asset('js/leads/leads-validate.js') }}"></script>
@endsection
