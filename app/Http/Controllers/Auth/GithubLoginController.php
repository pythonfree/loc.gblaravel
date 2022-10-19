<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Auth\Contract\SocialLoginController;

class GithubLoginController extends SocialLoginController
{
    protected string $socialNetwork = 'github';
    protected string $type_auth = 'github';
}
