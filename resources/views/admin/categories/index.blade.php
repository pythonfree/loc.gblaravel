@extends('layouts.main')

@section('title', 'Редактирование категорий')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header  text-center">@if($category->id){{'Изменить'}}@else{{'Добавить'}}@endif{{' категорию'}}</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post"
                              action="@if(!$category->id){{ route('admin.categories.store') }}@else{{ route('admin.categories.update', $category->id) }}@endif">
                            @csrf
                            @if($category->id) @method('PATCH') @endif
                            <input type="hidden" name="createCategory" value="createCategory">
                            <div class="mb-3 col-md-8">
                                <label for="title" class="form-label">Название категории:</label>
                                @if($errors->has('title'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('title') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') ?? $category->title }}">
                            </div>
                            <div class="mb-3  col-md-4">
                                <input type="submit" class="btn btn-outline-primary" id="addCategory" dusk="create-category"
                                       value="@if($category->id){{'Изменить'}}@else{{'Добавить'}}@endif{{' категорию'}}">
                            </div>
                        </form>
                        @forelse($categories as $key => $category)
                            <div class="d-flex flex-column">
                                ID = {{ $category->id }}, категория: "{{ $category->title }}"
                                <div class="d-flex">
                                    <a href="{{ route('admin.categories.edit', $category) }}">
                                        <button class="btn btn-success mr10 mb10">Edit</button>
                                    </a>
                                    <form method="post" action="{{ route('admin.categories.destroy', $category) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mr10 mb10">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            Нет категорий
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
