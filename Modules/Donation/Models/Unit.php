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

#[Fillable(['name', 'description'])]
#[ObservedBy([CRUDObserver::class, CascadeSoftDeleteObserver::class])]
class Unit extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "unit";

    public array $cascadeDeletes = ['donationItems'];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
    ];

    public function donationItems(): HasMany
    {
        return $this->hasMany(DonationItem::class, 'unit_id', 'id');
    }
}
