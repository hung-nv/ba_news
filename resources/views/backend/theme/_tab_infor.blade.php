<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-5">
            <input type="email" name="email" class="form-control" value="{{ $option['email'] or old('email') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Company Name</label>
        <div class="col-md-5">
            <input name="company_name" class="form-control"
                   value="{{ $option['company_name'] or  old('company_name') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Company Logo</label>
        <div class="col-md-5">
            @if(isset($option['company_logo']) && $option['company_logo'])
                <input type="hidden" name="old_company_logo" id="old_company_logo" data-id=""
                       value="{{ $option['company_logo'] or '' }}">
            @endif
            <input id="company_logo" name="company_logo" type="file" data-show-upload="false">
        </div>
    </div>
</div>