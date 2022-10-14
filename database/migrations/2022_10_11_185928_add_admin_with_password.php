<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        $now = now();
        $user = new User();
        $user->fill([
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('123'),
            'email_verified_at' => $now,
            'remember_token' => Str::random(10),
        ])->save();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $id = (int)User::query()->select(['id'])->where('name', '=', 'admin')->get()->first()->id;
        User::query()->where('id', '=', $id)->delete();
    }
};
