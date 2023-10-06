<?php

namespace App\Http\Resources\Realty;

class IndexResource extends RealtyResource
{
    public function toArray($request): array
    {
        return collect(parent::toArray($request))
            ->toArray();
    }

}
