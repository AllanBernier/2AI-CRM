<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcontractorStoreRequest extends FormRequest
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
            'first_name' => '',
            'last_name' => '',
            'email_perso' => '',
            'email_company' => '',
            'phone' => '',
            'company_name' => '',
            'city' => '',
            'subcontractor_id' => '',
        ];
    }
}
