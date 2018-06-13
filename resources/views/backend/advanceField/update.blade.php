@extends('backend.layouts.app')

@section('title')
    Update Advance Field id#{{ $data['id'] }}
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
                <small>Update</small>
            </h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-blue-haze">
                                <i class="icon-settings font-blue-haze"></i>
                                <span class="caption-subject bold uppercase"> Update field #{{ $data['id'] }}</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                                   data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ route('advanceField.update', ['advanceField' => $data['id']]) }}" class="form-horizontal" role="form"
                                  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-body">

                                    @include('backend.blocks.errors')

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Field Label</label>
                                        <div class="col-md-9">
                                            <input type="text" name="label" value="{{ $data['label'] or '' }}" class="form-control"
                                                   placeholder="This is the name which will appear on the EDIT page"
                                                   required/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Field Name</label>
                                        <div class="col-md-9">
                                            <input name="key" value="{{ $data['key'] or '' }}" type="text" class="form-control"
                                                   placeholder="Single word, no spaces. Underscores and dashes allowed" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Field Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type">
                                                <option value="0">Select...</option>
                                                <option value="text" @if ($option->input_type == "text") selected @endif>Text</option>
                                                <option value="textarea" @if ($option->input_type == "textarea") selected @endif>Text Area</option>
                                                <option value="email" @if ($option->input_type == "email") selected @endif>Email</option>
                                                <option value="image" @if ($option->input_type == "image") selected @endif>Image</option>
                                                <option value="editor" @if ($option->input_type == "editor") selected @endif>Editor</option>
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
                                                            <option value="post_type" @if ($option->apply_for == "post_type") selected @endif>Post type</option>
                                                            <option value="post_category" @if ($option->apply_for == "post_category") selected @endif>Post category</option>
                                                        </optgroup>
                                                        <optgroup label="Product">
                                                            <option value="product_type" @if ($option->apply_for == "product_type") selected @endif>Product type</option>
                                                            <option value="product_catalog" @if ($option->apply_for == "product_catalog") selected @endif>Product catalog</option>
                                                        </optgroup>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <select class="form-control" name="rule_equal" id="rule-equal">
                                                        <option value="1" @if ($option->apply_operator == "1") selected @endif>is equal to</option>
                                                        <option value="0" @if ($option->apply_operator == "0") selected @endif>is not equal to</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-control" name="rule_condition" id="rule-condition">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
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
            getOption($('#rule-type').val(), '{{ $option->apply_condition }}');

            $('#rule-type').change(function() {
                var value = $(this).val();
                getOption(value, '');
            });

            function getOption(value, checked) {
                if(value == "post_category") {
                    $.ajax({
                        url : "{{ route('api.getCate') }}",
                        type : "get",
                        dataType:"text",
                        data : "type=category&&id=" + checked,
                        success : function (result){
                            option = result;
                            $('#rule-condition').html('').append(option);
                        }
                    });
                } else if (value == "product_type") {
                    var option = '<option value="1">All Products</option>';
                    $('#rule-condition').html('').append(option);
                } else if (value == "post_type") {
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
                        data : "type=catalog&&id=" + checked,
                        success : function (result){
                            option = result;
                            $('#rule-condition').html('').append(option);
                        }
                    });
                }
            }
        });
    </script>
@endsection