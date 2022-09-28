@extends('layouts.app')

@section('title')
    @parent | Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости:</h2>
        @forelse($news as $article)
            <p><a href="{{ route('news.show', [$article['category']['slug'], $article['id']]) }}">{{ $article['title'] }}</a></p>
        @empty
            Нет новостей
        @endforelse
@endsection
