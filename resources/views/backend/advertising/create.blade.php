@extends('backend.layouts.app')

@section('title', 'Create Advertising')

@section('pageId', 'create-update-advertising')

@section('breadcrumbs')
    <a href="{{ route('advertising.index') }}">Users</a>
    <i class="fa fa-circle"></i>
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
                        <a href="{{ route('advertising.index') }}">Advertising</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>
            <h3 class="page-title"> Manage Advertising
                <small>All</small>
            </h3>

            <div class="row">

                <div class="col-md-12">

                    <div class="portlet box blue">

                        @include('backend.common.pageHeading')

                        <div class="portlet-body form">

                            @include('backend.blocks.message')

                            <form action="{{ route('advertising.store') }}" class="form-horizontal form-row-seperated"
                                  role="form"
                                  method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                @include('backend.blocks.errors')

                                @include('backend.advertising.partial._form')

                                @include('backend.common.actionForm')

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css" xmlns="http://www.w3.org/1999/html"/>
    <link href="{{ asset('/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/css/fileinput.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection

@section('footer')
    <script src="{{ asset('/admin/assets/global/plugins/select2/js/select2.full.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/fileinput.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/piexif.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/js/app.js') }}" type="text/javascript"></script>
@endsection