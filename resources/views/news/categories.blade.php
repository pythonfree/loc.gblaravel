@extends('layouts.main')

@section('title')
    @parent | Новости категории:
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости:</h2>
        @foreach ($categories as $category)
            <a href="{{ route('category.show', $category['name']) }}">{{ $category['title'] }}</a>
            <hr>
        @endforeach
@endsection
