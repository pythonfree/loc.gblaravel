@extends('layouts.main')

@section('title')
    @parent | Новость
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    @if($article)
        <h2>{{ $article['title'] }}</h2>
        <p>{{ $article['text'] }}</p>
    @else
        Нет такой новости!
    @endif
@endsection
