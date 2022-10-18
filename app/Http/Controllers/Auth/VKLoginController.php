<?php

namespace App\Http\Controllers\Auth;


class VKLoginController extends SocialLoginController
{
    protected static string $socialNetwork = 'vkontakte';
    protected static string $type_auth = 'vk';
}
