<?php

namespace App\Http\Controllers\News;


use App\Helpers\Controller as ControllerHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @param Category $category
     * @return Application|Factory|View
     */
    public function index(Category $category): Factory|View|Application
    {
        return view('categories.index')->with('categories', $category->getAll());
    }

    /**
     * @param string $slug
     * @param Article $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(string $slug, Article $news, Category $category): Factory|View|Application
    {
        $news = $news->getByCategorySlug($slug, $category) ?: [];
        ControllerHelper::addCategoryInfo($news, $category->getAll());
        return view('categories.show')->with(['news' => $news, 'title' => $category->getTitleBySlug($slug)]);
    }
}
