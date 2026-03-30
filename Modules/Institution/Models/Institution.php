<?php

namespace Modules\Institution\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CascadeSoftDeleteObserver;
use Modules\Core\Observers\SyncFilesObserver;
use Modules\Core\Observers\CRUDObserver;
use Modules\Institution\Enums\InstitutionType;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;

#[Fillable(['logo', 'name', 'description', 'owner_id', 'phone', 'email', 'type', 'is_active', 'attachments'])]
#[ObservedBy([SyncFilesObserver::class, CascadeSoftDeleteObserver::class, CRUDObserver::class])]
class Institution extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "institution";

    public array $cascadeDeletes = ['branches'];

    protected $guard_name = 'api';

    protected $casts = [
        'logo' => 'string',
        'name' => 'string',
        'description' => 'string',
        'owner_id' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'type' => InstitutionType::class,
        'is_active' => 'boolean',
        'attachments' => 'array',
    ];

    protected $attributes = [
        'attachments' => '[]',
    ];

    public function logoUrl(): Attribute
    {
        return new Attribute(
            get: fn () => $this->logo ? asset($this->logo) : '',
        );
    }

    protected function attachmentsUrls(): Attribute
    {
        return new Attribute(
            get: fn () => array_map(function ($attachment) {
                return asset($attachment);
            }, $this->attachments),
        );
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'institution_id', 'id');
    }
}
