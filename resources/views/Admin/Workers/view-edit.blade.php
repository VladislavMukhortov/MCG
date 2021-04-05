@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Workers
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
                    <li class="breadcrumb-item active fs-17px"><a href="{{ route('workers.index') }}">Workers</a></li>
                    <li class="breadcrumb-item fs-17px">Worker Details</li>
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
                    <h6 class="title"><em class="icon ni ni-info mr-1"></em>Worker Details</h6>
                </div>
            </div>  
            <div class="card-inner">
                <div class="nk-block">
                    
                    <div class="profile-ud-list">
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Name</span>
                                <span class="profile-ud-value">{{$reads->name}}</span>
                            </div>
                        </div>
                         
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Email Address</span>
                                <span class="profile-ud-value">{{$reads->email}}</span>
                            </div>
                        </div>
                        
                    </div><!-- .profile-ud-list -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Worker</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('workers.update', $reads->id) }}" method="put">
                    @method('PUT')
                    @csrf
                    <input type="hidden" class="form-control" name="user_status" value="1">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Full Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="name" placeholder="First Name" value="{{ $reads->name }}" required>
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
</div>
    

@endsection

@section('page-js') 

@endsection
