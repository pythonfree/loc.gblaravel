<?php

namespace App\Http\Controllers\News;


use App\Helpers\Model as ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @param Article $news
     * @param Category $category
     * @return Factory|View|Application
     */
    public function index(Article $news, Category $category): Factory|View|Application
    {
        $news = $news->getNews() ?: [];
        ModelHelper::addCategoryInfo($news, $category->getCategories());
        return view('news.index', ['news' => $news]);
    }

    /**
     * @param string $slug
     * @param int $id
     * @param Article $news
     * @param Category $category
     * @return Factory|View|Application
     */
    public function show(string $slug, int $id, Article $news, Category $category): Factory|View|Application
    {
        return view('news.show')->with([
            'article' => $news->getById($id),
            'title' => $category->getTitleBySlug($slug)
        ]);
    }
}
