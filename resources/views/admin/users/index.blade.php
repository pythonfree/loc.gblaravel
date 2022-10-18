@extends('layouts.main')

@section('title', 'Админка')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Пользователи:
                    </div>
                    <div class="card-body">
                        @forelse($users as $key => $user)
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row">
                                        <span>
                                            Пользователь: "{{ $user->name }}" (ID = {{ $user->id }}), email: {{ $user->email }}
                                        </span>
                                    @if($user->is_admin)
                                        <span class="text-danger">
                                            {{ '(Админ)' }}
                                        </span>
                                    @endif
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('admin.users.edit', $user) }}">
                                        <button class="btn btn-success mr10 mb10">Edit</button>
                                    </a>
                                    <form method="post" action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mr10 mb10">Delete</button>
                                    </form>
                                    <button class="btn btn-secondary mr10 mb10 testApi" data-id="{{ $user->id }}">test
                                        Api
                                    </button>
                                </div>
                            </div>
                        @empty
                            Нет пользователей
                        @endforelse
                        <div class="d-flex">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let buttons = document.querySelectorAll('.testApi');
        buttons.forEach((elem) => {
            elem.addEventListener('click', () => {
                let id = elem.getAttribute('data-id');
                (async () => {
                    const response = await fetch('/api/apiTest?id=' + id);
                    const answer = await response.json();
                    console.log(answer);
                })();
            })
        })
    </script>
@endsection
