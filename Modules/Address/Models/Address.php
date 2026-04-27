<?php

namespace Modules\Address\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CRUDObserver;
use Illuminate\Database\Eloquent\Model;
use Modules\Institution\Models\Branch;

#[Fillable(['branch_id', 'state_id', 'city', 'street', 'latitude', 'longitude', 'details'])]
#[ObservedBy([CRUDObserver::class])]
class Address extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "address";

    protected $casts = [
        'branch_id' => 'string',
        'state_id' => 'string',
        'city' => 'string',
        'street' => 'string',
        'latitude' => 'double',
        'longitude' => 'double',
        'details' => 'string',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
