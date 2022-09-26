<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = News::getNews();
        return view('news.index')->with('news', $news);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
