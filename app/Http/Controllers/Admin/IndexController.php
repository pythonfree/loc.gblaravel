<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }

    public function create(): Factory|View|Application
    {
        return view('admin.create');
    }

    public function test2(): Factory|View|Application
    {
        return view('admin.test2');
    }

}
