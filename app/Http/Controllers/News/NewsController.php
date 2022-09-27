<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $news = News::getNews() ?: [];
        return view('news.index')->with('news', $news);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $article = News::getArticleById($id);
        return view('news.article')->with('article', $article);
    }
}
