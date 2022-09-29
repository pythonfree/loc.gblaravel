@extends('layouts.main')

@section('title', 'test2')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <p>Админка</p>
                        <p>test2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
