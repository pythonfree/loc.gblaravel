<?php

namespace App\Http\Controllers\News;


use App\Helpers\Controller as ControllerHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @param Category $category
     * @return Application|Factory|View
     */
    public function index(Category $category)
    {
        $categories = $category->getCategories();
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * @param string $slug
     * @param News $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(string $slug, News $news, Category $category)
    {
        $categories = $category->getCategories();
        $news = $news->getNewsByCategorySlug($slug, $category) ?: [];
        ControllerHelper::addCategoryInfo($news, $categories);
        return view('categories.show')->with('news', $news);
    }
}
