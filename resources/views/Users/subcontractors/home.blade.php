@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    Home
@endsection

{{-- Page CSS --}}
@push('css')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endpush

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Home</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="w-full py-4" style="margin-left: 0px !important;">
        <div class="flex">
                @foreach(\App\Models\SubcontractorStatus::getStatusNames() as $key => $statusName)
                @php($statusName = \Str::of($statusName)->replace('_', ' ')->title()->__toString())

                    <div class="w-1/4">
                        <div class="relative mb-2">
                            @if (!$loop->first)
                                <div class="absolute flex align-center items-center align-middle content-center"
                                     style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                    <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                        <div class="w-0 bg-{{ $key > $subcontractor->status_id ? 'yellow' : 'green'}}-300 py-1 rounded" style="width: 100%;"></div>
                                    </div>
                                </div>
                            @endif
                            <div class="w-10 h-10 mx-auto bg-{{ $key > $subcontractor->status_id ? 'yellow' : 'green'}}-500 rounded-full text-lg text-white flex items-center">
                                  <span class="text-center text-white w-full">
                                  @if(($key > $subcontractor->status_id))
                                          <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                      <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                    </svg>
                                          {{--                                    <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"--}}
                                          {{--                                         height="24">--}}
                                          {{--                                      <path class="heroicon-ui"--}}
                                          {{--                                            d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm14 8V5H5v6h14zm0 2H5v6h14v-6zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>--}}
                                          {{--                                    </svg>--}}
                                      @else
                                          <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                      <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                    </svg>
                                      @endif
                                  </span>
                            </div>
                        </div>
                        <div class="text-xs text-center md:text-base">{{ $statusName }}</div>
                    </div>
                @endforeach
        </div>
    </div>

    <div class="col-xxl-12 mt-2">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-title-group align-start gx-3">
                    <div class="card-title" style="margin-top:15px;">
                        <h4 class="title"><em class="icon ni ni-info"></em> My Info</h4>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-inner">
                            <div class="nk-block">
                                <div class="profile-ud-list">
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Company Name</span>
                                            <span class="profile-ud-value">{{ $subcontractor->company_name }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Phone</span>
                                            <span class="profile-ud-value">{{ $subcontractor->phone }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Type</span>
                                            <span class="profile-ud-value">{{ $subcontractor->type }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Status</span>
                                            <span class="profile-ud-value">{{ $subcontractor->status_name }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Worker's Compensation</span>
                                            <span class="profile-ud-value">{{  $subcontractor->workers_compensation }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">General Liability</span>
                                            <span class="profile-ud-value">{{ $subcontractor->general_liability }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Has Tools</span>
                                            <span class="profile-ud-value">{{  $subcontractor->has_tools }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Primary Contact Name</span>
                                            <span class="profile-ud-value">{{  $subcontractor->name }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Address</span>
                                            <span class="profile-ud-value">{{ $subcontractor->address }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Licensed</span>
                                            <span class="profile-ud-value">{{ $subcontractor->licensed }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Crew Size</span>
                                            <span class="profile-ud-value">{{ $subcontractor->crew_size }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Has Vehicle</span>
                                            <span class="profile-ud-value">{{ $subcontractor->has_vehicle }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Email</span>
                                            <span class="profile-ud-value">{{ optional($subcontractor->user)->email }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Website</span>
                                            <span class="profile-ud-value">
                                                <a href="{{ $subcontractor->website }}" target="_blank">{{ $subcontractor->website_domain_name }}</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Languages</span>
                                            <span class="profile-ud-value">{{ $subcontractor->languages }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Entity Type</span>
                                            <span class="profile-ud-value">{{ $subcontractor->entity_type }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Driver's License</span>
                                            <span class="profile-ud-value">{{ $subcontractor->drivers_license }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Years of Experience</span>
                                            <span class="profile-ud-value">{{ $subcontractor->years_of_experience }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-12 mt-5">
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="card-head">
                        <h5 class="card-title">Pending Documents</h5>
                    </div>

                    <table class="datatable-init table">
                        <thead>
                            <hr />
                        </thead>
                        <tbody>
                        @foreach($subcontractor->pendingDocuments as $pendingDocument)
                            @include('Users.subcontractors.partials._document_item', ['item' => $pendingDocument])
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- .card-preview -->
        </div> <!-- nk-block -->
    </div>
@endsection

@push('js')

@endpush