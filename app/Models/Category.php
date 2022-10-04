<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category
{
    private Collection $categories;
    private int $lastId;
    private string $tableName = 'categories';

    public function __construct()
    {
        $this->categories = DB::table($this->tableName)->get();
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param $slug
     * @return mixed|null
     */
    public function getBySlug($slug): mixed
    {
        return $this->getCategories()->firstWhere('slug', $slug);
    }

    /**
     * @param array $requestData
     * @return bool
     */
    public function save(array $requestData): bool
    {
        return (bool)$this->lastId = DB::table($this->tableName)->insertGetId($requestData);
    }

    /**
     * @return int
     */
    public function getLastId(): int
    {
        return $this->lastId;
    }

}
