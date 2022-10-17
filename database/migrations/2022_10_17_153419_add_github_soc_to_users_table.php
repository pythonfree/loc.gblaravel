<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE ' . User::TABLE_NAME . " MODIFY COLUMN `type_auth` ENUM('site', 'vk', 'fb', 'github') DEFAULT 'site'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE ' . User::TABLE_NAME . " MODIFY COLUMN `type_auth` ENUM('site', 'vk', 'fb') DEFAULT 'site'");
    }
};
