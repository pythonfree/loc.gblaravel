<?php

use App\Models\Users;
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
        $id = (int)Users::query()->select(['id'])->where('name', '=', 'admin')->get()->first()->id;
        Users::query()->where('id', '=', $id)->update([
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
        $id = (int)Users::query()->select(['id'])->where('name', '=', 'admin')->get()->first()->id;
        Users::query()->where('id', '=', $id)->update([
            'is_admin' => false,
        ]);
    }
};
