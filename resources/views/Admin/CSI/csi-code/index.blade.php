@extends('layouts.master')

{{-- Page Title --}}
@section('page-title')
    CSI Codes
@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">CSI Codes</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
{{--                            <li class="nk-block-tools-opt">--}}
{{--                                <a href="{{ URL::route('csi-code.create') }}" class="btn btn-primary add_new_csi_code just-new-one">--}}
{{--                                    <em class="icon ni ni-plus-sm"></em><span>New CSI Code</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="nk-block-tools-opt">
                                <a href="" class="btn btn-primary add_new_csi_code new-1"
                                   data-toggle="modal"
                                   data-target="#modalNewCsi">
                                    <em class="icon ni ni-plus-sm"></em><span>New CSI Code</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="" class="btn btn-primary add_new_csi_code new-1"
                                   data-toggle="modal"
                                   data-target="#modalNewLvl1">
                                        <em class="icon ni ni-reports"></em><span>New CSI lvl1 </span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="" class="btn btn-primary add_new_csi_code new-2"
                                   data-toggle="modal"
                                   data-target="#modalNewLvl2">
                                    <em class="icon ni ni-reports"></em><span>New CSI lvl2 </span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="" class="btn btn-primary add_new_csi_code new-3"
                                   data-toggle="modal"
                                   data-target="#modalNewLvl3">
                                    <em class="icon ni ni-reports"></em><span>New CSI lvl3 </span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="" class="btn btn-primary add_new_csi_code new-4"
                                   data-toggle="modal"
                                   data-target="#modalNewLvl4">
                                    <em class="icon ni ni-reports"></em><span>New CSI lvl4 </span>
                                </a>
                            </li>
{{--                                <li class="nk-block-tools-opt">--}}
{{--                                    <a href="" class="btn btn-primary add_new_csi_code new-"--}}
{{--                                       data-toggle="modal"--}}
{{--                                       data-target="#modalTop">--}}
{{--                                       style="{{ !$loop->first ? $levels->get($index-1)->categories->count() ? '' : 'pointer-events: none;' : '' }}">--}}
{{--                                        <em class="icon ni ni-reports"></em><span>New CSI </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                        </ul>
                    </div>
                </div>

            </div><!-- .nk-block-head-content -->

            <div class="nk-block nk-block-lg">

            </div>

        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">CSI Codes</h5>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    В будущем сделать нормальный фронт, с vue компонентом и рекурсией--}}

                        @foreach($allCsiTree as $csiTree)
                                <tr>
                                    <td>
                                        <span>{{$csiTree['name']}} @isset($csiTree['description']){{ $csiTree['description'] }}@endisset </span><br>
                                        <span style="margin-left: 20px">{{$csiTree['children']['name']}} @isset($csiTree['children']['description']){{ $csiTree['children']['description'] }}@endisset</span><br>
                                        <span style="margin-left: 40px">{{$csiTree['children']['children']['name']}} @isset($csiTree['children']['children']['description']){{ $csiTree['children']['children']['description'] }}@endisset </span><br>
                                        <span style="margin-left: 60px">{{$csiTree['children']['children']['children']['name']}} @isset($csiTree['children']['children']['children']['description']){{ $csiTree['children']['children']['children']['description'] }}@endisset</span><br>
                                        <span style="margin-left: 80px">{{$csiTree['children']['children']['children']['children']['name']}} @isset($csiTree['children']['children']['children']['children']['description']){{ $csiTree['children']['children']['children']['children']['description'] }}@endisset</span><br>
                                    </td>
                                    <td><a href=""
                                           data-toggle="modal"
                                           data-target="#modalEditCsi{{ $csiTree['code_id'] }}"><em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></a>
                                        @if (isset($csiTree['description']))
                                            @include('Admin.CSI.csi-code.modals.edit_csi_code', ['vlv1_name' => $csiTree['name'] . $csiTree['description']])
                                        @else
                                            @include('Admin.CSI.csi-code.modals.edit_csi_code')
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('csi-code.destroy', $csiTree['code_id']) }}" onclick="event.preventDefault(); document.getElementById('delete_{{$csiTree['code_id']}}').submit();"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></a>
                                        <form action="{{ route('csi-code.destroy', $csiTree['code_id']) }}" method="post" class="d-none" id="delete_{{$csiTree['code_id']}}">
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


    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Level 1</h5>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    В будущем сделать нормальный фронт, с vue компонентом и рекурсией--}}

                    @foreach($level_1 as $item)
                        <tr>
                            <td>
                                {{$item->level_description}}
                            </td>
                            <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModalLevel{{$item->id}}"><em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></button>
                            @include('Admin.CSI.csi-code.modals.edit_level', ['id' => $item->id, 'level_description'=> $item->level_description, 'level_name' => $item->level_name])
                            <td>
                            <td><button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{$item->id}}"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></button></a>
                            @include('Admin.CSI.csi-code.modals.delete-confirm', ['id' => $item->id])
                            </td>
                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Level 2</h5>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    В будущем сделать нормальный фронт, с vue компонентом и рекурсией--}}

                    @foreach($level_2 as $item)
                        <tr>
                            <td>
                                {{$item->level_description}}
                            </td>
                            <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModalLevel{{$item->id}}"><em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></button>
                            @include('Admin.CSI.csi-code.modals.edit_level', ['id' => $item->id, 'level_description'=> $item->level_description, 'level_name' => $item->level_name])
                            <td>
                            <td><button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{$item->id}}"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></button></a>
                                @include('Admin.CSI.csi-code.modals.delete-confirm', ['id' => $item->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Level 3</h5>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    В будущем сделать нормальный фронт, с vue компонентом и рекурсией--}}

                    @foreach($level_3 as $item)
                        <tr>
                            <td>
                                {{$item->level_description}}
                            </td>
                            <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModalLevel{{$item->id}}"><em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></button>
                            @include('Admin.CSI.csi-code.modals.edit_level', ['id' => $item->id, 'level_description'=> $item->level_description, 'level_name' => $item->level_name])
                            <td>
                            <td><button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{$item->id}}"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></button></a>
                                @include('Admin.CSI.csi-code.modals.delete-confirm', ['id' => $item->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Level 4</h5>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    В будущем сделать нормальный фронт, с vue компонентом и рекурсией--}}

                    @foreach($level_4 as $item)
                        <tr>
                            <td>
                                {{$item->level_description}}
                            </td>
                            <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModalLevel{{$item->id}}"><em class="icon ni ni-edit-alt-fill text-primary fs-17px"></em></button>
                            @include('Admin.CSI.csi-code.modals.edit_level', ['id' => $item->id, 'level_description'=> $item->level_description, 'level_name' => $item->level_name])
                            <td>
                            <td><button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{$item->id}}"><em class="icon ni ni-trash-fill text-danger fs-17px"></em></button></a>
                                @include('Admin.CSI.csi-code.modals.delete-confirm', ['id' => $item->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>




    @include('Admin.CSI.csi-code.modals.csi_level_1')
    @include('Admin.CSI.csi-code.modals.csi_level_2')
    @include('Admin.CSI.csi-code.modals.csi_level_3')
    @include('Admin.CSI.csi-code.modals.csi_level_4')
    @include('Admin.CSI.csi-code.modals.add_csi_code')
@endsection

{{-- Page JS --}}
@section('page-js')
    <script type="text/javascript" src="{{ asset('js/csi/level_3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/csi/level_4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/csi/csi_code.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/csi/csi_code_edit.js') }}"></script>--}}
{{--    @include('Admin.CSI.csi-code.templates.csicodes_edit_modal_template')--}}
{{--    @include('Admin.CSI.csi-code.templates.csicodes_edit_modal_component_template')--}}
{{--    @include('Admin.CSI.csi-code.templates.csicodes_edit_form_select')--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/attachments/validation-errors.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/csicodes/csicodes.js') }}"></script>--}}
@endsection
