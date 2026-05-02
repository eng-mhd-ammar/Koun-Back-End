<?php

namespace Modules\Donation\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CRUDObserver;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Observers\CascadeSoftDeleteObserver;

#[Fillable(['name', 'donation_type_id'])]
#[ObservedBy([CRUDObserver::class, CascadeSoftDeleteObserver::class])]
class DonationType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "donation-type";

    public array $cascadeDeletes = ['donationItems', 'children'];

    protected $casts = [
        'name' => 'string',
        'donation_type_id' => 'string',
    ];

    public function donationItems(): HasMany
    {
        return $this->hasMany(DonationItem::class, 'donation_type_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(DonationType::class, 'donation_type_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(DonationType::class, 'donation_type_id', 'id');
    }
}
