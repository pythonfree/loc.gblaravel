@extends('layouts.main')

@section('title', 'test2')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <h2>Админка</h2>
                        <h2>Добавление новости:</h2>
                        <label for="title">Название</label>
                        <input type="password" id="title">
                        <label for="description">Описание</label>
                        <input type="text" id="description">
                        <label for="slug">Краткое описание</label>
                        <input type="text" id="slug">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
