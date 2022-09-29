<?php

namespace App\Http\Controllers\News;


use App\Helpers\Controller as ControllerHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @param Article $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function index(Article $news, Category $category): Factory|View|Application
    {
        $news = $news->get() ?: [];
        ControllerHelper::addCategoryInfo($news, $category->get());
        return view('news.index')->with('news', $news);
    }

    /**
     * @param string $slug
     * @param int $id
     * @param Article $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(string $slug, int $id, Article $news, Category $category): Factory|View|Application
    {
        return view('news.show')->with([
            'article' => $news->getArticleById($id),
            'title' => $category->getTitleBySlug($slug)
        ]);
    }
}
