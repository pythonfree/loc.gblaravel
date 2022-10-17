<?php

namespace App\Http\Controllers;

use App\Adaptors\Adaptor;
use App\Helpers\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Laravel\Socialite\Two\User as LaravelSoc2User;


class GithubLoginController extends Controller
{
    public function redirectGithub()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::driver('github')->redirect();
    }

    public function callbackGithub(Adaptor $userAdaptor, Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $user = Socialite::driver('github')->user();
        if (LoginController::checkUserByEmail($user, 'github')) {
            return redirect()
                ->route('login')
                ->with('error', 'Пользователь с таким email уже зарегистрирован.');
        }
        $userInSystem = $userAdaptor->getUserBySocId($user, 'github');
        if ($userInSystem) {
            Auth::login($userInSystem, true);
            if (Auth::check()) {
                return redirect()
                    ->route('home')
                    ->with('success', 'Успешная авторизация через соц. сеть!');
            }
        }
        return redirect()
            ->route('home')
            ->with('error', 'Ошибка авторизации через соц. сеть!');
    }
}
