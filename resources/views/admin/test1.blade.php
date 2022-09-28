@extends('layouts.app')

@section('title')
    @parent | test1
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h2>Админка</h2>
    <p>
        test1
    </p>
@endsection
