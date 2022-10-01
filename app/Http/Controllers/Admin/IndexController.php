<?php

namespace App\Http\Controllers\Admin;

use App\Contract\ICategory;
use App\Exports\NewsExport;
use App\Helpers\Model as ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\ArticleFile;
use App\Models\CategoryFile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return Application|Factory|View|JsonResponse|Response|BinaryFileResponse|null
     */
    public function download(Request $request, ArticleFile $article, CategoryFile $category): Factory|View|Response|BinaryFileResponse|JsonResponse|Application|null
    {
        if ($request->isMethod('post')) {
            $request->flash();
            $requestData = $request->all([
                'category_id',
                'file_format',
            ]);
            $categoryId = (int)$requestData['category_id'];
            $fileFormat = $requestData['file_format'];
            $news = $article->getByCategoryId($categoryId);
            $title = $category->getTitleByCategoryId($categoryId);
            $categories = $category->getAll();
            return static::exportFile($fileFormat, $news, $title, $categories);
        }
        return view('admin.download', [
            'categories' => $category->getAll(),
        ]);
    }

    /**
     * @param string $fileFormat
     * @param array $news
     * @param string $title
     * @param array $categories
     * @return Response|BinaryFileResponse|JsonResponse|null
     */
    private function exportFile(string $fileFormat, array $news, string $title, array $categories): Response|BinaryFileResponse|JsonResponse|null
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
        if ($fileFormat == 'pdf') {
            ModelHelper::addCategoryInfo($news, $categories);
            $pdf = Pdf::loadView('categories.pdf', [
                'news' => $news,
                'title' => $title,
            ]);
            return $pdf->download('news.pdf');
        }
        return null;
    }
}
