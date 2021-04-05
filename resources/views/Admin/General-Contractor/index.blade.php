@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
General Contractors
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">General Contractors</h3>
            
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content mt-4">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>Add General Contractors</span></a></li>
                         
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

{{-- Representatives Modal  --}}
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add General Contractors</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="/general-contractors" method="post" id="generalForm">
                    @csrf
                     <input type="hidden" class="form-control" name="user_status" value="1">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="first" placeholder="First" id="name">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label mt-3" for="name"></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="last" placeholder="Last" id="name">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="email-address" placeholder="abc@gmail.com" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Phone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="phone" placeholder="Enter a phone" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a location" name="address">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Street Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a street address" name="street_address">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">State</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a state" name="state">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">City</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a city" name="city">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="zip">Zip</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="zip" placeholder="Enter a zip" name="zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="">Website</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" placeholder="Enter a website" name="website">
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
                                     
                                    <input type="password"   id="password_confirmation" type="password_confirmation" class="form-control" name="password_confirmation" placeholder="******" autocomplete="new-password">
                                     
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
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Status</th>
                        <th>User Roles</th>
                        <th class="text-muted">View / Edit</th>
                     </tr>
                </thead>
                <tbody>
                    @foreach($generals as $general)
                    <tr>
                        <td>{{$general->name}}</td>
                        <td>{{$general->email}}</td>
                        <td>
                            @if($general->user_status == 1)
                                Active
                            @elseif($general->user_status == 0)
                                Inactive
                            @endif
                        </td>
                        <td>{{$general->role_name }}</td>
                        <td><a href="{{ route('general-contractors.show', $general->generalContractor->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

@endsection

@section('page-js')  
    <script type="text/javascript" src="{{ asset('js/generalSubcontractor/general.js') }}"></script>
@endsection
