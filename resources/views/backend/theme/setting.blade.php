@extends('backend.layouts.app')

@section('title')
    Setting
@endsection

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css" xmlns="http://www.w3.org/1999/html"/>
    <link href="{{ asset('/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/css/fileinput.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Setting</span>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('setting.store') }}"
                          class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}

                        <div class="portlet">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>Setting
                                </div>
                                <div class="actions btn-set">
                                    <button type="button" name="back" class="btn btn-secondary-outline">
                                        <i class="fa fa-angle-left"></i> Back
                                    </button>
                                    <button class="btn btn-secondary-outline" type="reset">
                                        <i class="fa fa-reply"></i> Reset
                                    </button>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                </div>
                            </div>
                            <div class="portlet-body">

                                @include('backend.blocks.message')

                                <div class="tabbable-bordered">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_general" data-toggle="tab"> General </a>
                                        </li>
                                        <li>
                                            <a href="#tab_meta" data-toggle="tab"> Meta Tag </a>
                                        </li>
                                        <li>
                                            <a href="#tab_infor" data-toggle="tab"> Information </a>
                                        </li>
                                        <li>
                                            <a href="#tab_social" data-toggle="tab"> Social & Google Tool </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_general">
                                            @include("backend.theme._tab_general", ['option' => $option])
                                        </div>
                                        <div class="tab-pane" id="tab_meta">
                                            @include("backend.theme._tab_meta", ['option' => $option])
                                        </div>
                                        <div class="tab-pane" id="tab_infor">
                                            @include("backend.theme._tab_infor", ['option' => $option])
                                        </div>
                                        <div class="tab-pane" id="tab_social">
                                            @include("backend.theme._tab_social", ['option' => $option])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('/admin/assets/global/plugins/select2/js/select2.full.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

    <script src="{{ asset('/admin/assets/global/plugins/fileinput.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/piexif.min.js') }}"
            type="text/javascript"></script>

    <script type="text/javascript">
        setImagePreview.init('company_logo', '/administrator/setting/file-delete', 'company_logo');
        setImagePreview.init('favico', '/administrator/setting/file-delete', 'favico');
    </script>
@endsection