@extends('backend.layouts.app')

@section('title')
    Create Landing Page
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
                        <a href="{{ route('page.index') }}">Landing Page</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Create</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Landing Page</h3>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('page.storeLanding') }}" class="horizontal-form" role="form"
                          method="post" enctype="multipart/form-data">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-red-mint sbold">Create Landing Page</span>
                                </div>

                                <div class="actions btn-set">
                                    <button type="button" name="back" class="btn btn-secondary-outline">
                                        <i class="fa fa-angle-left"></i> Back to list
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
                                {{ csrf_field() }}

                                @include('backend.blocks.errors')

                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs nav-tabs-lg">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab" aria-expanded="true"> General </a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_2" data-toggle="tab" aria-expanded="false"> Features</a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_3" data-toggle="tab" aria-expanded="false"> About</a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_4" data-toggle="tab" aria-expanded="false"> Price</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            @include('backend.page._form_landing')
                                        </div>
                                        <div class="tab-pane" id="tab_2">
                                            @include('backend.page._meta_field')
                                        </div>
                                        <div class="tab-pane" id="tab_3">
                                            @include('backend.page._about')
                                        </div>
                                        <div class="tab-pane" id="tab_4">
                                            @include('backend.page._price')
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
        $("#feature3-image, #feature2-image, #feature1-image").fileinput({
            allowedFileExtensions: ["jpg", "png"],
            browseLabel: "Select Image",
            showCaption: false,
            autoReplace: true,
            maxFileCount: 1,
            maxFileSize: 2048,
            showClose: false
        });
    </script>
@endsection