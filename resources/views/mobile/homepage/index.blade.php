@section('title')
    {{ $setting['meta_title'] or '' }}
@endsection

@section('description')
    {{ $setting['meta_description'] or '' }}
@endsection

@extends('mobile.layouts.appMobile')

@section('content')
    @if(!empty($mainCategory))
        @foreach($mainCategory as $category)
            <?php $posts = $category->posts; ?>
            @if(count($posts) > 0)
                <div class="home-rows clear">
                    <div class="home-head">
                        <a href="{{ $category->url }}">{{ $category->name }} » </a>
                        @if (count($category->childrens) > 0)
                            <ul>
                                @foreach ($category->childrens as $childCategory)
                                    <li><a href="{{ $childCategory->url }}">{{ $childCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="clear"></div>
                    </div>

                    <div class="cate-left">
                        <div class="cate-slide-content">
                            <a href="{{ $posts[0]->url }}" class="image-link">
                                <img src="{{ $posts[0]->image }}">
                            </a>

                            <div class="meta">
                                <span>{{ $posts[0]->created_at }}</span>
                            </div>

                            <h2><a href="{{ $posts[0]->url }}">{{ $posts[0]->name }}</a></h2>

                            <div class="excerpt">
                                <p>{{ $posts[0]->description }}</p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>
                    @if (count($posts) > 1)
                        <ul class="cate-right">
                            @for ($j = 1; $j < 4; $j++)
                                @if (!empty($posts[$j]))
                                    <li>
                                        <a class="cate-right-img" href="{{ $posts[$j]->url }}">
                                            <img src="/img/60{{ $posts[$j]->image }}">
                                        </a>
                                        <div class="cate-right-more">
                                            <span class="datetime">{{ $posts[$j]->created_at }}</span>
                                            <a href="{{ $posts[$j]->url }}">
                                                {{ $posts[$j]->name }}
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            @endfor
                        </ul>
                    @endif
                </div>
            @endif


            @if ($loop->first && !empty($ads300))
                <div class="ads" style="margin-left: -25px !important; margin-right: -25px !important;">
                    <!-- ADS 300 -->
                </div>
            @endif
        @endforeach
    @endif
    <div class="clear"></div>
@endsection