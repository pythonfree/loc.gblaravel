<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
//        $this->call(UsersSeed::class);
        $this->call(CategoriesSeeder::class);
        $this->call(NewsSeeder::class);
    }
}
