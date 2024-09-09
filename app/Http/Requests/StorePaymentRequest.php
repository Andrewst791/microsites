<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'reference'             => 'nullable',
            'description'           => 'nullable',
            'amount'                => 'nullable',
            'currency_id'           => 'required|exists:currencies,id',
            'status'                => 'nullable',
            'gateway'               => 'required',
            'process_identifier'    => 'nullable',
            'expiration'            => 'nullable',
            'fields_data'           => 'nullable',
            'site_id'               => 'required|exists:sites,id',
            'user_id'               => 'required|exists:users,id',
        ];
    }
}
