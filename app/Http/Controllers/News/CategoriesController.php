<?php

namespace App\Http\Controllers\News;


use App\Helpers\Model as ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @param Category $category
     * @return Factory|View|Application
     */
    public function index(Category $category): Factory|View|Application
    {
        return view('categories.index', ['categories' => $category->getCategories()]);
    }

    /**
     * @param string $slug
     * @param Article $news
     * @param Category $category
     * @return Factory|View|Application
     */
    public function show(string $slug, Article $news, Category $category): Factory|View|Application
    {
        $news = $news->getByCategorySlug($slug, $category);
        ModelHelper::addCategoryInfo($news, $category->getCategories());
        return view('categories.show', [
            'news' => $news,
            'title' => $category->getTitleBySlug($slug)
        ]);
    }
}
