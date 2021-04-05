<x-app-layout>
    <form class="users_from form-validate is-alter" action="{{ URL::route('users.store') }}" method="post">
        @csrf
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Users Lists</h3>
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
                                  Save Users
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
                  
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" 
                            id="name" placeholder="Enter your name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Email</label>
                            <input type="email" class="form-control form-control-lg" 
                            id="email" placeholder="Enter your email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Phone number</label>
                            <input type="text" class="form-control form-control-lg" id="text"
                            required
                             placeholder="Enter your phone number" name="phonenumber">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="">Please select role</option>
                                @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <div class="form-control-wrap">
                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input required type="password" class="form-control form-control-lg" id="password" placeholder="Enter your Password" name="password">
                            </div>
                        </div>
                   

                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
       
    </div><!-- .nk-block -->
</form>
</x-app-layout>