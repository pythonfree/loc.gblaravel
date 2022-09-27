<?php

namespace App\Models;

class Categories
{
    private static $categories = [
        [
            'id' => 1,
            'title' => 'Наука',
            'name' => 'science'
        ],
        [
            'id' => 2,
            'title' => 'Спорт',
            'name' => 'sport',
        ],
        [
            'id' => 3,
            'title' => 'Культура',
            'name' => 'culture',
        ]
    ];

    /**
     * @return array[]
     */
    public static function getCategories(): array
    {
        return static::$categories;
    }

    /**
     * @param string $name
     * @return int|null
     */
    public static function getCategoryIdByName(string $name): ?int
    {
        $collection = collect(static::$categories);
        $id = $collection->groupBy('name')->get($name);
        return $id ? $id->first()['id'] : null;
    }
}
