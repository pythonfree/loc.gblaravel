<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminCategoriesController extends Controller
{

    /**
     * @param Category $category
     * @return Application|Factory|View
     */
    public function index(Category $category): View|Factory|Application
    {
        $categories = Category::query()->get();
        return view('admin.categories.index')
            ->with('categories', $categories)
            ->with('category', $category);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, Category $category): RedirectResponse
    {
        $result = $this->saveData($request, $category);
        if ($result) {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', "Категория успешно добавлена (ID = {$category->getKey()}).");
        }
        return redirect()
            ->route('admin.categories.index')
            ->with('error', "Ошибка добавления категории!");
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateCategory(Request $request): array
    {
        return [
            'title' => $request->title ?: 'Default category',
            'slug' => $request->title ? Str::slug($request->title) : 'def-category',
        ];
    }

    public function create($id){}
    public function show($id){}

    /**
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        return view('admin.categories.index')
            ->with('categories', Category::query()->get())
            ->with('category', $category);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $result = $this->saveData($request, $category);
        if ($result) {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', "Категория \"{$category->title}\" c ID = {$category->getKey()} успешно изменена.")
                ->with('categories', Category::query()->get())
                ->with('category', $category);
        }
        return redirect()
            ->route('admin.categories.index')
            ->with('error', "Ошибка изменения категории с ID = {$category->getKey()}!")
            ->with('categories', Category::query()->get())
            ->with('category', $category);
    }


    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->delete()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', "Категория \"{$category->title}\" с ID = {$category->getKey()} успешно  удалена.");
        }
        return redirect()
            ->route('admin.categories.index')
            ->with('error', "Ошибка удаления категории \"{$category->title}\" с ID = {$category->getKey()})!");
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return bool
     * @throws ValidationException
     */
    public function saveData(Request $request, Category $category): bool
    {
        $request->flash();
        $this->validate($request, Category::rules(), [], Category::attributesName());
        $requestData = $this->validateCategory($request);
        return $category
            ->fill($requestData)
            ->save();
    }
}
