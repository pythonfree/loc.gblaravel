<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $news = News::getNews();
        return view('news.index')->with('news', $news);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $article = News::getArticleById($id);
        if (is_null($article)) {
            $article = [
                'title' => 'Упс...',
                'text' => 'А эта новость уже не новость =(...',
            ];
        }
        return view('news.article')->with('article', $article);
    }
}
