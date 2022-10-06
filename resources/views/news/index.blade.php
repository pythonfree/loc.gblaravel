@extends('layouts.main')

@section('title', "Новости")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Новости:</div>
                    <div class="card-body">
                        @forelse($news as $key => $article)
                            <div class="d-flex flex-row align-items-center">
                                {{ ++$key }}
                                <div class="card-img" style="background-image: url(
                                    {{ $article->image ?? asset('assets/img/default-news.png') }}
                                )">
                                </div>
                                <a href="{{ route('news.show', $article) }}">
                                    {{ $article->title }}
                                </a>
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
