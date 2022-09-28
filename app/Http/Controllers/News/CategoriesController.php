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
        return view('categories.index')->with('categories', $category->getCategories());
    }

    /**
     * @param string $slug
     * @param News $news
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(string $slug, News $news, Category $category)
    {
        $news = $news->getNewsByCategorySlug($slug, $category) ?: [];
        ControllerHelper::addCategoryInfo($news, $category->getCategories());
        return view('categories.show')->with(['news' => $news, 'title' => $category->getTitleBySlug($slug)]);
    }
}
