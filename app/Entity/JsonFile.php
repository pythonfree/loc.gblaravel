<?php

namespace App\Entity;

use App\Contract\IExportFile;
use Illuminate\Http\JsonResponse;

class JsonFile implements IExportFile
{
    /**
     * @param array $news
     * @param string $title
     * @param array $categories
     * @return JsonResponse
     */
    public function export(array $news, string $title = '', array $categories = []): JsonResponse
    {
        return response()
            ->json($news)
            ->header('Content-Disposition', 'attachment; filename = "news.txt"')
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
