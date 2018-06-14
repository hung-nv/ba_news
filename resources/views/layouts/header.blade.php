<div id="menutop">
    <div class="container">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul>
                <li class="home @if(empty($slug)) active @endif"><a href="/">Trang chủ</a></li>
                @if(!empty($topMenu))
                    @foreach($topMenu as $i_topMenu)
                        <li @if(isset($slug) && $slug == $i_topMenu->slug)class="active"@endif>
                            <a href="{{ $i_topMenu->url }}">
                                {{ $i_topMenu->name }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

<div id="logo">
    <div class="logo-left col-lg-2">
        <a href="/">
            @if(!empty($meta['company_logo']))
                <img src="{{ $meta['company_logo'] }}"/>
            @endif
        </a>
    </div>

    <div class="col-lg-10 logo-right">
        <div class="logo-tren">
            <h1>Tin tức về giới trẻ, teen 24h qua</h1>
            <form action="{{ route('news.search') }}" method="get">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Tìm kiếm..." name='txtSearch'
                           value="{{ old('txtSearch') }}"
                           required/>
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-flat" type="submit">Go!</button>
                    </span>
                </div>
            </form>
            <div class="clear"></div>
        </div>

        <div class="ads">
            <!-- ads 728 -->
        </div>
    </div>
    <div class="clear"></div>
</div>