<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;


class AdminMyTestPageController extends Controller
{
    public function index()
    {
//        dump(CategoryHelper::categoryKeyByToArray());

        $categories = Category::query()->get()->toArray();
        dump($categories);
        $categories = Category::query()->get()->keyBy('id')->toArray();
        dump($categories);
//
//        $categories = Category::query()->get()->keyBy('id')->toArray();
//        file_put_contents(__FILE__ . '$categories2', print_r($categories, 1));
//        dump(Category::query()->get()->keyBy('id')->all());

//        echo Category::query()->latest('id')->first()->id;
//        $rssLinks =  \App\Models\Resources::query()->get();
//        dump($rssLinks);
//        foreach ($rssLinks as $rssLink) {
//            echo $rssLink->link;
//        }
    }
}
