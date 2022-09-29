@extends('layouts.main')

@section('title', "Vue demo")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div id="app">
        <example-component></example-component>
    </div>
@endsection
