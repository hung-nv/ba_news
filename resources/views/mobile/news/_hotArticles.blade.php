<div class="box-private">
    <div class="cate-head">
        <h2>Tin nổi bật</h2>
    </div>

    @if(!empty($hotArticles))
        @foreach ($hotArticles as $itemHotArticle)
            <div class="cate-left">
                <div class="cate-slide-content">
                    <a href="{{ $itemHotArticle->url }}" class="image-link">
                        <img src="{{ $itemHotArticle->image }}">
                    </a>

                    <div class="meta">
                        <span>{{ $itemHotArticle->created_at }}</span>
                    </div>

                    <h2><a href="{{ $itemHotArticle->url }}">{{ $itemHotArticle->name }}</a></h2>

                    <div class="excerpt">
                        <p>{{ $itemHotArticle->description }}</p>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        @endforeach
    @endif

    <div class="clear"></div>
</div>