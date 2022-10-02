<?php

namespace App\Entity;

use App\Contract\IExportFile;
use App\Exports\NewsExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelFile implements IExportFile
{
    /**
     * @param array $news
     * @return BinaryFileResponse
     */
    public function export(array $news = []): BinaryFileResponse
    {
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
}
