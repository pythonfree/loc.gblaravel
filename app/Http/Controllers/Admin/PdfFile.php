<?php

namespace App\Http\Controllers\Admin;

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
        $pdf = Pdf::loadView('categories.pdf', [
            'news' => $news,
            'title' => $title,
            'slug' => $slug,
        ]);
        return $pdf->download('news.pdf');
    }
}
