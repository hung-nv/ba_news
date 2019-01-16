@section('title')
    {{ $article->meta_title or $article->name }}
@endsection

@section('description')
    {{ $article->meta_description or $article->description }}
@endsection

@section('activeText')
    {{ $article->name }}
@endsection

@extends('mobile.layouts.appMobile')

@section('content')
    <div class="entry-content">
        <h1>{{ $article->name }}</h1>
        <p class="datetime">
            <img src="/img/10/images/icons8-time-50.png"/>
            <span class="sptime">{{ $article->created_at }}</span>
        </p>
        <div class="description">
            {{ $article->description }}
        </div>

        @if (count($article->relatedPostsByTag()) > 0)
            <ul class="related">
                @foreach ($article->relatedPostsByTag() as $i)
                    <li><a href="{{ $i->url }}">{{ $i->name }}</a></li>
                @endforeach
            </ul>
        @endif

        @if(!empty($advertising[config('const.advertising.mobile.baiviet_tren')]))
            <div style="margin: 10px auto; left: 0; right: 0;">
                {!! $advertising[config('const.advertising.mobile.baiviet_tren')] !!}
            </div>
        @endif

        <div class="entry-post">
            {!! $article->content !!}
        </div>

        @if(!empty($advertising[config('const.advertising.mobile.baiviet_duoi')]))
            <div style="margin: 10px auto; left: 0; right: 0;">
                {!! $advertising[config('const.advertising.mobile.baiviet_duoi')] !!}
            </div>
        @endif

        @if (!empty($newArticles))
            <div class="box-private">
                <div class="cate-head" style="margin-bottom: 0;">
                    <h2>Tin tức mới</h2>
                </div>

                <ul class="box-moi">
                    @foreach ($newArticles as $i)
                        <li>
                            <a href="{{ $i->url }}">{{ $i->name }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="clear"></div>
            </div>
        @endif

        @include('mobile.news._hotArticles')
    </div>
@endsection
