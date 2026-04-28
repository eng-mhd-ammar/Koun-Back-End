<?php

namespace Modules\Institution\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CRUDObserver;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;

#[Fillable(['user_id', 'institution_id', 'is_admin'])]
#[ObservedBy([CRUDObserver::class])]
class UserInstitution extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "user-institution";

    protected $casts = [
        'user_id' => 'string',
        'institution_id' => 'string',
        'is_admin' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }
}
