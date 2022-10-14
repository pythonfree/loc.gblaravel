@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.main')
@section('title', "Редактирование профиля - $user->name (ID = $user->id)")

@section('menu')
    @include('admin.menu')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование профиля - {{ $user->name }} (ID = {{ $user->id }}):</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') ?? $user->name }}"  autocomplete="name"
                                           autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') ?? $user->email }}"  autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Текущий
                                    пароль:</label>
                                <div class="col-md-6">
                                    <input id="currentPassword"
                                           type="password"
                                           class="form-control @error('currentPassword') is-invalid @enderror"
                                           name="currentPassword"
                                           autocomplete="new-password"
                                           placeholder="Введите пароль для изменения профиля"

                                           @if(Auth::user()->is_admin && Route::current()->getName() == 'admin.users.edit'){{ 'disabled' }}@endif
                                           value="@if(Auth::user()->is_admin && Route::current()->getName() == 'admin.users.edit'){{ '********' }}@endif"
                                    >
                                    @if(Auth::user()->is_admin && Route::current()->getName() == 'admin.users.edit')
                                        <input type="hidden" name="currentPassword" value="********">
                                    @endif
                                    @if(Auth::user()->is_admin && Route::current()->getName() == 'admin.users.edit')
                                        <input type="hidden" name="userEdit" value="1">
                                    @endif
                                    @if(Auth::user()->is_admin && Route::current()->getName() == 'admin.users.edit')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                    @endif
                                    @error('currentPassword')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <fieldset class="border mb-3 border-danger">
                                <legend class="text-center text-black-50">Изменение пароля</legend>
                                <div class="row mb-3">
                                    <label class="col-md-4 form-check-label col-form-label text-md-end"
                                           for="is_change_password">Изменить пароль?</label>
                                    <div class="col-md-6">
                                        <input
                                            type="checkbox"
                                            class="form-check form-check-input"
                                            id="is_change_password"
                                            name="is_change_password"
                                            value="1"
                                            @if(Auth::user()->is_admin && Route::current()->getName() == 'admin.users.edit'){{ 'disabled' }}@endif
                                            onclick="
                                                const inputNewPassword = document.querySelector('#newPassword');
                                                const inputConfirmPassword = document.querySelector('#confirmPassword');
                                                let inputs = [inputNewPassword, inputConfirmPassword];
                                                for (let input of inputs) {
                                                  input.toggleAttribute('disabled');
                                                }
                                            "
                                        >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-form-label text-md-end">Новый
                                        пароль:</label>
                                    <div class="col-md-6">
                                        <input id="newPassword"
                                               type="password"
                                               class="form-control @error('newPassword') is-invalid @enderror"
                                               name="newPassword"
                                               autocomplete="new-password"
                                               disabled
                                        >
                                        @error('newPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="confirmPassword" class="col-md-4 col-form-label text-md-end">Подтвердите
                                        пароль:</label>
                                    <div class="col-md-6">
                                        <input id="confirmPassword"
                                               type="password"
                                               class="form-control @error('confirmPassword') is-invalid @enderror"
                                               name="confirmPassword"
                                               autocomplete="new-password"
                                               disabled
                                        >
                                        @error('confirmPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                            @if(Auth::user()->is_admin && Route::current()->getName() == 'admin.users.edit')
                                <fieldset class="border mb-3 border-danger">
                                    <legend class="text-center text-black-50">Администратор</legend>
                                    <div class="row mb-3 justify-content-center">
                                        <label class="col-md-2 form-check-label col-form-label text-md-end"
                                               for="is_admin">Да\Нет?</label>
                                        <div class="col-md-2">
                                            <input
                                                type="checkbox"
                                                class="col-md-1 form-check form-check-input"
                                                id="is_admin"
                                                name="is_admin"
                                                value="1"
                                            @if($user->is_admin && Route::current()->getName() == 'admin.users.edit'){{ 'checked' }}@endif
                                            >
                                        </div>
                                    </div>
                                </fieldset>
                            @endif
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Обновить профиль
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
