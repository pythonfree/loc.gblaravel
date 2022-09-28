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
        return view('news.categories')->with('categories', $categories);
    }

    /**
     * @param string $name
     * @param News $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(string $name, News $news, Category $category)
    {
        $categories = $category->getCategories();
        $news = $news->getNewsByCategoryName($name, $category) ?: [];
        ControllerHelper::addCategoryInfo($news, $categories);
        return view('news.category')->with('news', $news);
    }
}
