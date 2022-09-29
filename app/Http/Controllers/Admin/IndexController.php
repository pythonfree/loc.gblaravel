<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return Factory|View|Application
     */
    public function create(Request $request, Category $category): Factory|View|Application
    {
        if ($request->isMethod('post')) {
            $request->flash();
            dump($request);
        }
        return view('admin.create', [
            'categories' => $category->get(),
        ]);
    }

    /**
     * @return Factory|View|Application
     */
    public function test2(): Factory|View|Application
    {
        return view('admin.test2');
    }

}
