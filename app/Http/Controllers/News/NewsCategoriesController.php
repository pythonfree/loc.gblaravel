<?php

namespace App\Http\Controllers\News;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsCategoriesController extends Controller
{
    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|Factory|Application
    {
        $categories = Category::query()->get();
        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * @param string $slug
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $slug): \Illuminate\Contracts\View\View|Factory|Application
    {
        /** @var Category $category */
        $category = Category::query()->where('slug', $slug)->get()->first();
        $news = $category->news()->get();
        return view('categories.show')
            ->with('news', $news)
            ->with('category', $category);
    }
}
