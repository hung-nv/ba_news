<div class="main-box">
    <div class="main-left">
        @if(!empty($mainCategory))
            @foreach($mainCategory as $category)
                <?php $posts = $category->posts; ?>
                @if(count($posts) > 0)
                    <div class="home-box">
                        <div class="home-box-head">
                            <h2>
                                <a href="{{ $category->url }}">{{ $category->name }}</a>
                                <span class="more-child">»</span>
                            </h2>
                            @if (count($category->childrens) > 0)
                                <div class="home-box-subcate">
                                    <ul>
                                        @foreach ($category->childrens as $childCategory)
                                            <li><a href="{{ $childCategory->url }}"
                                                   class="isubCate">{{ $childCategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="clear"></div>
                        </div>

                        <div class="home-box-left">
                            @for ($i = 0; $i < 2; $i++)
                                @if (isset($posts[$i]) && $posts[$i])
                                    <div class="home-box-slide">
                                        <div class="home-box-slide-img">
                                            <a href="{{ $posts[$i]->url }}">
                                                <img src="/img/169_140{{ $posts[$i]->image }}">
                                            </a>
                                        </div>
                                        <div class="home-box-slide-more">
                                            <a href="{{ $posts[$i]->url }}">{{ $posts[$i]->name }}</a>
                                            <div class="box-text">
                                                {{ $posts[$i]->description }}
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                @endif
                            @endfor
                        </div>

                        @if (count($posts) > 2)
                            <div class="home-box-right">
                                <a class="slide" href="{{ $posts[2]->url }}">
                                    <div class="home-box-right-slide-img">
                                        <img src="/img/225_190{{ $posts[2]->image }}">
                                    </div>
                                    <div class="home-box-right-text">{{ $posts[2]->name }}</div>
                                </a>

                                @if (count($posts) > 3)
                                    <ul>
                                        @for ($i = 3; $i < 7; $i++)
                                            @if (isset($posts[$i]) && $posts[$i])
                                                <li><a href="{{ $posts[$i]->url }}">{{ $posts[$i]->name }}</a></li>
                                            @endif
                                        @endfor
                                    </ul>
                                @endif
                            </div>
                        @endif

                        <div class="clear"></div>
                    </div>
                @endif
            @endforeach
        @endif

    </div>

    <div class="main-right">

    </div>

    <div class="clear"></div>
</div>