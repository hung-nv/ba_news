<div id="menutop">
    <div class="container">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <div class="menu-inner">
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

            <div class="search-inner">
                <form action="{{ route('news.search') }}" method="get">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." name='txtSearch'
                               value="{{ old('txtSearch') }}"
                               required/>
                        <span class="input-group-btn">
                        <button class="btn btn-warning btn-flat" type="submit">Go!</button>
                    </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="logo">
    <h1 class="header-title">Tin tức về giới trẻ, teen 24h qua</h1>
    <div class="logo-left col-md-3">
        <a href="/">
            @if(!empty($setting['company_logo']))
                <img src="{{ $setting['company_logo'] }}"/>
            @endif
        </a>
    </div>

    <div class="col-md-9 logo-right">
        <div class="ads">
            <img src="{{ asset('images/728x90.jpeg') }}"/>
        </div>
    </div>
    <div class="clear"></div>
</div>