@extends('layouts.main')

@section('title')
    @parent | Новости по категориям
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости по категориям:</h2>
        @forelse ($categories as $category)
            <a href="{{ route('news.categories.show', $category['name']) }}">{{ $category['title'] }}</a>
            <hr>
        @empty
            Нет категорий
        @endforelse
@endsection
