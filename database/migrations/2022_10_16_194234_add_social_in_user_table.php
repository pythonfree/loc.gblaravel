<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->string('social_id')
                ->default('')
                ->index('inx_social_id')
                ->comment('ID в соц. сети');
            $table
                ->enum('type_auth', ['site', 'vk', 'fb'])
                ->default('site')
                ->index('inx_type_auth')
                ->comment('ID соц. сети');
            $table
                ->string('avatar')
                ->default('')
                ->index('inx_avatar')
                ->comment('Аватарка в соц. сети');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id_in_soc', 'type_auth', 'avatar']);
        });
    }
};
