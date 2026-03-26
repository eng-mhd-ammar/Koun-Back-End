<?php

namespace Modules\Auth\Commands;

use Illuminate\Console\Command;
use Modules\Auth\Models\User;

class DeleteUnverifiedUsers extends Command
{
    protected $signature = 'users:delete-unverified';
    protected $description = 'Deletes users created a week ago or more without phone verification';

    public function handle()
    {
        $count = User::whereNull('phone_verified_at')
            ->where('created_at', '<=', now()->subWeek())
            ->forceDelete();

        $this->info("Deleted {$count} unverified users older than one week.");
    }
}
