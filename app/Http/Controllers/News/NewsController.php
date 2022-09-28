<?php

namespace App\Http\Controllers\News;


use App\Helpers\Controller as ControllerHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @param News $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function index(News $news, Category $category)
    {
        $news = $news->getNews() ?: [];
        ControllerHelper::addCategoryInfo($news, $category->getCategories());
        return view('news.index')->with('news', $news);
    }

    /**
     * @param string $name
     * @param int $id
     * @param News $news
     * @return Application|Factory|View
     */
    public function show(string $name, int $id, News $news)
    {
        return view('news.show')->with(['article' => $news->getArticleById($id)]);
    }
}
