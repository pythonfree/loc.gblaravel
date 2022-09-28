<?php

namespace App\Models;

class Category
{
    private array $categories = [
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
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param string $name
     * @return int|null
     */
    public function getCategoryIdByName(string $name): ?int
    {
        $collection = collect($this->categories);
        $id = $collection->groupBy('name')->get($name);
        return $id ? $id->first()['id'] : null;
    }
}
