@extends('layouts.main')

@section('title')
    @parent | Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости:</h2>
        @forelse($news as $article)
            <a href="{{ route('article', $article['id']) }}">{{ $article['title'] }}</a>
            <hr>
        @empty
            Нет новостей
        @endforelse
@endsection
