@section('title')
    {{ $game->name }}
@endsection
@section('description')
    {{ $game->meta_description }}
@endsection
@extends('layouts.app')

@section('content')
    <div class="main-content game-details">
        <h1 class="game-title">{{ $game->name }}</h1>
        <div class="game-heading">
            <div class="row">
                <div class="col-md-3 game-thumb hidden-xs">
                    <img src="/img/190/190/{{ $game->image }}"/>
                </div>
                <div class="col-md-9">
                    <div class="game-box-download">
                        <p class="game-introduction">{{ $game->introduction }}</p>
                        <p>
                            <strong>Category:</strong>
                            @foreach($game->category as $category)
                                <a href="{{ route('game.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>@if (!$loop->last)
                                    ,@endif
                            @endforeach
                        </p>
                        <p class="game-createTime"><strong>Updated At:</strong> {{ $game->created_at }} </p>
                        <div class="download">
                            <div class="row">
                                @if(!empty($metaGame['url-download-window']))
                                    <div class="col-md-6">
                                        <a href="{{ $metaGame['url-download-window'] }}"
                                           class="btn btn-download -align-center">
                                            Free Download<br/>
                                            for PC
                                        </a>
                                    </div>
                                @endif
                                @if(!empty($metaGame['url-download-android']))
                                    <div class="col-md-6">
                                        <a href="{{ $metaGame['url-download-android'] }}"
                                           class="btn btn-download -align-center">
                                            <img class="btn-img-logo" src="{{ asset('images/android.png') }}" hspace="5"
                                                 width="32">
                                            Free Download<br/>
                                            for Android
                                        </a>
                                    </div>
                                @endif
                                @if(!empty($metaGame['url-download-ios']))
                                    <div class="col-md-6">
                                        <a href="{{ $metaGame['url-download-ios'] }}" class="btn btn-download -align-center">
                                            <img class="btn-img-logo" src="{{ asset('images/ios.png') }}" hspace="5"
                                                 width="32">
                                            Free Download<br/>
                                            for iOs
                                        </a>
                                    </div>
                                @endif
                                @if(!empty($metaGame['url-download-window-phone']))
                                    <div class="col-md-6">
                                        <a href="{{ $metaGame['url-download-window-phone'] }}" class="btn btn-download -align-center">
                                            Free Download<br/>
                                            for Window Phone
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($detect->isMobile())
                {!! \App\Models\Advertising::getAds('2') !!}
            @endif
        </div>

        <div class="game-content-inner">
            <div class="game-special">
                <span class="special-head">Game Description</span>
                @if($detect->isMobile())
                    {!! \App\Models\Advertising::getAds('3') !!}
                @endif
                <ul>
                    @foreach(explode("\r", $game->description) as $line)
                        <li>{{ $line }}</li>
                    @endforeach
                </ul>
            </div>
            {!! $game->content !!}
        </div>

        @if($detect->isMobile())
            {!! \App\Models\Advertising::getAds('4') !!}
        @endif

        <div class="row game-category">
            <h2 class="main-category-title">
                <a href="javascript: void();">New Games</a>
            </h2>
            @foreach($newGames as $game_category)
                <div class="col-md-2 col-xs-6">
                    <div class="game-img">
                        <a href="{{ route('game.view', ['slug' => $game_category->slug]) }}">
                            <img src="/img/115/115{{ $game_category->image }}" alt="{{ $game_category->name }}" title="{{ $game_category->name }}" class="img-responsive">
                        </a>
                    </div>
                    <h4>
                        <a href="{{ route('game.view', ['slug' => $game_category->slug]) }}">{{ $game_category->name }}</a>
                    </h4>
                    <p class="more-text">{{ $game_category->introduction }}</p>
                </div>
            @endforeach
        </div>

        @if($detect->isMobile())
            {!! \App\Models\Advertising::getAds('5') !!}
        @endif
    </div>
@endsection