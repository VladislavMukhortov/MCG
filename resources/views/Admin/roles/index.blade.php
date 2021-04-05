<x-app-layout>
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Role Lists</h3>
            <div class="nk-block-des text-soft">
                <p></p>
            </div>
        </div>
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                    <em class="icon ni ni-menu-alt-r"></em>
                </a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                       <li class="nk-block-tools-opt">
                            <div class="drodown">
                                <a href="{{ URL::route('roles.create') }}" class=" btn btn-primary save-permissions">
                                   Save Permissions
                                </a>
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
                <ul class="nav nav-tabs">
                    @foreach($roles as $role)
                        <li class="nav-item">
                        <a class="nav-link {{ $loop->iteration ==1 ? 'active':'' }}" 
                            data-toggle="tab" href="#tabItem{{ $loop->iteration }}">
                            {{ $role->name }}
                            
                        </a>
                        </li>
                    @endforeach
                   
                </ul>
                <div class="tab-content">
                    @foreach($roles as $role)
                <div class="tab-pane {{ $loop->iteration ==1 ? 'active':'' }}" id="tabItem{{ $loop->iteration }}">
                          <form class="permissions-tree{{ $loop->iteration }}" method="POST" action="{{ URL::route('roles.update',['role'=>$role->id]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permissions" class="assigned_permissions">
                            <div class="jstree">
                               
                                <ul>
                                  <li id="users.index">Users
                                    <ul>
                                     <li id="users.create" value="users.create">Create</li>
                                      <li id="users.edit">Edit</li>
                                      <li id="users.delete">Delete</li>
                                    </ul>
                                  </li>
                                
                                </ul>
                              </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div><!-- .card-inner -->
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
   
</div><!-- .nk-block -->
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
    $(document).ready(function(){
        $('.jstree').jstree({
            "plugins" : [ "wholerow", "checkbox" ]
            });

        $(document).on('click','.save-permissions', function(e){
            e.preventDefault();
            const form=$('.tab-pane.active form');
            var permissions= $(".jstree").jstree("get_checked",null,true);
            $(form).find('.assigned_permissions').val(permissions.join(','));
            $(form).submit();
            
            
        });
    });
</script>
@endpush
</x-app-layout>
