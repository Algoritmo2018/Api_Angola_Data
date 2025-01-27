<?php

namespace App\DTOs\Comunes;

use App\Http\Requests\Comune\StoreComuneRequest;

class CreateComuneDTO
{
    public function __construct(
        public string $name, 
        public int $municipality_id, 
    ) {}

    public static function makeFromRequest(StoreComuneRequest $request): self
    {
        return new self(
            $request->name,
            $request->municipality_id, 
        );
    }
}
