<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;


class AdminMyTestPageController extends Controller
{
    public function index()
    {
        echo Category::query()->latest('id')->first()->id;
//        $rssLinks =  \App\Models\Resources::query()->get();
//        dump($rssLinks);
//        foreach ($rssLinks as $rssLink) {
//            echo $rssLink->link;
//        }
    }
}
