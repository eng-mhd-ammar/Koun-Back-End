<?php

namespace Modules\Institution\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Observers\CascadeSoftDeleteObserver;
use Modules\Core\Observers\CRUDObserver;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;
use Modules\Donation\Models\Donation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

#[Fillable(['name', 'description', 'institution_id', 'phone', 'email', 'is_main_branch'])]
#[ObservedBy([CascadeSoftDeleteObserver::class, CRUDObserver::class])]
class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;

    public string $logChannel = "branch";

    public array $FilesFields = ['logo', 'attachments'];

    public array $cascadeDeletes = ['userBranches'];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'institution_id' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'is_main_branch' => 'boolean',
    ];

    public function employees(): Attribute
    {
        return Attribute::make(
            get: function () {

                $institution = $this->institution;

                return collect()

                    ->when($institution?->owner, fn ($c) => $c->push($institution->owner))

                    ->merge($institution?->members ?? collect())

                    ->merge($this->members)

                    ->unique('id')

                    ->values()
                    ->toArray();
            }
        );
    }

    public function admins(): Attribute
    {
        return Attribute::make(
            get: function () {

                $institution = $this->institution;

                return collect()

                    ->when($institution?->owner, fn ($c) => $c->push($institution->owner))

                    ->merge(
                        $institution?->members
                            ?->filter(fn ($member) => $member->pivot?->is_admin)
                            ?? collect()
                    )

                    ->merge(
                        $this->members
                            ->filter(fn ($member) => $member->pivot?->is_admin)
                    )

                    ->unique('id')
                    ->values()
                    ->toArray();
            }
        );
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }

    public function userBranches(): HasMany
    {
        return $this->hasMany(UserBranch::class, 'branch_id', 'id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_branches', 'branch_id', 'user_id');
    }

    public function donationsSent(): HasMany
    {
        return $this->hasMany(Donation::class, 'sender_branch_id', 'id');
    }

    public function donationsReceived(): HasMany
    {
        return $this->hasMany(Donation::class, 'receiver_branch_id', 'id');
    }

    public function scopeForUser(Builder $query, bool $value = false): Builder
    {
        $user = Auth::user();

        if (!$value) {
            if($user->is_admin) {
                return $query;
            } else {
                $value = !$value;
            }
        }

        return $query->where(function ($q) use ($user) {

            $q->whereHas('members', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })

            ->orWhereHas('institution', function ($q) use ($user) {

                $q->where('owner_id', $user->id)

                ->orWhereHas('members', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });

            });

        });
    }
}
