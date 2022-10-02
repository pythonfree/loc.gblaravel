<?php

namespace App\Entity;

use App\Contract\IExportFile;
use App\Helpers\Model as ModelHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfFile implements IExportFile
{
    /**
     * @param string $title
     * @param array $news
     * @param array $categories
     * @return Response
     */
    public function export(array $news = [], string $title = '', array $categories = []): Response
    {
        ModelHelper::addCategoryInfo($news, $categories);
        $pdf = Pdf::loadView('categories.pdf', [
            'news' => $news,
            'title' => $title,
        ]);
        return $pdf->download('news.pdf');
    }
}
