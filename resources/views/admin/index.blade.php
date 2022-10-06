@extends('layouts.main')

@section('title', 'Админка')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Админка</div>
                    <div class="card-body">
                        @forelse($news as $key => $article)
                            <div class="d-flex flex-column">
                                <a href="{{ route('news.show', $article) }}">
                                    ID = {{ $article->id }}, Новость: {{ $article->title }}
                                </a>
                                <div class="d-flex">
                                    <a href="{{ route('admin.edit', $article) }}">
                                        <button class="btn btn-success mr10 mb10">Edit</button>
                                    </a>
                                    <a href="{{ route('admin.destroy', $article) }}">
                                        <button class="btn btn-danger mr10 mb10">Delete</button>
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
