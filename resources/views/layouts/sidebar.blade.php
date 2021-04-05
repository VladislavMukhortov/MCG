
<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="./images/logo.png" srcset="./images/logo.png 2x" alt="logo-dark">
                {{-- <span class="nio-version">General</span> --}}
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{ route('home') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                            <span class="nk-menu-text">Home</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                   <li class="nk-menu-item">
                        <a href="{{ route('contacts.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Contacts</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('requests.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-inbox-fill"></em></span>
                            <span class="nk-menu-text">Requests</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('leads.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-thumbs-up"></em></span>
                            <span class="nk-menu-text">Leads</span>
                         </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-coin-alt-fill"></em></span>
                            <span class="nk-menu-text">Estimates</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-copy"></em></span>
                            <span class="nk-menu-text">Estimate Templates</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('projects.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>
                            <span class="nk-menu-text">Projects</span>
                         </a>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-truck"></em></span>
                            <span class="nk-menu-text">Subcontractors</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('subcontractors.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Subcontractors</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('public-subcontractors.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Pre Qualification Form</span>
                                </a>
                            </li>

                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('general-contractors.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-building-fill"></em></span>
                            <span class="nk-menu-text">General Contractors</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="home/#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-call-fill"></em></span>
                            <span class="nk-menu-text">Call Center</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="home/#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-help-fill"></em></span>
                            <span class="nk-menu-text">Questions</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="home/#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-calender-date"></em></span>
                            <span class="nk-menu-text">Events</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="home/#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-mail-fill"></em></span>
                            <span class="nk-menu-text">Email</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('workers.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-check-fill"></em></span>
                            <span class="nk-menu-text">Workers</span>
                         </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="home/#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-check-thick"></em></span>
                            <span class="nk-menu-text">Tasks</span>
                         </a>
                    </li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Settings</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ url('account-setting') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span>
                            <span class="nk-menu-text">Account Settings</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('user-role.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">User Roles</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-account-setting-fill"></em></span>
                            <span class="nk-menu-text">Admin Settings</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.csi.csicodel1') }}" class="nk-menu-link"><span class="nk-menu-text">CSI Codes</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('users.index') }}" class="nk-menu-link"><span class="nk-menu-text">Users</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
