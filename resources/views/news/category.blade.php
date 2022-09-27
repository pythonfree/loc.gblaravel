@extends('layouts.main')

@section('title')
    @parent | Новости категории - {{ $news[0]['category']['title'] }}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости категории - {{ $news[0]['category']['title'] }} :</h2>
        @forelse($news as $article)
            <a href="{{ route('article', [$article['category']['name'], $article['id']]) }}">{{ $article['title'] }}</a>
            <hr>
        @empty
            Нет новостей
        @endforelse
@endsection
