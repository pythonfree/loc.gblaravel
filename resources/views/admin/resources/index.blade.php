@extends('layouts.main')

@section('title', 'Ресурсы на парсинг RSS')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header  text-center">@if($resource->id)
                            {{'Изменить'}}
                        @else
                            {{'Добавить'}}
                        @endif{{' ссылку на RSS'}}</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post"
                              action="@if(!$resource->id){{ route('admin.resources.store') }}@else{{ route('admin.resources.update', $resource->id) }}@endif">
                            @csrf
                            @if($resource->id)
                                @method('PATCH')
                            @endif
                            <input type="hidden" name="createResource" value="createResource">
                            <div class="mb-3 col-md-8">
                                <label for="link" class="form-label">Ссылка на RSS:</label>
                                @if($errors->has('link'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('link') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="link" class="form-control" id="link" value="{{ old('link') ?? $resource->link }}">
                            </div>
                            <div class="mb-3  col-md-4">
                                <input type="submit" class="btn btn-outline-primary" id="addResource" dusk="create-resource"
                                       value="@if($resource->id){{'Изменить'}}@else{{'Добавить'}}@endif{{' ссылку'}}">
                            </div>
                        </form>
                        @forelse($resources as $key => $resource)
                            <div class="d-flex flex-column">
                                ID = {{ $resource->id }}, link:
                                <a href="{{ $resource->link }}" target="_blank" class="mb-1">
                                    {{ $resource->link }}
                                </a>
                                <div class="d-flex">
                                    <a href="{{ route('admin.resources.edit', $resource) }}">
                                        <button class="btn btn-success mr10 mb10">Edit</button>
                                    </a>
                                    <form method="post" action="{{ route('admin.resources.destroy', $resource) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mr10 mb10">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            Нет ссылок на парсинг RSS.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
