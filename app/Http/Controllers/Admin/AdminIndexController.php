<?php

namespace App\Http\Controllers\Admin;

use App\Contract\IExportFile;
use App\Http\Controllers\Admin\ExportEntity\ExcelFile;
use App\Http\Controllers\Admin\ExportEntity\JsonFile;
use App\Http\Controllers\Admin\ExportEntity\PdfFile;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminIndexController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('admin.index');
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
     * @param Category $category
     * @return Factory|View|Response|BinaryFileResponse|JsonResponse|Application|null
     */
    public function download(Request $request, Category $category): Factory|View|Response|BinaryFileResponse|JsonResponse|Application|null
    {
        if ($request->isMethod('post')) {
            $request->flash();
            return $this->exportFile($request);
        }
        return view('admin.export.download')->with(
            'categories', $category::query()->get(),
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function exportFile(Request $request): mixed
    {
        $exportEntities = [
            'json' => JsonFile::class,
            'excel' => ExcelFile::class,
            'pdf' => PdfFile::class,
        ];
        $fileFormat = (string)$request->file_format;
        if (array_key_exists($fileFormat, $exportEntities)) {
            /** @var IExportFile $exportEntity */
            $exportEntity = new $exportEntities[$fileFormat];
            /** @var Category $category */
            $category = Category::query()
                ->where('id', $request->category_id)
                ->get()
                ->first();
            return $exportEntity->export($category);
        }

        return null;
    }
}
