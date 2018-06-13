<div class="form-group">
    <label class="control-label col-md-3">Name</label>
    <div class="col-md-4">
        <input name="name" value="{{ $category['name'] or old('name') }}" class="form-control"
               placeholder="Enter your category name" required/></div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Slug</label>
    <div class="col-md-4">
        <input name="slug" value="{{ $category['slug'] or old('slug') }}" class="form-control"
               placeholder="Enter your category slug"></div>
</div>

<?php $parent = isset($category) ? $category['parent_id'] : old('parent_id'); ?>
<div class="form-group">
    <label class="control-label col-md-3">Parent</label>
    <div class="col-md-4">
        <select class="form-control" name="parent_id">
            <option value=''>Select...</option>
            <?php setMultiCategorySelect($data, $parent) ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputFile" class="col-md-3 control-label">Image</label>
    <div class="col-md-4">
        <input type="file" id="image" name="image">
        <p class="help-block"> Your category image. </p>

        @if(!empty($category['image']))
            <br />
            <img src="{{ asset($category['image']) }}" width="110" />
            <input type="hidden" name="old_image" value="{{ $category['image'] }}" />
        @endif
    </div>
</div>

<?php $type = isset($category) ? $category['system_link_type_id'] : old('type') ?>
<div class="form-group">
    <label class="control-label col-md-3">Type</label>
    <div class="col-md-4">
        @if(!empty($post_type))
            <select class="form-control" name="type">
                @foreach($post_type as $itemOfType)
                    <option value="{{ $itemOfType->id }}" @if($itemOfType->id == $type) selected @endif>{{ $itemOfType->name }}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Meta title</label>
    <div class="col-md-4">
        <input type="text" value="{{ $category['meta_title'] or old('meta_title') }}" name="meta_title" class="form-control"
               placeholder="Enter your category meta_title"></div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Meta description</label>
    <div class="col-md-4">
        <input value="{{ $category['meta_description'] or old('meta_description') }}" name="meta_description" class="form-control"
               placeholder="Enter your category meta_description"></div>
</div>

<?php $status = isset($category) ? $category['status'] : (old('status') ? old('status') : 1) ?>
<div class="form-group">
    <label class="control-label col-md-3">Status</label>
    <div class="col-md-4">
        <select class="form-control" name="status">
            <option value="0" @if($status === 0) selected @endif>No</option>
            <option value="1" @if($status === 1) selected @endif>Approved</option>
        </select>
    </div>
</div>