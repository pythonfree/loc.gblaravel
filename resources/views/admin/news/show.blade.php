@extends('layouts.main')
@section('title', "Новость из категории - $category->title")

@section('menu')
    @include('admin.menu')
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
                                <div class="d-flex flex-column align-items-center" style="text-align: center;">
                                    <div class="card-img-show" style="background-image: url(
                                        {{ $article->image ?? asset('assets/img/default-news.png') }}
                                    )">
                                    </div>
                                    <h2>{{ $article->title }}</h2>
                                    <p>
                                        {!! $article->text !!}
                                        <i>Опубликовано: {{ (new DateTime($article->created_at))->format('j F, Y') }}.</i>
                                        Весь текст новости доступен <a style="display:contents" href="{{ $article->link }}" target="_blank"> по ссылке
                                            >>></a>
                                    </p>
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
