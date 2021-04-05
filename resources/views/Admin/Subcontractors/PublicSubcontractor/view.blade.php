@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Pre Qualification Form
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
                    <li class="breadcrumb-item active fs-17px"><a href="{{ route('public-subcontractors.index') }}">Public SubContractors Page</a></li>
                    <li class="breadcrumb-item fs-17px">
                        Pre Qualification Form
                    </li>
                </ul>
            </nav>
        </div><!-- .nk-block-head-content -->   
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

<div class="row g-gs">
    <div class="col-lg-12">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Pre Qualification Form</h5>
                </div>
                <form action="{{ route('subcontractors.store') }}" method="post" class="form-validate">
                    @csrf
                    {{-- <input type="hidden" class="form-control" name="user_role_id" value="5"> --}}
                    <input type="hidden" class="form-control" name="user_status" value="1">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Company Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="full-name" name="company_name" placeholder="Company Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Entity Type</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="entity_type">
                                        <option selected disabled>Select</option>
                                        <option value="1">Individual</option>
                                        <option value="2">Business</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Primary Contact Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="email-address" placeholder="abc@gmail.com" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Phone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a phone" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="website">Website</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"placeholder="Enter a website" name="website">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a location" name="address">
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
                                <label class="form-label" for="email-address">Zip</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" placeholder="Enter a zip" name="zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Years of Experience<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="years_of_experience" placeholder="Years of Experience" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Crew Size<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="crew_size" placeholder="Crew Size" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="languages">Languages<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="languages" placeholder="Languages" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Licensed<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="licensed" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">General Liability<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="general_liability" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Driver's License<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="drivers_license" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Has Tools<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="has_tools" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Has Vehicle<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="has_vehicle" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Worker's Compensation<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select" name="workers_compensation" data-placeholder="Select a option" required>
                                        <option label="empty" value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="password">Password<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="******" required autocomplete="new-password">
                                     
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                         
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Save Information</button>
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

