@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Requests
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Requests</h3>
            
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content mt-4">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>New Request</span></a></li>
                        
                         
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->

    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Request</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('requests.store') }}" method="post" class="form-validate">
                    @csrf
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Contact<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on" name="contact" id="contact" required>
                                            <option selected disabled>Type to search</option>
                                            @foreach($contactslist as $id => $contactname)
                                            <option value="{{ $contactname->id }}">
                                            {{ $contactname->display_name }}</option>

                                            @endforeach
                                             
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Created Date</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-calendar-alt"></em>
                                        </div>
                                        <input type="text" class="form-control date-picker" name="date" placeholder="mm/dd/yyyy">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Created Time</label>
                                    <div class="form-control-wrap">
                                        <input type="time" class="form-control" placeholder="Input placeholder" name="time">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="cf-default-textarea">Request Information</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder=" " name="request_information"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
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
            <div class="card-head">
                <h5 class="card-title">My Requests</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Request Information</th>
                        <th>Status</th>
                        <th>View / Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>@isset($request->contacts->display_name){{ $request->contacts->display_name }}@endisset</td>
                        <td>@isset($request->contacts->display_name){{ $request->contacts->email }}@endisset</td>
                        <td>@isset($request->contacts->display_name){{ $request->request_information }}@endisset</td>
                        <td>
                            @if($request->status == 1)
                                New
                            @elseif($request->status == 2)
                                No Answer
                            @elseif($request->status == 3)
                                Spoke
                            @elseif($request->status == 4)
                                Unqualified
                            @elseif($request->status == 5)
                                Qualified
                            @elseif($request->status == 6)
                                Attachments Uploaded
                            @elseif($request->status == 7)
                                Lead
                            @endif
                        </td>
                         
                        <td>
                            <a href="{{ route('requests.show', $request->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a>
                        </td>
                        <td>
                            @if (isset($request->leads->estimateTemplate) && $request->leads->estimateTemplate->count())
                            @else
                                <a href="{{ route('requests.destroy', $request->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$request->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                <form action="{{ route('requests.destroy', $request->id) }}" method="post" class="d-none">
                                    <input type="submit" value="Send Request">
                                    @csrf
                                </form>
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">All Requests</h5>
            </div>
            <table class="datatable-init table">
                <thead>

                    <tr>
                        <th>#</th>
                        <th>Contact</th>
                        <th>Email</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($requestslist as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>@isset($list->contacts->display_name){{ $list->contacts->display_name }}@endisset</td>
                        <td>@isset($list->contacts->email){{ $list->contacts->email }}@endisset</td>
                         
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

 
 
</div>


@endsection

@section('page-js')
    <script type="text/javascript" src="{{ asset('js/contact/contact.js') }}"></script> 
@endsection
    