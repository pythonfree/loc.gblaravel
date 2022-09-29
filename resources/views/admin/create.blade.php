@extends('layouts.main')

@section('title', 'Добавить новость')

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
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="newsTitle" class="form-label">Название новости</label>
                                <input type="text" name="title" class="form-control" id="newsTitle" value="">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-outline-primary" id="addArticle" value="Добавить новость">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
