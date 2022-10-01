<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class NewsExport implements FromArray
{
    protected $news;

    public function __construct(array $news)
    {
        $this->news = $news;
    }

    public function array(): array
    {
        return $this->news;
    }
}
