<?php

namespace App\Http\Controllers\News;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NewsCategoriesController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(News $news): View|Factory|Application
    {
        $categories = Category::query()
            ->orWhereHas($news->getTable())
            ->get();
        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show(string $slug): View|Factory|Application
    {
        /** @var Category $category */
        $category = Category::query()
            ->where('slug', $slug)
            ->firstOrFail();
        $news = $category
            ->news()
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('categories.show')
            ->with('news', $news)
            ->with('category', $category);
    }
}
