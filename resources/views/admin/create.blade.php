@extends('layouts.main')

@section('title', 'Добавить: новость | категорию')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Добавить новость</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('admin.create') }}">
                            @csrf
                            <input type="hidden" name="createArticle" value="createArticle">
                            <div class="mb-3">
                                <label for="newsTitle" class="form-label">Заголовок новости:</label>
                                <input type="text" name="title" class="form-control" id="newsTitle" value="{{ old('title') }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="newsCategory" class="form-label">Категория новости:</label>
                                <select name="categoryId" class="form-select" id="newsCategory">
                                    @forelse($categories as $category)
                                        <option
                                            {{ old('categoryId') == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}"
                                        >
                                            {{ $category->title }}
                                        </option>
                                    @empty
                                        <option value="0" selected>Нет категории</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="articleText">Текст новости:</label>
                                <textarea class="form-control" id="articleText" name="text">{{ old('text') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Картинка:</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <div class="mb-3 form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="articlePrivate"
                                    name="isPrivate"
                                    value="checked"
                                    {{ old('isPrivate')?:'' }}
                                >
                                <label class="form-check-label" for="articlePrivate">Новость private?</label>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-outline-primary" id="addArticle" value="Добавить новость">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mb-1"></div>
                <div class="card">
                    <div class="card-header  text-center">Добавить категорию</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('admin.create') }}">
                            @csrf
                            <input type="hidden" name="createCategory" value="createCategory">
                            <div class="mb-3 col-md-4">
                                <label for="title" class="form-label">Название категории:</label>
                                <input type="text" name="title" class="form-control" id="title" value="">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-outline-primary" id="addCategory" value="Добавить категорию">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
