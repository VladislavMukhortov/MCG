@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
SubContractors
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">SubContractors</h3>
            
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content mt-4">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>Add SubContractors</span></a></li>
                         
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
                <h5 class="modal-title">Add SubContractors</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('subcontractors.store') }}" method="post" id="subcontractorForm">
                    @csrf
                    <input type="hidden" class="form-control" name="user_status" value="1">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Primary Contact Name<span style="color: red"> *</span></label>
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
                                <label class="form-label" for="name">Company Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="company_name" placeholder="Company Name" id="company_name">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Parent Vendor</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="parent_vendor">
                                        <option disabled selected>Select</option>
                                        @foreach($subcontractors as $id => $companyname)
                                            <option value="{{ $companyname->id }}">
                                                {{ $companyname->company_name }}
                                            </option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="email-address" placeholder="abc@gmail.com" name="email" required>
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
                                <label class="form-label" for="website">Website</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control"placeholder="Enter a website" name="website">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="status">
                                        <option selected disabled>Select</option>
                                        <option value="1">Pending Documents</option>
                                        <option value="2">Pending Approval</option>
                                        <option value="3">Rejected</option>
                                        <option value="4">Approved</option>
                                         
                                    </select>
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
                                <label class="form-label">Type</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="type">
                                        <option selected disabled>Select</option>
                                        <option value="1">Architect</option>
                                        <option value="2">Business Owner</option>
                                        <option value="3">Engineer</option>
                                        <option value="4">General Contractor</option>
                                        <option value="5">Government Agency</option>
                                        <option value="6">Homeowner</option>
                                        <option value="7">Insurance / Bond</option>
                                        <option value="8">Licensing / Other Agencies</option>
                                        <option value="9">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Vendor Source</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="vendor_source">
                                        <option selected disabled>Select</option>
                                        <option value="1">Dodge Data</option>
                                        <option value="2">Personal Invite From GC</option>
                                        <option value="3">External Referral</option>
                                        <option value="4">In-Store</option>
                                        <option value="5">On-Site</option>
                                        <option value="6">Social</option>
                                        <option value="7">Trade Show</option>
                                        <option value="8">Word of Mouth</option>
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
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">All SubContractors</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Primary Contact Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th class="text-muted">View/Edit</th>
{{--                         <th>Delete</th>
 --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcontractors as $subcontractor)
                    <tr>
                        <td>{{$subcontractor->company_name}}</td>
                        <td>{{$subcontractor->userGetdata->name}}</td>
                        <td>{{$subcontractor->userGetdata->email}}</td>
                        <td>{{$subcontractor->phone}}</td>
                        <td>
                            @if($subcontractor->status == 1)
                                Pending Documents
                            @elseif($subcontractor->status == 2)
                                Pending Approval
                            @elseif($subcontractor->status == 3)
                                Rejected
                            @elseif($subcontractor->status == 4)
                                Approved
                            @endif
                        </td>
                        <td>
                            @if($subcontractor->type == 1)
                                Architect
                            @elseif($subcontractor->type == 2)
                                Business Owner
                            @elseif($subcontractor->type == 3)
                                Engineer
                            @elseif($subcontractor->type == 4)
                                General Contractor
                            @elseif($subcontractor->type == 5)
                                Government Agency
                            @elseif($subcontractor->type == 6)
                                Homeowner
                            @elseif($subcontractor->status == 7)
                                Insurance / Bond
                            @elseif($subcontractor->status == 8)
                                Licensing / Other Agencies
                            @elseif($subcontractor->status == 9)
                                Other
                            @endif
                        </td>

                        <td><a href="{{ route('subcontractors.show',$subcontractor->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
 
                        {{-- <td>
                            <a href="{{ route('subcontractors.destroy', $subcontractor->user_id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$subcontractor->user_id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('subcontractors.destroy', $subcontractor->user_id) }}" method="post" class="d-none" id="delete_{{$subcontractor->user_id}}">
                                @method('delete')
                                @csrf
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

@endsection

@section('page-js')  
    <script type="text/javascript" src="{{ asset('js/subContractor/subcontractors.js') }}"></script>
 
@endsection
