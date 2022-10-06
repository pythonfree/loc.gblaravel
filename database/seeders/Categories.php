<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('categories')->insert($this->getData());
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        return  [
            [
                'title' => 'Наука (из базы)',
                'slug' => 'science'
            ],
            [
                'title' => 'Спорт (из базы)',
                'slug' => 'sport',
            ],
            [
                'title' => 'Культура (из базы)',
                'slug' => 'culture',
            ]
        ];
    }
}
