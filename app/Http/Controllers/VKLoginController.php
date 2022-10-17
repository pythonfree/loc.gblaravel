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


class VKLoginController extends Controller
{
    public function redirectVK()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callbackVK(Adaptor $userAdaptor, Request $request)
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
