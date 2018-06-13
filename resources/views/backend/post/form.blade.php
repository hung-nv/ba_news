<div class="col-md-9">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $post['name'] or old('name') }}" required/>
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $post['slug'] or old('slug') }}"/>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"
                  rows="4">{{ $post['description'] or old('description') }}</textarea>
    </div>

    <div class="form-group last">
        <label>Content</label>
        <textarea class="ckeditor form-control" name="content" rows="6"
                  data-error-container="#editor2_error">{{ $post['content'] or old('content') }}</textarea>
        <div id="editor2_error"></div>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn blue"
                        style="margin-top: 23px;">Submit
                </button>
            </div>
        </div>
    </div>

    <?php $parent = isset($post_category) ? $post_category : old('parent'); ?>

    <div class="form-group">
        <label>Select Category</label>
        <div class="mt-checkbox-list"
             data-error-container="#form_2_services_error">
            <?php setMultiCategoryCheckBox($data, $parent) ?>
        </div>
        <div id="form_2_services_error"></div>
    </div>

    <div class="form-group">
        <label>Keywords</label>
        <input type="text" name="keywords" class="form-control" value="{{ $post['keywords'] or  old('keywords') }}"/>
    </div>

    <div class="form-group">
        <label>Meta title</label>
        <input type="text" name="meta_title" class="form-control"
               value="{{ $post['meta_title'] or old('meta_title') }}"/>
    </div>

    <div class="form-group">
        <label>Meta description</label>
        <input type="text" name="meta_description" class="form-control"
               value="{{ $post['meta_description'] or old('meta_description') }}"/>
    </div>

    <div class="form-group">
        <label>Image</label>
        @if(isset($post) && $post['image'])
            <input type="hidden" name="old_image" id="old_image" data-id="{{ $post['id'] }}" value="{{ $post['image'] or '' }}">
        @endif
        <input id="image" name="image" type="file" data-show-upload="false" @if(!(isset($post) && $post['image'])) required @endif>
    </div>
</div>