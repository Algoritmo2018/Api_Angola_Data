<?php

namespace App\DTOs\Municipality;

use App\Http\Requests\Municipality\StoreMunicipalityRequest;

class CreateMunicipalityDTO
{
    public function __construct(
        public string $name, 
        public int $province_id, 
    ) {}

    public static function makeFromRequest(StoreMunicipalityRequest $request): self
    {
        return new self(
            $request->name,
            $request->province_id, 
        );
    }
}
