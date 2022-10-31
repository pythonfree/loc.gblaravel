<?php

namespace App\Jobs;

use App\Http\Controllers\Admin\Services\XMLParserService;
use App\Models\Resources;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Resources $resource;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Resources $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param XMLParserService $parserService
     * @return void
     */
    public function handle(XMLParserService $parserService): void
    {
        $parserService->saveNewsWithCategories($this->resource);
    }
}
