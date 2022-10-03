@extends('layouts.main')

@section('title', 'Новости по категориям')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Новости по категориям:</div>
                    <div class="card-body">
                        @forelse ($categories as $key => $category)
                            <p>
                                {{ ++$key }}
                                <a href="{{ route('news.categories.show', $category->slug) }}">{{ $category->title }}</a>
                            </p>
                        @empty
                            Нет категорий
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
