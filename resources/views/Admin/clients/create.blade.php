<x-app-layout>
    <form class="users_from form-validate is-alter" action="{{ URL::route('clients.store') }}" method="post">
        @csrf
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create Client</h3>
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
                                  Save Client
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
                            <label class="form-label" for="name">Contact</label>
                            <select name="contact_id" class="form-control form-control-lg">
                                @foreach($all_contacts as $contact)
                                    <option value="{{ $contact->id }}"> {{ $contact->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Rental Type</label>
                            <select name="rating" class="form-control form-control-lg">
                               <option value="Villas">Villas</option>
                               <option value="Yachts">Yachts</option>
                               <option value="Jets">Jets</option>
                               <option value="Cars">Cars</option>
                               <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Rating</label>
                            <select name="rating" class="form-control form-control-lg">
                               <option value="Villas">Not Interested</option>
                               <option value="Yachts">Bad</option>
                               <option value="Jets">Good</option>
                               <option value="Cars">Preferred</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Driving Licence</label>
                            <input type="text" name="driver_licence_number" class="form-control form-control-lg" id="driver_licence_number">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Private</label>
                            <div class="preview-block">
                                <span class="preview-title overline-title">Checked</span>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked="" id="customSwitch2">
                                    <label class="custom-control-label" for="customSwitch2">Switch</label>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
       
    </div><!-- .nk-block -->
</form>
</x-app-layout>