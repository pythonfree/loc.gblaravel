@extends('layouts.app')

@section('title')
    @parent | Vue demo
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>
        Авторизация:
    </h2>
    <label for="password">Введите пароль</label>
    <input type="password" id="password">
    <label for="login">Введите логин</label>
    <input type="password" id="login">
    <label for="remember">Запомнить меня</label>
    <input type="checkbox" id="remember">
    <button type="submit">Вход</button>
@endsection
