<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Article
{
    private Collection $news;
    private string $tableName = 'news';
    private int $lastId;

    public function __construct()
    {
        $this->news = DB::table($this->tableName)
            ->join('categories', 'news.categoryId', '=', 'categories.id')
            ->select(
                'news.*',
                'categories.slug as categorySlug',
                'categories.title as categoryTitle'
            )
            ->get();
    }

    /**
     * @return Collection
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id): mixed
    {
        return $this->getNews()->firstWhere('id', $id);
    }

    /**
     * @param int $categoryId
     * @return array|null
     */
    public function getByCategoryId(int $categoryId): ?array
    {
        return $this->getNews()->where('categoryId', $categoryId)->all();
    }

    /**
     * @param string $slug
     * @return array|null
     */
    public function getByCategorySlug(string $slug): ?array
    {
        return $this->getNews()->where('categorySlug', $slug)->all();
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

