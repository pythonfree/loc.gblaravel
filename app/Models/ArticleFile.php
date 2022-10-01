<?php

namespace App\Models;

use App\Contract\ICategory;
use Illuminate\Support\Facades\Storage;

class ArticleFile
{
    private ?array $news = [];
    private ?int $lastId = null;

    public function __construct()
    {
        $this->news = $this->readFile();
    }

    /**
     * @return array|null
     */
    public function readFile(): ?array
    {
        $jsonString = Storage::disk('public')->get('news.json');
        return json_decode($jsonString, true);
    }

    /**
     * @return array|null
     */
    public function getAll(): ?array
    {
        return $this->news;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getById($id): ?array
    {
        $collection = collect($this->getAll());
        $article = $collection->groupBy('id')->get($id);
        return $article ? $article->first() : null;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getByCategoryId(int $id): ?array
    {
        $collection = collect($this->getAll());
        $news = $collection->groupBy('category_id')->get($id);
        return $news ? $news->all() : null;
    }

    /**
     * @param string $slug
     * @param Category $category
     * @return array|null
     */
    public function getByCategorySlug(string $slug, ICategory $category): ?array
    {
        $id = $category->getIdBySlug($slug);
        return $this->getByCategoryId($id);
    }

    /**
     * @param array $requestData
     * @return bool
     */
    public function save(array $requestData): bool
    {
        $this->lastId = $this->news ? count($this->news) + 1 : 1;
        $this->news[] = array_merge([
            'id' => $this->lastId
        ], $requestData);
        $newJsonString = json_encode($this->news, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return Storage::disk('public')->put('news.json', $newJsonString);
    }

    /**
     * @return int
     */
    public function getLastId(): int
    {
        return $this->lastId;
    }
}
