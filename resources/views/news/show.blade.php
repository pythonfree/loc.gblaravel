@extends('layouts.main')

@section('title')
    @parent | Новость из категории - {{ $title }}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новость из категории - {{ $title }}:</h2>
    @if($article)
        <h2>{{ $article['title'] }}</h2>
        <p>{{ $article['text'] }}</p>
    @else
        Нет такой новости!
    @endif
@endsection
