<?php

namespace App\Http\Controllers\Admin\ExportEntity;

use App\Contract\IExportFile;
use App\Exports\NewsExport;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelFile implements IExportFile
{
    /**
     * @param Category $category
     * @return BinaryFileResponse
     */
    public function export(Category $category): BinaryFileResponse
    {
        $news = $category->news()->get()->toArray();
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
                'Ссылка на новость',
            ],
            $news,
        ]);
        return Excel::download($newsExport, 'news.xlsx');
    }
}
