<?php

namespace App\Http\Requests\Comune;

use App\Models\Municipality;
use Illuminate\Foundation\Http\FormRequest;

class StoreComuneRequest extends FormRequest
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
                'required',
                'string',
                'min:1',
                'max:255',
                'unique:comunes',
            ],
            'municipality_id' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
               // Verificando se o municipio selecionado existe
            $municipalityExists = Municipality::where('id', $this->municipality_id)->exists();

            if (!$municipalityExists) {
                $validator->errors()->add($this->municipality_id, 'O municipio selecioinado não existe');
            }
        });
    }
}
