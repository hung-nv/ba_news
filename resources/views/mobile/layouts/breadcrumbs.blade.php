<ol class="breadcrumb" @if(Route::current()->getAction()['as'] == 'homepage') style="padding:0;height:1px;margin-bottom:0 !important;" @endif>
    <li><a href="/">Trang chủ</a></li>
    <li class="active">@yield('activeText')</li>
</ol>