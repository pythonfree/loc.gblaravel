<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Article
{
    private ?array $news;
    private ?int $lastId = null;
    private string $tableName = 'news';

    public function __construct()
    {
        $this->news = DB::table($this->tableName)->get()->all();
    }

    /**
     * @return array|null
     */
    public function getNews(): ?array
    {
        return $this->news;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id): mixed
    {
        $collection = collect($this->getNews());
        $article = $collection->groupBy('id')->get($id);
        return $article ? $article->first() : null;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getByCategoryId(int $id): ?array
    {
        $collection = collect($this->getNews());
        $news = $collection->groupBy('categoryId')->get($id);
        return $news ? $news->all() : null;
    }

    /**
     * @param string $slug
     * @param Category $category
     * @return array|null
     */
    public function getByCategorySlug(string $slug, Category $category): ?array
    {
        $id = $category->getIdBySlug($slug);
        return $this->getByCategoryId($id);
    }

    /**
     * @param array $requestData
     * @return bool
     */
    public function save(array &$requestData): bool
    {
        $this->saveNews($requestData);
        $newJsonString = json_encode($this->news, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return Storage::disk('public')->put('news.json', $newJsonString);
    }

    /**
     * @param $requestData
     * @return void
     */
    private function saveNews(&$requestData): void
    {
        $this->setImageUrl($requestData);
        $this->setLastId();
        $this->setNews($requestData);
    }

    /**
     * @param $requestData
     * @return void
     */
    private function setNews($requestData): void
    {
        $this->news[] = array_merge([
            'id' => $this->lastId
        ], $requestData);
    }

    /**
     * @return void
     */
    private function setLastId(): void
    {
        $maxId = 1;
        foreach ($this->news as $article) {
            if ($article['id'] > $maxId) {
                $maxId = $article['id'];
            }
        }
        $maxId++;
        $this->lastId = $maxId;
    }

    /**
     * @param $requestData
     * @return void
     */
    private function setImageUrl(&$requestData): void
    {
        $img = $requestData['image'] ?? null;
        if ($img) {
            $path = Storage::putFile('public/images', $img);
            $url = Storage::url($path);
            $requestData['image'] = $url;
        }
    }

    /**
     * @return int
     */
    public function getLastId(): int
    {
        return $this->lastId;
    }
}
