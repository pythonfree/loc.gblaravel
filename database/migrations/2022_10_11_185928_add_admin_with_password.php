<?php

use App\Models\Users;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        $user = new Users();
        $user->fill([
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('123'),
        ])->save();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $id = (int)Users::query()->select(['id'])->where('name', '=', 'admin')->get()->first()->id;
        Users::query()->where('id', '=', $id)->delete();
    }
};
