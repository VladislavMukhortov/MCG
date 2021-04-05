<x-app-layout>
    <form class="users_from form-validate is-alter" action="{{ URL::route('listings.store') }}" method="post">
        @csrf
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create Listing</h3>
                <div class="nk-block-des text-soft">
                    <p></p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                           
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                <button  class="btn btn-primary" type="submit">
                                  Save List
                                </button>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
              
              
                <div class="card-inner">
                    <div class="row g-4">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Home Owner</label>
                                <select name="home_owner_id" class="form-control form-control-lg">
                                    @if(isset($all_home_owner))
                                        @foreach($all_home_owner as $contact)
                                            <option value="{{ $contact->id }}"> {{ $contact->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Listing Name</label>
                                <input type="text" name="name" class="form-control form-control-lg" id="name">
                            </div>
                        </div> 

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Listing Code</label>
                                <input type="text" name="code" class="form-control form-control-lg" id="code">
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Registration Number</label>
                                <input type="text" name="registration_number" class="form-control form-control-lg" id="registration_number">
                            </div>
                        </div>
                
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Short Description</label>
                                <textarea class="form-control form-control-lg" name="description" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">HighLights / Amenities</label>
                                <textarea class="form-control form-control-lg" name="highlights" rows="4"></textarea>
                            </div>
                        </div>
                        
                        
                    </div>      
                </div>

                <div class="card-inner">
                    <div class="card-head">
                        <h4 class="card-title">Address</h4>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Street</label>
                                    <input type="text" name="street" class="form-control form-control-lg" id="street">
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">City</label>
                                    <input type="text" name="city" class="form-control form-control-lg" id="city">
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">State</label>
                                    <input type="text" name="state" class="form-control form-control-lg" id="state">
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Zip</label>
                                    <input type="text" name="zip" class="form-control form-control-lg" id="zip">
                                </div>
                            </div>
    
                         
                        </div>
                    </div>
                </div>

                <div class="card-inner">
                    <div class="card-head">
                        <h4 class="card-title">Charges</h4>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-04">Average Daily Rent</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-coin-alt-fill"></em>
                                        </div>
                                        <input type="text" name="avg_daily_rent" class="form-control" id="default-04" placeholder="Average Daily Rent">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-04">Deposit</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-coin-alt-fill"></em>
                                        </div>
                                        <input type="text" name="deposit" class="form-control" id="default-04" placeholder="Deposit">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-04">Pool Heating Fee</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-coin-alt-fill"></em>
                                        </div>
                                        <input type="text" name="pool_heating_fee" class="form-control" id="default-04" placeholder="Pool Heating Fee">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-04">Early Check In Fee</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-coin-alt-fill"></em>
                                        </div>
                                        <input type="text" name="early_checkin_fee" class="form-control" id="default-04" placeholder="Early Check In Fee">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-04">Late Check Out Fee</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-coin-alt-fill"></em>
                                        </div>
                                        <input type="text" name="late_checkout_fee" class="form-control" id="default-04" placeholder="Late Check Out Fee">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-04">Insurance Fee</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-coin-alt-fill"></em>
                                        </div>
                                        <input type="text" name="insurance_fee" class="form-control" id="default-04" placeholder="Insurance Fee">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</x-app-layout>