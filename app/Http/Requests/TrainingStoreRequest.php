<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingStoreRequest extends FormRequest
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
            'status' => '',
            'product_id' => '',
            'customer_id' => '' ,
            'subcontractor_id' => '',
            'tjm_client' => '',
            'tjm_subcontractor' => '',
            'duree' => '',
            'start_date' => '',
            'end_date' => '',
            'num_session' => '',
            'num_bdc' => '',
            'travelling_expenses' => '',
            'location' => '',
            'text' => '',
            'action_customer' => '',
            'action_subcontractor' => '',
            'name' => '',
            'cursus_id' => '',
            'company_invoice_id' => '',
            'company_invoice_status' => '',
            'bdc_file' => '',
         ];
    }
}
