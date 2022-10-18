<?php

namespace App\Helpers;

use App\Adaptors\Adaptor;
use App\Models\User;

class LoginController
{

    /**
     * @param $user
     * @param string $socName
     * @return bool
     */
    public static function checkUserByEmail($user, string $socName): bool
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
