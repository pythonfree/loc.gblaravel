@extends('layouts.main')

@section('title', "О проекте")

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
                        <p>Это учебный проект, здесь будут самые интересные новости.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
