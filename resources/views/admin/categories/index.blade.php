@extends('layouts.main')

@section('title', 'Админка')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header  text-center">@if($category->id)Изменить@elseДобавить@endif категорию</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post"
                              action="@if(!$category->id){{ route('admin.categories.store') }}@else{{ route('admin.categories.update', $category->id) }}@endif">
                            @csrf
                            <input type="hidden" name="createCategory" value="createCategory">
                            <div class="mb-3 col-md-4">
                                <label for="title" class="form-label">Название категории:</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ $category->title ?? old('title') }}">
                            </div>
                            <div class="mb-3  col-md-4">
                                <input type="submit" class="btn btn-outline-primary" id="addCategory"
                                       value="@if($category->id)Изменить@elseДобавить@endif категорию">
                            </div>
                        </form>
                        @forelse($categories as $key => $category)
                            <div class="d-flex flex-column">
                                ID = {{ $category->id }}, категория: "{{ $category->title }}"
                                <div class="d-flex">
                                    <a href="{{ route('admin.categories.edit', $category) }}">
                                        <button class="btn btn-success mr10 mb10">Edit</button>
                                    </a>
                                    <a href="{{ route('admin.categories.destroy', $category) }}">
                                        <button class="btn btn-danger mr10 mb10">Delete</button>
                                    </a>
                                </div>
                            </div>
                        @empty
                            Нет новостей
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
