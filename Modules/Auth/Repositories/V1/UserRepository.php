<?php

namespace Modules\Auth\Repositories\V1;

use Modules\Auth\Interfaces\V1\User\UserRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Auth\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('user', 'id'),
            AllowedFilter::exact('role', 'roles.id'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('roles'),
            AllowedInclude::relationship('addresses.state'),
            AllowedInclude::relationship('policies'),
            AllowedInclude::relationship('notifications'),
            AllowedInclude::relationship('user_topics.topic', 'userTopics.topic'),
            AllowedInclude::relationship('fcm_tokens', 'fcmTokens'),
            AllowedInclude::relationship('suggestions'),
            AllowedInclude::relationship('coupon_users', 'couponUsers'),
            AllowedInclude::relationship('allowed_coupons', 'allowedCoupons'),
            AllowedInclude::relationship('referring_coupons', 'referringCoupons'),
            AllowedInclude::relationship('coupon_usages', 'couponUsages'),
            AllowedInclude::relationship('coupon_usage_details', 'couponUsageDetails'),
        ];
    }
}
