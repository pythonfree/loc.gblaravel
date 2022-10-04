<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category
{
    private Collection $categories;
    private string $tableName = 'categories';

    public function __construct()
    {
        $this->categories = collect(DB::table($this->tableName)
            ->get()
            ->all()
        );
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param $slug
     * @return mixed|null
     */
    public function getBySlug($slug): mixed
    {
        return $this->getCategories()->firstWhere('slug', $slug);
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function getTitleById(int $id): ?string
    {
        return $this->getCategories()->firstWhere('id', $id)->title;
    }

}
