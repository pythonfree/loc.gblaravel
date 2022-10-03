@extends('layouts.main')

@section('title', "Новость из категории - $title")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <p>Новость из категории - {{ $title }}:</p>
                        @if($article)
                            <h2>{{ $article['title'] }}</h2>
                                <div class="card-img" style="background-image: url(
                                    {{ $article['image'] ?? asset('assets/img/default-news.png') }}
                                )">
                                </div>
                            <p>{{ $article['text'] }}</p>
                        @else
                            Нет такой новости!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
