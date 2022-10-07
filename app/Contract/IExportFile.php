<?php

namespace App\Contract;

use App\Models\Category;

interface IExportFile
{
    public function export(Category $category);
}
