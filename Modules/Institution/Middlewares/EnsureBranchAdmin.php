<?php

namespace Modules\Institution\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Utilities\Response as UtilitiesResponse;
use Modules\Institution\Models\Branch;

class EnsureBranchAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return (new UtilitiesResponse())->error(message: 'Unauthenticated.');
        }

        if ($user->is_admin) {
            return $next($request);
        }

        $branch = Branch::query()->findOrFail($request->route('modelId'));

        if ($this->isUserInBranch($user->id, $branch)) {
            return $next($request);
        }

        return (new UtilitiesResponse())->error(message: 'Sorry you can\'t access this branch.');
    }

    private function isUserInBranch(int $userId, Branch $branch): bool
    {
        return $branch->institution?->owner_id === $userId || $branch->members()->where('user_id', $userId)->where('is_admin', true)->exists() || $branch->institution->members()->where('user_id', $userId)->wherePivot('is_admin', true)->exists();
    }
}
