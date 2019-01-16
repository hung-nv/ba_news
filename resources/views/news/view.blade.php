@section('title')
    {{ $article->meta_title or $article->name }}
@endsection

@section('description')
    {{ $article->meta_description or $article->description }}
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="column1">
            <ol class="breadcrumb">
                <li><a href="/">Trang chủ</a></li>
                @if (count($article->category) == 1)
                    <li><a href="{{ $article->category->first()->url }}">{{ $article->category->first()->name }}</a></li>
                @endif
                <li class="active">{{ $article->name }}</li>
            </ol>
            <div class="entry-content">
                <h1>{{ $article->name }}</h1>
                <p class="datetime">
                    <img src="/img/10/images/icons8-time-50.png"/>
                    <span class="sptime">{{ $article->created_at }}</span>
                </p>
                <div class="description">
                    {{ $article->description }}
                </div>
                @if ($article->relatedPostsByTag())
                    <ul class="related">
                        @foreach ($article->relatedPostsByTag() as $i)
                            <li><a href="{{ $i->url }}">{{ $i->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
                <div class="entry-post">
                    @if(!empty($advertising[config('const.advertising.pc.bai_viet_tren')]))
                        <div style="width:300px; height:250px; float: left; margin-right: 10px; margin-bottom: 10px;">
                            {!! $advertising[config('const.advertising.pc.bai_viet_tren')] !!}
                        </div>
                    @endif
                    {!! $article->content !!}
                </div>

                @if (isset($newArticles) && $newArticles)
                    <div class="other">
                        <h2>Tin mới nhất</h2>
                        <div class="other-tren">
                            <div class="other-tren-left">
                                @for($i = 0; $i < 2; $i++)
                                    @if (isset( $newArticles[ $i ] ) && $newArticles[ $i ])
                                        <div class="other-row">
                                            <a href="{{ $newArticles[$i]->url }}" class="other-row-img">
                                                <img src="/img/154_102{{ $newArticles[$i]->image }}">
                                            </a>
                                            <h4>
                                                <a href="{{ $newArticles[$i]->url }}">
                                                    {{ $newArticles[$i]->name }}
                                                </a>
                                            </h4>
                                            <p>{{ $newArticles[$i]->description }}</p>
                                            <div class="clear"></div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                            <div class="other-tren-right">
                                @if(!empty($advertising[config('const.advertising.pc.bai_viet_duoi')]))
                                    {!! $advertising[config('const.advertising.pc.bai_viet_duoi')] !!}
                                @else
                                    <img src="{{ asset('images/banner_5.jpg') }}"/>
                                @endif
                            </div>
                            <div class="clear"></div>
                        </div>

                        @if (count( $newArticles ) > 2)
                            <ul>
                                @for ($i = 2; $i < 11; $i ++)
                                    @if (isset( $newArticles[ $i ] ) && $newArticles[ $i ])
                                        <li>
                                            <a href="{{ $newArticles[$i]->url }}">
                                                {{ $newArticles[$i]->name }}
                                            </a>
                                            <span>&nbsp;({{ $newArticles[$i]->created_at }})</span>
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="column2">
            @include('homepage._mainRight')
        </div>
    </div>

    @include('news._topArticles')
@endsection