<?php

namespace App\Http\Controllers\Admin;

use App\Contract\IExportFile;
use Illuminate\Http\JsonResponse;

class JsonFile implements IExportFile
{
    /**
     * @param array $news
     * @return JsonResponse
     */
    public function export(array $news = []): JsonResponse
    {
        return response()
            ->json($news)
            ->header('Content-Disposition', 'attachment; filename = "news.txt"')
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
