@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
General Contractors
@endsection

{{-- Page CSS --}}
@push('css')

@endpush

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item active fs-17px"><a href="{{ route('general-contractors.index') }}">General Contractors</a></li>
                    <li class="breadcrumb-item fs-17px">General Contractor Details</li>
                </ul>
            </nav>
        </div><!-- .nk-block-head-content -->   
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="col-xxl-6">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3 mb-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-info"></em> Details</h6>
                     
                </div>
                {{-- <div class="card-tools">
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em><span><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em></a>
                         
                    </div>
                </div> --}}
            </div>  
            <div class="card-inner">
                <div class="nk-block">
                    
                    <div class="profile-ud-list">
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Name</span>
                                <span class="profile-ud-value">{{$generalContractor->user_name}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Website</span>
                                <span class="profile-ud-value">
                                    <a href="{{ $generalContractor->website }}">
                                        {{$generalContractor->website_domain_name }}
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Email Address</span>
                                <span class="profile-ud-value">{{ optional($generalContractor->user)->email }}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Address</span>
                                <span class="profile-ud-value">{{ $generalContractor->address }}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Phone</span>
                                <span class="profile-ud-value">{{ $generalContractor->phone }}</span>
                            </div>
                        </div>    
                    </div><!-- .profile-ud-list -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
{{-- @php
    $first_name = $last_name = null;
    $full_name = $reads->name;
    $name = explode(' ', $full_name);
    if (isset($name[0])){
        $first_name = $name[0];
    }
    if (isset($name[1])){
        $last_name = $name[1];
    }

    $state = $address =$street_address = $city =$zip = null;
    $full_address = $reads->userGen['address'];
    $add = explode(',', $full_address);
    if (isset($add[0])){
        $address = $add[0];
    }
    if (isset($add[1])){
        $street_address = $add[1];
    }
    if (isset($add[2])){
        $state = $add[2];
    }
    if (isset($add[3])){
        $city = $add[3];
    }
    if (isset($add[4])){
        $zip = $add[4];
        $zip = str_replace(".", "", $zip);
    }

@endphp  --}}

{{-- Edit Modal --}}
{{-- <div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit General Contractor</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('general-contractors.update',$reads->id) }}" method="post" class="form-validate">
                    @method('PUT')
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="first" placeholder="First" id="name" value="{{ $first_name }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label mt-3" for="name"></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="last" placeholder="Last" id="name" value="{{ $last_name }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Phone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="phone" placeholder="Enter a phone" value="{{ $reads->userGen['phone'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="website">Website</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"placeholder="Enter a website" value="{{ $reads->userGen['website'] }}" name="website">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a location" name="address" value="{{ $address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Street Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a street address" name="street_address" value="{{ $street_address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">State</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a state" name="state" value="{{ $state }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">City</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a city" name="city" value="{{ $city }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="zip">Zip</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="zip" placeholder="Enter a zip" name="zip" value="{{ $zip }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form> 
                 
            </div>
             
        </div>
    </div>
</div> --}}
    

@endsection

@section('page-js') 
 
@endsection
