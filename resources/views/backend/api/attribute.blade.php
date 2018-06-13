<option></option>
@if(isset($data) && $data)
    @foreach($data as $attribute)
        <option value="{{ $attribute['id'] }}">{{ $attribute['attr_value'] }}</option>
    @endforeach
@endif