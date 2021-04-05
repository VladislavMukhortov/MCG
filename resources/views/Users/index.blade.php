    @extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
User Roles
@endsection

{{-- Page CSS --}}
@section('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">User Roles
</h3>
            
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>Add User Roles</span></a></li>
                         
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
                <h5 class="modal-title">Add User Roles</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('user-role.store') }}" method="post"  class="form-validate user-roles-create">
                    @csrf
                    <input type="hidden" name="permissions" class="permissions-tree"/>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">User Role Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="title" placeholder="User Role Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="jstree">
                                @include('Users.permission-tree')
                            </div>
                        </div>
                         
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary save-permissions">Submit</button>
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
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Roles</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$user->title}}</td>
                        <td>
                            <a href="{{ route('user-role.show', $user->id) }}"  >
                                <em class="icon ni ni-eye-alt text-primary fs-17px"></em> / 
                                <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em>
                            </a>
                        </td>
                        <td>
                          
                            <a href="{{ route('user-role.destroy', $user->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$user->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('user-role.destroy', $user->id) }}" method="post" class="d-none" id="delete_{{$user->id}}">
                                @method('delete')
                                @csrf
                            </form>
                          
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
 
@endsection

@section('page-js') 
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>--}}
{{--<script type="text/javascript">--}}
{{--     $(document).ready(function(){--}}
{{--        $('.jstree').jstree({--}}
{{--            "plugins" : [ "wholerow", "checkbox" ]--}}
{{--            });--}}

{{--        $(document).on('click','.save-permissions', function(e){--}}
{{--            e.preventDefault();--}}
{{--            const form=$('.user-roles-create');--}}
{{--            var permissions=$(".jstree").jstree("get_checked");--}}
{{--            $(form).find('.permissions-tree').val(permissions.join(','));--}}
{{--            $(form).submit();--}}
{{--            --}}
{{--            --}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
 
@endsection
