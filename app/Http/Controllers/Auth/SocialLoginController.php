<?php

namespace App\Http\Controllers\Auth;

use App\Adaptors\Adaptor;
use App\Helpers\LoginController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;


abstract class SocialLoginController extends Controller
{
    protected static string $socialNetwork = '';
    protected static string $type_auth = '';

    /**
     * @return RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function redirect(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            $userName = User::query()->where('id', '=', Auth::id())->first()->name;
            return redirect()
                ->route('home')
                ->with('error', 'Пользователь "' . $userName . '" уже авторизован.');
        }
        return Socialite::driver(static::$socialNetwork)->redirect();
    }

    /**
     * @param Adaptor $userAdaptor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Adaptor $userAdaptor): \Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $user = Socialite::driver(static::$socialNetwork)->user();
        if (LoginController::checkUserByEmail($user, static::$type_auth)) {
            return redirect()
                ->route('login')
                ->with('error', 'Пользователь с таким email уже зарегистрирован.');
        }
        $userInSystem = $userAdaptor->getUserBySocId($user, static::$type_auth);
        if ($userInSystem) {
            Auth::login($userInSystem, true);
            if (Auth::check()) {
                return redirect()
                    ->route('home')
                    ->with('success', 'Успешная авторизация через "' . static::$socialNetwork . '"!');
            }
        }
        return redirect()
            ->route('home')
            ->with('error', 'Ошибка авторизации через "' . static::$socialNetwork . '"!');
    }
}
