@extends('layouts.main')

@section('title', "Новости категории - \"$category->title\"")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Новости категории - "{{ $category->title }}":</div>
                    <div class="card-body">
                        @forelse($news as $key => $article)
                            <div class="d-flex flex-row align-items-center justify-content-center mb-1">
                                {{ ++$key }}
                                <div class="card-img" style="background-image: url(
                                    {{ $article->image ?? asset('assets/img/default-news.png') }}
                                )"></div>
                                <div class="col-md-8">
                                    {{ $article->title }}.
                                    <i>(Опубликовано: {{ Carbon\Carbon::instance(new DateTime($article->created_at))->translatedFormat('j F, Y') }})</i>
                                </div>
                                <div class="col-md-2" style="text-align: center">
                                    <a href="{{ route('news.show', $article->id) }}">
                                        Подробнее >>>
                                    </a>
                                </div>
                            </div>
                        @empty
                            Нет новостей
                        @endforelse
                        <div class="d-flex">
                            {{ $news->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
