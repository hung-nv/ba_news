@section('title')
    {{ !empty($meta['meta_title']) ? $meta['meta_title'] : '' }}
@endsection

@section('description')
    {{ !empty($meta['meta_description']) ? $meta['meta_description'] : '' }}
@endsection

@extends('layouts.appHome')

@section('content')
    <div class="container page-index">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-7 w-topGame">
                        <h3 class="game-title"><span>New Games</span></h3>
                        @if($newGames)
                            @foreach($newGames as $i_newGame)
                                <div class="d-table w-topGameList">
                                    <div class="d-cell media">
                                        <div class="wrap_img">
                                            <a href="{{ route('game.view', ['slug' => $i_newGame->slug]) }}"
                                               rel="bookmark">
                                                <img src="/img/80/80{{ $i_newGame->image }}"
                                                     alt="Luyen Rong"> </a>
                                        </div>
                                    </div>
                                    <div class="d-cell text">
                                        <h4 class="title"><a
                                                    href="{{ route('game.view', ['slug' => $i_newGame->slug]) }}">{{ $i_newGame->name }}</a>
                                        </h4>
                                        <div class="desc">{{ $i_newGame->introduction }}</div>
                                        <div class="rating">
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                            <i class="fa fa-star"> </i>
                                        </div>
                                    </div>
                                    <div class="d-cell meta">
                                        <a href="{{ route('game.view', ['slug' => $i_newGame->slug]) }}"
                                           class="btn-freeDownload">Free</a>
                                        <div class="count_views">{{ $i_newGame->view }} view</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if($detect->isMobile())
                        {!! \App\Models\Advertising::getAds('7') !!}
                    @endif

                    <div class="col-md-5 w-hotGame">
                        <h3 class="game-title"><span>Hot Games</span></h3>
                        @if($hotGames)
                            <div class="row">
                                @foreach($hotGames as $i_hotGame)
                                    <div class="col-md-6 d-table col-xs-6">
                                        <div class="game-img">
                                            <a href="{{ route('game.view', ['slug' => $i_hotGame->slug]) }}">
                                                <img src="/img/150/150{{ $i_hotGame->image }}"
                                                     alt="{{ $i_hotGame->name }}" title="{{ $i_hotGame->name }}"
                                                     class="img-responsive">
                                            </a>
                                        </div>
                                        <h4>
                                            <a href="{{ route('game.view', ['slug' => $i_hotGame->slug]) }}">{{ $i_hotGame->name }}</a>
                                        </h4>
                                        <p class="more-text">{{ $i_hotGame->introduction }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if($detect->isMobile())
                        {!! \App\Models\Advertising::getAds('8') !!}
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="w-category">
                    <h3 class="game-title"><span>Category</span></h3>
                    @if($leftMenu)
                        <ul>
                            @foreach($leftMenu as $i_category)
                                <li><a href="{{ route('game.category', ['slug' => $i_category->slug]) }}"><i
                                                class="fa fa-angle-right"></i>{{ $i_category->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        @foreach($gameCategory as $category)
            <div class="row main-content">
                <h2 class="main-category-title">
                    <a href="{{ route('game.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                </h2>
                @foreach($category->getNewGameOfCategory() as $game_category)
                    <div class="col-md-2 col-xs-6">
                        <div class="game-img">
                            <a href="{{ route('game.view', ['slug' => $game_category->slug]) }}">
                                <img src="/img/150/150{{ $game_category->image }}" alt="{{ $game_category->name }}"
                                     title="{{ $game_category->name }}" class="img-responsive">
                            </a>
                        </div>
                        <h4>
                            <a href="{{ route('game.view', ['slug' => $game_category->slug]) }}">{{ $game_category->name }}</a>
                        </h4>
                        <p class="more-text">{{ $game_category->introduction }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

@endsection