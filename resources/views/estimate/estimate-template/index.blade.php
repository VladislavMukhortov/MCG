@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Estimate Templates
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Estimate Templates</h3>
        </div>
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                            <a href="javascript:;" class="btn btn-primary add-estimate-template" 
                                data-toggle="modal" data-target="#modalTop">
                                <em class="icon ni ni-plus-sm"></em>
                                <span>Add Estimate Template</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="estimateTemplateModel">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Estimate Template</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estimate-templates.store') }}" method="post" class="form-validate estimate-template-form">
                    @csrf
                <input type="hidden" name="created_by" value="{{ Auth::id() }}"/> 
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Template Name</label>
                                <div class="form-control-wrap">
                                  
                                    <input type="text" class="form-control form-control-lg" name="template_name" placeholder="Template Name">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
                 
            </div>
             <div class="modal-footer">
                 <a href="javascript:;" class="save-estimate-template btn btn-primary">
                     Save Template
                 </a>
                 <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">
                    Cancel
                 </a>
             </div>
        </div>
    </div>
</div>
<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Estimate Templates</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Template Name</th>
                        <th>Count Line Items</th>
                        <th>View / Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_templates as $template)
                    <tr>
                        <td>{{ Carbon\Carbon::parse($template->created_at)->format('Y-m-d') }}</td>
                        <td>{{ $template->user->name }}</td>
                        <td>{{ $template->template_name }}</td>
                        <td>{{ !empty($template->total)?$template->total:0 }}</td>
                        
                        <td><a href="{{ route('estimate-templates.show', $template->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                        <td>
                            <a href="{{ route('estimate-templates.destroy', $template->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$template->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('estimate-templates.destroy', $template->id) }}" method="post" class="d-none" id="delete_{{$template->id}}">
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
</div>


@endsection

@section('page-js') 
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script type="text/javascript" src="{{ asset('js/estimate-template/estimate-template.js') }}"></script>
@endsection
    