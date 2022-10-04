<?php

namespace App\Entity;

use App\Contract\IExportFile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfFile implements IExportFile
{
    /**
     * @param array $news
     * @return Response
     */
    public function export(array $news = []): Response
    {
        $title = $news[0]->categoryTitle;
        $pdf = Pdf::loadView('categories.pdf', [
            'news' => $news,
            'title' => $title,
        ]);
        return $pdf->download('news.pdf');
    }
}
