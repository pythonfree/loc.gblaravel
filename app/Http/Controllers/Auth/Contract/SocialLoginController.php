<?php

namespace App\Http\Controllers\Auth\Contract;

use App\Helpers\LoginController;
use App\Http\Controllers\Auth\Adaptors\Adaptor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Symfony\Component\HttpFoundation\RedirectResponse;


abstract class SocialLoginController extends Controller
{
    protected string $socialNetwork = '';
    protected string $type_auth = '';

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
        return Socialite::driver($this->socialNetwork)->redirect();
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
        try {
            $user = Socialite::driver($this->socialNetwork)->user();
        } catch (InvalidStateException $e) {
            return redirect()
                ->route('home');
        }
        if (LoginController::checkUserByEmail($user, $this->type_auth)) {
            return redirect()
                ->route('login')
                ->with('error', 'Пользователь с таким email уже зарегистрирован.');
        }
        $userInSystem = $userAdaptor->getUserBySocId($user, $this->type_auth);
        if ($userInSystem) {
            Auth::login($userInSystem, true);
            if (Auth::check()) {
                return redirect()
                    ->route('home')
                    ->with('success', 'Успешная авторизация через "' . $this->socialNetwork . '"!');
            }
        }
        return redirect()
            ->route('home')
            ->with('error', 'Ошибка авторизации через "' . $this->socialNetwork . '"!');
    }
}
