@extends('layouts.main')

@section('title', "Главная")

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <p2>Приветствую на агрегаторе новостей!</p2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
