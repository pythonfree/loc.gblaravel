<?php

namespace App\Http\Controllers\News;


use App\Helpers\Controller as ControllerHelper;
use App\Http\Controllers\Controller;
use App\Models\CategoryFile;
use App\Models\ArticleFile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @param CategoryFile $category
     * @return Application|Factory|View
     */
    public function index(CategoryFile $category): Factory|View|Application
    {
        return view('categories.index')->with('categories', $category->getAll());
    }

    /**
     * @param string $slug
     * @param ArticleFile $news
     * @param CategoryFile $category
     * @return Application|Factory|View
     */
    public function show(string $slug, ArticleFile $news, CategoryFile $category): Factory|View|Application
    {
        $news = $news->getByCategorySlug($slug, $category) ?: [];
        ControllerHelper::addCategoryInfo($news, $category->getAll());
        return view('categories.show')->with(['news' => $news, 'title' => $category->getTitleBySlug($slug)]);
    }
}
