@extends('layouts.main')

@section('title', "Новости категории - $category->title")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Новости категории - {{ $category->title }}:</div>
                    <div class="card-body">
                        @forelse($news as $key => $article)
                            <div class="d-flex flex-row align-items-center mb-1">
                                {{ ++$key }}
                                <div class="card-img" style="background-image: url(
                                    {{ $article->image ?? asset('assets/img/default-news.png') }}
                                )">
                                </div>
                                <p>
                                    <a href="{{ route('news.show', $article->id) }}">
                                        {{ $article->title }}
                                    </a>
                                </p>
                            </div>
                        @empty
                            Нет новостей
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
