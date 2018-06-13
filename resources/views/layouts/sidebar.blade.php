<div class="w-category">
    <h3 class="game-title"><span>Category</span></h3>
    @if($leftMenu)
        <ul>
            @foreach($leftMenu as $i_leftMenu)
                <li><a href="{{ setUrlByType($i_leftMenu->type, $i_leftMenu->slug) }}"><i
                                class="fa fa-angle-right"></i>{{ $i_leftMenu->name }}</a></li>
            @endforeach
        </ul>
    @endif
</div>

@if($hotGames)
    <div class="w-topGame">
        <h3 class="game-title"><span>Hot Games</span></h3>
        @foreach($hotGames as $game)
            <div class="d-table w-topGameList">
                <div class="d-cell media">
                    <div class="wrap_img">
                        <a href="{{ route('game.view',['slug' => $game->slug]) }}" rel="bookmark">
                            <img src="/img/80/80/{{ $game->image }}" alt="{{ $game->name }}">
                        </a>
                    </div>
                </div>
                <div class="d-cell text">
                    <h4 class="title"><a href="{{ route('game.view',['slug' => $game->slug]) }}">{{ $game->name }}</a></h4>
                    <div class="desc">{{ $game->introduction }}</div>
                    <div class="rating">
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif