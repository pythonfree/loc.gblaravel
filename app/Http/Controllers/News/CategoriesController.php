<?php

namespace App\Http\Controllers\News;


use App\Helpers\Model as ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\ArticleDb;
use App\Models\CategoryDb;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @param CategoryDb $category
     * @return Factory|View|Application
     */
    public function index(CategoryDb $category): Factory|View|Application
    {
        return view('categories.index', ['categories' => $category->getAll()]);
    }

    /**
     * @param string $slug
     * @param ArticleDb $news
     * @param CategoryDb $category
     * @return Factory|View|Application
     */
    public function show(string $slug, ArticleDb $news, CategoryDb $category): Factory|View|Application
    {
        $news = $news->getByCategorySlug($slug, $category) ?: [];
        ModelHelper::addCategoryInfo($news, $category->getAll());
        return view('categories.show', [
            'news' => $news,
            'title' => $category->getTitleBySlug($slug)
        ]);
    }
}
