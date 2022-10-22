<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resources;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminResourcesController extends Controller
{

    /**
     * @param Resources $resource
     * @return Application|Factory|View
     */
    public function index(Resources $resource): View|Factory|Application
    {
        $resources = Resources::query()->get();
        return view('admin.resources.index')
            ->with('resources', $resources)
            ->with('resource', $resource);
    }

    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return string[]
     */
    private function validateCategory(Request $request): array
    {
        return [
            'link' => $request->link ?: 'https://lenta.ru/rss/news',
        ];
    }

    /**
     * @param Request $request
     * @param Resources $resource
     * @return bool
     * @throws ValidationException
     */
    public function saveData(Request $request, Resources $resource): bool
    {
        $request->flash();
        $this->validate($request, Resources::rules(), [], Resources::attributesName());
        $requestData = $this->validateCategory($request);
        return $resource
            ->fill($requestData)
            ->save();
    }

    /**
     * @param Request $request
     * @param Resources $resource
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, Resources $resource): RedirectResponse
    {
        $result = $this->saveData($request, $resource);
        if ($result) {
            return redirect()
                ->route('admin.resources.index')
                ->with('success', "Ссылка успешно добавлена (ID = {$resource->getKey()}).");
        }
        return redirect()
            ->route('admin.resources.index')
            ->with('error', "Ошибка добавления ссылки!");
    }

    public function show($id)
    {
        //
    }

    /**
     * @param Resources $resource
     * @return Application|Factory|View
     */
    public function edit(Resources $resource): View|Factory|Application
    {
        return view('admin.resources.index')
            ->with('resources', Resources::query()->get())
            ->with('resource', $resource);
    }

    /**
     * @param Request $request
     * @param Resources $resource
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Resources $resource): RedirectResponse
    {
        $result = $this->saveData($request, $resource);
        if ($result) {
            return redirect()
                ->route('admin.resources.index')
                ->with('success', "Ссылка на RSS \"{$resource->link}\" c ID = {$resource->getKey()} успешно изменена.")
                ->with('resources', Resources::query()->get())
                ->with('resource', $resource);
        }
        return redirect()
            ->route('admin.resources.index')
            ->with('error', "Ошибка изменения ссылки на RSS с ID = {$resource->getKey()}!")
            ->with('categories', Resources::query()->get())
            ->with('category', $resource);
    }

    /**
     * @param Resources $resource
     * @return RedirectResponse
     */
    public function destroy(Resources $resource): RedirectResponse
    {
        if ($resource->delete()) {
            return redirect()
                ->route('admin.resources.index')
                ->with('success', "Ссылка на RSS \"{$resource->link}\" с ID = {$resource->getKey()} успешно  удалена.");
        }
        return redirect()
            ->route('admin.resources.index')
            ->with('error', "Ошибка удаления ссылки на RSS \"{$resource->link}\" с ID = {$resource->getKey()})!");
    }
}
