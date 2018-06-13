@extends('layouts.app')

@section('content')
    <h1>{{ $page->name }}</h1>
    <div class="page-content">
        {!! $page->content !!}
    </div>
@endsection