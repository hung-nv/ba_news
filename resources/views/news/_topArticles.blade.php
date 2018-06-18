@if(!empty($mostArticles))
    <div class="row">
        <div class="docnhieunhat">
            <div class="box1">
                <h2>Tin tức xem nhiều</h2>
                <ul>
                    @foreach ($mostArticles as $i)
                        <li @if($loop->index == 5) class="clear" @endif>
                            <a class="imgbox1" href="{{ $i->url }}">
                                <img src="/img/185_140{{ $i->image }}"/>
                            </a>
                            <p><a href="{{ $i->url }}">{{ $i->name }}</a></p>
                        </li>
                    @endforeach
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@endif