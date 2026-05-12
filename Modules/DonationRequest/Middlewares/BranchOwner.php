<?php

namespace Modules\DonationRequest\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Utilities\Response as UtilitiesResponse;
use Modules\DonationRequest\Models\DonationItem;
use Modules\DonationRequest\Models\DonationRequest;
use Modules\DonationRequest\Models\DonationRequestItem;
use Modules\Institution\Models\Branch;

class BranchOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if($user->is_admin) {
            return $next($request);
        }

        $donationRequestId = $request->input('donation_request_id');
        $donationRequest = null;

        if ($donationRequestId)
            $donationRequest = DonationRequest::findOrFail($donationRequestId);
        else
            $donationRequest = DonationRequestItem::query()->findOrFail($request->route('modelId'))->donationRequest;

        if(!$donationRequest->receiverBranch->isEmployee($user)) {
            return (new UtilitiesResponse)->error('You are not authorized to perform this action.', UtilitiesResponse::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
