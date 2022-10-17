<?php

namespace App\Adaptors;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;

class Adaptor
{
    public function getUserBySocId($user, string $socName)
    {
        $email = static::getEmail($user);
        $userInSystem = User::query()
            ->where('social_id', '=', $user->getId())
            ->where('type_auth', '=', $socName)
            ->first();
        if (is_null($userInSystem) && $user->getId() && $socName) {
            $userInSystem = new User();
            $userInSystem->fill([
                'name' => $user->getName() ?: $user->getEmail() ?: $user->getId(),
                'email' => $email,
                'password' => Hash::make($user->getId() . $socName),
                'is_admin' => false,
                'social_id' => $user->getId(),
                'type_auth' => $socName,
                'avatar' => $user->getAvatar() ?: '',
            ]);
            if ($userInSystem->save()) {
                return $userInSystem;
            }
        }
        return $userInSystem;
    }

    public static function getEmail($user): mixed
    {
        return $user->getEmail() ?: $user->accessTokenResponseBody['email'];
    }
}
