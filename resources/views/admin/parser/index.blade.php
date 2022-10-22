@extends('layouts.main')

@section('title', 'RSS')

@section('menu')
    @include('admin.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Текущие RSS:
                    </div>
                    <div class="card-body">
                        @forelse($resources as $key => $resource)
                            <div class="d-flex flex-row align-items-center justify-content-center mb-1">
                                <div class="mr10">{{ ++$key }}</div>
                                <div class="col-md-8">
                                    <a href="{{ $resource->link }}" target="_blank">{{ $resource->link }}</a>
                                </div>
                                <div class="col-md-2" style="text-align: center">
                                    <a href="{{ route('admin.resources.edit', $resource) }}">
                                        Редактировать >>>
                                    </a>
                                </div>
                            </div>
                        @empty
                            Нет ресурсов
                        @endforelse
                        <div class="d-flex">
                            <button class="btn btn-success mr10 mb10 parseAction" data-is_admin="{{ \Illuminate\Support\Facades\Auth::user()->is_admin }}">
                                Парсить!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let button = document.querySelector('.parseAction');
        button.addEventListener('click', () => {
            let success = document.querySelector('.alert-success');
            let danger = document.querySelector('.alert-danger');
            // let is_admin = button.getAttribute('data-is_admin');
            // (async () => {
            //     const response = await fetch("/api/parseAction");
            //     const answer = await response.json();
            //     console.log(answer);
            //     if (answer.status === 'ok') {
            //         success.classList.toggle("d-none");
            //         setTimeout(() => {
            //             success.classList.toggle("d-none");
            //         }, "4000");
            //     }
            //     if (answer.status === 'false') {
            //         danger.classList.toggle("d-none");
            //         setTimeout(() => {
            //             danger.classList.toggle("d-none");
            //         }, "4000");
            //     }
            // })();
            axios.get('/api/parseAction')
                .then(response => {
                    const answer = response.data;
                    if (answer.status === 'ok') {
                        success.classList.toggle("d-none");
                        setTimeout(() => {
                            success.classList.toggle("d-none");
                        }, "3000");
                    }
                    if (answer.status === 'false') {
                        danger.classList.toggle("d-none");
                        setTimeout(() => {
                            danger.classList.toggle("d-none");
                        }, "3000");
                    }
                });
        });
    </script>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-6">
                <div class="alert alert-success d-none" role="alert">
                    Успешно поставлено в очередь.
                </div>
                <div class="alert alert-danger d-none" role="alert">
                    Ошибка постановки в очередь!
                </div>
            </div>
        </div>
    </div>
@endsection
