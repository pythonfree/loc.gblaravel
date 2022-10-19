<?php

namespace App\Http\Controllers\Auth\Adaptors;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Adaptor
{
    /**
     * @param $user
     * @param string $socName
     * @return Model|Builder|User|null
     */
    public function getUserBySocId($user, string $socName): Model|Builder|User|null
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

    /**
     * @param $user
     * @return mixed
     */
    public static function getEmail($user): mixed
    {
        return $user->getEmail() ?: $user->accessTokenResponseBody['email'];
    }
}
