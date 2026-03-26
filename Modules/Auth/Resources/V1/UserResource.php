<?php

namespace Modules\Auth\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Address\Resources\V1\AddressResource;
use Modules\Coupon\Resources\V1\CouponResource;
use Modules\Coupon\Resources\V1\CouponUsageResource;
use Modules\Coupon\Resources\V1\CouponUserResource;
use Modules\Coupon\Resources\V1\ReferralResource;
use Modules\Notification\Resources\V1\FcmTokenResource;
use Modules\Notification\Resources\V1\TopicResource;
use Modules\Notification\Resources\V1\UserTopicResource;
use Modules\Policy\Resources\V1\PolicyResource;
use Modules\Suggestion\Resources\V1\SuggestionResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo_url,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'username' => $this->username,
            'phone' => $this->phone,
            'birthday' => \Carbon\Carbon::parse($this->birthday)->format('Y-m-d'),
            'gender' => $this->gender,

            'addresses' => AddressResource::collection($this->whenLoaded('addresses')),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'policies' => PolicyResource::collection($this->whenLoaded('policies')),
            'user_topics' => UserTopicResource::collection($this->whenLoaded('userTopics')),
            'topics' => TopicResource::collection($this->whenLoaded('topics')),
            'fcm_tokens' => FcmTokenResource::collection($this->whenLoaded('fcmTokens')),
            'suggestions' => SuggestionResource::collection($this->whenLoaded('suggestions')),
            'coupon_users' => CouponUserResource::collection($this->whenLoaded('couponUsers')),
            'allowed_coupons' => CouponResource::collection($this->whenLoaded('allowedCoupons')),
            'referring_coupons' => CouponResource::collection($this->whenLoaded('referringCoupons')),
            'coupon_usages' => CouponResource::collection($this->whenLoaded('couponUsages')),
            'coupon_usage_details' => CouponUsageResource::collection($this->whenLoaded('couponUsageDetails')),
        ];
    }
}
