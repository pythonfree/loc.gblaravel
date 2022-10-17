@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.main')

@section('title', "Новости")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Новости:</div>
                    <div class="card-body">
                        @forelse($news as $key => $article)
                            <div class="d-flex flex-row align-items-center justify-content-center mb-1">
                                {{ ++$key }}
                                <div class="card-img" style="background-image: url(
                                            {{ $article->image ?? asset('assets/img/default-news.png') }}
                                        )"></div>
                                <div class="col-md-8">
                                    {{ $article->title }}
                                    @if($article->is_private)
                                        <span class="text-danger">
                                                {{ '(Приватная)' }}
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-2" style="text-align: center">
                                    @if(!$article->is_private || Auth::id())
                                        <a href="{{ route('news.show', $article) }}">
                                            Подробнее >>>
                                        </a>
                                    @else
                                        (Чтение только для зарегистрированных)
                                    @endif
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
