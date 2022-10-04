<?php

namespace App\Http\Controllers\News;


use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @param Article $news
     * @return Factory|View|Application
     */
    public function index(Article $news): Factory|View|Application
    {
        return view('news.index')
            ->with('news', $news->getNews());
    }

    /**
     * @param string $slug
     * @param int $id
     * @param Article $news
     * @return Factory|View|Application|RedirectResponse
     */
    public function show(string $slug, int $id, Article $news): Factory|View|Application|RedirectResponse
    {
        if (!$news->getById($id)) {
            return redirect()->route('news.index');
        }
        return view('news.show')
            ->with('article', $news->getById($id));
    }
}
