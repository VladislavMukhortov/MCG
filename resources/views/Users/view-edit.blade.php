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
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item active fs-17px"><a href="{{ route('user-role.index') }}">User Roles</a></li>
                    <li class="breadcrumb-item fs-17px">Details</li>
                </ul>
            </nav>    
        </div><!-- .nk-block-head-content -->  
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="col-xxl-6">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3 mb-3">
                <div class="card-title" style="margin-top:15px;">
                    <h6 class="title"><em class="icon ni ni-info"></em>Details</h6>
                     
                </div>
                <div class="card-tools">
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em><span><span class="d-none d-md-inline">Edit</span></a>
                        <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-edit"></em></a>
                         
                    </div>
                </div>
            </div>  
            <div class="card-inner">
                <div class="nk-block">
                    
                    <div class="profile-ud-list">
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">#</span>
                                <span class="profile-ud-value">{{$role->id}}</span>
                            </div>
                        </div>
                         
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">User Roles</span>
                                <span class="profile-ud-value">{{$role->title}}</span>
                            </div>
                        </div>
                    </div><!-- .profile-ud-list -->
                </div><!-- .nk-block -->
              </div>
        </div>
    </div>
</div>

 
 


{{-- Edit Modal --}}
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Role</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('user-role.update', $role->id) }}" method="post" class="form-validate user-roles-edit">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="permissions" class="permissions-tree"/>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">User Role Name<span style="color: red"> *</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="user_role" placeholder="First Name" value="{{ $role->title }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary update-permissions">Update</button>
                            </div>
                        </div>
                    </div>
                </form> 
                 
            </div>
             
        </div>
    </div>
</div>
   

@endsection

@section('page-js')

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>--}}
<script>
    {{--$(document).ready(function(){--}}
    {{--    $('.jstree')--}}
    {{--    .on('loaded.jstree', treeLoaded)--}}
    {{--    .jstree({--}}
    {{--        "plugins" : [ "wholerow", "checkbox" ],--}}
    {{--        "select_node":['users.create']--}}
    {{--        });--}}

    {{--    $(document).on('click','.update-permissions', function(e){--}}
    {{--        e.preventDefault();--}}
    {{--        const form=$('.user-roles-edit');--}}
    {{--        var permissions=$(".jstree").jstree("get_checked");--}}
    {{--        $(form).find('.permissions-tree').val(permissions.join(','));--}}
    {{--        $(form).submit();--}}
    {{--        --}}
    {{--        --}}
    {{--    });--}}
    {{--});--}}
    {{--function treeLoaded(event, data) {--}}
    {{-- --}}
    {{--    --}}
    {{--    data.instance.select_node(@json($role->getAbilities()->pluck('name')->toArray()));--}}
    {{--}--}}
</script>
@endsection
