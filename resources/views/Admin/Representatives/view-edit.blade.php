@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Representatives
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
                    <li class="breadcrumb-item fs-17px"><a href="{{ route('representatives.index') }}">Representatives</a></li>
                    <li class="breadcrumb-item active fs-17px">Details</li>
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
                <div class="card-tools">
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em><span><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em></a>
                         
                    </div>
                </div>
            </div>  
            <div class="card-inner">
                <div class="nk-block">
                    
                    <div class="profile-ud-list">
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Full Name</span>
                                <span class="profile-ud-value">{{$reads->name}}</span>
                            </div>
                        </div>
                         
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">Email Address</span>
                                <span class="profile-ud-value">{{$reads->email}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">User Roles</span>
                                <span class="profile-ud-value">{{$reads->role_name}}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">User Status</span>
                                <span class="profile-ud-value">
                                    @if($reads->user_status == 1)
                                        Active
                                    @elseif($reads->user_status == 0)
                                        Inactive
                                    @endif  
                                </span>
                            </div>
                        </div>
                        
                    </div><!-- .profile-ud-list -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

<div class="col-xxl-6 mt-2">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3 mb-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-cc-secure"></em> Reset Password</h6>
                     
                </div>
            </div>  
            <div class="card-inner">
                <div class="nk-block">
                    <form action="{{ route('representatives.update',$reads->id) }}" method="post"> 
                        @method('PUT')
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="password">New Password</label>
                                    <div class="form-control-wrap">
                                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="******" autocomplete="new-password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                    <div class="form-control-wrap">
                                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password_confirmation">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password"   id="password_confirmation" type="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="******"  autocomplete="new-password" required>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
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
                </div><!-- .profile-ud-list -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>


{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Representative</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('representatives.update',$reads->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" class="form-control" name="user_role" value="Representatives">
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
