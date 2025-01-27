<?php

namespace App\Http\Resources;

use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComuneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'municipality_id' => $this->municipality_id,
            'municipality' =>  Municipality::where('id', $this->municipality_id)->with('province')->first(),
        ];
    }
}
