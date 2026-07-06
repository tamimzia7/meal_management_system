<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rate' => ['required', 'numeric', 'min:0', 'max:999999.99'],
        ];
    }

    public function messages(): array
    {
        return [
            'rate.required' => 'Please enter the per meal rate.',
            'rate.numeric' => 'Rate must be a valid number.',
            'rate.min' => 'Rate cannot be negative.',
        ];
    }
}
