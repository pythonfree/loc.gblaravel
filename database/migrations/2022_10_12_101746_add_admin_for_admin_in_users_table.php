<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $id = (int)User::query()->select(['id'])->where('name', '=', 'admin')->get()->first()->id;
        User::query()->where('id', '=', $id)->update([
            'is_admin' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $id = (int)User::query()->select(['id'])->where('name', '=', 'admin')->get()->first()->id;
        User::query()->where('id', '=', $id)->update([
            'is_admin' => false,
        ]);
    }
};
