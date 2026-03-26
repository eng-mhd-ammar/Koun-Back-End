<?php

namespace Modules\Auth\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Address\Models\Address;
use Modules\Auth\Enums\Gender;
use Modules\Core\Observers\CascadeSoftDeleteObserver;
use Modules\Core\Observers\SyncFilesObserver;
use Modules\Core\Observers\CRUDObserver;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Models\CouponUser;
// use Modules\Coupon\Models\Referral;
use Modules\Notification\Models\FcmToken;
use Modules\Notification\Models\Notification;
use Modules\Notification\Models\Topic;
use Modules\Notification\Models\UserTopic;
use Modules\Package\Models\Package;
use Modules\Package\Models\UserPackage;
use Modules\Point\Models\UserPoint;
use Modules\Policy\Models\Policy;
use Modules\Rate\Models\Rate;
use Modules\Suggestion\Models\Suggestion;
use Modules\Vehicle\Models\UserVehicle;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Modules\Support\Models\Department;
use Modules\Support\Models\UserDepartment;
use Modules\Support\Models\TicketCategory;
use Modules\Support\Models\UserTicketCategory;

#[ObservedBy([SyncFilesObserver::class, CascadeSoftDeleteObserver::class, CRUDObserver::class])]
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasPermissions;
    use HasRoles;

    public string $logChannel = "user";

    public array $FilesFields = ['photo'];

    public array $cascadeDeletes = ['addresses', 'userTopics'];

    protected string $guard_name = 'user';

    protected $fillable = [
        'photo',
        'first_name',
        'last_name',
        'username',
        'phone',
        'phone_verified_at',
        'password',
        'code',
        'code_expired_at',
        'birthday',
        'gender',
        'new_phone',
        'new_phone_code',
        'new_phone_code_expired_at',
    ];

    protected $casts = [
        'photo' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'username' => 'string',
        'phone' => 'string',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
        'code' => 'string',
        'code_expired_at' => 'datetime',
        'birthday' => 'date',
        'gender' => Gender::class,
        'new_phone' => 'string',
        'new_phone_code' => 'string',
        'new_phone_code_expired_at' => 'datetime',
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

    public function isSupport(): Attribute
    {
        return new Attribute(
            get: fn () => $this->hasRole('support'),
        );
    }

    public function isDelivery(): Attribute
    {
        return new Attribute(
            get: fn () => $this->hasRole('delivery'),
        );
    }

    public function isCustomer(): Attribute
    {
        return new Attribute(
            get: fn () => $this->hasRole('customer'),
        );
    }

    public function photoUrl(): Attribute
    {
        return new Attribute(
            get: fn () => $this->photo ? asset($this->photo) : '',
        );
    }

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->first_name . $this->last_name,
        );
    }

    public function fullPoints(): Attribute
    {
        return new Attribute(
            get: fn () => $this->points()->sum('points'),
        );
    }

    public function markAsPhoneVerified()
    {
        $this->update(['phone_verified_at' => \Carbon\Carbon::now()]);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class, 'user_id', 'id');
    }

    public function packagesDetails(): HasMany
    {
        return $this->hasMany(UserPackage::class, 'user_id', 'id');
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'user_packages', 'user_id', 'package_id');
    }

    public function userVehicles(): HasMany
    {
        return $this->hasMany(UserVehicle::class, 'user_id', 'id');
    }

    public function policies(): HasMany
    {
        return $this->hasMany(Policy::class, 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notificable');
    }

    public function userTopics(): HasMany
    {
        return $this->hasMany(UserTopic::class, 'user_id', 'id');
    }

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class, 'user_topics', 'user_id', 'topic_id');
    }

    public function fcmTokens(): HasMany
    {
        return $this->hasMany(FcmToken::class, 'user_id', 'id');
    }

    public function points(): HasMany
    {
        return $this->hasMany(UserPoint::class, 'user_id', 'id');
    }

    public function couponUsers(): HasMany
    {
        return $this->hasMany(CouponUser::class, 'user_id', 'id');
    }

    public function allowedCoupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'coupon_users', 'user_id', 'coupon_id');
    }

    public function referringCoupons(): HasMany
    {
        return $this->hasMany(Coupon::class, 'referral_id', 'id');
    }

    public function couponUsages(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'coupon_usages', 'coupon_id', 'id');
    }

    public function couponUsageDetails(): HasMany
    {
        return $this->hasMany(CouponUser::class, 'coupon_id', 'id');
    }

    public function rates()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'user_departments', 'user_id', 'department_id');
    }

    public function userDepartments(): HasMany
    {
        return $this->hasMany(UserDepartment::class, 'user_id', 'id');
    }

    public function ticketCategory(): BelongsToMany
    {
        return $this->belongsToMany(TicketCategory::class, 'user_ticket_categories', 'user_id', 'ticket_category_id');
    }

    public function userTicketCategories(): HasMany
    {
        return $this->hasMany(UserTicketCategory::class, 'user_id', 'id');
    }
}
