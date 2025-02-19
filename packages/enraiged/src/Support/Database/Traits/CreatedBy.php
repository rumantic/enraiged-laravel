<?php

namespace Enraiged\Support\Database\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait CreatedBy
{
    use AtTimestamp, ByUser;

    /**
     *  @return void
     */
    public static function bootCreatedBy()
    {
        self::creating(fn ($model) => $model->setCreatedBy());
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'created_by');
    }

    /**
     *  @return array
     */
    public function getCreatedAttribute()
    {
        return [
            'at' => $this->atTimestamp($this->created_at),
            'by' => $this->byUser($this->createdBy),
        ];
    }

    /**
     *  @return void
     */
    private function setCreatedBy()
    {
        if (Auth::check()) {
            $this->created_by = Auth::id();
        }
    }
}
