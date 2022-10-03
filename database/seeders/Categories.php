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
    public function run()
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
                'id' => 1,
                'title' => 'Наука (из базы)',
                'slug' => 'science'
            ],
            [
                'id' => 2,
                'title' => 'Спорт (из базы)',
                'slug' => 'sport',
            ],
            [
                'id' => 3,
                'title' => 'Культура (из базы)',
                'slug' => 'culture',
            ]
        ];
    }
}
