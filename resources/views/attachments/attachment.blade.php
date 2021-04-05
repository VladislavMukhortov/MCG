@extends('layouts.attachment')

{{-- Page Title --}}
@section('page-title')
    Requests

@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
<form action="{{ route('attachment-create', $id) }}" method="post" class="form-validate" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        @if ($errors->attachment->all())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->attachment->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="default-06">Upload existing condition</label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" multiple class="custom-file-input" id="customFile" name="condition">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="default-06">Upload concept photo</label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" multiple class="custom-file-input" id="customFile" name="concept">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" for="default-06">Upload floor plan</label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" multiple class="custom-file-input" id="customFile" name="plan">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
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



@endsection

@section('page-js')


@endsection
