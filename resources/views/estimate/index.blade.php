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
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Estimate</h3>
            
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content mt-4">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalEstimate"><em class="icon ni ni-plus-sm"></em><span>New Estimate</span></a></li>
                        
                         
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->

    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

<div class="modal fade" tabindex="-1" id="modalEstimate">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Estimate</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estimate-reps.store') }}" method="post" class="form-validate">
                    @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Lead<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on" name="lead_id" required>
                                            <option selected disabled>Type to search</option>
                                            @foreach($leadslist as $id => $leadname)
                                                 <option value="{{ $leadname->id }}">
{{--                                            {{ optional($leadname->getUser)->name }}--}}
                                                     {{ $leadname->name . " " . $leadname->last_name}}
                                             </option>

                                            @endforeach
                                             
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Type<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-control form-select" name="type" data-placeholder="Select a option" required>
                                            <option label="empty" value=""></option>
                                            <option value="1">Pre-Estimate</option>
                                            <option value="2">Final Estimate</option>  
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Job Name<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-control form-select" name="job_name" data-placeholder="Select a option" required>
                                            <option label="empty" value=""></option>
                                            <option value="1">Interior Project - Apartment</option>
                                            <option value="2">Interior Project - House</option>
                                            <option value="3">Interior Project - Commercial</option>  

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
                 
            </div>
             
        </div>
    </div>
</div>
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">My Estimate</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Date Created</th>
                        <th>Lead</th>
                        <th>Type</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date Sent</th>
                        <th>View / Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estimates as $estimate)
                    <tr>
                        <td>{{ $estimate->created_at }}</td>
                        <td>{{ $estimate->leads->name . ' ' . $estimate->leads->last_name }}</td>
                        
                        <td>
                            @if($estimate->type == 1)
                                Pre-Estimate
                            @elseif($estimate->type == 2)
                                Final Estimate
                            @endif
                        </td>
                        <td>
                            @if($estimate->total_price)
                                ${{ $estimate->total_price}}
                            @else
                            
                            @endif
                            </td>
                        <td>
                            @if($estimate->status == 1)
                                Draft
                            @elseif($estimate->status == 2)
                                Sent
                            @elseif($estimate->status == 3)
                                Viewed
                            @elseif($estimate->status == 4)
                                Rejected
                            @elseif($estimate->status == 5)
                                Approved
                            @elseif($estimate->status == 6)
                                Project
                            @endif
                        </td>
                        <td>{{ $estimate->date_sent}}</td>

                         
                        <td>
                            <a href="{{ route('estimate-reps.show', $estimate->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a>
                        </td>
                        <td>
                            <a href="{{ route('estimate-reps.destroy', $estimate->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$estimate->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('estimate-reps.destroy', $estimate->id) }}" method="post" class="d-none" id="delete_{{$estimate->id}}">
                                @method('delete')
                                @csrf
                            </form>
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
                <h5 class="card-title">All Estimate</h5>
            </div>
            <table class="datatable-init table">
                <thead>

                    <tr>
                        <th>Date Created</th>
                        <th>Lead</th>
                        <th>Type</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date Sent</th>
                        <th>View / Edit</th>
                        <th>Delete</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($allestimates as $list)
                    <tr>
                        <td>{{ $list->created_at }}</td>
                        <td>{{ $list->leads->name . ' ' . $list->leads->last_name }}</td>
                        
                        <td>
                            @if($list->type == 1)
                                Pre-Estimate
                            @elseif($list->type == 2)
                                Final Estimate
                            @endif
                        </td>
                        <td>
                            @if($list->total_price)
                                ${{ $list->total_price}}
                            @else
                            
                            @endif
                            </td>
                        <td>
                            @if($list->status == 1)
                                Draft
                            @elseif($list->status == 2)
                                Sent
                            @elseif($list->status == 3)
                                Viewed
                            @elseif($list->status == 4)
                                Rejected
                            @elseif($list->status == 5)
                                Approved
                            @elseif($list->status == 6)
                                Project
                            @endif
                        </td>
                        <td>{{ $list->date_sent}}</td>
                        <td><a href="{{ route('estimate-reps.show', $list->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                        <td>
                            <a href="{{ route('estimate-reps.destroy', $list->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$list->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('estimate-reps.destroy', $list->id) }}" method="post" class="d-none" id="delete_{{$list->id}}">
                                @method('delete')
                                @csrf
                            </form>
                        </td>
                         
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

{{-- Add Contact Modal --}}
 
 


@endsection

@section('page-js') 

@endsection
    