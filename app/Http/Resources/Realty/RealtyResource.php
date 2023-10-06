<?php

namespace App\Http\Resources\Realty;

use App\Http\Resources\JsonResource;
use Enraiged\Support\Resources\DatetimeAttributeResource as Datetime;

class RealtyResource extends JsonResource
{
    public function toArray($request): array
    {
        $resource = [
            'id' => $this->id,
            'text' => $this->text,
            'active' => $this->active,
            'created' => Datetime::from($this)->attribute('created_at'),
            'created_at' => $this->created_at,
        ];


        if ($this->created_at !== $this->updated_at) {
            $resource['updated'] = Datetime::from($this)->attribute('updated_at');
        }

        return $resource;
    }


}
