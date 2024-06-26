<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'code' => '',
            'description' => '',
            'url' => '',
            'tjm' => '',
            'duree' => '',
            'company_id' => 'exists:App\Models\Company,id',
            'tjm_type_id' => ''
        ];
    }
}
