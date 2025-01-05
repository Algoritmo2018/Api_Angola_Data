<?php

namespace App\DTOs\Province;

use App\Http\Requests\Province\UpdateProvinceRequest;

class UpdateProvinceDTO
{
    public function __construct(
        public int $id,
        public string $name = '', 
    ) {}

    public static function makeFromRequest(UpdateProvinceRequest $request): self
    {
return new self(
    $request->id,
    $request->name ?? '', 
);
    }
}
