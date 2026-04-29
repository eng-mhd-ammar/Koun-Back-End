<?php

namespace Modules\Address\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Utilities\Response as UtilitiesResponse;
use Modules\Institution\Models\Branch;

class IsBranchAdmin
{
    public function handle(Request $request, Closure $next, string $scope)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return (new UtilitiesResponse())->error(message: 'Unauthenticated.');
        }

        if ($user->is_admin) {
            return $next($request);
        }

        $allowed = $this->checkBranch($request, $user->id);

        if ($allowed) {
            return $next($request);
        }

        return (new UtilitiesResponse())->error(
            message: 'Unauthorized access.'
        );
    }

    // ========================= 'ensure_institution_admin:branch'

    private function checkBranch(Request $request, int $userId): bool
    {
        $branch = Branch::findOrFail($request->input('branch_id'));
        if (!$branch) {
            return true;
        }

        return
            $branch->institution?->owner_id === $userId

            || $branch->members()
                ->where('user_id', $userId)
                ->wherePivot('is_admin', true)
                ->exists()

            || $branch->institution?->members()
                ->where('user_id', $userId)
                ->wherePivot('is_admin', true)
                ->exists();
    }
}
