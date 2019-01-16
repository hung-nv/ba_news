@if(isset($hotArticles) && $hotArticles)
    <div class="box-doc-1">
        <h2>Bài viết nổi bật</h2>
        <ul>
            @foreach($hotArticles as $itemHotArticles)
                <li>
                    @if($loop->first)
                        <a class="bold" href="{{ $itemHotArticles->url }}">{{ $itemHotArticles->name }}</a>
                        <div class="box-doc-1-first">
                            <div class="box-doc-1-first-img">
                                <img src="{{ $itemHotArticles->image }}"/>
                            </div>
                            <p>
                                {{ $itemHotArticles->description }}
                            </p>
                        </div>
                        <div class="clear"></div>
                    @else
                        <a href="{{ $itemHotArticles->url }}">{{ $itemHotArticles->name }}</a>
                        <div class="clear"></div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if(!empty($advertising[config('const.advertising.pc.sidebar')]))
    <div style="width:300px; margin: 10px auto;">
        {!! $advertising[config('const.advertising.pc.sidebar')] !!}
    </div>
@endif

@if(isset($baivietmoi) && $baivietmoi)
    <div class="box-doc-1">
        <h2>Bài viết mới nhất</h2>
        <ul>
            @foreach($baivietmoi as $itemMoi)
                <li>
                    <a class="bold" href="{{ $itemMoi->url }}">{{ $itemMoi->name }}</a>
                    <div class="box-doc-1-first">
                        <div class="box-doc-1-first-img">
                            <img src="/img/116_80/{{ $itemMoi->image }}"/>
                        </div>
                        <p>
                            {{ $itemMoi->description }}
                        </p>
                    </div>
                    <div class="clear"></div>
                </li>
            @endforeach
        </ul>
    </div>
@endif