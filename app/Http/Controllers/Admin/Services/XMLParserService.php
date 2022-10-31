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
        try {
            $xml = XmlParser::load($resource->link);
            $news = $xml->parse([
                'news' => [
                    'uses' => 'channel.item[title,link,category,pubDate,enclosure::url,description]'
                ],
            ])['news'];
            file_put_contents(__FILE__ . '$news', print_r($news, 1));
            $this->importNewsToDB($news);
        } catch (\Exception $e) {
//            file_put_contents(__FILE__ . '$e', print_r($e, 1));
        }
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
        $categories[] = [
            'title' => 'Empty category',
            'slug' => Str::slug('Пустая категория'),
        ];
        DB::table(Category::TABLE_NAME)->insertOrIgnore($categories);
        $categories = Category::query()
            ->get()
            ->toArray();
        $categoriesKeyedByTitle = collect($categories)
            ->keyBy('title')
            ->all();
        $news = collect($news)
            ->map(function ($item, $key) use ($categoriesKeyedByTitle) {
                return [
                    'title' => $item['title'],
                    'text' => $item['description'],
                    'is_private' => false,
                    'category_id' => $categoriesKeyedByTitle[$item['category'] ?? 'Empty category']['id'],
                    'image' => $item['enclosure::url'],
                    'link' => $item['link'],
                    'created_at' => $item['pubDate'] ? (new \DateTime($item['pubDate']))->format('Y-m-d H:i:s') : (new \DateTime('1 years ago'))->format('Y-m-d H:i:s'),
                ];
            })
            ->all();
        DB::table(News::TABLE_NAME)->insertOrIgnore($news);
    }
}
