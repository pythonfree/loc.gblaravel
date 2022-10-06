<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $news = News::query()
            ->paginate(5);
        return view('admin.index')
            ->with('news', $news);
    }

    /**
     * @param News $article
     * @return View|Factory|Application
     */
    public function edit(News $article): View|Factory|Application
    {
        return view('admin.create')
            ->with('categories', Category::query()->get())
            ->with('article', $article);
    }


    /**
     * @param Request $request
     * @param News $article
     * @return RedirectResponse|null
     */
    public function update(Request $request, News $article): ?RedirectResponse
    {
        $requestData = $this->validateArticle($request);
        if ($article->fill($requestData)->save()) {
            return redirect()->route('admin.index')
                ->with('success', "Новость c ID = {$article->getKey()} успешно изменена.");
        }
        return redirect()->route('admin.index')
            ->with('error', "Ошибка изменения новости с ID = {$article->getKey()}!");
    }

    /**
     * @param News $article
     * @return RedirectResponse
     */
    public function destroy(News $article): RedirectResponse
    {
        if ($article->delete()) {
            return redirect()->route('admin.index')
                ->with('success', "Новость с ID = {$article->getKey()} успешно  удалена.");
        }
        return redirect()->route('admin.index')
            ->with('error', "Ошибка удаления новости с ID = {$article->getKey()})!");
    }

    /**
     * @param Request $request
     * @param News $article
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(Request $request, News $article, Category $category): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            if ($request->createArticle) {
                $request->flash();
                $requestData = $this->validateArticle($request);
                if ($article->fill($requestData)->save()) {
                    return redirect()->route('admin.create')
                        ->with('success', "Новость успешно добавлена (ID = {$article->getKey()}).");
                }
                return redirect()->route('admin.create')
                    ->with('error', "Ошибка добавления новости!");
            }
        }
        if ($request->createCategory) {
            $request->flash();
            $requestData = $this->validateCategory($request);
            if ($category->fill($requestData)->save()) {
                return redirect()->route('admin.create')
                    ->with('success', "Категория \"{$requestData['title']}\" успешно добавлена (ID = {$category->getKey()}).");
            }
            return redirect()->route('admin.create')
                ->with('error', "Ошибка добавления категории!");
        }

        return view('admin.create', [
            'categories' => Category::query()->get(),
            'article' => $article,
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateCategory(Request $request): array
    {
        return [
            'title' => $request->title ?: 'Default category',
            'slug' => Str::slug($request->title),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateArticle(Request $request): array
    {
        $img = $request->image ?: null;
        if ($img) {
            $path = Storage::putFile('public/images', $img);
            $request->image = Storage::url($path);
        }

        return [
            'title' => $request->title ?: 'Default article title',
            'category_id' => $request->category_id ?: 1,
            'text' => $request->text ?: 'Default article text',
            'is_private' => (bool)$request->is_private,
            'image' => $request->image,
        ];
    }
}