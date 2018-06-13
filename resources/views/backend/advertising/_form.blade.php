<div class="form-group">
    <label class="control-label col-md-3">Name</label>
    <div class="col-md-4">
        <input name="name" value="{{ $ads['name'] or old('name') }}" class="form-control"
               required/></div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Code</label>
    <div class="col-md-4">
        <textarea name="code" rows="10" class="form-control">{{ $ads['code'] or old('code') }}</textarea>
    </div>
</div>

<?php $is_mobile = isset($ads) ? $ads['is_mobile'] : old('is_mobile'); ?>
<div class="form-group">
    <label class="control-label col-md-3">Show</label>
    <div class="col-md-4">
        <select class="form-control" name="is_mobile" id="is-mobile">
            <option value="0" @if($is_mobile == '0') selected @endif>PC</option>
            <option value="1" @if($is_mobile == '1') selected @endif>Mobile</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Location</label>
    <div class="col-md-4">
        @if(isset($ads) && $ads['location'])
            <input type="text" class="form-control" disabled="disabled" value="{{ $ads->getLocation() }}">
        @else
            <select class="form-control" name="location" id="location">
                <option value="10">Auto</option>
            </select>
        @endif
    </div>
</div>

@section('footer')
    <script type="text/javascript">
        $(function () {
            $('#is-mobile').on('change', function () {
                if($(this).val() == '0') {
                    $('#location').html('');
                    $('#location').html('<option value="10">Auto</option>');
                } else {
                    $('#location').html('');
                    $('#location').html('<option value="1">Sau Menu</option>\n' +
                        '            <option value="2">Sau mục Download (Trang chi tiết)</option>\n' +
                        '            <option value="3">Sau Description (Trang chi tiết)</option>\n' +
                        '            <option value="4">Sau Content (Trang chi tiết)</option>\n' +
                        '            <option value="5">Sau Bài viết liên quan (Trang chi tiết)</option>\n' +
                        '            <option value="6">Sau Bài viết nổi bật (Trang chi tiết)</option>\n' +
                        '            <option value="7">Sau Bài viết mới (Trang chủ)</option>\n' +
                        '            <option value="8">Sau Bài viết nổi bật (Trang chủ)</option>\n' +
                        '            <option value="9">Luôn hiển thị dưới cùng</option>');
                }
            });
        });
    </script>
@endsection