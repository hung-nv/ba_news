@section('title')
    {{ $category->name }}
@endsection

@section('description')
    {{ $category->meta_description }}
@endsection

@extends('layouts.app')

@section('content')
    <div class="row main-content game-category">
        <h2 class="main-category-title">
            <a href="{{ route('game.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
        </h2>
        @foreach($games as $game_category)
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
@endsection