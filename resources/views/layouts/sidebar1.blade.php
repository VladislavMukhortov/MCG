<div class="nk-sidebar nk-sidebar-fat nk-sidebar-fixed" data-content="sidebarMenu">
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
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">

                {{-- <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                    <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
                        <div class="user-card-wrap">
                            <div class="user-card">
                                <div class="user-avatar">
                                    <span>AB</span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">Abu Bin Ishtiyak</span>
                                    <span class="sub-text">info@softnio.com</span>
                                </div>
                                <div class="user-action">
                                    <em class="icon ni ni-chevron-down"></em>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="nk-profile-content toggle-expand-content" data-content="sidebarProfile">
                        <div class="user-account-info between-center">
                            <div class="user-account-main">
                                <h6 class="overline-title-alt">Available Balance</h6>
                                <div class="user-balance">2.014095 <small class="currency currency-btc">BTC</small></div>
                                <div class="user-balance-alt">18,934.84 <span class="currency currency-btc">BTC</span></div>
                            </div>
                            <a href="#" class="btn btn-icon btn-light"><em class="icon ni ni-line-chart"></em></a>
                        </div>

                        <ul class="link-list">
                            <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                        </ul>
                    </div>
                </div> --}}<!-- .nk-sidebar-widget -->
                <div class="nk-sidebar-menu">
                    <ul class="nk-menu">
                        <li class="nk-menu-item">
                            <a href="{{ route('home') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                                <span class="nk-menu-text">Home</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                        @can('viewPage', (new \App\Models\Contact))
                       <li class="nk-menu-item">
                            <a href="{{ route('contacts.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                <span class="nk-menu-text">Contacts</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                        @endcan
                        @can('viewPage', (new \App\Models\Request))
                        <li class="nk-menu-item" style="display: none">
                            <a href="{{ route('requests.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-inbox-fill"></em></span>
                                <span class="nk-menu-text">Requests</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                        @endcan
                        @can('viewPage', (new \App\Models\Leads))
                        <li class="nk-menu-item">
                            <a href="{{ route('leads.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-thumbs-up"></em></span>
                                <span class="nk-menu-text">Leads</span>
                             </a>
                        </li><!-- .nk-menu-item -->
                        @endcan
                        @can('viewPage', (new \App\Models\EstimateRepository))
                        <li class="nk-menu-item">
                            <a href="{{ URL::route('estimate-reps.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-coin-alt-fill"></em></span>
                                <span class="nk-menu-text">Estimates</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', (new \App\Models\EstimateTemplateRepository))
                        <li class="nk-menu-item">
                        <a href="{{ URL::route('estimate-templates.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-copy"></em></span>
                                <span class="nk-menu-text">Estimate Templates</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', (new \App\Models\Project))
                        <li class="nk-menu-item">
                            <a href="{{ route('projects.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>
                                <span class="nk-menu-text">Projects</span>
                             </a>
                        </li>
                        @endcan
{{--                        todo change logic!!! temp! --}}
                        @if(optional(\Auth::user())->is_lead)
                            <li class="nk-menu-item">
                                <a href="{{ route('documents.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-folder-list"></em></span>
                                    <span class="nk-menu-text">Documents</span>
                                </a>
                            </li>
                        @endif
{{--                        todo change logic!!! temp!--}}
                        @if(optional(\Auth::user())->is_lead)
                            <li class="nk-menu-item">
                                <a href="{{ route('attachments.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-download-cloud"></em></span>
                                    <span class="nk-menu-text">Attachments</span>
                                </a>
                            </li>
                        @endif
                        @can('viewPage', (new \App\Models\SubContractors))
                        <li class="nk-menu-item">
                            <a href="{{ route('subcontractors.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-truck"></em></span>
                                <span class="nk-menu-text">Subcontractors</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                        @endcan
                        @can('viewPage', (new \App\Models\GeneralContractors))
                        <li class="nk-menu-item">
                            <a href="{{ route('general-contractors.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-building-fill"></em></span>
                                <span class="nk-menu-text">General Contractors</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', [\Auth::user(),'call_center'])
                        <li class="nk-menu-item">
                            <a href="javascript:void(0);" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-call-fill"></em></span>
                                <span class="nk-menu-text">Call Center</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', (new \App\Models\Question))
                        <li class="nk-menu-item">
                            <a href="{{ route('questions.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-help-fill"></em></span>
                                <span class="nk-menu-text">Questions</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', [\Auth::user(), 'events'])
                        <li class="nk-menu-item">
                            <a href="javascript:void(0);" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-calender-date"></em></span>
                                <span class="nk-menu-text">Events</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', [\Auth::user(), 'email'])
                        <li class="nk-menu-item">
                            <a href="javascript:void(0);" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-mail-fill"></em></span>
                                <span class="nk-menu-text">Email</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', [\Auth::user(), 'workers'])
                        <li class="nk-menu-item">
                            <a href="{{ route('workers.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-user-check-fill"></em></span>
                                <span class="nk-menu-text">Workers</span>
                             </a>
                        </li>
                        @endcan
                        @can('viewPage', (new \App\Models\Task))
                        <li class="nk-menu-item">
                            <a href="{{ route('task.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-check-thick"></em></span>
                                <span class="nk-menu-text">Tasks</span>
                             </a>
                        </li>
                        @endcan
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Settings</h6>
                        </li>
                        @can('viewPage', [\Auth::user(), 'account_settings'])
                        <li class="nk-menu-item">
                            <a href="{{ url('account-setting') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span>
                                <span class="nk-menu-text">Account Settings</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewPage', [\Auth::user(), 'user_roles'])
                        <li class="nk-menu-item">
                            <a href="{{ route('user-role.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                <span class="nk-menu-text">User Roles</span>
                            </a>
                        </li>
                        @endcan
                        @can('viewPage', [\Auth::user(), 'admin_settings'])
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
                        @endcan
                    </ul><!-- .nk-menu -->
                </div><!-- .nk-sidebar-menu -->
            </div><!-- .nk-sidebar-contnet -->
        </div><!-- .nk-sidebar-body -->
    </div><!-- .nk-sidebar-element -->
</div>
