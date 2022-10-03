<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;

class News extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        $faker = FakerFactory::create('ru_RU');
        $data = [];
        for($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => '"' . $faker->company() . '"' . ' сообщает: ' . Str::limit($faker->realText(100), 95) . ' (Из базы)',
                'text' => $faker->realText(rand(1000, 3000)),
                'isPrivate' => (bool)rand(0,1),
                'categoryId' => rand(1,3),
            ];
        }
        return  $data;
    }
}
