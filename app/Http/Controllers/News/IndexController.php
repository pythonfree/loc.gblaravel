<?php

namespace App\Http\Controllers\News;


use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $news = News::query()
            ->paginate(3);
        return view('news.index')->with('news', $news);
    }

    /**
     * @param $id
     * @return Factory|View|Application|RedirectResponse
     */
    public function show($id): Factory|View|Application|RedirectResponse
    {
        /** @var News $article */
        $article = News::query()->find($id);
        if (!$article) {
            return redirect()->route('news.index');
        }
        $category = $article->category()->get()->first();
        return view('news.show')
            ->with('article', $article)
            ->with('category', $category);
    }
}
