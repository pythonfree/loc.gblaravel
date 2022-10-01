<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Http\Controllers\Controller;
use App\Models\ArticleFile;
use App\Models\CategoryFile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Facades\Excel;

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

    /**
     * @param Request $request
     * @param ArticleFile $article
     * @param CategoryFile $category
     * @return Application|Factory|View|JsonResponse|BinaryFileResponse
     */
    public function download(Request $request, ArticleFile $article, CategoryFile $category): View|Factory|BinaryFileResponse|JsonResponse|Application
    {
        if ($request->isMethod('post')) {
            $request->flash();
            $requestData = $request->all([
                'category_id',
                'file_format',
            ]);
            $news = $article->getByCategoryId((int)$requestData['category_id']);
            $fileFormat = $requestData['file_format'];
            return static::exportFile($fileFormat, $news);
        }
        return view('admin.download', [
            'categories' => $category->getAll(),
        ]);
    }

    /**
     * @param string $fileFormat
     * @param array $news
     * @return JsonResponse|BinaryFileResponse|null
     */
    private function exportFile(string $fileFormat, array $news): BinaryFileResponse|JsonResponse|null
    {
        if ($fileFormat == 'json') {
            return response()
                ->json($news)
                ->header('Content-Disposition', 'attachment; filename = "news.txt"')
                ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        if ($fileFormat == 'excel') {
            $newsExport = new NewsExport([
                [
                    'ID новости',
                    'Заголовок',
                    'Текст',
                    'ID категории'
                ],
                $news,
            ]);
            return Excel::download($newsExport, 'news.xlsx');
        }
        return null;
    }
}
