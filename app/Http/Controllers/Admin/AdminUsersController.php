<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $users = Users::query()
            ->where('id', '!=', Auth::id())
            ->paginate(10);
        return view('admin.users.index')->with('users', $users);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    /**
     * @param Users $user
     * @return Application|Factory|View
     */
    public function edit(Users $user): View|Factory|Application
    {
        return view('profile')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
    }

    /**
     * @param Users $user
     * @return RedirectResponse
     */
    public function destroy(Users $user): RedirectResponse
    {
        if ($user->delete()) {
            return redirect()
                ->route('admin.users.index')
                ->with('success', "Пользователь с ID = {$user->getKey()} успешно удален.");
        }
        return redirect()
            ->route('admin.users.index')
            ->with('error', "Ошибка удаления пользователя с ID = {$user->getKey()}!");
    }
}
