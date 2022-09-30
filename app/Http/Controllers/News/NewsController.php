<?php

namespace App\Http\Controllers\News;


use App\Helpers\Controller as ControllerHelper;
use App\Http\Controllers\Controller;
use App\Models\CategoryFile;
use App\Models\ArticleFile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @param ArticleFile $news
     * @param CategoryFile $category
     * @return Application|Factory|View
     */
    public function index(ArticleFile $news, CategoryFile $category): Factory|View|Application
    {
        $news = $news->getAll() ?: [];
        ControllerHelper::addCategoryInfo($news, $category->getAll());
        return view('news.index')->with('news', $news);
    }

    /**
     * @param string $slug
     * @param int $id
     * @param ArticleFile $news
     * @param CategoryFile $category
     * @return Application|Factory|View
     */
    public function show(string $slug, int $id, ArticleFile $news, CategoryFile $category): Factory|View|Application
    {
        return view('news.show')->with([
            'article' => $news->getById($id),
            'title' => $category->getTitleBySlug($slug)
        ]);
    }
}
