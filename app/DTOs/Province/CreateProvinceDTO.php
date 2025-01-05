<?php

namespace App\DTOs\Province;

use App\Http\Requests\Province\StoreProvinceRequest;

class CreateProvinceDTO
{
    public function __construct(
        public string $name, 
    ) {}

    public static function makeFromRequest(StoreProvinceRequest $request): self
    {
        return new self(
            $request->name, 
        );
    }
}
