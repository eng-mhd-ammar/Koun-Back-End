<?php

namespace Modules\Delivery\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CRUDObserver;
use Illuminate\Database\Eloquent\Model;
use Modules\Delivery\Enums\DeliveryStatus;
use Modules\Donation\Models\DonationRequest;

#[Fillable(['donation_request_id', 'delivery_id', 'receiver_id', 'status', 'picked_at', 'delivered_at'])]
#[ObservedBy([CRUDObserver::class])]
class Delivery extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "delivery";

    protected $casts = [
        'donation_request_id' => 'string',
        'delivery_id' => 'string',
        'receiver_id' => 'string',
        'status' => DeliveryStatus::class,
        'picked_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function formattedPickedAt(): Attribute
    {
        return new Attribute(
            get: fn () => $this->picked_at ? \Carbon\Carbon::parse($this->picked_at)->format('Y-m-d H:i') : null,
        );
    }

    public function formattedDeliveredAt(): Attribute
    {
        return new Attribute(
            get: fn () => $this->delivered_at ? \Carbon\Carbon::parse($this->delivered_at)->format('Y-m-d H:i') : null,
        );
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function donationRequest(): BelongsTo
    {
        return $this->belongsTo(DonationRequest::class, 'donation_request_id');
    }
}
