<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyMealRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'company_person';
    }

    public function rules(): array
    {
        return [
            'breakfast_meal' => ['required', 'integer', 'min:0'],
            'lunch_meal' => ['required', 'integer', 'min:0'],
            'dinner_meal' => ['required', 'integer', 'min:0'],
            'remarks' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'breakfast_meal.required' => 'Please enter the number of breakfasts needed.',
            'lunch_meal.required' => 'Please enter the number of lunches needed.',
            'dinner_meal.required' => 'Please enter the number of dinners needed.',
        ];
    }
}
