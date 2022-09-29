@extends('layouts.main')

@section('title', "Новости")

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
                        <p>Новости:</p>
                        @forelse($news as $article)
                            <p><a href="{{ route('news.show', [$article['category']['slug'], $article['id']]) }}">{{ $article['title'] }}</a></p>
                        @empty
                            Нет новостей
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
