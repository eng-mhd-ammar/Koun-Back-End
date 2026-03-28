<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Auth\Enums\Gender;
use Modules\Core\Observers\CascadeSoftDeleteObserver;
use Modules\Core\Observers\SyncFilesObserver;
use Modules\Core\Observers\CRUDObserver;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[Fillable(['avatar', 'first_name', 'last_name', 'password', 'birthday', 'gender', 'username', 'phone', 'phone_verified_at', 'email', 'email_verified_at'])]
#[ObservedBy([SyncFilesObserver::class, CascadeSoftDeleteObserver::class, CRUDObserver::class])]
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasPermissions;
    use HasRoles;

    public string $logChannel = "user";

    public array $FilesFields = ['avatar'];

    public array $cascadeDeletes = ['verificationCodes'];

    protected $guard_name = 'api';

    protected $casts = [
        'avatar' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'password' => 'hashed',
        'birthday' => 'date',
        'gender' => Gender::class,
        'username' => 'string',
        'phone' => 'string',
        'phone_verified_at' => 'datetime',
        'email' => 'string',
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin(): Attribute
    {
        return new Attribute(
            get: fn () => $this->hasRole('admin'),
        );
    }

    public function isUser(): Attribute
    {
        return new Attribute(
            get: fn () => $this->hasRole('user'),
        );
    }

    public function avatarUrl(): Attribute
    {
        return new Attribute(
            get: fn () => $this->avatar ? asset($this->avatar) : '',
        );
    }

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->first_name . ' ' . $this->last_name,
        );
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function verificationCodes(): HasMany {
        return $this->hasMany(VerificationCode::class, 'user_id', 'id');
    }
}
