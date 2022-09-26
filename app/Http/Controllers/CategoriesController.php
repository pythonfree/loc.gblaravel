<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Categories::getCategories();
        return view('categories')->with('categories', $categories);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $news = News::getNewsByCategoryId($id);
        if (is_null($news)) {
            $news[] = [
                'id' => '#',
                'title' => "Нет новостей для категории - {$id}.",
            ];
        }

        return view('news.index')->with('news', $news);
    }
}
