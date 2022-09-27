@extends('layouts.main')

@section('title')
    @parent | test2
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h2>Админка</h2>
    <p>
        test2
    </p>
@endsection
