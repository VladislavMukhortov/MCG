<x-app-layout>
    <form class="users_from form-validate is-alter" action="{{ URL::route('contacts.store') }}" method="post">
        @csrf
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create Contact</h3>
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
                                  Save Contact
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
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" 
                            id="name" placeholder="Enter your name" name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Email</label>
                            <input type="email" class="form-control form-control-lg" 
                            id="email" placeholder="Enter your email" name="email" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Phone number</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                            required
                             placeholder="Enter your phone number" name="phonenumber">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Instagram Username</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                             placeholder="Enter your Instagram Username" name="insta_user_name">
                        </div>
                    </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Address</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                             placeholder="Enter your location" name="address">
                          
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Street Address</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                             placeholder="Enter your street" name="address_2">
                          
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">City</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                             placeholder="Enter your city" name="city">
                          
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">State</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                             placeholder="Enter your state" name="state">
                          
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Zip</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                             placeholder="Enter your zip" name="zip">
                          
                        </div>
                    </div>
                    
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
       
    </div><!-- .nk-block -->
</form>
</x-app-layout>