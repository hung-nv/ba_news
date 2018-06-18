<div class="header">
    <div class='rmm' data-menu-style="sapphire" data-menu-title="">
        @if(!empty($topMenu))
            <ul>
                <li><a href='/'>Home</a></li>
                @foreach($topMenu as $itemTopMenu)
                    <li><a href="{{ setUrlByType($itemTopMenu->type, $itemTopMenu->slug) }}">{{ $itemTopMenu->name }}</a></li>
                @endforeach
            </ul>
            @if($detect->isMobile())
                {!! \App\Models\Advertising::getAds('1') !!}
            @endif
        @endif
    </div>
</div>