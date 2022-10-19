@extends('layouts.main')

@section('title', 'Login')

@section('menu')
    @include('menu')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }} (admin@admin.ru)</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }} (123)</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse mb-1">
                            <div class="col-md-8">
                                @if(env('VKONTAKTE_CLIENT_ID', '') == '' || env('VKONTAKTE_CLIENT_SECRET', '') == '')
                                    <a class="btn btn-block btn-social btn-vk" href="#" style="color: white">
                                        <span class="fa fa-vk"></span> Add CREDENTIALS for VK in ".env"
                                    </a>
                                @else
                                    <a class="btn btn-block btn-social btn-vk" href="{{ route('LoginVK') }}"
                                       style="color: white">
                                        <span class="fa fa-vk"></span> Sign in with VK
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse mb-1">
                            <div class="col-md-8">
                                @if(env('GITHUB_CLIENT_ID', '') == '' || env('GITHUB_CLIENT_SECRET', '') == '')
                                    <a class="btn btn-block btn-social btn-github" href="#" style="color: white">
                                        <span class="fa fa-vk"></span> Add CREDENTIALS for Github in ".env"
                                    </a>
                                @else
                                    <a class="btn btn-block btn-social btn-github" href="{{ route('LoginGithub') }}">
                                        <span class="fa fa-github"></span> Sign in with Github
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
