@if(isset($selectedArticles) && $selectedArticles)
    <div class="top_left">
        <div class="top_left_main">
            @for($i = 0; $i < 2; $i ++)
                @if (isset( $selectedArticles[ $i ] ) && $selectedArticles[ $i ])
                    <div class="top_left_main_iterm">
                        <a href="{{ route('news.view', ['slug' => $selectedArticles[$i]->slug]) }}">
                            <img src="/img/212{{ $selectedArticles[$i]->image }}">
                        </a>
                        <a class='top_left_main_text' href="{{ route('news.view', ['slug' => $selectedArticles[$i]->slug]) }}">
                            {{ $selectedArticles[$i]->name }}
                        </a>
                    </div>
                @endif
            @endfor
        </div>

        @if (count( $selectedArticles ) > 3)
            <div class="right_hot_news">
                <div class="right_hot_news_main">
                    <ul>
                        @for ($i = 2; $i < 10; $i ++)
                            @if (isset( $selectedArticles[ $i ] ) && $selectedArticles[ $i ])
                                <li><a href="{{ route('news.view', ['slug' => $selectedArticles[$i]->slug]) }}">{{ $selectedArticles[$i]->name }}</a></li>
                            @endif
                        @endfor
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endif