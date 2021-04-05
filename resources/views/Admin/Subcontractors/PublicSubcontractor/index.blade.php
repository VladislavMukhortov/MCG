@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Public SubContractors
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Public SubContractors Page</h3>
            
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="{{ route('public-subcontractors.create') }}" class="btn btn-primary"><em class="icon ni ni-plus-sm"></em><span>Pre Qualification Form</span></a></li>
                         
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
 
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Primary Contact Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>View/Edit</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($generals as $general) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td> 
                           {{--  @if($general->user->user_status == 1)
                                Active
                            @elseif($general->user->user_status == 0)
                                Inactive
                            @endif --}}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td>{{-- <a href=" "><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a> --}}</td>
                        <td></td>
                        {{-- <td>
                            <a href="{{ route('general-contractors.destroy', $general->user_id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$general->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('general-contractors.destroy', $general->user_id) }}" method="post" class="d-none" id="delete_{{$general->id}}">
                                @method('delete')
                                @csrf
                            </form>
                        </td> --}}
                    </tr>
                    {{-- @endforeach --}}
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

@endsection

@section('page-js')  

@endsection
