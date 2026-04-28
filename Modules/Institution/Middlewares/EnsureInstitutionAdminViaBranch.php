<?php

namespace Modules\Institution\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Utilities\Response as UtilitiesResponse;
use Modules\Institution\Models\Branch;
use Modules\Institution\Models\Institution;

class EnsureInstitutionAdminViaBranch
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

        $institution = $this->resolveInstitution($request);

        if (!$institution) {
            return (new UtilitiesResponse())->error(message: 'Institution not found.');
        }

        if ($this->isUserInInstitution($user->id, $institution)) {
            return $next($request);
        }

        return (new UtilitiesResponse())->error(message: 'Sorry you can\'t access this branch.');
    }

    private function resolveInstitution(Request $request): ?Institution
    {
        if ($request->route('modelId')) {

            if ($request->input('institution_id')) {
                return Institution::find($request->input('institution_id'));
            }

            $branch = Branch::find($request->route('modelId'));
            return $branch?->institution;
        }

        return Institution::find($request->input('institution_id'));
    }

    private function isUserInInstitution(int $userId, Institution $institution): bool
    {
        return $institution->owner_id === $userId || $institution->members()->where('user_id', $userId)->wherePivot('is_admin', true)->exists();
    }
}
