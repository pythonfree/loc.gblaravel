@extends('layouts.main')

@section('title')
    @parent | Админка
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h2>
        Админка
    </h2>
@endsection
