<?php

namespace App\Http\Requests\Municipality;

use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMunicipalityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'min:1',
                'max:255',
                'unique:municipalities',
            ],
            'province_id' => [
                'numeric',
                'min:1',
            ],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Verificando se a provincia selecionada existe
            $provinceExists = Province::where('id', $this->province_id)->exists();

            if (!$provinceExists) {
                $validator->errors()->add($this->province_id, 'A provincia selecionada não existe');
            }
        });
    }
}
