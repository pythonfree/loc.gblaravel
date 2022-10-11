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
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $categories = Category::query()->get();
        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * @param string $slug
     * @return Factory|View|Application|RedirectResponse
     */
    public function show(string $slug): Factory|View|Application|RedirectResponse
    {
        /** @var Category $category */
        $category = Category::query()->where('slug', $slug)->get()->first();
        $news = $category->news()->get();
        return view('categories.show')
            ->with('news', $news)
            ->with('category', $category);

    }
}
