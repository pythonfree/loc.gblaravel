<?php

namespace App\Helpers;

use App\Adaptors\Adaptor;
use App\Models\User;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;

class LoginController
{

    public static function checkUserByEmail($user, string $socName)
    {
        $email = Adaptor::getEmail($user);
        if ($email) {
            $user = User::query()
                ->where('social_id', '=', $user->getId())
                ->where('type_auth', '=', $socName)
                ->where('email', '=', $email)->first();
            if (!is_null($user)) {
                return false;
            }
            $userByEmail = User::query()
                ->where('email', '=', $email)->first();
            if (!is_null($userByEmail)) {
                return true;
            }
        }
        return false;
    }
}
