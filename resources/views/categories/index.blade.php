@extends('layouts.main')

@section('title')
    @parent | Новости по категориям
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости по категориям:</h2>
        @foreach ($categories as $category)
            <a href="{{ route('categories.show', $category['name']) }}">{{ $category['title'] }}</a>
            <hr>
        @endforeach
@endsection
