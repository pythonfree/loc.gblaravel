<?php

use App\Http\Controllers\Admin\AdminParserController;
use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')
    ->get('/parseAction', function (Request $request, AdminParserController $adminParserController) {
        $resourcesDone = $adminParserController->runParse();
        $resources = Resources::query()->get()->all();
        if ($resourcesDone == $resources) {
            return response()->json(
                [
                    'status' => 'ok',
                ],
                JSON_UNESCAPED_UNICODE
            );
        }
        return response()->json(
            [
                'status' => 'false',
            ],
            JSON_UNESCAPED_UNICODE
        );
    });

// Example by default
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
