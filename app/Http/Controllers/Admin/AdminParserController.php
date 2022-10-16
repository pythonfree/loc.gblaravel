<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return view('admin.parser.index')
            ->with('mainTitle', $mainTitle)
            ->with('news', $news);
    }
}
