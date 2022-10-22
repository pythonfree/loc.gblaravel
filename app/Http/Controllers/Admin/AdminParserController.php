<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\Models\Resources;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminParserController extends Controller
{
    public $resources;

    public function __construct()
    {
        $this->resources = Resources::query()->get();
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $resources = Resources::query()->get();
        return view('admin.parser.index')
            ->with('resources', $resources);
    }

    /**
     * @return array
     */
    public function runParse(): array
    {
        $resourcesDone = [];
        foreach ($this->resources as $resource) {
            NewsParsing::dispatch($resource);
            $resourcesDone[] = $resource;
        }
        return $resourcesDone;
    }
}
