<?php

namespace App\Models;

use App\Contract\ICategory;
use Illuminate\Support\Facades\File;

class ArticleFile
{
    private array $news = [];

    public function __construct()
    {
        $this->news = $this->readFile();
    }

    /**
     * @return array|null
     */
    public function readFile(): ?array
    {
        $path = realpath(__DIR__ . '/../../storage/news.json');
        $jsonString = File::get($path);
        return json_decode($jsonString, true);
    }

    /**
     * @return array[]
     */
    public function getAll(): array
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
     * @param string $path
     * @param array $requestData
     * @return void
     */
    public function save(string $path, array $requestData): void
    {
        $this->news[] = array_merge(['id' => $this->news ? count($this->news) + 1 : 1], $requestData);
        $newJsonString = json_encode($this->news, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        File::put($path, $newJsonString);
    }
}
