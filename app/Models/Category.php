<?php

namespace App\Models;

use App\Contract\ICategory;

class Category implements ICategory
{
    private array $categories = [
        [
            'id' => 1,
            'title' => 'Наука (из массива)',
            'slug' => 'science'
        ],
        [
            'id' => 2,
            'title' => 'Спорт (из массива)',
            'slug' => 'sport',
        ],
        [
            'id' => 3,
            'title' => 'Культура (из массива)',
            'slug' => 'culture',
        ]
    ];

    /**
     * @return array[]
     */
    public function getAll(): array
    {
        return $this->categories;
    }

    /**
     * @param string $slug
     * @return int|null
     */
    public function getIdBySlug(string $slug): ?int
    {
        $collection = collect($this->categories);
        $id = $collection->groupBy('slug')->get($slug);
        return $id ? $id->first()['id'] : null;
    }

    /**
     * @param string $slug
     * @return string|null
     */
    public function getTitleBySlug(string $slug): ?string
    {
        $collection = collect($this->getAll());
        $title = $collection->groupBy('slug')->get($slug);
        return $title ? $title->first()['title'] : null;
    }
}
