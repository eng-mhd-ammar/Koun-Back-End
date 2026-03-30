<?php

namespace Modules\Institution\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CascadeSoftDeleteObserver;
use Modules\Core\Observers\SyncFilesObserver;
use Modules\Core\Observers\CRUDObserver;
use Modules\Institution\Enums\InstitutionType;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;

#[Fillable(['name', 'description', 'institution_id', 'phone', 'email', 'is_main_branch'])]
#[ObservedBy([CascadeSoftDeleteObserver::class, CRUDObserver::class])]
class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "branch";

    public array $FilesFields = ['logo', 'attachments'];

    // public array $cascadeDeletes = ['address'];

    protected $guard_name = 'api';

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'institution_id' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'is_main_branch' => 'boolean',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }

    // public function verificationCodes(): HasMany
    // {
    //     return $this->hasMany(VerificationCode::class, 'user_id', 'id');
    // }
}
