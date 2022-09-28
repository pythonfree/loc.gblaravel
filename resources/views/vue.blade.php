@extends('layouts.app')

@section('title')
    @parent | Vue demo
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div id="app">
        <example-component></example-component>
    </div>
@endsection
