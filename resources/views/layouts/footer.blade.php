<div id="footer">
    <ul class="bottom">
        <li><a href="/">Home</a></li>
        @if($footerMenu)
            @foreach($footerMenu as $i_footerMenu)
                <li><a href="{{ setUrlByType($i_footerMenu->type, $i_footerMenu->slug) }}">{{ $i_footerMenu->name }}</a></li>
            @endforeach
        @endif
    </ul>
    <div class="clear"></div>

    <div class="infor">
		Cong ty cp thuong mai evnbay
    </div>
</div>