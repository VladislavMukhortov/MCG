@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Users
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
                    <li class="breadcrumb-item active fs-17px"><a href="{{ route('users.index') }}">Admin Settings</a></li>
                    <li class="breadcrumb-item  fs-17px">Users</li>
                </ul>
            </nav>    
        </div><!-- .nk-block-head-content -->  
         <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addAccount"><em class="icon ni ni-plus-sm"></em><span>Add Accounts</span></a></li>
                         
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
            <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Accounts</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Status</th>
                        <th>User Roles</th>
                        <th class="text-muted">View / Edit</th>
                        <th class="text-muted">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->user_status == 1)
                                Active
                            @elseif($user->user_status == 0)
                                Inactive
                            @endif
                        </td>
                        <td>{{$user->role_name}}</td>
                        <td><a href="{{ route('users.show', $user->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>

                        <td>    
                            <a href="{{ route('users.destroy', $user->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$user->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-none" id="delete_{{$user->id}}">
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


{{-- Add Accounts Modal --}}
<div class="modal fade" tabindex="-1" id="addAccount">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Accounts</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="post" id="accountForm">
                    @csrf
                     

                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Full Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="name" placeholder="First Name" id="name">
                                </div>
                            </div>
                        </div>
                         
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="email" placeholder="" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="password">Password<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                     
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="******" autocomplete="new-password">
                                     
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Password Confirmation<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                     
                                    <input type="password" id="password_confirmation" type="password_confirmation" class="form-control" name="password_confirmation" placeholder="******" autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Role<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg"   name="role_id">
                                        {{-- <option selected disabled>Add Roles</option> --}}
                                        @foreach($roleslist as $id => $rolename)
                                        <option value="{{ $rolename->id }}">
                                        {{ $rolename->name }}</option>

                                        @endforeach
                                         
                                    </select>
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

<div class="modal fade" tabindex="-1" id="userAccount">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.update',$user->id) }}" method="post" class="form-validate">
                    @csrf
                     

                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Full Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="name" placeholder="First Name" required value="{{ $user->name }}">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="******" required autocomplete="new-password">
                                     
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
                                    <input type="password"   id="password_confirmation" type="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="******" required autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Role<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on" name="user_role_id" required>
                                            <option selected disabled>Add Roles</option>
                                            @foreach($roleslist as $id => $rolename)
                                            <option value="{{ $rolename->id }}" @if($user->isA($rolename->name)) selected='selected' @endif>
                                            {{ $rolename->name }}</option>

                                            @endforeach
                                             
                                        </select>
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

@endsection

@section('page-js')  
    <script type="text/javascript" src="{{ asset('js/account/account.js') }}"></script> 
@endsection
