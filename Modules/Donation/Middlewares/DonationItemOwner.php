<?php

namespace Modules\Donation\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Utilities\Response as UtilitiesResponse;
use Modules\Donation\Models\DonationItem;

class DonationItemOwner
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

        $donationId = $request->input('donation_id');
        $donationItem = DonationItem::query()
        ->where('donation_id', $donationId)
        ->orWhereHas('donation', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhereHas('branch', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
        })
        ->first();

        if (!$donationItem) {
            return (new UtilitiesResponse())->error(message: 'Sorry you are not the owner of this donation item.');
        }

        return $next($request);
    }
}
