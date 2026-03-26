<?php

namespace Modules\Core\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CRUDObserver
{
    protected function logAction(string $action, Model $model): void
    {
        // $channelName = property_exists($model, 'logChannel') && !empty($model->logChannel)
        //     ? $model->logChannel
        //     : 'default';

        // $parts = explode('\\', $model::class);
        // $folder = $parts[1] ?? 'models';

        // $logPath = storage_path("logs/{$folder}");
        // if (!is_dir($logPath)) {
        //     mkdir($logPath, 0755, true);
        // }

        // $logger = Log::build([
        //     'driver' => 'single',
        //     'path'   => "{$logPath}/{$channelName}.log",
        //     'level'  => 'info',
        // ]);

        // $modelName = class_basename($model);

        // $logger->info("{$modelName} {$action}: ", $model->toArray());
    }

    public function retrieved(Model $model)
    {
        $this->logAction('retrieved', $model);
    }

    // CRUD Actions =====================================================

    public function creating(Model $model)
    {
        $this->logAction('creating', $model);
    }

    public function created(Model $model)
    {
        $this->logAction('created', $model);
    }

    public function updating(Model $model)
    {
        $this->logAction('updating', $model);
    }

    public function updated(Model $model)
    {
        $this->logAction('updated', $model);
    }

    public function saving(Model $model)
    {
        $this->logAction('saving', $model);
    }

    public function saved(Model $model)
    {
        $this->logAction('saved', $model);
    }

    public function deleting(Model $model)
    {
        $this->logAction('deleting', $model);
    }

    public function deleted(Model $model)
    {
        $this->logAction('deleted', $model);
    }

    public function restoring(Model $model)
    {
        $this->logAction('restoring', $model);
    }

    public function restored(Model $model)
    {
        $this->logAction('restored', $model);
    }

    public function forceDeleted(Model $model)
    {
        $this->logAction('force deleted', $model);
    }

    // Pivot Relations =====================================================

    public function attached($relation, $parent, $ids, $attributes)
    {
        $this->logAction("attached to {$relation}", $parent);
    }

    public function detached($relation, $parent, $ids)
    {
        $this->logAction("detached from {$relation}", $parent);
    }

    public function synced($relation, $parent, $changes)
    {
        $this->logAction("synced {$relation}", $parent);
    }
}
