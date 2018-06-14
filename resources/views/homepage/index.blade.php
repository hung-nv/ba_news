@section('title')
    {{ !empty($meta['meta_title']) ? $meta['meta_title'] : '' }}
@endsection

@section('description')
    {{ !empty($meta['meta_description']) ? $meta['meta_description'] : '' }}
@endsection

@extends('layouts.app')

@section('content')
    @include('homepage._hotArticles')

	@include('homepage._newArticles')


    <div class="top-right">
        <div class="ads" style="margin-bottom: 10px;">
            <img style="width: 100%" src="{{ asset('images/chup_san_pham_sang_tao.jpeg') }}" />
        </div>

        <div class="top-right-qc">
            <img src="{{ asset('images/imgdai2.jpg') }}" />
        </div>
    </div>
@endsection