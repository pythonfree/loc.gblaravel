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
use Illuminate\Validation\ValidationException;

class AdminNewsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $news = News::query()->paginate(5);
        return view('admin.index')->with('news', $news);
    }

    /**
     * @param News $news
     * @return Application|Factory|View
     */
    public function show(News $news): View|Factory|Application
    {
        $category = $news->category()->get()->first();
        return view('admin.show')
            ->with('article', $news)
            ->with('category', $category);
    }

    /**
     * @param News $news
     * @return View|Factory|Application
     */
    public function edit(News $news): View|Factory|Application
    {
        return view('admin.create')
            ->with('categories', Category::query()->get())
            ->with('article', $news);
    }


    /**
     * @param Request $request
     * @param News $news
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, News $news): RedirectResponse
    {
        $this->validate($request, News::rules(), [], News::attributesName());
        $requestData = $this->validateArticle($request);
        $result = $news->fill($requestData)->save();
        if ($result) {
            return redirect()
                ->route('admin.news.index')
                ->with('success', "Новость c ID = {$news->getKey()} успешно изменена.");
        }
        return redirect()
            ->route('admin.news.index')
            ->with('error', "Ошибка изменения новости с ID = {$news->getKey()}!");
    }

    /**
     * @param News $news
     * @return RedirectResponse
     */
    public function destroy(News $news): RedirectResponse
    {
        if ($news->delete()) {
            return redirect()
                ->route('admin.news.index')
                ->with('success', "Новость с ID = {$news->getKey()} успешно удалена.");
        }
        return redirect()
            ->route('admin.news.index')
            ->with('error', "Ошибка удаления новости с ID = {$news->getKey()}!");
    }

    /**
     * @param News $article
     * @return Application|Factory|View
     */
    public function create(News $article): View|Factory|Application
    {
        return view('admin.create',
            [
                'categories' => Category::query()->get(),
                'article' => $article,
            ]
        );
    }

    /**
     * @param Request $request
     * @param News $article
     * @return Application|Factory|View|RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, News $article): View|Factory|RedirectResponse|Application
    {
//        $request->flash();
        $this->validate($request, News::rules(), [], News::attributesName());
        $requestData = $this->validateArticle($request);
        $result = $article
            ->fill($requestData)
            ->save();
        if ($result) {
            return redirect()
                ->route('admin.news.create')
                ->with('success', "Новость успешно добавлена (ID = {$article->getKey()}).");
        }
        return redirect()
            ->route('admin.news.create')
            ->with('error', "Ошибка добавления новости!");
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateArticle(Request $request): array
    {
        $this->validateImage($request);

        return [
            'title' => $request->title ?: 'Default article title',
            'category_id' => $request->category_id ?: 1,
            'text' => $request->text ?: 'Default article text',
            'is_private' => (bool)$request->is_private,
            'image' => $request->image,
        ];
    }

    /**
     * @param Request $request
     * @return void
     */
    public function validateImage(Request $request): void
    {
        $img = $request->image ?: null;
        if ($img) {
            $path = Storage::putFile('public/images', $img);
            $request->image = Storage::url($path);
        }
    }
}
