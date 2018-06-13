@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title')
    Create Custom Field
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
                        <a href="{{ route('advanceField.index') }}">Custom Field</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Custom Field
                <small>Create</small>
            </h3>

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-blue-haze">
                                <i class="icon-settings font-blue-haze"></i>
                                <span class="caption-subject bold uppercase"> Create Custom Field</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                                   data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ route('advanceField.store') }}" class="form-horizontal" role="form"
                                  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">

                                    @include('backend.blocks.errors')

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Field Label</label>
                                        <div class="col-md-9">
                                            <input type="text" name="label" class="form-control"
                                                   placeholder="This is the name which will appear on the EDIT page"
                                                   required/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Field Name</label>
                                        <div class="col-md-9">
                                            <input name="key" type="text" class="form-control"
                                                   placeholder="Single word, no spaces. Underscores and dashes allowed" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Field Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type">
                                                <option value="0">Select...</option>
                                                <option value="text">Text</option>
                                                <option value="textarea">Text Area</option>
                                                <option value="email">Email</option>
                                                <option value="image">Image</option>
                                                <option value="editor">Editor</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Rule</label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <select class="form-control" name="rule_type" id="rule-type">
                                                        <optgroup label="Post">
                                                            <option value="post_type" selected>Post type</option>
                                                            <option value="post_category">Post Category</option>
                                                        </optgroup>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <select class="form-control" name="rule_equal" id="rule-equal">
                                                        <option value="1">is equal to</option>
                                                        <option value="0">is not equal to</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-control" name="rule_condition" id="rule-condition">
                                                        @foreach($post_type as $i)
                                                            <option value='{{ $i->id }}'>{{ $i->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn blue">Submit</button>
                                        </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#rule-type').change(function() {
                var option, value;
                value = $(this).val();

                if(value === "post_category") {
                    $.ajax({
                        url : "{{ route('api.getCate') }}",
                        type : "get",
                        dataType:"text",
                        data : "type=category",
                        success : function (result){
                            option = result;
                            $('#rule-condition').html('').append(option);
                        }
                    });
                } else if (value === "product_type") {
                    option = '<option value="1">All Products</option>';
                    $('#rule-condition').html('').append(option);
                } else if (value === "post_type") {
                    $.ajax({
                        url: "{{ route('systemLinkType.getPostType') }}",
                        type: "get",
                        dataType:"html",
                        success: function (result) {
                            option = JSON.parse(result).data;
                            $('#rule-condition').html('').append(option);
                        }
                    });
                } else {
                    $.ajax({
                        url : "{{ route('api.getCate') }}",
                        type : "get",
                        dataType:"text",
                        data : "type=catalog",
                        success : function (result){
                            option = result;
                            $('#rule-condition').html('').append(option);
                        }
                    });
                }
            });
        });
    </script>
@endsection