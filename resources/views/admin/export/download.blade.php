@extends('layouts.main')

@section('title', 'Скачать новости категории')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Выберите категорию:</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.download') }}">
                            @csrf
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="newsCategory" class="form-label">Категория новости:</label>
                                    <select name="category_id" class="form-select" id="newsCategory">
                                        @forelse($categories as $category)
                                            <option
                                                {{ old('category_id') == $category->id ?' selected' : '' }}
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
                                    <label for="file_format" class="form-label">Выберите формат файла:</label>
                                    <div class="col-md-5 mb-3">
                                        <select name="file_format" class="form-select" id="file_format">
                                                <option value="json" {{ old('file_format')=='json'?'selected':'' }}>json</option>
                                                <option value="excel" {{ old('file_format')=='excel'?'selected':'' }}>excel</option>
                                                <option value="pdf" {{ old('file_format')=='pdf'?'selected':'' }}>pdf</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-outline-primary" id="getNews" value="Скачать новости">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
