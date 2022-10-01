<?php

namespace App\Models;

use App\Contract\ICategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryFile implements ICategory
{
    private array $categories = [];

    public function __construct()
    {
        $this->categories = $this->readFile();
    }

    /**
     * @param int $categoryId
     * @return string|null
     */
    public function getTitleByCategoryId(int $categoryId): ?string
    {
        $slug = $this->getSlugById($categoryId);
        return $this->getTitleBySlug($slug);
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function getSlugById(int $id): ?string
    {
        $collection = collect($this->categories);
        $slug = $collection->firstWhere('id', $id);
        return $slug ? $slug['slug'] : null;
    }

    /**
     * @return array|null
     */
    public function readFile(): ?array
    {
        $jsonString = Storage::disk('public')->get('categories.json');
        return json_decode($jsonString, true);
    }

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
