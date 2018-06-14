@if(isset($hotArticles) && $hotArticles)
    <div class="box-doc-1">
        <h2>Bài viết nổi bật</h2>
        <ul>
            @foreach($hotArticles as $itemHotArticles)
                <li>
                    <a href="{{ $itemHotArticles->url }}">{{ $itemHotArticles->name }}</a>
                    <div class="clear"></div>
                </li>
            @endforeach
        </ul>
    </div>
@endif