<?php

namespace App\Contract;

interface IExportFile
{
    public function export(array $news, string $title, array $categories);
}
