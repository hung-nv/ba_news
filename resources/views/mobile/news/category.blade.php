@section('title')
    {{ $category->meta_title or $category->name }}
@endsection

@section('description')
    {{ $category->meta_description or $category->description }}
@endsection

@section('activeText')
    {{ $category->name }}
@endsection

@extends('mobile.layouts.appMobile')

@section('content')
    <div class="home-rows home-right">
        <h1 class="h1cate">{{ $category->name }}</h1>

        <ul class="cate-right">
            @foreach ($articles as $i)
                <li>
                    <a class="cate-right-img" href="{{ route('news.view', ['slug' => $i->slug]) }}">
                        <img src="/img/80{{ $i->image }}" alt="">
                    </a>
                    <div class="cate-right-more">
                        <span class="datetime">{{ $i->created_at }}</span>
                        <a href="{{ route('news.view', ['slug' => $i->slug]) }}">
                            {{ $i->name }}
                        </a>
                    </div>
                </li>

                @if ($loop->index == 2 && !empty($ads300))
                    <div class="ads"
                         style="margin-left: -25px !important; margin-right: -25px !important; margin-top: 10px; text-align: center;">
                        <!-- ADS -->
                    </div>
                @endif
            @endforeach
        </ul>
        <div class="clear"></div>
    </div>

    <div class="clear"></div>
    <div id="ptr">
        {{ $articles->links() }}
        <div class="clear"></div>
    </div>

    @include('mobile.news._hotArticles')
@endsection
