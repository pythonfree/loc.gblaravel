<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return bool
     */
    private function checkNewAndConfirmRequestPasswords(Request $request): bool
    {
        return $request->post('newPassword') === $request->post('confirmPassword');
    }

    /**
     * @param Request $request
     * @param Users $user
     * @return bool
     */
    private function checkUserAndRequestCurrentPasswords(Request $request, Users $user): bool
    {
        return Hash::check($request->post('currentPassword'), $user->getAuthPassword());
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function isBlankNewRequestPassword(Request $request): bool
    {
        return empty(trim($request->post('confirmPassword')));
    }

    /**
     * @param Request $request
     * @param Users $user
     * @return array
     */
    private function getRequestPasswordErrors(Request $request, Users $user): array
    {
        $errors = [];
        if (!$this->checkUserAndRequestCurrentPasswords($request, $user)) {
            $errors['currentPassword'] = 'Текущий пароль введен неверно.';
        }
        if (!$this->checkNewAndConfirmRequestPasswords($request)) {
            $errors['newPassword'] = $errors['confirmPassword'] = 'Пароли не совпадают.';
        }
        if ($this->isBlankNewRequestPassword($request)) {
            $errors['newPassword'] = $errors['confirmPassword'] = 'Новый пароль не может быть пустой.';
        }
        return $errors;
    }


    /**
     * @param Request $request
     * @return View|Factory|RedirectResponse|Application
     * @throws ValidationException
     */
    public function update(Request $request): View|Factory|RedirectResponse|Application
    {
        /** @var Users $user */
        $user = Auth::user();
        if ($request->isMethod('post')) {
            if ($request->userEdit) {
                $user = Users::query()
                    ->where('id', '=', $request->id)
                    ->get()
                    ->first();
                $user->fill([
                    'name' => $request->name,
                    'email' => $request->email,
                    'is_admin' => $request->is_admin ?? false,
                ]);
                if ($user->save()) {
                    return redirect()
                        ->route('admin.users.edit', ['user' => $user])
                        ->with('success', "Данные пользователя \"{$user->name}\" (ID = {$user->id}) успешно изменены (" . date('H:i:s') . ").");
                }
            } else {
                $errors = $this->validateUser($request, $user);
                if (empty($errors)) {
                    $user->fill([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->post('is_change_password') ? Hash::make($request->post('newPassword')) : $user->getAuthPassword(),
                    ]);
                    if ($user->save()) {
                        return redirect()
                            ->route('profile')
                            ->with('success', "Данные пользователя \"{$user->name}\" (ID = {$user->id}) успешно изменены (" . date('H:i:s') . ").");
                    }
                }
            }

            return redirect()
                ->route('profile')
                ->with('error', "Ошибка изменения данных пользователя \"{$user->name}\" (ID = {$user->id})!")
                ->withErrors($errors);
        }

        return view('profile')
            ->with('user', $user);
    }

    /**
     * @param Request $request
     * @param Users $user
     * @return array|string[]
     */
    private function validateUser(Request $request, Users $user): array
    {
        $passwordErrors = $request->post('is_change_password') ? $this->getRequestPasswordErrors($request, $user) : [];
        $userPasswordErrors = $this->checkUserAndRequestCurrentPasswords($request, $user) ? [] : ['currentPassword' => 'Текущий пароль введен неверно.'];
        return array_merge($passwordErrors, $userPasswordErrors);
    }
}
