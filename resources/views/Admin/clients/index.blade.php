<x-app-layout>

    @section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Clients Lists</h3>
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
                                <a href="{{ URL::route('clients.create') }}" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                    
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
                <div class="card-inner position-relative card-tools-toggle">
                    <div class="card-title-group">
                       
                    </div><!-- .card-title-group -->
                  
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">  
                                
                                <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Email</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Instagram User</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone Number</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_clients as $client)
                                <tr class="nk-tb-item">
                                    
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                            <span>{{ $client->contact->initials() }}</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="tb-lead">{{ $client->contact->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                            <span>{{ $client->contact->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                 
                                    <td class="nk-tb-col tb-col-md">
                                        <span class="">{{ $client->contact->email }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span class="">{{ $client->contact->insta_user_name }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span class="">{{ $client->contact->phonenumber }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span class="">{{ $client->contact->address }}</span>
                                    </td>
                                    
                                  
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{ URL::route('contacts.edit',['contact'=>$client->id]) }}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                            <li><a href="{{ URL::route('contacts.delete',['contact'=>$client->id]) }}"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                        </tbody>
                    </table>
                
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
       
    </div><!-- .nk-block -->
    
    </x-app-layout>
    