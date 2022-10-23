@extends('layouts.main')

@section('title', 'RSS')

@section('menu')
    @include('admin.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Текущие RSS:
                    </div>
                    <div class="card-body">
                        @forelse($resources as $key => $resource)
                            <div class="d-flex flex-row align-items-center justify-content-center mb-1">
                                <div class="mr10">{{ ++$key }}</div>
                                <div class="col-md-8">
                                    <a href="{{ $resource->link }}" target="_blank">{{ $resource->link }}</a>
                                </div>
                                <div class="col-md-2" style="text-align: center">
                                    <a href="{{ route('admin.resources.edit', $resource) }}">
                                        Редактировать >>>
                                    </a>
                                </div>
                            </div>
                        @empty
                            Нет ресурсов
                        @endforelse
                        <div class="d-flex">
                            <button class="btn btn-success mr10 mb10 parseAction" data-is_admin="{{ \Illuminate\Support\Facades\Auth::user()->is_admin }}">
                                Парсить!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center mt-1">
            <div class="col-md-6">
                <div class="alert alert-success d-none" role="alert">
                    Все ресурсы успешно отработаны!
                </div>
                <div class="alert alert-danger d-none" role="alert">
                    Не все ресурсы были отработаны, смотри отчет в <a class="errorMessage" href="/horizon">Horizon</a>
                </div>
                <div class="alert alert-warning d-none" role="alert"></div>
            </div>
        </div>
    </div>
@endsection
