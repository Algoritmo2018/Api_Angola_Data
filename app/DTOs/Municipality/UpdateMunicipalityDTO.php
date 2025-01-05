<?php

namespace App\DTOs\Municipality;

use App\Http\Requests\Municipality\UpdateMunicipalityRequest;

class UpdateMunicipalityDTO
{
    public function __construct(
        public int $id,
        public string $name='', 
        public int $province_id=0,  
    ) {}

    public static function makeFromRequest(UpdateMunicipalityRequest $request): self
    {
return new self(
    $request->id,
    $request->name ?? '',
    $request->province_id ?? 0,  
);
    }
}
