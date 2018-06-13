<select class="form-control" id="list-menu-item">
    <option value="">Select...</option>
    @foreach($menuGroups as $menu)
        <option value="{{ $menu->id }}" @if(Request::get('menu_group') == $menu->id) selected @endif>{{ $menu->name }}</option>
    @endforeach
</select>