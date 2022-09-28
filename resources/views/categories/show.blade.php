@extends('layouts.main')

@section('title')
    @parent | Новости категории - {{ $title }}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости категории - {{ $title }}:</h2>
        @forelse($news as $article)
            <a href="{{ route('news.show', [$article['category']['slug'], $article['id']]) }}">{{ $article['title'] }}</a>
            <hr>
        @empty
            Нет новостей
        @endforelse
@endsection
