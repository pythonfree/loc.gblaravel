<?php

namespace App\Http\Controllers\Admin;

use App\Entity\ExcelFile;
use App\Entity\JsonFile;
use App\Entity\PdfFile;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param Category $category
     * @param Article $article
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(Request $request, Category $category, Article $article): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $request->flash();
            $requestData = $request->all([
                'title',
                'category_id',
                'text',
                'isPrivate',
                'image',
            ]);
            if ($article->save($requestData)) {
                $lastId = $article->getLastId();
                if ($lastId) {
                    return redirect()->route('admin.create')->with('success', "Новость успешно добавлена (ID - {$lastId}).");
                }
            }
        }
        return view('admin.create', [
            'categories' => $category->getCategories(),
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
     * @param Article $article
     * @param Category $category
     * @return Factory|View|Response|BinaryFileResponse|JsonResponse|Application|null
     */
    public function download(Request $request, Article $article, Category $category): Factory|View|Response|BinaryFileResponse|JsonResponse|Application|null
    {
        if ($request->isMethod('post')) {
            $request->flash();
            return $this->exportFile($request, $article);
        }
        return view('admin.download')->with(
            'categories', $category->getCategories()
        );
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return mixed|null
     */
    public function exportFile(Request $request, Article $article): mixed
    {
        $requestData = $request->all([
            'category_id',
            'file_format',
        ]);
        $exportEntities = [
            'json' => JsonFile::class,
            'excel' => ExcelFile::class,
            'pdf' => PdfFile::class,
        ];
        $fileFormat = (string)$requestData['file_format'];
        if (array_key_exists($fileFormat, $exportEntities)) {
            $exportEntity = new $exportEntities[$fileFormat];
            return $exportEntity->export(
                $article->getByCategoryId((int)$requestData['category_id'])
            );
        }

        return null;
    }
}
