<?php

namespace Modules\Address\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Address\Models\Address;
use Modules\Core\Utilities\Response as UtilitiesResponse;
use Modules\Institution\Models\Branch;

class IsBranchAdmin
{
    public function handle(Request $request, Closure $next)
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
        $address = Address::find($request->route('modelId'));

        if (!$address || !$address->branch) {
            return false;
        }

        $branch = $address->branch;

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
