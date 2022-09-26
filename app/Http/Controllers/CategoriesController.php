<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Categories::getCategories();
        return view('categories')->with('categories', $categories);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
