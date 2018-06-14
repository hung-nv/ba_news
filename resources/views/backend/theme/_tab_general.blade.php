<div class="form-body">
    <?php $main_menu_id = isset($option['top_menu_id']) ? $option['top_menu_id'] : old('top_menu_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Main Menu</label>
        <div class="col-md-5">
            <select class="form-control" name="top_menu_id">
                <option value="">Select Menu...</option>
                @foreach($menus as $mainMenu)
                    <option value="{{ $mainMenu->id }}"
                            @if($mainMenu->id == $main_menu_id) selected @endif>{{ $mainMenu->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <?php $sub_menu_id = isset($option['left_menu_id']) ? $option['left_menu_id'] : old('left_menu_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Left Menu</label>
        <div class="col-md-5">
            <select class="form-control" name="left_menu_id">
                <option value="">Select Menu...</option>
                @foreach($menus as $subMenu)
                    <option value="{{ $subMenu->id }}"
                            @if($subMenu->id == $sub_menu_id) selected @endif>{{ $subMenu->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

	<?php $bottom_menu_id = isset($option['bottom_menu_id']) ? $option['bottom_menu_id'] : old('bottom_menu_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Footer Menu</label>
        <div class="col-md-5">
            <select class="form-control" name="bottom_menu_id">
                <option value="">Select Menu...</option>
                @foreach($menus as $bottomMenu)
                    <option value="{{ $bottomMenu->id }}"
                            @if($bottomMenu->id == $bottom_menu_id) selected @endif>{{ $bottomMenu->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <?php $hot_category = isset($option['hot_category']) ? explode(',', $option['hot_category']) : old('hot_category'); ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Hot Category</label>
        <div class="col-md-5">
            <div class="mt-checkbox-list"
                 data-error-container="#form_2_services_error">
                <?php setMultiCategoryCheckBox($hotCategory, $hot_category, 0, 0, 'hot_category'); ?>
            </div>
        </div>
        <div id="form_2_services_error"></div>
    </div>

    <?php $parent = isset($option['parent']) ? explode(',', $option['parent']) : old('parent'); ?>
    <div class="form-group">
        <label class="col-md-2 control-label">News Category</label>
        <div class="col-md-5">
            <div class="mt-checkbox-list"
                 data-error-container="#form_2_services_error">
		        <?php setMultiCategoryCheckBox($mainCategory, $parent); ?>
            </div>
        </div>
        <div id="form_2_services_error"></div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Favico</label>
        <div class="col-md-5">
            @if(isset($option['favico']) && $option['favico'])
                <input type="hidden" name="old_favico" id="old_favico" data-id="" value="{{ $option['favico'] or '' }}">
            @endif
            <input id="favico" name="favico" type="file" data-show-upload="false">
        </div>
    </div>
</div>