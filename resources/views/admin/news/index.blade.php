@extends('layouts.main')

@section('title', 'Админка')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a class="nav-link" href="{{ route('admin.news.create') }}">
                            <button class="btn btn-success mr10 mb10">Добавить новость</button>
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($news as $key => $article)
                            <div class="d-flex flex-column">
                                <a href="{{ route('admin.news.show', $article) }}">
                                    ID = {{ $article->id }}, Новость: {{ $article->title }}
                                    @if($article->is_private)
                                        <span class="text-danger">
                                            {{ '(Приватная)' }}
                                        </span>
                                </a>
                                    @endif
                                <div class="d-flex">
                                    <a href="{{ route('admin.news.edit', $article) }}">
                                        <button class="btn btn-success mr10 mb10">Edit</button>
                                    </a>
                                    <form method="post" action="{{ route('admin.news.destroy', $article) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mr10 mb10">Delete</button>
                                    </form>
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
