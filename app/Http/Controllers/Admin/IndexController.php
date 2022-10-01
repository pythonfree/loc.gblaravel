<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleFile;
use App\Models\CategoryFile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class IndexController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }

    /**
     * @param Request $request
     * @param CategoryFile $category
     * @param ArticleFile $article
     * @return Factory|View|Application
     */
    public function create(Request $request, CategoryFile $category, ArticleFile $article): Factory|View|Application
    {
        if ($request->isMethod('post')) {
            $request->flash();
            $requestData = $request->all([
                'title', 'category_id', 'text', 'isPrivate'
            ]);
            if ($article->save($requestData)) {
                $lastId = $article->getLastId();
                $categoryId = (int)$requestData['category_id'];
                return view('news.show')->with([
                    'article' => $article->getById($lastId),
                    'title' => $category->getTitleBySlug($category->getSlugById($categoryId)),
                ]);
            }
        }
        return view('admin.create', [
            'categories' => $category->getAll(),
        ]);
    }

    /**
     * @return BinaryFileResponse
     */
    public function imageDownload(): BinaryFileResponse
    {
        return response()->download('photo.jpg');
    }


    public function imageJson(ArticleFile $article)
    {
        return response()
            ->json($article->getAll())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

}
