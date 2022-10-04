<?php

namespace App\Helpers;

final class Model
{
    /**
     * @param array $news
     * @param array $categories
     * @return void
     */
    public static function addCategoryInfo(array &$news, array $categories): void
    {
        $newsCollection = collect($news);
        $categoriesCollection = collect($categories);
        $newsCollection->each(function ($article, $key) use (&$news, $categoriesCollection) {
            $category = $categoriesCollection->firstWhere('id', $article->categoryId);
            $news[$key]->categorySlug = $category->slug;
        });
    }
}
