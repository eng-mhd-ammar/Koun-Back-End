<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CascadeSoftDeleteObserver;
use Modules\Core\Observers\SyncFilesObserver;
use Modules\Core\Observers\CRUDObserver;

#[Fillable(['user_id', 'code', 'type', 'target', 'expired_at', 'verified_at'])]
#[ObservedBy([SyncFilesObserver::class, CascadeSoftDeleteObserver::class, CRUDObserver::class])]
class VerificationCode extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "Verification-codes";

    protected $casts = [
        'user_id' => 'string',
        'code' => 'string',
        'type' => \Modules\Auth\Enums\VerificationCodeType::class,
        'target' => 'string',
        'expired_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
