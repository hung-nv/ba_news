<div class="header">
    <div class='rmm' data-menu-style="sapphire" data-menu-title="">
        @if(!empty($topMenu))
            <ul>
                <li><a href='/'>Home</a></li>
                @foreach($topMenu as $itemTopMenu)
                    <li><a href="{{ setUrlByType($itemTopMenu->type, $itemTopMenu->slug) }}">{{ $itemTopMenu->name }}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
</div>