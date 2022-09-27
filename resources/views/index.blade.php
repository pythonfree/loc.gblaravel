@extends('layouts.main')

@section('title')
    @parent | Главная
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
<h2>
    Приветствую на агрегаторе новостей!
</h2>
@endsection
