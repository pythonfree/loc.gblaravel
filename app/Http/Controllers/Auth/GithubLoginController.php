<?php

namespace App\Http\Controllers\Auth;


class GithubLoginController extends SocialLoginController
{
    protected static string $socialNetwork = 'github';
    protected static string $type_auth = 'github';
}
