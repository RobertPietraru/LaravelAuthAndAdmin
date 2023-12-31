<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'gender' => ['string', 'in:male,female'],
            'address' => ['string', 'max:255'],
            'phone' => ['string', 'max:255'],
            'school' => ['string', 'max:255'],
        ];
    }
}
