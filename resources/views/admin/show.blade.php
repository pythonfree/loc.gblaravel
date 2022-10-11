@extends('layouts.main')
@section('title', "Новость из категории - $category->title")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Новость из категории - {{ $category->title }}:</div>
                    <div class="card-body">
                        @if($article)
                            @if(!$article->isPrivate)
                                <div class="d-flex flex-column align-items-center">
                                    <div class="card-img-show" style="background-image: url(
                                        {{ $article->image ?? asset('assets/img/default-news.png') }}
                                    )">
                                    </div>
                                    <h2>{{ $article->title }}</h2>
                                    <p>{{ $article->text }}</p>
                                </div>
                            @else
                                Новость приватная...
                            @endif
                        @else
                            Нет такой новости!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
