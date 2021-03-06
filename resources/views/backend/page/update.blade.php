@extends('backend.layouts.app')

@section('title')
    Update Page
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
                        <a href="{{ route('post.index') }}">Page</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Update</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Pages</h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-mint sbold">Update Page</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <form action="{{ route('page.update', ['page' => $page['id']]) }}" class="horizontal-form" role="form"
                                  method="post" enctype="multipart/form-data" id="page-update-form">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-body">
                                    <div class="row">

                                        @include('backend.blocks.errors')

                                        @include('backend.page.form')
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
        setImagePreview.init('image', '/api/posts/file-delete');
    </script>
@endsection