<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Categories::getCategories();
        return view('news.categories')->with('categories', $categories);
    }

    /**
     * @param string $name
     * @return Application|Factory|View
     */
    public function show(string $name)
    {
        $news = News::getNewsByCategoryName($name) ?: [];
        return view('news.category')->with('news', $news);
    }
}
