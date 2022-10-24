<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class IsAdmin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->is_admin) {
            return redirect()
                ->route('home')
                ->with('error', 'Только для Администратора.');
        }
        return $next($request);
    }
}
