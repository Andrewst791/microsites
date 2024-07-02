<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'                  => 'required',
//            'email'                 => 'required|string|lowercase|email|max:255|unique:'.User::class,
//            'password_confirmation' => 'nullable|string|min:8|confirmed',
            'password'              => ['sometimes', 'required', 'confirmed', Rules\Password::defaults()],
            'role'                  => 'required|exists:roles,name',
        ];
    }
}
