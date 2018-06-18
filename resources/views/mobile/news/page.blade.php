@section('title')
    {{ $page->meta_title or $page->name }}
@endsection

@section('description')
    {{ $page->meta_description or $page->description }}
@endsection

@section('activeText')
    {{ $page->name }}
@endsection

@extends('mobile.layouts.appMobile')

@section('content')
    <div class="entry-content">
        <h1>{{ $page->name }}</h1>
        <p class="datetime">
            <img src="/img/10/images/icons8-time-50.png"/>
            <span class="sptime">{{ $page->created_at }}</span>
        </p>

        <div class="entry-post">
            {!! $page->content !!}
        </div>

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
