@extends('layouts.master')

{{-- Page Title --}}
@section('page-title') 
Contacts
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Contacts</h3>
            
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content mt-4">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                         
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTop"><em class="icon ni ni-plus-sm"></em><span>New Contact</span></a></li>
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
                <h5 class="modal-title">New Contact</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
             
                <form action="{{ route('contacts.store') }}" method="post" id="contactForm">
                    @csrf
                         <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name<span style="color: #ff0000"> *</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="first" placeholder="First" id="first">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label mt-3" for="name"></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="last" placeholder="Last" id="last">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control"  id="email" placeholder="abc@gmail.com" name="email">
                                    </div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Phone<span style="color: #ff0000"> *</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="phone" placeholder="Enter a phone" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="address">Address</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="address" placeholder="Enter a location" name="address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="street-address">Street Address</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="street-address" placeholder="Enter a street address" name="street">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="state">State<span style="color: #ff0000"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-control" id="state" name="state">
                                            @foreach($states as $state)
                                                <option value="{{ $state }}">
                                                    {{ $state }}
                                                </option>
                                            @endforeach
                                        </select>
{{--                                        <input type="text" class="form-control" id="state" placeholder="Enter a state" name="state">--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="city">City</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="city" placeholder="Enter a city" name="city">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="zip">Zip</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="zip" placeholder="Enter a zip" name="zip">
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
                <h5 class="card-title">My Contacts</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="text-muted">View / Edit</th>
                        <th class="text-muted">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name . ' ' . $contact->last_name }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $fullAddress[$contact->id] }}</td>
                        <td><a href="{{ route('contacts.show', $contact->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                        <td>
                            <a href="{{ route('contacts.destroy', $contact->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$contact->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="post" class="d-none" id="delete_{{$contact->id}}">
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

<div class="nk-block nk-block-lg">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">All Contacts</h5>
            </div>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="text-muted">View / Edit</th>
                        <th class="text-muted">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getcontacts as $getcontact)
                    <tr>
                        <td>{{ $getcontact->name . ' ' . $getcontact->last_name }}</td>
                        <td>{{ $getcontact->phone }}</td>
                        <td>{{ $getcontact->email }}</td>
                        <td>{{ $fullAddress[$getcontact->id] }}</td>
                         
                        <td><a href="{{ route('contacts.show', $getcontact->id) }}"><em class="icon ni ni-eye-alt text-primary fs-17px"></em> / <em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a></td>
                        <td>
                            <a href="{{ route('contacts.destroy', $getcontact->id) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$getcontact->id}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                            <form action="{{ route('contacts.destroy', $getcontact->id) }}" method="post" class="d-none" id="delete_{{$getcontact->id}}">
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
    <script type="text/javascript" src="{{ asset('js/contact/contact-validate.js') }}"></script>
@endsection