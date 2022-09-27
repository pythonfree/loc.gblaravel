<?php

namespace App\Helpers;

final class Controller
{
    /**
     * @param array $news
     * @param array $categories
     * @return void
     */
    public static function addCategoryInfo(array &$news, array $categories): void
    {
        foreach ($news as &$article) {
            foreach ($categories as $category) {
                if ($article['category_id'] == $category['id']) {
                    $article['category']['name'] = $category['name'];
                    $article['category']['title'] = $category['title'];
                    break;
                }
            }
        }
    }
}
