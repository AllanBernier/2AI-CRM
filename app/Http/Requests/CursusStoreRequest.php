<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursusStoreRequest extends FormRequest
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
            'name' => '',
            'product_id' => '',
            'customer_id' => '',
            'tjm' => '',
            'travelling_expenses' => '',
            'location' => '',
            'status' => '',
            'send_to_customer' => '',
            'send_to_subcontractors' => ''
        ];

    }
}
