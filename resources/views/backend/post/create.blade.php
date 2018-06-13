@extends('backend.layouts.app')

@section('title')
    Create Post
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
                        <a href="{{ route('post.index') }}">Post</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Create</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Posts</h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-mint sbold">Create Post</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <form action="{{ route('post.store') }}" class="horizontal-form" role="form"
                                  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-body">
                                    <div class="row">

                                        @include('backend.blocks.errors')

                                        @include('backend.post.form')
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
        $("#image").fileinput({
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