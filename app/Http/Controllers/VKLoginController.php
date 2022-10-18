<?php

namespace App\Http\Controllers;

use App\Adaptors\Adaptor;
use App\Helpers\LoginController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VKLoginController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|RedirectResponse
     */
    public function redirectVK(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::driver('vkontakte')->redirect();
    }

    /**
     * @param Adaptor $userAdaptor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callbackVK(Adaptor $userAdaptor): \Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $user = Socialite::driver('vkontakte')->user();
        if (LoginController::checkUserByEmail($user, 'vk')) {
            return redirect()
                ->route('login')
                ->with('error', 'Пользователь с таким email уже зарегистрирован.');
        }
        $userInSystem = $userAdaptor->getUserBySocId($user, 'vk');
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
