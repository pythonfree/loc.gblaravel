@extends('layouts.app')

@section('title')
    @parent | test2
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h2>Админка</h2>
    <h2>Добавление новости:</h2>
    <label for="title">Название</label>
    <input type="password" id="title">
    <label for="description">Описание</label>
    <input type="text" id="description">
    <label for="slug">Краткое описание</label>
    <input type="text" id="slug">
@endsection
