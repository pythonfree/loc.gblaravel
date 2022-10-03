<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Category
{
    private ?array $categories;
    private string $tableName = 'categories';

    public function __construct()
    {
        $this->categories = DB::table($this->tableName)->get()->all();
    }

    /**
     * @return array|null
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id): mixed
    {
        return DB::table($this->tableName)->find($id);
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function getTitleById(int $id): ?string
    {
        $slug = $this->getSlugById($id);
        return $this->getTitleBySlug($slug);
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function getSlugById(int $id): ?string
    {
        $collection = collect($this->getCategories());
        $slug = $collection->firstWhere('id', $id);
        return $slug ? $slug->slug : null;
    }

    /**
     * @param string $slug
     * @return int|null
     */
    public function getIdBySlug(string $slug): ?int
    {
        $collection = collect($this->getCategories());
        $id = $collection->groupBy('slug')->get($slug);
        return $id ? $id->first()->id : null;
    }

    /**
     * @param string $slug
     * @return string|null
     */
    public function getTitleBySlug(string $slug): ?string
    {
        $collection = collect($this->getCategories());
        $title = $collection->groupBy('slug')->get($slug);
        return $title ? $title->first()->title : null;
    }
}
