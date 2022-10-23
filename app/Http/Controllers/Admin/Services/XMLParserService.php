<?php

namespace App\Http\Controllers\Admin\Services;

use App\Models\Category;
use App\Models\News;
use App\Models\Resources;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class XMLParserService
{
    /**
     * @param Resources $resource
     * @return void
     */
    public function saveNewsWithCategories(Resources $resource): void
    {
        $xml = XmlParser::load($resource->link);
        $news = $xml->parse([
            'news' => ['uses' => 'channel.item[title,link,category,pubDate,enclosure::url,description]'],
        ])['news'];
        $this->importNewsToDB($news);
    }

    /**
     * @return int
     */
    private function getLastCategoryId(): int
    {
        return DB::getPdo()->lastInsertId();
    }

    /**
     * @param array $news
     * @return void
     */
    private function importNewsToDB(array $news): void
    {
        $categories = collect($news)
            ->keyBy('category')
            ->keys()
            ->map(function ($item, $key) {
                return [
                    'title' => $item ?: 'Empty category',
                    'slug' => $item ? Str::slug($item) : Str::slug('Пустая категория'),
                ];
            })
            ->all();
        if (empty($categories)) {
            $categories[] = [
                'title' => 'Empty category',
                'slug' => Str::slug('Пустая категория'),
            ];
        }

        $lastCategoryId = $this->getLastCategoryId();
        $categoriesKeyedByTitle = collect($categories)
            ->map(function ($item, $key) use ($lastCategoryId) {
                return [
                    'id' => $lastCategoryId + ++$key,
                    'title' => $item['title'] ?: 'Empty category',
                ];
            })
            ->keyBy('title');

        $news = collect($news)
            ->map(function ($item, $key) use ($categoriesKeyedByTitle) {
                return [
                    'title' => $item['title'],
                    'text' => $item['description'],
                    'is_private' => false,
                    'category_id' => $categoriesKeyedByTitle[$item['category'] ?: 'Empty category']['id'],
                    'image' => $item['enclosure::url'],
                    'link' => $item['link'],
                    'created_at' => (new \DateTime($item['pubDate']))->format('Y-m-d H:i:s'),
                ];
            })
            ->all();

        DB::table(Category::TABLE_NAME)->insertOrIgnore($categories);
        DB::table(News::TABLE_NAME)->insertOrIgnore($news);
    }
}