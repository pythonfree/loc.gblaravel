<?php

namespace App\Models;

class Categories
{
    private static $categories = [
        [
            'id' => 1,
            'title' => 'Наука'
        ],
        [
            'id' => 2,
            'title' => 'Спорт'
        ],
        [
            'id' => 3,
            'title' => 'Культура'
        ]
    ];

    /**
     * @return array[]
     */
    public static function getCategories(): array
    {
        return static::$categories;
    }
}
