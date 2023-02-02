<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'client_name' => 'nullable|string',
            'user_id' => 'nullable|string',
            'service_id' => 'required|string',
            'starting_date' => 'required|string',
            'ending_date' => 'required|string',
            'value' => 'nullable|string',
            'value_paid' => 'nullable|string',
            'value_payable' => 'nullable|string',
            'documents' => 'nullable',
            'cover' => 'nullable',
            'description' => 'required|string',
            'short_description' => 'required|string',
        ];
    }
}
