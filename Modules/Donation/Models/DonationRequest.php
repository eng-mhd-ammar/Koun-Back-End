<?php

namespace Modules\Donation\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CRUDObserver;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;
use Modules\Core\Observers\CascadeSoftDeleteObserver;
use Modules\Donation\Enums\DonationRequestStatus;
use Modules\Institution\Models\Branch;

#[Fillable(['donation_id', 'receiver_user_id', 'receiver_branch_id', 'status', 'notes'])]
#[ObservedBy([CRUDObserver::class/*, CascadeSoftDeleteObserver::class*/])]
class DonationRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "donation-request";

    // public array $cascadeDeletes = ['donationItems'];

    protected $casts = [
        'donation_id' => 'string',
        'receiver_user_id' => 'string',
        'receiver_branch_id' => 'string',
        'status' => DonationRequestStatus::class,
        'notes' => 'string',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id', 'id');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver_user_id', 'id');
    }

    public function receiverBranch()
    {
        return $this->belongsTo(Branch::class, 'receiver_branch_id', 'id');
    }
}
