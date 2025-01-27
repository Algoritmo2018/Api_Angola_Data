<?php

namespace App\DTOs\Comunes;

use App\Http\Requests\Comune\UpdateComuneRequest;

class UpdateComuneDTO
{
    public function __construct(
        public int $id,
        public string $name='', 
        public int $municipality_id=0,  
    ) {}

    public static function makeFromRequest(UpdateComuneRequest $request): self
    {
return new self(
    $request->id,
    $request->name ?? '',
    $request->municipality_id ?? 0,  
);
    }
}
