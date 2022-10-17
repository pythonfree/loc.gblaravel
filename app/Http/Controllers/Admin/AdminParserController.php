<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class AdminParserController extends Controller
{

    const RSS_LINK = 'https://www.vedomosti.ru/rss/news';

    public function index()
    {
        $xml = XmlParser::load(static::RSS_LINK);
        $mainTitle = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'image' => ['uses' => 'channel.image.url'],
        ]);
        $news = $xml->parse([
            'news' => ['uses' => 'channel.item[title,link,category,pubDate,enclosure::url]'],
        ]);
        $news = $news['news'];
        $newsForView = $news;

        $categories = collect($news)
            ->keyBy('category')
            ->keys()
            ->map(function ($item, $key) {
                return [
                    'title' => $item,
                    'slug' => Str::slug($item),
                ];
            })
            ->all();
        $lastCategoryId = DB::table(Category::TABLE_NAME)->orderBy('id', 'desc')->first()->id ?: 1;
        $categoriesKeyed = collect($categories)
            ->map(function ($item, $key) use ($lastCategoryId) {
                return [
                    'id' => $lastCategoryId + ++$key,
                    'title' => $item['title'],
                ];
            })
            ->keyBy('title');
        $news = collect($news)
            ->map(function ($item, $key) use ($categoriesKeyed) {
                return [
                    'title' => $item['title'],
                    'text' => $item['title'],
                    'is_private' => false,
                    'category_id' => $categoriesKeyed[$item['category']]['id'],
                    'image' => $item['enclosure::url'],
                    'link' => $item['link'],
                ];
            })
            ->all();
        Category::query()->delete();
        DB::table(Category::TABLE_NAME)->insert($categories);
        News::query()->delete();
        DB::table(News::TABLE_NAME)->insert($news);

        return view('admin.parser.index')
            ->with('mainTitle', $mainTitle)
            ->with('news', $newsForView);
    }
}