@extends('layouts.pdf')

@section('title', "Новости категории - $title")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>Новости категории - {{ $title }}:</p>
                        @forelse($news as $article)
                            <p>
                                <a href="{{ route('news.show', [$slug, $article['id']]) }}">{{ $article['title'] }}</a>
                            </p>
                        @empty
                            Нет новостей
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
