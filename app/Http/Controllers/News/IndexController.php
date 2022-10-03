<?php

namespace App\Http\Controllers\News;


use App\Helpers\Model as ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\ArticleDb;
use App\Models\CategoryDb;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @param ArticleDb $news
     * @param CategoryDb $category
     * @return Factory|View|Application
     */
    public function index(ArticleDb $news, CategoryDb $category): Factory|View|Application
    {
        $news = $news->getAll() ?: [];
        ModelHelper::addCategoryInfo($news, $category->getAll());
        return view('news.index', ['news' => $news]);
    }

    /**
     * @param string $slug
     * @param int $id
     * @param ArticleDb $news
     * @param CategoryDb $category
     * @return Factory|View|Application
     */
    public function show(string $slug, int $id, ArticleDb $news, CategoryDb $category): Factory|View|Application
    {
        return view('news.show')->with([
            'article' => $news->getById($id),
            'title' => $category->getTitleBySlug($slug)
        ]);
    }
}
