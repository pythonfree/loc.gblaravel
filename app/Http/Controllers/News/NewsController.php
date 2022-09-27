<?php

namespace App\Http\Controllers\News;


use App\Helpers\Controller as ControllerHelper;
use App\Http\Controllers\Controller;
use App\Models\Categories;
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
        $categories = Categories::getCategories();
        $news = News::getNews() ?: [];
        ControllerHelper::addCategoryInfo($news, $categories);
        return view('news.index')->with('news', $news);
    }

    /**
     * @param string $name
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(string $name, int $id)
    {
        $article = News::getArticleById($id);
        return view('news.article')->with('article', $article);
    }
}
