<?php

namespace App\Http\Controllers\Admin;

use App\Contract\IExportFile;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class JsonFile implements IExportFile
{
    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function export(Category $category): JsonResponse
    {
        $news = $category->news()->get()->toArray();
        return response()
            ->json($news)
            ->header('Content-Disposition', 'attachment; filename = "news.txt"')
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
