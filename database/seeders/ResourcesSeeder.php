<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert($this->getData());
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        return [
            [
                'link' => 'https://lenta.ru/rss/news',
            ],
            [
                'link' => 'https://lenta.ru/rss/top7',
            ],
            [
                'link' => 'https://lenta.ru/rss/last24',
            ],
            [
                'link' => 'https://lenta.ru/rss/articles',
            ],
            [
                'link' => 'https://lenta.ru/rss/news/russia',
            ],
            [
                'link' => 'https://lenta.ru/rss/articles/russia',
            ],
            [
                'link' => 'https://lenta.ru/rss/photo/russia',
            ],
        ];
    }
}
