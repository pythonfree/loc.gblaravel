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
        $news = json_decode(json_encode($news, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), true);
        $newsExport = new NewsExport([
            [
                'ID новости',
                'Заголовок',
                'Текст',
                'Приватная?',
                'ID категории',
                'Картинка',
                'Дата создания',
                'Дата редактирования',
            ],
            $news,
        ]);
        return Excel::download($newsExport, 'news.xlsx');
    }
}
