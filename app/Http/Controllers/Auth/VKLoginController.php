<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Auth\Contract\SocialLoginController;

class VKLoginController extends SocialLoginController
{
    protected string $socialNetwork = 'vkontakte';
    protected string $type_auth = 'vk';
}
