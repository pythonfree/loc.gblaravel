<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Article
{
    private Collection $news;
    private ?int $lastId = null;
    private string $tableName = 'news';

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
