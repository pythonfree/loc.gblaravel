<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email:rfc',
            'currentPassword' => 'required|min:3',
            'newPassword' => 'nullable|min:3',
            'confirmPassword' => 'nullable|min:3',
        ];
    }

    /**
     * @return string[]
     */
    public static function attributesName(): array
    {
        return [
            'name' => '"Имя"',
            'email' => '"Email"',
            'currentPassword' => '"Пароль"',
            'newPassword' => '"Пароль"',
            'confirmPassword' => '"Пароль"',
        ];
    }

}
