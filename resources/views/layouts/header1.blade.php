<header id="header">
    <div class="container hidden-xs hidden-sm">
        <div class="row">
            <div class="col-md-3">
                @if(!empty($meta['company_logo']))
                    <img src="{{ $meta['company_logo'] }}"/>
                @endif
            </div>
            <div class="col-md-4">
                <form action="{{ route('game.search') }}" method="get">
                    <div class="input-group input-group-search">
                        <input type="text" class="form-control" placeholder="Search for..." name="txtSearch"
                               value="{{ old('txtSearch') }}" required>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-offset-2 col-md-3">
                <ul class="top-reason">
                    <li>
                        <img src="{{ asset('/images/safesecure.png') }}" width="27" height="30">
                        No Adware or Spyware
                    </li>
                    <li>
                        Safe &amp; Easy Downloads
                    </li>
                    <li>
                        No pirated software, 100% legal games
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <nav class="navbar">
        <div id="main-menu" class="hidden-xs hidden-sm">
            <div class="container">
                @if(!empty($topMenu))
                    <ul id="navbar-mobile" class="navbar-nav visible-large">
                        <li class="menu-item active "><h2 class="nav_label"><a href="/"><i class="fa fa-home"></i> Home</a>
                            </h2></li>
                        @foreach($topMenu as $i_topMenu)
                            <li class="menu-item ">
                                <h2 class="nav_label"><a
                                            href="{{ setUrlByType($i_topMenu->type, $i_topMenu->slug) }}"> {{ $i_topMenu->name }}</a>
                                </h2>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <div class='rmm hidden-md hidden-lg' data-menu-style="sapphire" data-menu-title="">
            @if(!empty($topMenu))
                <ul>
                    <li><a href='/'>Home</a></li>
                    @foreach($topMenu as $i_topMenu)
                        <li><a href="{{ setUrlByType($i_topMenu->type, $i_topMenu->slug) }}">{{ $i_topMenu->name }}</a></li>
                    @endforeach
                </ul>
                @if($detect->isMobile())
                    {!! \App\Models\Advertising::getAds('1') !!}
                @endif
            @endif
        </div>

        @if($detect->isMobile())
            <!-- QUANG CAO DUOI MENU MOBILE -->
        @endif
    </nav>
</header>