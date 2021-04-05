@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Account Setting
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Account Settings</h3>
             
        </div><!-- .nk-block-head-content -->
         
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="card card-bordered">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Account Settings</h5>
        </div>
        <form action="{{ route('account-setting.update' , $user->id) }}" method="post" class="form-validate">
            @method('PUT')
        	@csrf
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Full Name<span style="color: red"> *</span></label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" required value="{{ $user->name }}">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="email-address">Email<span style="color: red"> *</span></label>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control" id="email-address" placeholder="" name="email" required value="{{ $user->email }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                	<div class="form-group">
                        <label class="form-label" for="cf-default-textarea">Email Signature</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control form-control-sm"
                                      id="cf-default-textarea"
                                      placeholder="Write your Mail Signature"
                                      name="email_signature">{{ $account->email_signature }}</textarea>
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

{{-- <div class="col-xxl-6 mt-2"> --}}
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3 mb-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-cc-secure"></em> Change Password</h6>
                     
                </div>
            </div>  
            <div class="card-inner">
                <div class="nk-block">
                    <form action="{{ route('account-setting.update' ,Auth::id()) }}" method="post" class="form-validate">
                        @method('PUT')
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="password">Current Password</label>
                                    <div class="form-control-wrap">
                                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="current_password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="******" autocomplete="new-password" required >
                                        @error('current_password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
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
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
                                            <div class="alert alert-danger">{{ $message }}</div>
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
{{-- </div> --}}
 
@endsection

@section('page-js') 

 
@endsection
