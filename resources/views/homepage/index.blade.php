@section('title')
    {{ $setting['meta_title'] or '' }}
@endsection

@section('description')
    {{ $setting['meta_description'] or '' }}
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        @include('homepage._selectedArticles')

        @include('homepage._newArticles')

        <div class="top-right">
            <div class="ads">
                @if(!empty($advertising[config('const.advertising.pc.trangchu_top_tren')]))
                    {!! $advertising[config('const.advertising.pc.trangchu_top_tren')] !!}
                @else
                    <img src="{{ asset('images/chup_san_pham_sang_tao.jpeg') }}" />
                @endif
            </div>

            <div class="top-right-qc">
                @if(!empty($advertising[config('const.advertising.pc.trangchu_top_duoi')]))
                    {!! $advertising[config('const.advertising.pc.trangchu_top_duoi')] !!}
                @else
                    <img src="{{ asset('images/imgdai2.jpg') }}" />
                @endif
            </div>
        </div>
    </div>

    @include('news._topArticles')

    <div class="row">
        @include('homepage._mainContent')
    </div>

@endsection