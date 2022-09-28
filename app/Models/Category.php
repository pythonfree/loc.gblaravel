<?php

namespace App\Models;

class Category
{
    private array $categories = [
        [
            'id' => 1,
            'title' => 'Наука',
            'slug' => 'science'
        ],
        [
            'id' => 2,
            'title' => 'Спорт',
            'slug' => 'sport',
        ],
        [
            'id' => 3,
            'title' => 'Культура',
            'slug' => 'culture',
        ]
    ];

    /**
     * @return array[]
     */
    public function get(): array
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
        $collection = collect($this->get());
        $title = $collection->groupBy('slug')->get($slug);
        return $title ? $title->first()['title'] : null;
    }
}
