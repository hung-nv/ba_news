@if (isset($newArticles) && $newArticles)
    <div class="top_main">
        @if(isset($newArticles[0]) && $newArticles[0])
            <div class="slide_top">
                <a href="{{ $newArticles[0]->url }}" class="slide-img">
                    <img src="/img/469_312{{ $newArticles[0]->image }}">
                </a>
                <h2 class="slide-title">
                    <a href="{{ $newArticles[0]->url }}">
                        {{ $newArticles[0]->name }}
                    </a>
                </h2>
            </div>
        @endif

        <div class="top-main-list">
            <div class="top-main-left">
                @if (isset($newArticles[1]) && $newArticles[1])
                    <div class="top-avg">
                        <div class="top-avg-img">
                            <a href="{{ $newArticles[1]->url }}">
                                <img src="/img/227_150{{ $newArticles[1]->image }}">
                            </a>
                        </div>
                        <a href="{{ $newArticles[1]->url }}" class="link">{{ $newArticles[1]->name }}</a>
                    </div>
                @endif

                <div class="top-list">
                    <ul>
                        @for ($i = 2; $i < 6; $i++)
                            @if (isset($newArticles[$i]) && $newArticles[$i])
                                <li>
                                    <a href="{{ $newArticles[$i]->url }}">{{ $newArticles[$i]->name }}</a>
                                </li>
                            @endif
                        @endfor
                    </ul>
                </div>
            </div>

            <div class="top-main-right">
                @if (isset( $newArticles[6] ) && $newArticles[6])
                    <div class="top-avg">
                        <div class="top-avg-img">
                            <a href="{{ $newArticles[6]->url }}">
                                <img src="/img/227_150{{ $newArticles[6]->image }}">
                            </a>
                        </div>
                        <a href="{{ $newArticles[6]->url }}" class="link">{{ $newArticles[6]->name }}</a>
                    </div>
                @endif

                <div class="top-list">
                    <ul>
                        @for ($i = 7; $i < 11; $i ++)
                            @if (isset( $newArticles[ $i ] ) && $newArticles[ $i ])
                                <li>
                                    <a href="{{ $newArticles[$i]->url }}">
                                        {{ $newArticles[$i]->name }}
                                    </a>
                                </li>
                            @endif
                        @endfor
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endif