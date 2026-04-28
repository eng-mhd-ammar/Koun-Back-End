<?php

namespace Modules\Institution\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Utilities\Response as UtilitiesResponse;
use Modules\Institution\Models\Branch;
use Modules\Institution\Models\Institution;

class EnsureInstitutionAdmin
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

        $institution = Institution::query()->findOrFail($request->route('modelId'));

        if ($this->isUserInInstitution($user->id, $institution)) {
            return $next($request);
        }

        return (new UtilitiesResponse())->error(message: 'Sorry you can\'t access this institution.');
    }

    private function isUserInInstitution(int $userId, Institution $institution): bool
    {
        return $institution->owner_id === $userId || $institution->members()->where('user_id', $userId)->wherePivot('is_admin', true)->exists();
    }
}
