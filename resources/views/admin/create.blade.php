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
                        <form enctype="multipart/form-data" method="post" action="@if(!isset($article->id)){{ route('admin.create') }}@else{{ route('admin.update', $article) }}@endif">
                            @csrf
                            <div class="mb-3">
                                <label for="newsTitle" class="form-label">Заголовок новости:</label>
                                <input type="text" name="title" class="form-control" id="newsTitle" value="{{ $article->title ?? old('title') }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="newsCategory" class="form-label">Категория новости:</label>
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
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="articleText">Текст новости:</label>
                                <textarea class="form-control" id="articleText" name="text" rows="10">{{ $article->text ??  old('text') }}</textarea>
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
                                    name="is_private"
                                    value="1"
                                    @if ($article->is_private == 1 || old('is_private') == 1) checked @endif
                                >
                                <label class="form-check-label" for="articlePrivate">Новость private?</label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-primary">
                                    @if(isset($article->id))Изменить@elseДобавить@endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
