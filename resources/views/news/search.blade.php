@section('title')
    {{ 'Tim kiem "'. $search. '"' }}
@endsection

@section('description')
    {{ $setting['meta_description'] or '' }}
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="column1">
            <h1 class="cate-title"><a href="#">{{ $search }}</a></h1>
            <div class="clear"></div>
            @if(isset($articles) && $articles)
                @foreach ($articles as $i)
                    <div class="@if($loop->index % 2 == 0)cate-left clear @else cate-right @endif">
                        <div class="cate-slide-content">
                            <a href="{{ route('news.view', ['slug' => $i->slug]) }}" class="image-link">
                                <img src="/img/330{{ $i->image }}">
                            </a>

                            <div class="meta">
                                <span>{{ $i->created_at }}</span>
                            </div>

                            <h2><a href="{{ route('news.view', ['slug' => $i->slug]) }}">{{ $i->name }}</a></h2>

                            <div class="excerpt">
                                <p>{{ $i->description }}</p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                @endforeach
            @endif

            <div class="clear"></div>
            <div id="ptr">
                {{ $articles->links() }}
                <div class="clear"></div>
            </div>
        </div>
        <div class="column2">
            @include('homepage._mainRight')
        </div>
    </div>

    @if(!empty($mostArticles))
        <div class="docnhieunhat">

        </div>
    @endif
@endsection