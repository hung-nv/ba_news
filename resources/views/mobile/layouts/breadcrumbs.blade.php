@if(Route::getCurrentRoute()->uri() != '/')
    <ol class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li class="active">@yield('activeText')</li>
    </ol>
@endif