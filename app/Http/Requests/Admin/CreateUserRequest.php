<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    } 

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', Password::defaults()],
            'name' => ['string', 'max:255'],
            'gender' => ['string', 'in:male,female'],
            'address' => ['string', 'max:255'],
            'phone' => ['string', 'max:255'],
            'school' => ['string', 'max:255'],
        ];
    }
}
