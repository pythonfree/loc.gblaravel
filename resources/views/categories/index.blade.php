@extends('layouts.app')

@section('title')
    @parent | Новости по категориям
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости по категориям:</h2>
        @forelse ($categories as $category)
            <p><a href="{{ route('news.categories.show', $category['slug']) }}">{{ $category['title'] }}</a></p>
        @empty
            Нет категорий
        @endforelse
@endsection
