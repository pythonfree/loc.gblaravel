<?php

namespace App\Http\Controllers;

use App\Adaptors\Adaptor;
use App\Helpers\LoginController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;


class GithubLoginController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|RedirectResponse
     */
    public function redirectGithub(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::driver('github')->redirect();
    }

    /**
     * @param Adaptor $userAdaptor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callbackGithub(Adaptor $userAdaptor): \Illuminate\Http\RedirectResponse
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
