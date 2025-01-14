<?php

namespace Enraiged\Support\Database\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait DeletedBy
{
    /**
     *  @return void
     */
    public static function bootDeletedBy()
    {
        self::deleting(fn ($model) => $model->setDeletedBy());
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'deleted_by');
    }

    /**
     *  @return array
     */
    public function getDeletedAttribute()
    {
        return [
            'at' => $this->atTimestamp($this->deleted_at),
            'by' => $this->byUser($this->deletedBy),
        ];
    }

    /**
     *  @return void
     */
    private function setDeletedBy()
    {
        if (Auth::check()) {
            $this->deleted_by = Auth::id();
        }
    }
}
