<?php

namespace App\Http\Controllers\Admin\ExportEntity;

use App\Contract\IExportFile;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfFile implements IExportFile
{
    /**
     * @param Category $category
     * @return Response
     */
    public function export(Category $category): Response
    {
        $news = $category->news()->get()->toArray();
        $title = $category->title;
        $slug = $category->slug;
        $pdf = Pdf::loadView('admin.export.pdf', [
            'news' => $news,
            'title' => $title,
            'slug' => $slug,
        ]);
        return $pdf->download('news.pdf');
    }
}
