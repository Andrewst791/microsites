<?php

namespace App\Http\Requests;

use App\Constants\DocumentTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiteRequest extends FormRequest
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
            'name'          => 'required|string|max:100',
            'slug'          => 'required|string|max:50',
            'document_type' => [
                'required',
                Rule::in(array_column(DocumentTypes::cases(), 'name'))
            ],
            'document'      => 'required|string|max:20',
            'category_id'   => 'required|integer|exists:categories,id',
        ];
    }
}
