<?php

namespace App\Http\Controllers\News;


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
        return view('categories.index')
            ->with('categories', $category->getCategories());
    }

    /**
     * @param string $slug
     * @param Article $news
     * @param Category $category
     * @return Factory|View|Application
     */
    public function show(string $slug, Article $news, Category $category): Factory|View|Application
    {
        return view('categories.show')
            ->with('news', $news->getByCategorySlug($slug))
            ->with('category', $category->getBySlug($slug));

    }
}
