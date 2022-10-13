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
                    <div class="card-header text-center">@if(!isset($article->id))Добавить@elseИзменить@endif новость</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post"
                              action="@if(!isset($article->id)){{ route('admin.news.store') }}@else{{ route('admin.news.update', $article) }}@endif">
                            @csrf
                            @if($article->id) @method('PATCH') @endif
                            <div class="mb-3">
                                <label for="newsTitle" class="form-label">Заголовок новости:</label>
                                @if($errors->has('title'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('title') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="title" class="form-control" id="newsTitle" value="{{ old('title') ?? $article->title }}">
                            </div>
                            <div class="mb-3 col-md-8">
                                <label for="newsCategory" class="form-label">Категория новости:</label>
                                @if($errors->has('category_id'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('category_id') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <select name="category_id" class="form-select" id="newsCategory">
                                    @forelse($categories as $category)
                                        <option
                                            {{ old('category_id') == $category->id || $category->id == $article->category_id ? 'selected' : '' }}
                                            value="{{ $category->id }}"
                                        >
                                            {{ $category->title }}
                                        </option>
                                    @empty
                                        <option value="0" selected>Нет категории</option>
                                    @endforelse
                                    <option value="999" @if($errors->has('category_id')) selected @endif>Не верная категория</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="articleText">Текст новости:</label>
                                @if($errors->has('text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('text') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <textarea class="form-control" id="articleText" name="text" rows="10">{{ empty(old()) ? $article->text : old('text') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Картинка:</label>
                                @if($errors->has('image'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('image') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <div class="mb-3 form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="articlePrivate"
                                    name="is_private"
                                    value="1"
                                    @if ($article->is_private == 1 || old('is_private') == 1) checked @endif
                                >
                                <label class="form-check-label" for="articlePrivate">Новость private?</label>
                                @if($errors->has('is_private'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('is_private') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-primary" dusk="create-article">
                                    @if(isset($article->id)){{ __('Изменить') }}@else{{ __('Добавить') }}@endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
