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
                <img src="{{ asset('images/chup_san_pham_sang_tao.jpeg') }}" />
            </div>

            <div class="top-right-qc">
                <img src="{{ asset('images/imgdai2.jpg') }}" />
            </div>
        </div>
    </div>

    @include('news._topArticles')

    <div class="row">
        @include('homepage._mainContent')
    </div>

@endsection